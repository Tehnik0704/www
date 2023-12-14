
<?
use Citrus\Developer\Iblock;
$this->setFrameMode(true);?>

<?$APPLICATION->IncludeComponent(
	"citrus.developer:complex.news.detail",
	".default",
	Array(
		"VIEW_TEMPLATE" => "photo-progress-detail",

		"ACTIVE_DATE_FORMAT" => "j F Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
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
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" =>  $arResult['VARIABLES']['PHOTO_CODE'],
		"ELEMENT_ID" => $arResult['VARIABLES']['PHOTO_ID'],
		"FIELD_CODE" => array("", ""),
		"IBLOCK_ID" => Iblock::getId(Iblock::PHOTOS),
		"IBLOCK_TYPE" => "jhk",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "",
		"PROPERTY_CODE" => array("PHOTO", ""),
		"SET_BROWSER_TITLE" => "Y",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => "N",
		"URL_TEMPLATES_PATH" => $arResult['URL_TEMPLATES_PATH'],
	),
	$component
);?>

<? if (CModule::IncludeModule("subscribe"))	{
	?>
	<?$APPLICATION->IncludeComponent("citrus:subscribe.form", "line", Array(
		"FORMAT" => "text",
		"INC_JQUERY" => "N",
		"NO_CONFIRMATION" => "N",
	),
		false
	);?><?
} ?>
