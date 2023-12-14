<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

$arStyles = array(
	"embed-responsive" => array(
		"tag" => 'div',
		"title" => Loc::getMessage('STYLE_EMBED_RESPONSIVE'),
	),
	"embed-responsive embed-responsive-4by3" => array(
		"tag" => 'div',
		"title" => Loc::getMessage("STYLE_EMBED_RESPONSIVE_4BY3"),
	),
	"embed-responsive embed-responsive-16by9" => array(
		"tag" => 'div',
		"title" => Loc::getMessage("STYLE_EMBED_RESPONSIVE_16BY9"),
	),
	"embed-responsive embed-responsive-21by9" => array(
		"tag" => 'div',
		"title" => Loc::getMessage("STYLE_EMBED_RESPONSIVE_21BY9"),
	),
	"embed-responsive embed-responsive-1by1" => array(
		"tag" => 'div',
		"title" => Loc::getMessage("STYLE_EMBED_RESPONSIVE_1BY1"),
	),
	"table-formatted" => array(
		"tag" => 'table',
		"title" => Loc::getMessage("STYLE_TALBE_FORMATTED"),
	)
);
return $arStyles;
?>