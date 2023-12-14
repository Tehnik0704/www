<?php

use Bitrix\Main\Config\Configuration;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Localization\Loc;
use Citrus\Developer\Components\JkFormatter;
use Citrus\Developer\Iblock\ForeignIblock;
use Citrus\Developer\Template\HeaderContent;
use Citrus\Developer\Iblock;
use Arrilot\BitrixHermitage\Action;
use Citrus\Core\SolutionFactory;

use function Citrus\Developer\Template\showFavicon;

$asset = Asset::getInstance();
$appPath = SITE_TEMPLATE_PATH . '/app/';

//header messages
Loc::loadMessages($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/header.php');

$asset->addCss(SITE_TEMPLATE_PATH.'/jk-template/style.css');
$asset->addJs(SITE_TEMPLATE_PATH.'/jk-template/script.js');

/**
 * Shampka podklyuchaetsya cherez otlozhennuyu funktsiyu,
 * zdesy uzhe dostupen instans kompleksnogo komponenta, kotoriy bil poklyuchen na stranitse
 *
 * @var $complex Citrus\Developer\Components\ResidentalComplex\Component
 */
$complex = Citrus\Developer\Components\ResidentalComplex\Component::getInstance();
$settings = \Citrus\Developer\Entity\JkSettingsService::getInstance();
$settingsBlocks = $settings->get('blocks');

$SettingsTable = SolutionFactory::get()->settings();

#theme
$theme = new Citrus\Developer\Theme(SITE_ID, $settings->get('THEME'), null, 'jk-template');
$mainTheme =  new Citrus\Developer\Theme(SITE_ID, null, null, 'main-template');
$asset->addCss($theme->getPath() . '/colors.css', true);

$APPLICATION->AddViewContent('html-head', showFavicon($theme));

$asset->addString("<script>
	window.citrusTemplateColor = '#".$theme->getColor()."';
	window.citrusMapIcon = {
		href: '". CUtil::JSEscape($theme->getPath(). 'map.png') ."',
		size: [32, 52],
		offset: [-16, -48]
	};
</script>
");

$router = $complex->getRouter();
$arJk = $complex->getJhk();
$arHouse = $complex->getHouse();
$arOffice = $complex->getOffice();

if (($jkLogoId = $settings->get('LOGO')) && is_numeric($jkLogoId))
{
    $logoHref = CFile::ResizeImageGet($jkLogoId, ['width' => 240, 'height' => 90], BX_RESIZE_IMAGE_PROPORTIONAL)['src'];
}
else
{
	$logoHref = $settings->get('LOGO', true);
}
CJSCore::Init(['favorites']);

?>

<? ob_start();?>

<?if(Configuration::getValue('citrus_demo') || $APPLICATION->GetUserRight('citrus.developer') >= 'W'):
	$APPLICATION->IncludeComponent(
	    "citrus.core:settings.widget.placeholder",
	    "",
	    [
	    	"DATA" => [
	    		"COMPONENT" => "citrus.developer:jk.settings.widget",
		    	"COMPONENT_TEMPLATE" => "",
		        "CACHE_TYPE" => "N",
				'JK_ID' => $settings->getJkId(),
            	"DEMO_MODE" => $settings->isDemoMode() ? 'Y' : 'N',
	    	],
	    ],
		null,
		['HIDE_ICONS' => 'Y']
	)?>
<?endif;?>

<script>
	BX.message({
		CITRUS_DEVELOPER_PDF_SEND_PROMPT: '<?=Loc::getMessage("SEND_PDF_TITLE")?>',
		CITRUS_DEVELOPER_PDF_SEND_RESULT: '<?=Loc::getMessage("SEND_PDF_SUCCESS")?>'
	});
</script>

    <header class="h _jk">
        <div class="h__top js-header-fixed">
            <div class="w">
                <div class="h__inner">
                    <a
	                    data-settings="show_header_name"
	                    href="<?=$router->getUrl('about')?>"
                       class="h__logo _jk <?=$settings->get('show_header_name') ? '_with-text' : ''?>"
                       id="<?=Action::editIBlockElement($complex, $complex->getJhk('ID'))?>">
                        <span class="logo-image__w">
	                        <img
		                        data-settings="SCHEME_LOGO"
		                        src="<?=$logoHref ?: $theme->getPath() . 'logo.png'?>"
                                alt=""
	                            width="240">
                        </span>
	                    <span class="logo__text">
                            <span class="logo__text-1">Жилой дом</span>
                            <span class="logo__text-2" >&ldquo;<span  data-settings="NAME"><?=$settings->get('NAME', true)?></span>&rdquo;</span>
                        </span>
                    </a>
                    <div class="h__right">
                        <div class="h__right-1">
                            <a href="tel:<?=$arOffice['PROPERTIES']['PHONE']['VALUE'][0]?>"
                               class="h__phone-number  display-md-b">
	                            <?=$arOffice['PROPERTIES']['PHONE']['VALUE'][0]?>
                            </a>
                            <a href="tel:<?=$arOffice['PROPERTIES']['PHONE']['VALUE'][0]?>" class="h__order-call print-hidden">
                                <i class="icon-phone" aria-hidden="true"></i>
                            </a>
                            <a href="<?=$router->getUrl('favorites')?>" class="h__right-icon display-xs-n display-sm-f display-dt-n print-hidden">
	                            <i class="icon-heart"><span class="h__right-icon-favorite__counter js-favorites-count"></span></i>
                            </a>
                            <a href="javascript:void(0);" class="h__gabmurder hamburger display-dt-n display-xs-f js-toggle-menu print-hidden">
                                <span class="lines"></span>
                            </a>
                            <script>bindModalLinks();</script>
							<? $APPLICATION->IncludeComponent(
								"citrus:currency",
								'',
								[
									'HIDE_DROPDOWN' => 'Y',
									'BASE' => $SettingsTable::getValue('CURRENCY'),
									'CURRENT' => $SettingsTable::getValue('CURRENCY'),
									'CURRENT_CURRENCY_FACTOR' => $SettingsTable::getValue('CURRENCY_FACTOR'),
								],
								null,
								['HIDE_ICONS' => 'Y']
							); ?>
							<script>
								(function () {
									if ('currency' in window) {
										if (currency.base != currency.getFromStorage()) {
											currency.setCurrent(currency.base, true, true);
										}
									}
								})();
							</script>
                        </div>

						<span data-settings="hide_developer_block" class="<?= $settings->get('hide_developer_block')? 'hidden' : '' ?>">
							<?$isLogoText = $SettingsTable::getValue('LOGO_SHOW_TEXT') == 'Y'?>
		                    <a href="<?= $complex->getLinkUrl($settings->get('url_developer_block')) ?>" class="h__logo _developer  <?if($isLogoText):?>_with-text<?endif;?>"
		                    	data-settings="url_developer_block" >
	                            <span class="logo-image__w">
		                            На сайт<br>Алтай-Строй
	                            </span>
		                        <?if($isLogoText && $arCompanyName = HeaderContent::getSplitCompanyName()):?>
	                            <span class="logo__text">
	                                <span class="logo__text-1"><?=$arCompanyName[0]?></span>
	                                <span class="logo__text-2"><?=$arCompanyName[1]?></span>
	                            </span>
		                        <?endif;?>
	                        </a>
	                   	</span>
                    </div><!-- .h__right -->
                </div><!-- .h__inner -->
            </div><!-- .w -->
        </div><!-- .h__top -->

	    <div class="content-overlay"></div>
	    <div class="main-menu-w jk-menu-fixed print-hidden">
        <?$APPLICATION->IncludeComponent(
	        "bitrix:menu",
	        "main-menu-jk",
	        Array(
		        "ALLOW_MULTI_SELECT" => "N",
		        "CHILD_MENU_TYPE" => "left",
		        "DELAY" => "N",
		        "MAX_LEVEL" => "1",
		        "MENU_CACHE_GET_VARS" => array(""),
		        "MENU_CACHE_TIME" => "3600",
		        "MENU_CACHE_TYPE" => "Y",
		        "MENU_CACHE_USE_GROUPS" => "N",
		        "ROOT_MENU_TYPE" => "jk",
		        "USE_EXT" => "N",
	        )
        );?>
	    </div>
    </header>

    <?#slider?>
	<?if(!defined('ERROR_404') && in_array($router->getCurrentPage(), array('about', 'house_detail'))):?>
		<?$parent = ($router->getCurrentPage() === 'house_detail') ? $arHouse : $arJk ?>
		<?if ($sliderSection = ForeignIblock::getSectionId($parent, Iblock::SLIDER)):?>
			<? $APPLICATION->IncludeComponent(
				"citrus.core:include",
				".default",
				array(
					"PATH" => $complex->getTemplate()->GetFolder()."/blocks/slider.php",
					"TITLE" => "",
					"DESCRIPTION" => "",
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "clear.php",
					"PAGE_SECTION" => "N",
					"COMPONENT_TEMPLATE" => ".default",
					"BG_COLOR" => "N",
					"COMPOSITE_FRAME_MODE" => "A",
					"COMPOSITE_FRAME_TYPE" => "AUTO",
					"WIDGET_REL" => "slider",
					"JK_SETTINGS" => $settingsBlocks,
					"SECTION_ID" => $sliderSection
				),
				false
			); ?>
		<?endif;?>
	<?endif;?>

<?$APPLICATION->AddViewContent('header', ob_get_clean())?>

