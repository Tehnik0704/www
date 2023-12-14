<?php

use Bitrix\Main\Localization\Loc;
use Citrus\Developer\Iblock;
use Citrus\Developer\Iblock\CalcLinked;
use Citrus\Developer\Template\Property;
use Citrus\Developer\TemplateHelper;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$complex = \Citrus\Developer\Components\ResidentalComplex\Component::getInstance();
$arResult['JK'] = $complex->getJhk();
$arResult['HOUSE'] = $complex->getHouse();
$arResult['MORTGAGE_LINK'] = $complex->getRouter()->getUrl('mortgage');

/**
 * Svoystva planirovki budut ispolyzovatysya esli u kvartiri eti svoystva ne zapolneni
 */
$arResult['PLAN'] = [];
if ($layout = $arResult['PROPERTIES']['layout'])
{
	$arFilter = [
		"ACTIVE" => "Y",
		"ID" => $layout['VALUE'],
	];
	if ($layout['LINK_IBLOCK_ID'])
	{
		$arFilter['=IBLOCK_ID'] = $layout['LINK_IBLOCK_ID'];
	}
	else
	{
		$arFilter['=IBLOCK_CODE'] = Iblock::LAYOUTS;
	}
	$arResult['PLAN'] = \Citrus\Developer\Cache::remember(['plan_for_flat_', $arFilter], 3600,
		function () use ($arResult, $arFilter) {
			$element = null;
			$obElement = CIBlockElement::GetList(
				[],
				$arFilter,
				false,
				false,
				['ID', 'IBLOCK_ID', 'PREVIEW_PICTURE']
			)->GetNextElement();
			if ($obElement)
			{
				$element = $obElement->GetFields();
				$element["PROPERTIES"] = $obElement->GetProperties();

				if ($element["PROPERTIES"]['floor_plan']['VALUE'])
				{
					$element["PROPERTIES"]['floor_plan']['VALUE'] = CFile::ResizeImageGet(
						$element["PROPERTIES"]['floor_plan']['VALUE'],
						['width' => 1250, 'height' => 800],
						BX_RESIZE_IMAGE_PROPORTIONAL,
						true
					);
				}
			}

			return $element;
		});
}

/**
 * PoluchenieSroka sdachi iz svoystv planirovki
 */
$sectionCalc = new CalcLinked(Iblock::getId(Iblock::SECTIONS), 'ID');
$sectionCalc
	->groupByForeign()
	->addReadyDate()
	->query()->addSelect('PROPERTY_ready_date_VALUE', 'ready_date');

$section = Iblock\ForeignIblock::getParentByChildSection($arResult['IBLOCK_SECTION_ID'], Iblock::SECTIONS);
if ($section)
{
	$sectionCalcValues = $sectionCalc->query()
		->addFilter('ID', $section['ID'])
		->exec()->fetch();

	if (is_array($sectionCalcValues))
	{
		$formatter = new Iblock\OrmPropertyFormatter($sectionCalcValues, Iblock::getId(Iblock::SECTIONS));
		$arResult['PROPERTIES']['ready_date'] = [
			'TITLE' => Loc::getMessage("CITRUS_DEVELOPER_FLAT_READY_DATE"),
			'VALUE' => $formatter->getFormatValue('ready_date'),
		];
	}
}

$arResult['PDF_DETAIL_URL'] = $complex->getRouter()->getUrl('pdf');

$serializer = new \Citrus\Core\Components\ParamsSerializer();
$property = new Property($arResult);
$planProperty = new Property($arResult['PLAN']);

// podstavity izobrazheniya iz planirovki esli oni ne zadani v kvartire
if (empty($arResult['DETAIL_PICTURE']) && !empty($arResult['PLAN']['PREVIEW_PICTURE']))
{
	$arResult['DETAIL_PICTURE'] = $arResult['PLAN']['PREVIEW_PICTURE'];
}
if (empty($arResult['PROPERTIES']['photo']['VALUE']) && !empty($arResult['PLAN']['PROPERTIES']['photo']['VALUE']))
{
	$arResult['PROPERTIES']['photo']['VALUE'] = $arResult['PLAN']['PROPERTIES']['photo']['VALUE'];
}
if (empty($arResult['PROPERTIES']['plan']['VALUE']) && !empty($arResult['PLAN']['PROPERTIES']['plan']['VALUE']))
{
	$arResult['PROPERTIES']['plan']['VALUE'] = $arResult['PLAN']['PROPERTIES']['plan']['VALUE'];
	$arResult['DISPLAY_PROPERTIES']['plan'] = $arResult['PROPERTIES']['plan'];
	$arResult['DISPLAY_PROPERTIES']['plan']['FILE_VALUE'] = \CFile::GetFileArray($arResult['PROPERTIES']['plan']['VALUE']);
}

/*gallery*/
$arResult['GALLERY'] = array_merge(
	$arResult['DETAIL_PICTURE'] ? [$arResult['DETAIL_PICTURE']] : [],
	$arResult['PROPERTIES']['photo']['VALUE'] ?: []
);

TemplateHelper::fixGalleryImagesFromPlan($arResult);

$arResult['GALLERY'] = array_map(function ($photoId) {

	$galleryItem = is_array($photoId) ? $photoId : CFile::GetFileArray($photoId);
	$galleryItem['MIN'] = CFile::ResizeImageGet($photoId, ['width' => 600, 'height' => 600], BX_RESIZE_IMAGE_PROPORTIONAL);

	return $galleryItem;

}, $arResult['GALLERY']);

$arResult['PDF'] = \Citrus\Core\Components\Pdf::encodeParams([
	'ID' => $arResult['ID'],
	'IBLOCK_ID' => $arParams["IBLOCK_ID"],
	'PROPERTY_CODE' => $arParams['PROPERTY_CODE'] ?: [],
	'PRICE' => $property->getValue('cost') ?: $planProperty->getValue('cost'),
	'USING_PRICE_MODE' => $arParams['USING_PRICE_MODE'],
	'SHOW_DEACTIVATED' => 'Y',
], 'bitrix:catalog.element', 'pdf_detail');
