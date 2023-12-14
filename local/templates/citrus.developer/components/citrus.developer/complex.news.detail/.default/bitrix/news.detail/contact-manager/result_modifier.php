<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

	if ($arResult['PREVIEW_PICTURE']['SRC']) {
		$arResult['PREVIEW_PICTURE']['MIN'] = CFile::ResizeImageGet($arResult['PREVIEW_PICTURE']["ID"], array('width'=> 200, 'height'=> 300), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	}

	// pervoe slovo imeni budet zhirnim
	$tmp_name = explode(' ', $arResult['NAME']);
	$arResult['DISPLAY_NAME'] = '<b>'.array_shift($tmp_name).'</b> '.implode(' ', $tmp_name);