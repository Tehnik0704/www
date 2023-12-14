<?php

/** @var \Citrus\Developer\Components\ResidentalComplex\Component $parentSectionId */

use Bitrix\Main\Localization\Loc;
use Citrus\Developer\Iblock;

$this->setFrameMode(true);

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$APPLICATION->SetTitle(Loc::getMessage("CITRUS_DEVELOPER_COMPLEX_SELECT_APARTMENT_TITLE"));
?>
<?php $parentSectionId = Iblock\ForeignIblock::getSectionId($component->getJhk('ID'), Iblock::getId(Iblock::APARTMENTS));

$showCostM2 = Iblock\OrmPropertyFormatter::showCostM2('PLAN_PRICE_MODE');
foreach ($arParams['FIELDS'] as $i => $col) {
	if ($col['code'] == 'cost_m2') {
		if (!$showCostM2) {
			$arParams['FIELDS'][$i]['code'] = 'cost';
		}
	}
}

$selectApartmentView = function () use ($component, $arParams, $arResult, $APPLICATION, $showCostM2, $parentSectionId) {
?>

	<div class="tabs-nav-area">
		<div class="tabs-menu-w">

			<nav class="tabs-menu">

				<a href="#tabs-0" class="tabs-menu__item _selected" data-tabs="tabs-list">
					<span class="tabs-menu__item-inner"><?php echo Loc::getMessage("CITRUS_DEVELOPER_COMPLEX_SELECT_APARTMENT_TAB_1"); ?></span>
				</a>

				<a href="#tabs-1" class="tabs-menu__item" data-tabs="tabs-list">
					<span class="tabs-menu__item-inner"><?php echo Loc::getMessage("CITRUS_DEVELOPER_COMPLEX_SELECT_APARTMENT_TAB_2"); ?></span>
				</a>

			</nav>

			<script>
				;
				(function() {
					$('[data-tabs]').on('click', function(event) {
						event.preventDefault();

						var $tabsList = $('[data-tabs=' + $(this).data('tabs') + ']');

						$tabsList.removeClass('_selected');

						$(this).addClass('_selected');

						$tabsList.each(function() {
							if (!$(this).hasClass('_selected')) {
								$($(this).attr('href')).removeClass('_selected');
							} else {
								$($(this).attr('href')).addClass('_selected');
							}
						});
					});
				}());
			</script>

		</div>
	</div>

	<div id="tabs-0" class="tabs-content _selected">
		<? $APPLICATION->IncludeComponent(
			"citrus.developer:template",
			"favorites-planing",
			array(
				'XML_ID' => $component->getJhk('XML_ID'),
				'APARTMENTS_ID' => Iblock::getId(Iblock::APARTMENTS),
				'URL_TEMPLATE_PATH' => $arResult["URL_TEMPLATES_PATH"]["flat_detail"]
			),
			$component,
			array("HIDE_ICONS" => "Y")
		); ?>
	</div>
	<div id="tabs-1" class="tabs-content">
		<? $APPLICATION->IncludeComponent(
			"citrus.developer:complex.catalog.smart.filter",
			".default",
			array(
				"VIEW_TEMPLATE" => ".default",

				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"DISPLAY_ELEMENT_COUNT" => "N",
				"FILTER_NAME" => $arParams["FILTER_NAME"],
				"FILTER_VIEW_MODE" => "vertical",
				"IBLOCK_ID" => Iblock::getId(Iblock::APARTMENTS),
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"INSTANT_RELOAD" => "N",
				"POPUP_POSITION" => "left",
				"SAVE_IN_SESSION" => "N",
				"SECTION_ID" => $parentSectionId,
				"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
				"XML_EXPORT" => "Y",
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"SEF_MODE" => "N",
				"SEF_RULE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["smart_filter"],
				"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
				"AJAX_LIST_COLUMNS" => $arParams['FIELDS'],
				"JK_ID" => $component->getJhk('ID'),
				"SHOW_COST_M2" => $showCostM2,
			),
			$component,
			array('HIDE_ICONS' => 'Y')
		); ?>

		<? $APPLICATION->IncludeComponent(
			"citrus.developer:template",
			"favorites",
			array(
				'URL_TEMPLATES_PATH' => $arResult['URL_TEMPLATES_PATH'],
				'TEMPLATE' => 'OFFERS',
				'PROPERTY_LIST' => $arParams['FIELDS'],
			),
			false,
			array("HIDE_ICONS" => "Y")
		); ?>
	</div>
<?php
};
?>
<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	"developer",
	array(
		"TITLE" => $APPLICATION->GetTitle(),
		"DESCRIPTION" => Loc::getMessage("CITRUS_DEVELOPER_COMPLEX_SELECT_APARTMENT_SUBTITLE"),
		"AREA_FILE_SHOW" => "function",
		"VIEW_FUNCTION" => $selectApartmentView,
		"h" => "h1",
		"SECTION_HEADER_CLASS" => "_min",
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"DATA_SRC" => "select-apartment",
	),
	false
); ?>

<?
$GLOBALS['SPECIAL_FILTER'] = [
	'PROPERTY_quick_sale_VALUE' => 'Y',
	'PROPERTY_complex' => $component->getJhk('XML_ID')
]; ?>
<?php ob_start() ?>
<? $APPLICATION->IncludeComponent(
	"citrus.developer:complex.catalog.section",
	".default",
	array(
		"VIEW_TEMPLATE" => "flat-slider",

		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => Iblock::getId(Iblock::APARTMENTS),
		"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
		"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
		"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
		"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
		"PROPERTY_CODE" => array('common_area', 'cost'),
		"INCLUDE_SUBSECTIONS" => "Y",

		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],

		"FILTER_NAME" => 'SPECIAL_FILTER',
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => 'Y',
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"SECTION_ID" => '',
		"SHOW_ALL_WO_SECTION" => 'Y',
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
		'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
		"ADD_SECTIONS_CHAIN" => "Y",
		"SECTION_USER_FIELDS" => array("UF_TYPE", "UF_PROP_LINK", "UF_SORT_FIELDS"),
		"EMPTY_LIST_MESSAGE" => $arParams['EMPTY_LIST_MESSAGE'],
		"USING_PRICE_MODE" => "FLAT_PRICE_MODE",
	),
	$component
); ?>
<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"TITLE" => Loc::getMessage("FLAT_SLIDER_SECTION_TITLE"),
		"DESCRIPTION" => Loc::getMessage("CITRUS_DEVELOPER_COMPLEX_SELECT_APARTMENT_SPECIAL_OFFERS_SUB"),
		"AREA_FILE_SHOW" => "html",
		"h" => ".h1",
		"HTML" => ob_get_clean(),
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"DATA_SRC" => "specialoffers-select-apartment",
	),
	false
); ?>

<? require __DIR__ . '/block_contacts.php'; ?>

<? require __DIR__ . '/block_callout.php'; ?>