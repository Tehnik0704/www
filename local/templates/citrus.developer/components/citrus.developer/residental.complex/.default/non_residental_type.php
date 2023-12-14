<?php

/** @var \Citrus\Developer\Components\ResidentalComplex\Component $component */
/** @var string $templateFolder */

use Bitrix\Main\Localization\Loc;
use Citrus\Developer\Components\JkFormatter;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

$APPLICATION->SetTitle($component->getNonResidentalType('NAME'));
$APPLICATION->SetPageProperty('title', JkFormatter::format(
	Loc::getMessage("CITRUS_DEVELOPER_COMPLEX_SELECT_NON_RESIDENTAL_BROWSER_TITLE", [
		'#NON_RESIDENTAL_TYPE#' => $component->getNonResidentalType('NAME'),
	]),
	$component->getJhk(), [\Citrus\Core\Morpher::CASE_P, JkFormatter::CASE_LOWER]
));

$APPLICATION->IncludeComponent(
	"citrus.core:include",
	"",
	[
		"PATH" => $templateFolder."/block_non_residental.php",
		"TITLE" => $APPLICATION->GetTitle(),
		"DESCRIPTION" => JkFormatter::format(
			Loc::getMessage("CITRUS_DEVELOPER_COMPLEX_SELECT_NON_RESIDENTAL_SUBTITLE", [
				'#NON_RESIDENTAL_TYPE#' => $component->getNonResidentalType('NAME'),
			]),
			$component->getJhk(), [\Citrus\Core\Morpher::CASE_P, JkFormatter::CASE_LOWER]
		),
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"PAGE_SECTION" => "Y",
		"BG_COLOR" => "N",
		"SECTION_HEADER_CLASS" => '_min',
		"DATA_SRC" => $APPLICATION->GetCurPage(false),
	],
	$component,
	['HIDE_ICONS' => 'Y']
);

require __DIR__ . '/block_contacts.php';

require __DIR__ . '/block_callout.php';
