<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty('SHOW_TITLE', 'N');
$APPLICATION->SetTitle("Новости и акции");
?>

<?php ob_start() ?>
<? $APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"shares-slider",
	array(
	"ACTIVE_DATE_FORMAT" => "j F Y",
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
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"DISPLAY_TOP_PAGER" => "N",
	"FIELD_CODE" => array(
	0 => "",
	1 => "",
	),
	"FILTER_NAME" => "",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"IBLOCK_ID" => \Citrus\Developer\Iblock::COMPAIGNS,
	"IBLOCK_TYPE" => "subscribecontent",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"INCLUDE_SUBSECTIONS" => "N",
	"MESSAGE_404" => "",
	"NEWS_COUNT" => "8",
	"PAGER_BASE_LINK_ENABLE" => "N",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => ".default",
	"PAGER_TITLE" => "Акции",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"PREVIEW_TRUNCATE_LEN" => "",
	"PROPERTY_CODE" => array(
	0 => "",
	1 => "",
	),
	"SET_BROWSER_TITLE" => "N",
	"SET_LAST_MODIFIED" => "N",
	"SET_META_DESCRIPTION" => "N",
	"SET_META_KEYWORDS" => "N",
	"SET_STATUS_404" => "N",
	"SET_TITLE" => "N",
	"SHOW_404" => "Y",
	"FILE_404" => "/404.php",
	"SORT_BY1" => "SORT",
	"SORT_BY2" => "ACTIVE_FROM",
	"SORT_ORDER1" => "ASC",
	"SORT_ORDER2" => "DESC",
	"STRICT_SECTION_CHECK" => "N",
	"COMPONENT_TEMPLATE" => "news-standard"
	),
	false
	)
;?>

<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"TITLE" => "Акции",
		"DESCRIPTION" => "Выгодные предложения от застройщика!",
		"AREA_FILE_SHOW" => "html",
		"h" => "h1",
		"HTML" => ob_get_clean(),
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"DATA_SRC" => "news-and-shares-offers",
	),
	false
); ?>

<?php ob_start() ?>
<? $APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"news-standard",
	array(
		"ACTIVE_DATE_FORMAT" => "j F Y",
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
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => \Citrus\Developer\Iblock::NEWS,
		"IBLOCK_TYPE" => "subscribecontent",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "9",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "news-standard"
	),
	false
);?>
<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"TITLE" => "Новости",
		"DESCRIPTION" => "Здесь мы будем сообщать о событиях нашей компании! Будьте с нами!",
		"AREA_FILE_SHOW" => "html",
		"h" => "h1",
		"HTML" => ob_get_clean(),
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"DATA_SRC" => "news-and-shares-news",
	),
	false
); ?>

<? if (CModule::IncludeModule("subscribe"))	{
	?>
	<? $APPLICATION->IncludeComponent("citrus:subscribe.form", "line", Array(
		"FORMAT" => "text",
		"INC_JQUERY" => "N",
		"NO_CONFIRMATION" => "N",
	),
		false
	);?><?
} ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
