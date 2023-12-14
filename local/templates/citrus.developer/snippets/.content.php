<?
use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

Loc::loadMessages(__FILE__);

$SNIPPETS = array(
	"table.snp" => Array("title" => Loc::getMessage("CITRUS_SNIPPET_TABLE_FORMATTED"), "description" => "",),
	"embed-responsive.snp" => Array("title" => Loc::getMessage("CITRUS_SNIPPET_EMBED_RESPONSIVE"), "description" => Loc::getMessage("CITRUS_SNIPPET_EMBED_RESPONSIVE_DESC"),),
);
