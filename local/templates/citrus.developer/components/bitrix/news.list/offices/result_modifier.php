<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @var $arResult;
 */

$arResult['SOC_PROPERTIES'] = array();
foreach($arResult["ITEMS"] as $key => &$arItem){
    if( $arItem["PREVIEW_PICTURE"] ){
	    if( is_int($arItem["PREVIEW_PICTURE"]) ) $arItem["PREVIEW_PICTURE"] = array("ID" => $arItem["PREVIEW_PICTURE"]);
	    $arItem["PREVIEW_PICTURE"]["MIN"] = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=> 500, 'height'=>500), BX_RESIZE_IMAGE_PROPORTIONAL, true);//BX_RESIZE_IMAGE_EXACT
    }

	foreach ($arItem['PROPERTIES'] as $propertyCode => &$arProperty) {
    	if (strpos($propertyCode, 'SOC_') !== false) {
		    $arProperty['SOC'] = strtolower(str_replace('SOC_', '', $propertyCode));
    		if($arProperty['VALUE']) $arResult['SOC_PROPERTIES'][$propertyCode] = $arProperty;
		    unset($arProperty);
	    }
	}
}