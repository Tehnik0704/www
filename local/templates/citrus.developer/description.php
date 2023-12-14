<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

\Bitrix\Main\Localization\Loc::loadMessages(__FILE__);

$arTemplate = [
	"NAME" => GetMessage("CITRUS_DEVELOPER_TEMPLATE_NAME"),
	"SORT" => 100,
	"DESCRIPTION" => GetMessage("CITRUS_DEVELOPER_TEMPLATE_DESCRIPTION"),
];
