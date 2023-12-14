<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

use Bitrix\Main\Localization\Loc;
?>

<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"PATH" => $templateFolder."/inc/log.php",
		"TITLE" => Loc::getMessage("DOCS_LOG_TITLE"),
		"DESCRIPTION" => "",
		"BIG_DESCRIPTION" => Loc::getMessage("DOCS_LOG_BIG_DESCRIPTION"),
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "clear.php",
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"BG_COLOR" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_CODE" => $arParams["PARENT_SECTION_CODE"],
		"ITEMS_PER_PAGE" => "",
		"DATA_SRC" => "docs-inc-log",
	),
	$component
); ?>

