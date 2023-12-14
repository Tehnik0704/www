<?php

use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

Loc::loadMessages(__FILE__);

$APPLICATION->SetPageProperty('SHOW_TITLE', 'N');

?>

<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"PATH" => SITE_DIR . "include/agreement.php",
		"TITLE" => Loc::getMessage("CITRUS_DEVELOPER_AGREEMENT_TITLE"),
		"h" => ".h1",
		"DESCRIPTION" => "",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "clear.php",
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"BG_COLOR" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"WIDGET_REL" => "",
		"DATA_SRC" => "agreement",
		"BROWSER_TITLE" => "Y",
	),
	false
);?>
