<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;

$arTemplateParameters = array(
	"BG_COLOR"=>array(
		"NAME" => GetMessage("INCLUDE_TPL_BG_COLOR"),
		"TYPE" => "LIST",
		"DEFAULT" => "",
		'VALUES' => array(
			'N' => GetMessage('INCLUDE_TPL_BG_OVERLAY__NONE'),
			'SITE' => GetMessage('INCLUDE_TPL_BG_OVERLAY__SITE'),
			'GRAY' => GetMessage('INCLUDE_TPL_BG_OVERLAY__GRAY'),
		),
	),
	"BIG_DESCRIPTION"=>array(
		"NAME" => Loc::getMessage("INCLUDE_TPL_BIG_DESCRIPTION"),
		"TYPE" => "TEXT",
		"DEFAULT" => "",
		"ROWS" => 55,
	),
	"LEGEND"=>array(
		"NAME" => Loc::getMessage("INCLUDE_TPL_LEGEND"),
		"TYPE" => "TEXT",
		"DEFAULT" => "",
		"ROWS" => 10,
	),
	"SECTION_HEADER_CLASS"=>array(
		"NAME" => Loc::getMessage("INCLUDE_TPL_SECTION_HEADER_CLASS"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"FOOTER"=>array(
		"NAME" => Loc::getMessage("INCLUDE_TPL_FOOTER"),
		"TYPE" => "TEXT",
		"DEFAULT" => "",
		"ROWS" => 10,
	),
);
