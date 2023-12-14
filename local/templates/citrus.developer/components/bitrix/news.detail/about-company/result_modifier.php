<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @var array $arResult;
 */

$files = &$arResult['DISPLAY_PROPERTIES']['DOCS']['FILE_VALUE'];
if($files && !$files[0]) $files = array($files);