<?php

use Bitrix\Main\Localization\Loc;
use Citrus\Developer\Iblock;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var \Citrus\Developer\Components\ResidentalComplex\Component $component */

$this->setFrameMode(true);

if (!\Bitrix\Main\Loader::includeModule('citrus.developer'))
	return;

$APPLICATION->SetPageProperty('JK_TEMPLATE', '0');

$iblock = CIBlock::GetArrayByID($component->getJhkIblockId());
$router = $component->getRouter();

?>

			<?php ob_start() ?>
            <div class="project-nav-area">
                <div class="project-menu-w">
	                <?$APPLICATION->IncludeComponent(
	                    "bitrix:menu",
	                    "project-menu",
	                    Array(
	                        "ALLOW_MULTI_SELECT" => "N",
	                        "CHILD_MENU_TYPE" => "",
	                        "DELAY" => "N",
	                        "MAX_LEVEL" => "1",
	                        "MENU_CACHE_GET_VARS" => array(""),
	                        "MENU_CACHE_TIME" => "3600",
	                        "MENU_CACHE_TYPE" => "N",
	                        "MENU_CACHE_USE_GROUPS" => "Y",
	                        "ROOT_MENU_TYPE" => "project",
	                        "USE_EXT" => "Y"
	                    )
	                );?>
                </div>

                <?$citrusSort=$APPLICATION->IncludeComponent("citrus.developer:sort", "view-list", Array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "IBLOCK_TYPE" => 'realty',
                    "IBLOCK_ID" => $component->getJhkIblockId(),
                    "VIEW_LIST" => array(
                        0 => "CARDS",
                        1 => "LIST",
                        2 => "",
                    ),
                    "VIEW_DEFAULT" => "CARDS",
                ),
                    false
                );?>
            </div>
            <?php

            $GLOBALS['mainCatalogFilter']['!PROPERTY_archive_VALUE'] = 'Y';
            if ($router->getVar('spec'))
            {
            	$GLOBALS['mainCatalogFilter']['PROPERTY_special_VALUE'] = 'Y';
            }

            ?>
            <? $intSectionID = $APPLICATION->IncludeComponent(
                "citrus.developer:complex.catalog.section",
                ".default",
                array(
					"VIEW_TEMPLATE" => "catalog_cards",

                    "IBLOCK_TYPE" => 'realty',
                    "IBLOCK_ID" => $component->getJhkIblockId(),
                    "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                    "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                    "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                    "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                    "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "BASKET_URL" => $arParams["BASKET_URL"],
                    "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                    "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                    "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                    "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                    "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                    "FILTER_NAME" => 'mainCatalogFilter',
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "CACHE_FILTER" => 'Y',
                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                    "SET_TITLE" => $arParams["SET_TITLE"],
                    "MESSAGE_404" => $arParams["MESSAGE_404"],
                    "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                    "SHOW_404" => $arParams["SHOW_404"],
                    "FILE_404" => $arParams["FILE_404"],
                    "DISPLAY_COMPARE" => "N",
                    "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
                    "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                    "PRICE_CODE" => $arParams["PRICE_CODE"],
                    "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                    "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                    "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                    "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                    "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                    "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                    "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

                    "SECTION_ID" => $router->getVar('id') ?: '',
                    "SHOW_ALL_WO_SECTION" => 'Y',
                    "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                    "DETAIL_URL" => $router->getUrl('about'),
                    'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                    'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                    'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],

                    "ADD_SECTIONS_CHAIN" => "Y",

                    "SECTION_USER_FIELDS" => array("UF_TYPE", "UF_PROP_LINK", "UF_SORT_FIELDS"),
                    "CITRUS_THEME" => \Citrus\Developer\Helper::getTheme(),
                    "EMPTY_LIST_MESSAGE" => $arParams['EMPTY_LIST_MESSAGE'],
                    "VIEW" => strtolower($citrusSort["VIEW"]),
	                "URL_TEMPLATES_PATH" => $arResult['URL_TEMPLATES_PATH'],

	                "PROPERTY_CODE" => array('short_type_name'),
	                "USING_PRICE_MODE" => "JK_PRICE_MODE",
                ),
                $component
            ); ?>
			<? $APPLICATION->IncludeComponent(
				"citrus.core:include",
				".default",
				array(
					"TITLE" => $iblock['NAME'],
					"DESCRIPTION" => $iblock['DESCRIPTION'],
					"AREA_FILE_SHOW" => "html",
					"h" => "h1",
					"HTML" => ob_get_clean(),
					"PAGE_SECTION" => "Y",
					"COMPONENT_TEMPLATE" => ".default",
					"DATA_SRC" => "jk-index",
				),
				false
			); ?>

<?#archive?>
<?
$GLOBALS['archiveFilter']['PROPERTY_archive_VALUE'] = 'Y';
ob_start();
$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "catalog-slider",
    array(
        "IBLOCK_TYPE" => 'realty',
        "IBLOCK_ID" => $component->getJhkIblockId(),
        "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
        "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
        "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
        "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
        "PROPERTY_CODE" => array('geodata'),
        "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
        "INCLUDE_SUBSECTIONS" => "Y",
        "BASKET_URL" => $arParams["BASKET_URL"],
        "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
        "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
        "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
        "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
        "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
        "FILTER_NAME" => 'archiveFilter',
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "CACHE_FILTER" => 'Y',
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "SET_TITLE" => "N",
        "MESSAGE_404" => $arParams["MESSAGE_404"],
        "SET_STATUS_404" => $arParams["SET_STATUS_404"],
        "SHOW_404" => $arParams["SHOW_404"],
        "FILE_404" => $arParams["FILE_404"],
        "DISPLAY_COMPARE" => 'N',
        "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
        "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
        "PRICE_CODE" => $arParams["PRICE_CODE"],
        "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
        "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

        "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
        "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
        "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
        "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
        "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

        "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
        "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
        "PAGER_TITLE" => $arParams["PAGER_TITLE"],
        "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
        "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
        "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
        "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],

        "SECTION_ID" => '',
        "SHOW_ALL_WO_SECTION" => 'Y',
        "SECTION_CODE" => '',
        "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
        "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
        'HIDE_NOT_AVAILABLE' => "N",

        "ADD_SECTIONS_CHAIN" => "Y",

        "SECTION_USER_FIELDS" => array("UF_TYPE", "UF_PROP_LINK", "UF_SORT_FIELDS"),
        "SHOW_MAP" => "Y",
        "EMPTY_LIST_MESSAGE" => $arParams['EMPTY_LIST_MESSAGE'],
        "SHOW_INFO" => "N",
        "SHOW_MORE"=> "N",
        "URL_TEMPLATES_PATH" => $arResult['URL_TEMPLATES_PATH'],
	    "PAGE_SECTION" => "Y",
	    "USING_PRICE_MODE" => "JK_PRICE_MODE",
    ),
    $component
); ?>
<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"TITLE" => Loc::getMessage("ARCHIVE_TITLE"),
		"DESCRIPTION" => Loc::getMessage("ARKHIVE_DESCRIPTION"),
		"AREA_FILE_SHOW" => "html",
		"h" => "h1",
		"HTML" => ob_get_clean(),
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"DATA_SRC" => "jk-archive",
		"CLASS" => "section-archive",
	),
	false
); ?>

<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"TITLE" => Loc::getMessage("CATALOG_DESCRIPTION_TITLE"),
		"DESCRIPTION" => "",
		"h" => ".h1",
		"PATH" => SITE_DIR."include/catalog_description.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "clear.php",
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
        "CLASS" => "_catalog-description",
		"DATA_SRC" => "catalog-description",
	),
	false
); ?>

<?require __DIR__ . '/block_callout.php';?>
