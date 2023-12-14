<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

	if (!$arResult['DISPLAY_PROPERTIES']['PHOTO']['FILE_VALUE'][0]) $arResult['DISPLAY_PROPERTIES']['PHOTO']['FILE_VALUE'] = [$arResult['DISPLAY_PROPERTIES']['PHOTO']['FILE_VALUE']];

	array_walk($arResult['DISPLAY_PROPERTIES']['PHOTO']['FILE_VALUE'], function (&$arFile){
		$arFile['MIN'] = CFile::ResizeImageGet($arFile["ID"], array('width'=> 600, 'height'=> 600), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$arFile['MEDIUM'] = CFile::ResizeImageGet($arFile["ID"], array('width'=> 1000, 'height'=> 1000), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	});