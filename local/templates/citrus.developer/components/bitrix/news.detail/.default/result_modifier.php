<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE'] && !$arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE'][0])
{
	$arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE'] = [$arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE']];
}

if ($arResult['DETAIL_PICTURE']['SRC'])
{
	$arResult['DETAIL_PICTURE']['MIN'] = CFile::ResizeImageGet(
		$arResult['DETAIL_PICTURE']["ID"],
		['width' => 1250, 'height' => 600],
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true
	);
}

if (is_array($arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE']))
{
	foreach ($arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE'] as &$galleryItem)
	{
		$galleryItem['MIN'] = CFile::ResizeImageGet(
			$galleryItem["ID"],
			['width' => 500, 'height' => 500],
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		);
	}
}
