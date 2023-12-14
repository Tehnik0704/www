<?php

use Citrus\Developer\Iblock;
use Citrus\Core\SolutionFactory;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

$SettingsTable = SolutionFactory::get()->settings();

?>

<?#flat-detail?>
<?$APPLICATION->IncludeComponent(
	"citrus.developer:complex.catalog.element",
	".default",
	array(
		"VIEW_TEMPLATE" => "flat-detail",

		"ACTION_VARIABLE" => "action",
		"ADD_DETAIL_TO_SLIDER" => "N",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BRAND_USE" => "N",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_SECTION_ID_VARIABLE" => "N",
		"COMPATIBLE_MODE" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_PICTURE_MODE" => array("POPUP", "MAGNIFIER"),
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PREVIEW_TEXT_MODE" => "E",
		"ELEMENT_CODE" => $arResult['VARIABLES']['CODE'],
		"ELEMENT_ID" => $arResult['VARIABLES']['ID'],
		"IBLOCK_ID" => Iblock::getId(Iblock::NON_RESIDENTAL),
		"IBLOCK_TYPE" => "realty",
		"IMAGE_RESOLUTION" => "16by9",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"LINK_IBLOCK_ID" => "",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_PROPERTY_SID" => "",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "0",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
		"PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
		"PRODUCT_PROPERTIES" => array(),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PROPERTY_CODE" => array_column($arParams['NON_RESIDENTAL_DETAIL_PROPERTIES'], 'code'),
		"SECTION_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "Y",
		"SHOW_DEACTIVATED" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		'URL_TEMPLATES_PATH' => $arResult['URL_TEMPLATES_PATH'],
		"USING_PRICE_MODE" => $SettingsTable::getValue("NON_RESIDENTAL_PRICE_MODE"),
		'NON_RESIDENTAL' => true,
		'debug' => isset($_REQUEST['debug_pdf']),
		),
		$component
	);
?>

<?require __DIR__ . '/block_contacts.php';?>

<?require __DIR__ . '/block_callout.php';?>
