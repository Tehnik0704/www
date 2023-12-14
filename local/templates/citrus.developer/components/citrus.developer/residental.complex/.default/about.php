<?php

use Bitrix\Main\Localization\Loc;
use Citrus\Core\Morpher;
use Citrus\Developer\Components\JkFormatter;
use Citrus\Developer\Components\ResidentalComplex\Component;
use Citrus\Developer\Iblock\ForeignIblock;
use Citrus\Developer\Iblock;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

Loc::loadMessages(__FILE__);

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
/** @var Component $component */
$this->setFrameMode(true);

// FIX ustanovka seo dannih title, keywords, description
$iproperty = $component->getJhk('IPROPERTY');
if (!empty($iproperty['ELEMENT_META_TITLE']))
{
	$APPLICATION->SetTitle($iproperty['ELEMENT_META_TITLE']);
}
else
{
	$APPLICATION->SetTitle(JkFormatter::format('#TYPE_FULL# &laquo;#NAME#&raquo;', $component->getJhk()));
}
if (!empty($iproperty['ELEMENT_META_KEYWORDS']))
{
	$APPLICATION->SetPageProperty('keywords', $iproperty['ELEMENT_META_KEYWORDS']);
}
if (!empty($iproperty['ELEMENT_META_DESCRIPTION']))
{
	$APPLICATION->SetPageProperty('description', $iproperty['ELEMENT_META_DESCRIPTION']);
}

$settingsBlocks = $component->settings->get('blocks');

?>

<?#houses?>
<?if($houseSection = ForeignIblock::getSectionId($component->getJhk(), Iblock::HOUSES)):?>
	<?$APPLICATION->IncludeComponent(
		"citrus.core:include",
		".default",
		array(
			"PATH" => $templateFolder."/blocks/house-list.php",
			"TITLE" => JkFormatter::format(Loc::getMessage("JK_HOUSES"), $component->getJhk(), [Morpher::CASE_R]),
			"DESCRIPTION" => Loc::getMessage("JK_ADDRESS", ['#ADDRESS#' => (string)$component->getJhk('ADDRESS')]),
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "clear.php",
			"PAGE_SECTION" => "Y",
			"COMPONENT_TEMPLATE" => ".default",
			"BG_COLOR" => "N",
			"COMPOSITE_FRAME_MODE" => "A",
			"COMPOSITE_FRAME_TYPE" => "AUTO",
			"WIDGET_REL" => "house-list",
			"JK_SETTINGS" => $settingsBlocks,
			"SECTION_ID" => $houseSection
		),
		$component
	); ?>
<?endif;?>

<?$APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"PATH" => $templateFolder."/blocks/about-developer.php",
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
		"WIDGET_REL" => "about-developer",
		"JK_SETTINGS" => $settingsBlocks,
	),
	$component
); ?>

<?#description?>
<?if($descriptionSectionId = ForeignIblock::getSectionId($component->getJhk(), Iblock::COMPLEXES_DESCRIPTION)):?>
	<?$APPLICATION->IncludeComponent(
		"citrus.core:include",
		".default",
		array(
			"PATH" => $templateFolder."/blocks/description.php",
			"TITLE" => $component->getJhk('PROPERTIES.jk_title.VALUE') ?: JkFormatter::format(Loc::getMessage("JK_DESCRIPTION"), $component->getJhk(), [Morpher::CASE_R, JkFormatter::CASE_LOWER]),
			"DESCRIPTION" => $component->getJhk('PROPERTIES.jk_description.VALUE'),
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "clear.php",
			"PAGE_SECTION" => "Y",
			"COMPONENT_TEMPLATE" => ".default",
			"BG_COLOR" => "N",
			"COMPOSITE_FRAME_MODE" => "A",
			"COMPOSITE_FRAME_TYPE" => "AUTO",
			"WIDGET_REL" => "description",
			"JK_SETTINGS" => $settingsBlocks,
			"SECTION_ID" => $descriptionSectionId
		),
		$component
	); ?>
<?endif;?>

<?#infrastructure?>
<?if($component->getJhk('MAP_BOUNDS') && \Citrus\Core\YandexMap::hasKey()):?>
	<?$APPLICATION->IncludeComponent(
		"citrus.core:include",
		".default",
		array(
			"PATH" => $templateFolder."/blocks/infrastructure.php",
			"TITLE" => Loc::getMessage("JK_INFRASTRUCTUR"),
			"DESCRIPTION" => "",
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "clear.php",
			"PAGE_SECTION" => "Y",
			"COMPONENT_TEMPLATE" => ".default",
			"BG_COLOR" => "N",
			"COMPOSITE_FRAME_MODE" => "A",
			"COMPOSITE_FRAME_TYPE" => "AUTO",
			"WIDGET_REL" => "infrastructure",
			"JK_SETTINGS" => $settingsBlocks,
			"DATA_SRC" => "about-infrastructure",
		),
		$component
	); ?>
<?endif;?>

<?#photo-progress?>
<?$APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"PATH" => $templateFolder."/blocks/photo-progress.php",
		"TITLE" => Loc::getMessage("JK_COURSE"),
		"DESCRIPTION" => Loc::getMessage("JK_COURSE_DESCRIPTION"),
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "clear.php",
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"BG_COLOR" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"WIDGET_REL" => "photo-progress",
		"JK_SETTINGS" => $settingsBlocks,
		"DATA_SRC" => "about-photo-progress",
	),
	$component
); ?>

<?require __DIR__ . '/block_contacts.php';?>

<?require __DIR__ . '/block_callout.php';?>
