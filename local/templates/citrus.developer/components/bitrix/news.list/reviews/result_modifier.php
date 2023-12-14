<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


foreach($arResult["ITEMS"] as &$arItem){
    if( !$arItem["PREVIEW_PICTURE"] ) continue;
    if( is_int($arItem["PREVIEW_PICTURE"]) ) $arItem["PREVIEW_PICTURE"] = array("ID" => $arItem["PREVIEW_PICTURE"]);
    $arItem["PREVIEW_PICTURE"]["MIN"] = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_EXACT, true);
}