<?
use Bitrix\Main\Localization\Loc;
use Citrus\Developer\Iblock;

/** @var string $templateFolder */

$this->setFrameMode(true);
$APPLICATION->SetTitle(Loc::getMessage("MORTGAGE_PAGE_TITLE"));
?>
<?$GLOBALS['MORTGAGE_FILTER']['CODE'] = 'mortgage';?>

<?#mortgage description?>

<?$APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"TITLE" => Loc::getMessage("MORTGAGE_DESCRIPTION_TITLE"),
		"DESCRIPTION" => Loc::getMessage("MORTGAGE_DESCRIPTION_DESCRIPTION"),
		"h" => "h1",
		"PATH" => $templateFolder."/blocks/mortgage-description.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "clear.php",
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"DATA_SRC" => "mortgage-description",
		"EDIT_VISUAL" => "Y",
	),
	$component
); ?>

<?#calculator?>
<? /*$APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"TITLE" => Loc::getMessage("MORTGAGE_SECTION_TITLE"),
		"DESCRIPTION" => Loc::getMessage("MORTGAGE_SECTION_DESCRIPTION"),
		"TEXTP" => Loc::getMessage("MORTGAGE_SECTION_TOP_TEXT"),
		"h" => ".h1",
		"PATH" => $templateFolder."/blocks/mortgage-filter.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "clear.php",
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"DATA_SRC" => "mortgage-filter",
		"HTML_ATTR_ID" => "mortgage-filter",
		"EDIT_VISUAL" => "Y",
	),
	false
); */?>


<?#mortgage form?>
<? /* $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"TITLE" => Loc::getMessage("MORTGAGE_FORM_TITLE"),
		"DESCRIPTION" => Loc::getMessage("MORTGAGE_FORM_DESCRIPTION"),
		"PATH" => SITE_DIR . "include/jk/mortgage_form.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "clear.php",
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"DATA_SRC" => "include-jk-mortgage-form",
	),
	false
); */?>

<?#docs list?>

<?php ob_start() ?>
<?$APPLICATION->IncludeComponent(
	"citrus.developer:complex.news.detail",
	".default",
	array(
		"VIEW_TEMPLATE" => "mortgage-docs",

		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" => "mortgage",
		"ELEMENT_ID" => "",
		"FIELD_CODE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "",
		),
		"IBLOCK_ID" => Iblock::getId(Iblock::MORTGAGE),
		"IBLOCK_TYPE" => "jhk",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "",
		"PROPERTY_CODE" => array(
			0 => "DOCS",
			1 => "",
			2 => "",
			3 => "",
			4 => "",
			5 => "",
			6 => "",
			7 => "",
			8 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"BORDER" => "N",
		"ORDER_CALL_BTN" => "Y",
	),
	$component,
	array(
		'HIDE_ICONS' => 'Y'
	)
);?>
<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"TITLE" => Loc::getMessage("MORTGAGE_DOCS_TITLE"),
		"AREA_FILE_SHOW" => "html",
		"h" => ".h2",
		"HTML" => ob_get_clean(),
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"DATA_SRC" => "mortgage-docs",
		"HEADER" => "N",
	),
	false
); ?>

<?#banks?>
<?php ob_start() ?>
<?$APPLICATION->IncludeComponent(
	"citrus.developer:complex.news.list",
	".default",
	Array(
		"VIEW_TEMPLATE" => "banks",

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
		"FIELD_CODE" => array("", ""),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => Iblock::BANKS,
		"IBLOCK_TYPE" => "info",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("CREDIT_PERIOD", "RATE", "INITIAL_PAYMENT", "CREDIT_TYPE", ""),
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
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	),
	$component
);?>
<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"TITLE" => Loc::getMessage("BANK_LIST_TITLE"),
		"DESCRIPTION" => Loc::getMessage("BANK_LIST_DESCRIPTION"),
		"AREA_FILE_SHOW" => "html",
		"h" => ".h1",
		"HTML" => ob_get_clean(),
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"DATA_SRC" => "mortgage-banks",
		"BG_COLOR" => "GRAY",
	),
	false
); ?>

<?require __DIR__ . '/block_contacts.php';?>

<?require __DIR__ . '/block_callout.php';?>
