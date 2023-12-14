<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * @var $arResult
 */

use Citrus\Helpers;
use Citrus\Developer\Entity\DocslogTable;

foreach ($arResult['ITEMS'] as &$arItem) {
	if (!$arItem['DISPLAY_PROPERTIES']['FILE']) continue;
	if (!$arItem['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE'][0])
		$arItem['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE'] = array($arItem['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']);

	// nayti privyazannie aktualynie versii v zhurnale
	$fileIds = array_map(function ($v) { return $v['ID']; }, $arItem['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']);
	$actualFiles = DocslogTable::getList(['filter' => [
		'IBLOCK_FILE_ID' => $fileIds,
	]])->fetchAll();
	$actualFilesResult = [];
	foreach ($actualFiles as $actualFile)
	{
		$actualFilesResult[$actualFile['IBLOCK_FILE_ID']] = $actualFile;
	}
	if (empty($actualFilesResult))
	{
		continue;
	}

	if (0)
	{
		echo '<xmp>';
		print_r($fileIds);
		print_r($arItem['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']);
		print_r($actualFilesResult);
		echo '</xmp>';
	}

	// podmenity na aktualynie versii iz zhurnala
	$newFileInfo = [];
	foreach ($arItem['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE'] as $i => $v)
	{
		if (isset($actualFilesResult[$v['ID']]))
		{
			$tmp = \CFile::GetFileArray($actualFilesResult[$v['ID']]['FILE_ID']);
			$tmp['USER'] = $actualFilesResult[$v['ID']]['CHANGES'];
			$tmp['DATE'] = $actualFilesResult[$v['ID']]['DATE'];
			$newFileInfo[] = $tmp;
		}
	}
	if (count($newFileInfo))
	{
		$arItem['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE'] = $newFileInfo;
	}
}
