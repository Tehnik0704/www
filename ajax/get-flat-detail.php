<?php

$isAjax = isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest";
if ( $isAjax ) {
	require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
	$APPLICATION->SetTitle("");
}
else {
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
}
$APPLICATION->SetPageProperty('JK_TEMPLATE' ,'1');
$flatId = isset($_REQUEST['id']) ? (int) $_REQUEST['id'] : 296;
?>
<?if(!$isAjax):?>
<section class="section _with-padding section-color-n">
	<div class="w">
		<div class="section-inner">
<?endif;?>
<? $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"ajax-flat-detail",
	Array(
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
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" => "",
		"ELEMENT_ID" => $flatId,
		"FIELD_CODE" => array("", ""),
		"IBLOCK_ID" => \Bitrix\Main\Loader::includeModule('citrus.developer') ? \Citrus\Developer\Helper::getIblock("offers") : -1,
		"IBLOCK_TYPE" => "realty",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "",
		"PROPERTY_CODE" => array("cost"),
		"SET_BROWSER_TITLE" => "N",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => "N"
	)
);?>
<?if(!$isAjax):?>
		</div><!-- .section-inner -->
	</div><!-- .w -->
</section>
<?endif;?>

<?
if ($isAjax)
	require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
else
	require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>
