<?php

use Bitrix\Main\Config\Configuration;
use Bitrix\Main\Page\Asset;
use Citrus\Core\SolutionFactory;

use function Citrus\Developer\Template\showFavicon;

$asset = Asset::getInstance();
$appPath = SITE_TEMPLATE_PATH . '/app/';
$asset->addCss(SITE_TEMPLATE_PATH.'/main-template/style.css');
#theme
$theme = new Citrus\Developer\Theme(SITE_ID, null, null, 'main-template');
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

$bCitrusTemplateIndex = $APPLICATION->GetCurPage(false) === SITE_DIR;

$SettingsTable = SolutionFactory::get()->settings();

ob_start();

?>

<?if(Configuration::getValue('citrus_demo') || $APPLICATION->GetUserRight('citrus.developer') >= 'W'):
	$APPLICATION->IncludeComponent(
	    "citrus.core:settings.widget.placeholder",
	    "",
	    [
	    	"DATA" => [
	    		"COMPONENT" => "citrus.developer:settings.widget",
		    	"COMPONENT_TEMPLATE" => "",
		        "CACHE_TYPE" => "N",
				"DEMO_MODE" => $APPLICATION->GetUserRight('citrus.developer') < 'W' && Configuration::getValue('citrus_demo') ? 'Y' : 'N',
	    	],
	    ],
		null,
		['HIDE_ICONS' => 'Y']
	)?>
<?endif;?>

<header class="h">
	<div class="h-fixed js-header-fixed">
		<div class="w">
			<div class="h__inner">
				<?php
				$isLogoText = $SettingsTable::getValue('LOGO_SHOW_TEXT') == 'Y'?>

				<?ob_start();?>
				<a href="<?=SITE_DIR?>" data-settings="LOGO_SHOW_TEXT" class="h__logo <?if($isLogoText):?>_with-text<?endif;?>">
                    <span class="logo-image__w">
                       <img data-settings="SCHEME_LOGO"
                            data-settings-rel="logo"
                            src="<?=$SettingsTable::getLogoPath(['width' => 240, 'height' => 90]) ?: $theme->getPath() . 'logo.png'?>"
                            alt="">
                    </span>

					<?$arCompanyName = \Citrus\Developer\Template\HeaderContent::getSplitCompanyName();?>
					<span class="logo__text">
						<span class="logo__text-1"
						      data-settings="SITE_NAME"
						      data-settings-rel="text1">
							<?=$arCompanyName[0]?></span>
                        <span class="logo__text-2"
                              data-settings="SITE_NAME"
                              data-settings-rel="text2">
	                        <?=$arCompanyName[1]?></span>


						<span
							class="logo__description <?if(!$SettingsTable::getValue('DESCRIPTION')):?>hidden<?endif;?>"
							data-settings="DESCRIPTION">
							<?=$SettingsTable::getValue('DESCRIPTION')?>
						</span>

                    </span>
				</a>
				<?$htmlLogo = ob_get_contents();
				ob_get_clean();
				//add edit area
				echo $SettingsTable::showValue('SITE_NAME', $htmlLogo);
				?>

				<div class="content-overlay"></div>
				<div class="main-menu-w">
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"main-menu",
						Array(
							"ALLOW_MULTI_SELECT" => "N",
							"CHILD_MENU_TYPE" => "left",
							"DELAY" => "N",
							"MAX_LEVEL" => "1",
							"MENU_CACHE_GET_VARS" => array(""),
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_TYPE" => "N",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"ROOT_MENU_TYPE" => "top",
							"USE_EXT" => "N"
						)
					);?>
				</div>

				<div class="h__right">
					<?$GLOBALS['FILTER_MAIN_OFFICE']['MAIN_VALUE'] = 'Y'?>
					<?$APPLICATION->IncludeComponent("bitrix:news.list", "header_phone", Array(
						"ACTIVE_DATE_FORMAT" => "d.m.Y",
						"ADD_SECTIONS_CHAIN" => "N",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"CACHE_FILTER" => "N",
						"CACHE_GROUPS" => "Y",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"CHECK_DATES" => "Y",
						"COMPOSITE_FRAME_MODE" => "A",
						"COMPOSITE_FRAME_TYPE" => "AUTO",
						"DETAIL_URL" => "",
						"DISPLAY_BOTTOM_PAGER" => "N",
						"DISPLAY_DATE" => "N",
						"DISPLAY_NAME" => "N",
						"DISPLAY_PICTURE" => "N",
						"DISPLAY_PREVIEW_TEXT" => "N",
						"DISPLAY_TOP_PAGER" => "N",
						"FIELD_CODE" => array(
							0 => "",
							1 => "",
						),
						"FILTER_NAME" => "FILTER_MAIN_OFFICE",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"IBLOCK_ID" => Citrus\Developer\Iblock::getId(\Citrus\Developer\Iblock::OFFICES),
						"IBLOCK_TYPE" => "company",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"INCLUDE_SUBSECTIONS" => "N",
						"MESSAGE_404" => "",
						"NEWS_COUNT" => "5",
						"PAGER_BASE_LINK_ENABLE" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => ".default",
						"PAGER_TITLE" => "",
						"PARENT_SECTION" => "",
						"PARENT_SECTION_CODE" => "main",
						"PREVIEW_TRUNCATE_LEN" => "",
						"PROPERTY_CODE" => array(
							0 => "geodata",
							1 => "PHONE",
							2 => "TIMETABLE",
							3 => "Email",
							4 => "",
						),
						"SET_BROWSER_TITLE" => "N",
						"SET_LAST_MODIFIED" => "N",
						"SET_META_DESCRIPTION" => "N",
						"SET_META_KEYWORDS" => "N",
						"SET_STATUS_404" => "N",
						"SET_TITLE" => "N",
						"SHOW_404" => "N",
						"SORT_BY1" => "SORT",
						"SORT_BY2" => "ID",
						"SORT_ORDER1" => "ASC",
						"SORT_ORDER2" => "DESC",
						"STRICT_SECTION_CHECK" => "N",
					),
						false
					);?>
					<a href="tel:+78332712225" class="h__order-call"><i class="icon-phone" aria-hidden="true"></i></a>
					<script>bindModalLinks();</script>
					<a href="javascript:void(0);" class="h__gabmurder hamburger display-dt-n display-xs-f js-toggle-menu"><span class="lines"></span></a>
					<? $APPLICATION->IncludeComponent(
						"citrus:currency",
						'',
						[
							'HIDE_DROPDOWN' => 'Y', // R S R Rio S R S S R R S S  R R S RioRio S R  R S R R R RioS  R S RioR R R  R R S R S R R RioS  R  RATE R  R R S R R R Rio
							'BASE' => $SettingsTable::getValue('CURRENCY'),
							'CURRENT' => $SettingsTable::getValue('CURRENCY'),
							'CURRENT_CURRENCY_FACTOR' => $SettingsTable::getValue('CURRENCY_FACTOR'),
						],
						null,
						['HIDE_ICONS' => 'Y']
					); ?>
				</div>

			</div><!-- .h__inner -->
		</div><!-- .w -->
	</div>
</header>

<?if($bCitrusTemplateIndex):?>
	<? $APPLICATION->IncludeComponent(
		"citrus.core:include",
		".default",
		array(
			"PATH" => SITE_DIR."index_slider.php",
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
		),
		false
	); ?>
<?endif;?>

<main class="container">

<?$APPLICATION->AddViewContent('header', ob_get_clean());?>

</main>
