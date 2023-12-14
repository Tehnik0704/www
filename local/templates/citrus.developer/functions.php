<?php

namespace Citrus\Developer\Template;

use Citrus\Arealty\Object\GeoProperty;
use Citrus\Developer\Iblock\PropertyFormatter;
use Citrus\Yandex\Geo\GeoObject;
use Bitrix\Main\Web\Json;
use Bitrix\Main\Localization\Loc;
use Citrus\Developer\Theme;
use Spatie\HtmlElement\HtmlElement;
use Citrus\Core\SolutionFactory;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

Loc::loadMessages(__FILE__);

class Property extends PropertyFormatter
{

	public static $propertyIcon = [
		'geodata' => 'icon-map',
		'PHONE' => 'icon-phone',
		'TIMETABLE' => 'icon-time',
		'EMAIL' => 'icon-mail',
	];

	public function getPropertyIcon ($propertyCode = '') {
		return static::$propertyIcon[$propertyCode] ?: '';
	}

	public function formatValue($propertyCode, $value, $display = true, $withHint = true)
	{
		if (!$value) return $value;

		switch ($propertyCode) {
			case 'geodata':
				$value = $this->getMapLink(false);
				break;
			case 'email':
			case 'EMAIL':
				$value = '<a href="mailto:'.$value.'">'.$value.'</a>';
				break;
			case 'phone':
            case 'phones':
            case 'PHONE':
            case 'PHONES':
                $value = \Citrus\Arealty\Helper::formatPhoneNumber($value, '');
                break;
		}

		return parent::formatValue($propertyCode, $value, $display = true, $withHint = true);
	}

	public function getDescription ($propertyCode, $key = 0) {
		return $this->item['PROPERTIES'][$propertyCode]['DESCRIPTION'][$key];
	}

	public function getArValues ($propertyCode) {
		$value = $this->getValue($propertyCode);
		return (is_array($value) && $value[0]) ? $value : [$value];
	}

	public function valueWalk ($propertyCode = '', $f) {
		if (!$f) return;
		$value = $this->getValue($propertyCode);
		$arValue = (is_array($value) && $value[0]) ? $value : [$value];
		array_walk($arValue, $f);
	}

	public function getMapLink($icon = true)
	{
		/**
		 * @var GeoObject $geodata
		 */
		$geodata = $this->getValue('geodata');
		$address = GeoProperty::formatAddress($geodata, false);
		if (!$address)
		{
			return '';
		}

		$dataCoords = null;
		if ($geodata->getLatitude() && $geodata->getLongitude())
		{
			$dataCoords = ' data-coords="' . Json::encode([
				$geodata->getLatitude(),
				$geodata->getLongitude(),
			]) . '"';
		}

		ob_start();

		if (\Citrus\Core\YandexMap::hasKey())
		{

		?><a href="javascript:void(0);"
           class="map-link"
           title="<?=$address?>"
           data-address="<?=$address?>"
           <?=$dataCoords?>
        >
			<?if($icon):?>
				<span class="map-link__icon <?=static::$propertyIcon['geodata']?>"></span>
			<?endif;?>
            <span><?=$address?></span>
        </a>
		<?php

		\CJSCore::Init(['realtyAddress']);

		}
		else
		{
			?><span class="map-link"><?=$address?></span><?php
		}

		return ob_get_clean();
	}

	public function shareLabel($check = true)
	{
		$isSuccessCheck = !$check || $this->hasValue('special') || $this->hasValue('quick_sale');
		return $isSuccessCheck ?
			'<span class="share-label theme--color"><span class="share-label__inner"><span class="share-label__text">' . Loc::getMessage("FUNCTIONS_SHARE_LABEL") . '</span></span></span>' : '';
	}
}

class HeaderContent
{
	public static function getLogoImage()
	{
		$SettingsTable = SolutionFactory::get()->settings();
		$theme = new Theme(SITE_ID, null, null, 'main-template');
		$logoSizes = $SettingsTable::getValue('LOGO_SHOW_TEXT') === 'Y' ? ["width"=>70, "height"=>90] : ["width"=>240, "height"=>90];
		return $SettingsTable::getValue('LOGO') ?
			$SettingsTable::getLogoPath($logoSizes) :
			$theme->getPath() . 'logo.png';
	}

	public static function getSplitCompanyName()
	{
		$SettingsTable = SolutionFactory::get()->settings();
		if (!$companyName = $SettingsTable::getValue("SITE_NAME"))
		{
			return [Loc::getMessage("FUNCTIONS_DEFAULT_SITE_NAME_1"), Loc::getMessage("FUNCTIONS_DEFAULT_SITE_NAME_2")];
		}
		$arName = explode(' ', trim($companyName));
		$arNameLast = array_pop($arName); //last word
		$arNameFirst = implode(' ', $arName);

		return [$arNameFirst, $arNameLast];
	}

	public static function workarea()
	{
		global $APPLICATION;

		if ($APPLICATION->GetProperty('SHOW_TITLE', 'Y') === 'Y')
		{
			$subheaderHtml = '';
			if ($subheader = $APPLICATION->GetProperty('PAGE_SUBHEADER'))
			{
				$subheaderHtml = HtmlElement::render('.section-description', $subheader);
			}

			$title = $APPLICATION->GetPageProperty('pageH1', 'h1#pagetitle');

			$pageSectionClass = trim($APPLICATION->GetPageProperty('pageSectionClass'));
			$pageSectionClass = $pageSectionClass ? ' ' . $pageSectionClass : '';

			$pageSectionContentClass = trim($APPLICATION->GetPageProperty('pageSectionContentClass'));
			$pageSectionContentClass = $pageSectionContentClass ? ' ' . $pageSectionContentClass : '';

			$titleHtml = HtmlElement::render($title, $APPLICATION->GetTitle(false));

			$blockStart = <<<HTML
<section class="section section--page-wrapper _with-padding$pageSectionClass">
	<div class="w">
		<div class="section-inner">
			<header class="section__header">
			    {$titleHtml}
				{$subheaderHtml}
			</header><!-- .section__header -->
			<div class="section__content$pageSectionContentClass">

HTML;
			$APPLICATION->AddViewContent('workarea-start', $blockStart);

			$blockEnd = <<<HTML
			</div><!-- .section__content -->
		</div><!-- .section-inner -->
	</div><!-- .w -->
</section>
HTML;
			echo $blockEnd;
		}

		$APPLICATION->ShowViewContent('workarea-end');

	}
}

function getMimeTypeByExtension($fname)
{
	$extension = strtolower(trim(pathinfo($fname, PATHINFO_EXTENSION)));
	$extensions = [
		'svg' => 'image/svg+xml',
	];
	return isset($extensions[$extension])? $extensions[$extension] : ('image/' . $extension);
}

function showFavicon($theme)
{
	$SettingsTable = SolutionFactory::get()->settings();
	$iconUrl = $SettingsTable::getValue('FAVICON') ?: $theme->getPath() . 'logo.png';
	$iconFile = $_SERVER['DOCUMENT_ROOT'] . $iconUrl;
	if (!file_exists($iconFile)) {
		return;
	}
	$mime = '';
	// mime_content_type can detect svg, getimagesize - not
	if (function_exists('mime_content_type'))
	{
		$mime = mime_content_type($iconFile);
	}
	else
	{
		$size = getimagesize($iconFile);
		$mime = is_array($size) ? $size['mime'] : false;
	}
	if (empty($mime))
	{
		$mime = getMimeTypeByExtension($iconFile);
	}

	return <<<HTML
<link data-settings="SCHEME_FAVICON" rel="icon" type="$mime" href="$iconUrl" />
HTML;
}

function getAgreementLinkTitle()
{
	return SITE_SERVER_NAME ?: $_SERVER['SERVER_NAME'] . (SITE_DIR !== '/' ? SITE_DIR : '');
}

function getAgreementLinkUrl()
{
	return \CHTTP::URN2URI(SITE_DIR, SITE_SERVER_NAME ?: $_SERVER['SERVER_NAME']);
}
