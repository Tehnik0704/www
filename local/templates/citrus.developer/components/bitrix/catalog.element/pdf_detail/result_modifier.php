<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

use Citrus\Developer\Cache;
use Citrus\Developer\Iblock;
use Citrus\Developer\Iblock\CalcLinked;
use Bitrix\Main\Localization\Loc;
use Citrus\Developer\Iblock\ForeignIblock;
use Citrus\Developer\Template\Property;

include_once $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH."/functions.php";

if (!empty($arParams['debug']))
{
	$APPLICATION->RestartBuffer();
}

$arResult['IS_LAYOUT'] = $arParams['IBLOCK_ID'] === Iblock::getId(Iblock::LAYOUTS) || $arParams['IBLOCK_CODE'] === Iblock::LAYOUTS;

$houseId = $arResult['PROPERTIES']['house']['VALUE'] ?:
	ForeignIblock::getParentByChildElement($arResult['ID'], Iblock::HOUSES)['ID'];
//house
if ($houseId) {
	$arResult['HOUSE'] = Cache::remember(['pdf_house_', $houseId], 60, function() use ($houseId){
		$obItem = CIBlockElement::GetByID($houseId)->GetNextElement();
		$arItem = [];
		if ($obItem) {
			$arItem = $obItem->GetFields();
			$arItem["PROPERTIES"] = $obItem->GetProperties();
			Cache::registerIblockCacheTag($arItem['IBLOCK_ID']);

			$geodata = $arItem['PROPERTIES']['geodata']['VALUE'];
			if ($geodata && $geodata instanceof \Citrus\Yandex\Geo\GeoObject) {
				$arItem['ADDRESS'] = (string) $geodata;
			}
		}
		return $arItem;
	});
}

if (!empty($arParams['JK'])) {
	$arResult['JK'] = $arParams['JK'];
} elseif($complexCode = $arResult['PROPERTIES']['complex']['VALUE']) {
	//jk
	$arResult['JK'] = Cache::remember(['pdf_complex_', $complexCode], 60, function() use ($complexCode){
		$obItem = CIBlockElement::GetList(
			[],
			[
				'IBLOCK_ID' => Iblock::getId(Iblock::COMPLEXES),
				"ACTIVE" => "Y",
				'XML_ID' => $complexCode
			],
			false,
			["nTopCount" => 1],
			['NAME','IBLOCK_ID' , 'ID']
		)->GetNextElement();
		$arItem = [];
		if ($obItem) {
			$arItem = $obItem->GetFields();
			$arItem["PROPERTIES"] = $obItem->GetProperties();
			Cache::registerIblockCacheTag($arItem['IBLOCK_ID']);
		}
		return $arItem;
	});
} elseif ($arResult['HOUSE']['ID']) {
	$arResult['JK'] = Cache::remember(['pdf_complex_for_house', $arResult['HOUSE']['ID']], 60, function() use ($arResult){
		$arJK = ForeignIblock::getParentByChildElement($arResult['HOUSE']['ID']);
		$obItem = CIBlockElement::GetList(
			[],
			[
				'IBLOCK_ID' => Iblock::getId(Iblock::COMPLEXES),
				"ACTIVE" => "Y",
				'ID' => $arJK['JK']['ID']
			],
			false,
			["nTopCount" => 1],
			['NAME','IBLOCK_ID' , 'ID']
		)->GetNextElement();
		$arItem = [];
		if ($obItem) {
			$arItem = $obItem->GetFields();
			$arItem["PROPERTIES"] = $obItem->GetProperties();
			Cache::registerIblockCacheTag($arItem['IBLOCK_ID']);
		}
		return $arItem;
	});
}

//contact $component->getJhk('PROPERTIES.contact.VALUE')
if ($contactId = $arResult['JK']['PROPERTIES']['contact']['VALUE']) {
	$arResult['CONTACT'] = Cache::remember(['pdf_contact_', $contactId], 60, function() use ($contactId, $arParams){
		$obItem = CIBlockElement::GetByID($contactId)->GetNextElement();
		$arItem = [];
		if ($obItem) {
			$arItem = $obItem->GetFields();
			$arItem["PROPERTIES"] = $obItem->GetProperties();
			Cache::registerIblockCacheTag($arItem['IBLOCK_ID']);
		}
		return $arItem;
	});
	if ($arResult['CONTACT']['PREVIEW_PICTURE']) {
		$arResult['CONTACT']['PREVIEW_PICTURE'] = CFile::ResizeImageGet(
			$arResult['CONTACT']['PREVIEW_PICTURE'],
			array('width'=>70, 'height'=>70),
			BX_RESIZE_IMAGE_EXACT,
			true);
		$arResult['CONTACT']['PREVIEW_PICTURE']['src'] = $arParams['debug'] ?
			$arResult['CONTACT']['PREVIEW_PICTURE']['src'] :
			$_SERVER['DOCUMENT_ROOT'].$arResult['CONTACT']['PREVIEW_PICTURE']['src'];
	}
}

// dannie ob ipoteke - menyaem kodirovku
if ($arParams['ADDITIONAL']) {
	$additional = \Bitrix\Main\Text\Encoding::convertEncodingToCurrent(htmlspecialchars_decode($arParams['~ADDITIONAL']));
	$additional = \Bitrix\Main\Text\Encoding::convertEncoding($additional, SITE_CHARSET,'utf-8');
	$arParams['ADDITIONAL'] = \Bitrix\Main\Web\Json::decode($additional);
}

//office
$arResult['OFFICE'] = Cache::remember(['pdf_office_', 'main_office'], 60, function() use ($officeId){
	$arItem = [];
	$arFilter = array(
		"IBLOCK_ID" => Iblock::getId(Iblock::OFFICES),
		"ACTIVE" => "Y",
		"PROPERTY_MAIN_VALUE" => 'Y'
	);
	$res = CIBlockElement::GetList([], $arFilter, false, ["nTopCount" => 1], ['NAME','IBLOCK_ID' , 'ID']);
	if($obItem = $res->GetNextElement()){
		$arItem = $obItem->GetFields();
		$arItem["PROPERTIES"] = $obItem->GetProperties();
		Cache::registerIblockCacheTag($arItem['IBLOCK_ID']);
	}
	return $arItem;
});

if ($arResult['IS_LAYOUT'])
{
	$offersIblockId = Iblock::getId(Iblock::APARTMENTS);
	$calc =
		(new CalcLinked($offersIblockId, 'PROPERTY_layout_VALUE.ID'))
			->groupByForeign()
			->addForeignCount();

	$calc->query()
		->addFilter('PROPERTY_layout_VALUE.ID', $arResult['ID']);

	$activeCountSubQuery = clone $calc->query();
	$activeCountSubQuery = $activeCountSubQuery->addFilter('ACTIVE', 'Y');
	$calc->query()
		->addSelect(new \Bitrix\Main\Entity\ExpressionField('ACTIVE_COUNT', '(' . $activeCountSubQuery->getQuery() . ')'));

	$calc
		->addCostAppartments('PROPERTY_costa_VALUE')
		->addCostPerSqm('PROPERTY_cost_m2_VALUE');

	$property = new Property($arResult);
	foreach ($arParams['PROPERTY_CODE'] as $code)
	{
		if ($property->hasValue($code))
		{
			$arResult["DISPLAY_PROPERTIES"][$code]['NAME'] = $property->getName($code);
			$arResult["DISPLAY_PROPERTIES"][$code]['DISPLAY_VALUE'] = $property->getFormatValue($code);
		}
		else
		{
			unset($arResult["DISPLAY_PROPERTIES"][$code]);
		}
	}

	/** @var array[] $offerProperties */
	$offerProperties = Iblock::getProperties($offersIblockId);
	$calcOfferProperties = array_intersect($arParams['PROPERTY_CODE'], array_keys($offerProperties));
	$displayAsBounds = [
		'cost_m2',
		'costa',
	];
	foreach ($calcOfferProperties as $property)
	{
		if ($offerProperties[$property]['MULTIPLE'] != 'Y' && $offerProperties[$property]['PROPERTY_TYPE'] != 'F')
		{
			$calc->addPropertyBounds($property);
			$calc->addPropertyValues($property);
		}
	}
	$calcFields =
		$calc
			->query()
			->exec()->fetch();

	$propertyFormatter = new Iblock\OrmPropertyFormatter([], $offersIblockId);
	$propertyFormatter
		->mockCostPerSqm()
		->mockCostAppartments()
		->mockFlatCount((int)$calcFields['ACTIVE_COUNT'] . Loc::getMessage("CITRUS_DEVELOPER_FLAT_COUNT_FROM") . $calcFields[CalcLinked::FOREIGN_COUNT_ALIAS]);

	foreach ($calcOfferProperties as $property)
	{
		$displayValues = [];
		if (is_array($calcFields[ToUpper($property)]))
		{
			foreach ($calcFields[ToUpper($property)] as $value)
			{
				$displayValues[] = $propertyFormatter->formatValue($property, $value, true, false);
			}
		}

		if (in_array($property, $displayAsBounds) || count($displayValues) > 5)
		{
			$minVal = $propertyFormatter->formatValue($property, $calcFields[ToUpper("MIN_{$property}")], false);
			if (!$minVal)
			{
				continue;
			}
			$displayValue = $propertyFormatter->formatValue($property, $minVal, true, false);

			$maxVal = $propertyFormatter->formatValue($property, $calcFields[ToUpper("MAX_{$property}")], false);
			if ($maxVal && $maxVal !== $minVal)
			{
				$displayValue .= Loc::getMessage('CITRUS_DEVELOPER_PLAN_FLATS_ON_SALE_NONE')
					. $propertyFormatter->formatValue($property, $maxVal, true, false);
			}
		}
		else
		{
			$minVal = reset($displayValues);
			$displayValue = implode(', ', $displayValues);
		}

		if ($propertyFormatter->getHint($property))
		{
			$displayValue .= ' ' . $propertyFormatter->getHint($property);
		}

		$propertyFormatter->mockProperty($property, [
			'VALUE' => $minVal,
			'DISPLAY_VALUE' => $displayValue,
		]);
	}
	$arResult['DISPLAY_PROPERTIES'] += $propertyFormatter->getDisplayProperties();
}
else
{
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
	// podstavity izobrazheniya iz planirovki esli oni ne zadani v kvartire
	if (empty($arResult['DETAIL_PICTURE']) && !empty($arResult['PLAN']['PREVIEW_PICTURE']))
	{
		$arResult['DETAIL_PICTURE'] = [
			'ID' => $arResult['PLAN']['PREVIEW_PICTURE'],
			'TITLE' => '',
			'ALT' => '',
		];
	}
	if (empty($arResult['PROPERTIES']['photo']['VALUE']) && !empty($arResult['PLAN']['PROPERTIES']['photo']['VALUE']))
	{
		$arResult['PROPERTIES']['photo']['VALUE'] = $arResult['PLAN']['PROPERTIES']['photo']['VALUE'];
	}
}
