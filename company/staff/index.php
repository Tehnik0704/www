<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty('SHOW_TITLE', 'N');
$APPLICATION->SetTitle("Новый раздел");
?>

<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"TITLE" => "Наша команда",
		"DESCRIPTION" => "Мы гордимся нашей дружной командой!",
		"PATH" => "index_1.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "clear.php",
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
	),
	false
); ?>

<? $APPLICATION->IncludeComponent(
	"citrus.developer:callout",
	".default",
	array(
		"IBLOCK_ID" => "callout",
		"ID" => "hotite-kvartiry",
		"COMPONENT_TEMPLATE" => "callout",
		"IBLOCK_TYPE" => "info",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
