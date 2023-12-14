<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * @var $arParams, $arResult
 */

use Citrus\Yandex\Geo\GeoObject;

if(CModule::IncludeModule("iblock") && ($arIBlock = GetIBlock($arParams["IBLOCK_ID"]))) {
	$arResult['LIST_PAGE_URL'] = $arIBlock['LIST_PAGE_URL'];
}
$arResult['COMPONENT_ID'] = 'component_'.$arParams['UNIQ_ID'];
