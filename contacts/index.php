<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty('SHOW_TITLE', 'N');
$APPLICATION->SetTitle("Контакты");
?>

<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default", 
	array(
		"TITLE" => "Контактная информация",
		"DESCRIPTION" => "11 лет успешной работы на рынке строительства!",
		"PATH" => "index_1.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "clear.php",
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"BG_COLOR" => "N",
		"DATA_SRC" => "contacts-info",
	),
	false
); ?>

<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"TITLE" => "Написать нам",
		"DESCRIPTION" => "Если у вас появились вопросы, напишите нам!",
		"PATH" => "index_2.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "clear.php",
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"DATA_SRC" => "contacts-feedback",
	),
	false
); ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
