<?php

/** @var \Citrus\Developer\Components\ResidentalComplex\Component $component */
/** @var string $templateFolder */

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

$APPLICATION->SetTitle($component->getNonResidentalType('NAME'));

$APPLICATION->IncludeComponent(
	"citrus.core:include",
	"",
	[
		"PATH" => $templateFolder."/block_non_residental.php",
		"TITLE" => $APPLICATION->GetTitle(),
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
