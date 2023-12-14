<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

?><?$APPLICATION->IncludeComponent(
	"citrus.developer:callout",
	".default",
	array(
		"IBLOCK_ID" => \Citrus\Developer\Iblock::CALLOUT,
		"ID" => "zapisatsya-na-prosmotr-kvartiry",
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_TYPE" => "info",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>