<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (is_array($arResult['DISPLAY_PROPERTIES']['PHOTO']['FILE_VALUE']))
{
	array_walk($arResult['DISPLAY_PROPERTIES']['PHOTO']['FILE_VALUE'], function (&$arFile) {
		$arFile['MIN'] = CFile::ResizeImageGet(
			$arFile["ID"],
			['width' => 600, 'height' => 600],
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		);
	});
}
