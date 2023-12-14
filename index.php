<?

use Citrus\Developer\Iblock;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty('SHOW_TITLE', 'N');
$APPLICATION->SetTitle("Сайт застройщика");
?>

<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"PATH" => SITE_DIR."index_1.php",
		"TITLE" => "Спецпредложения",
		"h" => ".h1",
		"DESCRIPTION" => "Покупай квартиры с выгодой! Суперцены от застройщика.",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "clear.php",
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"BG_COLOR" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"WIDGET_REL" => "special",
		"DATA_SRC" => "index-special",
	),
	false
);?>


<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"PATH" => SITE_DIR."index_about.php",
		"TITLE" => "",
		"h" => ".h1",
		"DESCRIPTION" => "",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "clear.php",
		"PAGE_SECTION" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"BG_COLOR" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"WIDGET_REL" => "about",
	),
	false
);?>

<? $APPLICATION->IncludeComponent(
	"citrus.core:include", 
	".default", 
	array(
		"TITLE" => "Наши дома",
		"h" => ".h1",
		"DESCRIPTION" => "",
		"PATH" => SITE_DIR."index_3.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "clear.php",
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"WIDGET_REL" => "new",
		"DATA_SRC" => "index-new",
		"PADDING" => "Y",
		"BG_COLOR" => "N",
		"BIG_DESCRIPTION" => "",
		"LEGEND" => "",
		"SECTION_HEADER_CLASS" => "",
		"FOOTER" => ""
	),
	false
);?>


<? $APPLICATION->IncludeComponent(
	"citrus.core:include", 
	".default", 
	array(
		"TITLE" => "Преимущества",
		"h" => ".h1",
		"DESCRIPTION" => "C нами выгодно работать!",
		"PATH" => SITE_DIR."index_4.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "clear.php",
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"BG_COLOR" => "N",
		"CLASS" => "display-xs-n display-md-b",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"WIDGET_REL" => "benefit",
		"DATA_SRC" => "index-benefit",
		"PADDING" => "Y",
		"BIG_DESCRIPTION" => "",
		"LEGEND" => "",
		"SECTION_HEADER_CLASS" => "",
		"FOOTER" => ""
	),
	false
);?>

<? $APPLICATION->IncludeComponent(
	"citrus.developer:callout",
	".default",
	array(
		"IBLOCK_ID" => Iblock::CALLOUT,
		"ID" => "hotite-kvartiry",
		"COMPONENT_TEMPLATE" => "callout",
		"IBLOCK_TYPE" => "info",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
