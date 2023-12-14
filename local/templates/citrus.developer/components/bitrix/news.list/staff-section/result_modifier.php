<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult['SECTIONS'] = [];
$arResult['LIST_PAGE_URL'] = \Citrus\Developer\TemplateHelper::preparePath($arResult['LIST_PAGE_URL']);

foreach ($arResult['ITEMS'] as &$arItem) {
	if( $arItem["PREVIEW_PICTURE"] ){
		if( is_int($arItem["PREVIEW_PICTURE"]) ) $arItem["PREVIEW_PICTURE"] = array("ID" => $arItem["PREVIEW_PICTURE"]);
		$arItem["PREVIEW_PICTURE"]["MIN"] = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=> 400, 'height'=>400), BX_RESIZE_IMAGE_PROPORTIONAL, true);//BX_RESIZE_IMAGE_EXACT
	}

	// R R S R R R  S R R R R  RioR R R Rio R S R R S  R RioS R S R 
	$tmp_name = explode(' ', $arItem['NAME']);
	$arItem['DISPLAY_NAME'] = '<b>'.array_shift($tmp_name).'</b> '.implode(' ', $tmp_name);

	$sectionId = $arItem['PROPERTIES']['DEPARTMENT']['VALUE_ENUM_ID'];

	if ( $arParams['SPLIT_SECTION'] !== 'N' ) {
		if(!$arResult['SECTIONS'][$sectionId]) {
			$arResult['SECTIONS'][$sectionId]['NAME'] = $arItem['PROPERTIES']['DEPARTMENT']['VALUE'];
			$arResult['SECTIONS'][$sectionId]['ID'] = $sectionId;
		}
		if ($sectionId)
			$arResult['SECTIONS'][$sectionId]['ITEMS'][] = $arItem;
	} else {
		$arResult['SECTIONS'][0]['ITEMS'][] = $arItem;
	}

}

