<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ($arResult['ITEMS'] as &$arItem)
{
	if ($arItem['PREVIEW_PICTURE']['SRC']) {
		$arItem['PREVIEW_PICTURE']['MIN'] = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']["ID"], array('width'=> 200, 'height'=> 300), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	}

	// pervoe slovo imeni budet zhirnim
	$tmp_name = explode(' ', $arItem['NAME']);
	$arItem['DISPLAY_NAME'] = '<b>'.array_shift($tmp_name).'</b> '.implode(' ', $tmp_name);
}
