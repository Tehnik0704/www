<?
use Bitrix\Main\Localization\Loc;

$APPLICATION->SetTitle(Loc::getMessage("CONTACTS_TITLE"));

$this->setFrameMode(true);

?>

<?$APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"TITLE" => $APPLICATION->GetTitle(false),
		"DESCRIPTION" => Loc::getMessage("CONTACTS_DESCRIPTION"),
		"h" => "h1",
		"PATH" => $templateFolder."/blocks/contact-info.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "clear.php",
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"DATA_SRC" => "contact-info",
	),
	$component
);?>

<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"TITLE" => Loc::getMessage("CONTACTS_FORM_TITLE"),
		"DESCRIPTION" => Loc::getMessage("CONTACTS_FORM_DESCRIPTION"),
		"PATH" => SITE_DIR . "include/jk/contact-form.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "clear.php",
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"DATA_SRC" => "include-jk-contact-form",
	),
	false
); ?>

<?require __DIR__ . '/block_callout.php';?>
