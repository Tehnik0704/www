<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Loader;
global $APPLICATION;

if (Loader::includeModule('iblock')) {
	$aMenuLinksExt=$APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
		"IS_SEF" => "N",
		"SEF_BASE_URL" => "/zhilye-kompleksy/",
		"SECTION_URL" => "?id=#ID#",
		"IBLOCK_TYPE" => "realty",
		"IBLOCK_ID" => \Citrus\Developer\Helper::getIblock('complexes'),
		"DEPTH_LEVEL" => "1",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000"
	),
		false
	);

	$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
}
?>