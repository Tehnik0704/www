<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arTemplateParameters = array(
	"UNIQ_ID"=>array(
		"NAME" => GetMessage("CITRUS_UNIQ_ID"),
		"TYPE" => "STRING",
		"DEFAULT" => md5(uniqid(rand(),1)),
	),
);
