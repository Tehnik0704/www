<?php

use Bitrix\Main\ORM\Fields\ExpressionField;
use Citrus\Developer\Components\ResidentalComplex\Component as ResidentalComplexComponent;
use Citrus\Developer\Iblock;
use Citrus\Developer\Iblock\CalcLinked;
use Bitrix\Main\Localization\Loc;
use Citrus\Developer\Template\Property;
use Citrus\Developer\TemplateHelper;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

/*gallery*/
$arResult['GALLERY'] = array_merge(
	$arResult['PREVIEW_PICTURE'] ? [$arResult['PREVIEW_PICTURE']] : [],
	$arResult['PROPERTIES']['photo']['VALUE'] ?: []
);

TemplateHelper::fixGalleryImagesFromPlan($arResult);

$arResult['GALLERY'] = array_map(function ($photoId) {

	$galleryItem = is_array($photoId) ? $photoId : CFile::GetFileArray($photoId);
	$galleryItem['MIN'] = CFile::ResizeImageGet($photoId, ['width' => 600, 'height' => 600], BX_RESIZE_IMAGE_PROPORTIONAL);

	return $galleryItem;

}, $arResult['GALLERY']);

$complex = ResidentalComplexComponent::getInstance();
$arResult['JK'] = $complex->getJhk();
$arResult['HOUSE'] = $complex->getHouse();

// region R R R R R S R R R R  R R R S R R RioR  S R R R S S R  R R S  R S R R S R R R R RioS 
if ($arResult['ID'])
{
	/**
	 * 1. R R S R R S RioS R R R R RioR  S R R R S S R  S R R R R R S R  R R  R R R R RioS R R R Rio (S R S R R  \Citrus\Developer\Template\Property)
	 * 2. R S R R S R R  R R R S R R RioS R R R R R S S  R R R S R R RioR  S R R R S S R  R R R S S RioS , R S RioR R R R R R R S RioR  R R R R RioS R R R R  (S R S R R  \Citrus\Developer\Iblock\CalcLinked)
	 * 3. R R S R R S RioS R R R R RioR  S R R R S S R  S R R R R R S R  R R  R R R S S RioS S  (S R S R R  \Citrus\Developer\Iblock\OrmPropertyFormatter)
	 */

	/**
	 * R R R R R S R R R R  R R R S R S R  R R S  R S R R S R Rio R R R S R R RioS R R R R R S S  R R R S R R RioR  S R R R S S R  R R R S S RioS 
	 *
	 * @param int $layoutId ID R R R R RioS R R R Rio
	 * @param callable $onBeforeQuery R R R S R R R RioR , R S R S R R R S S S  R R S R R  R R R R S R S R R  S R R S R S S R S R , R  R S R S R R R S R S  R R R S S R R S  RioR S S R R S  CalcLinked
	 * @return Bitrix\Main\DB\Result
	 */
	$apartmentsQuery = static function ($layoutId, callable $onBeforeQuery = null) {
		$calc = (new CalcLinked(Iblock::getId(Iblock::APARTMENTS), 'PROPERTY_layout_VALUE.ID'))
			->groupByForeign()
			->addForeignCount();

		$calc->query()
			->addFilter('ACTIVE', 'Y')
			->addFilter('PROPERTY_layout_VALUE.ID', $layoutId);

		$activeCountSubQuery = clone $calc->query();
		$totalCountSubQuery = clone $calc->query();

		$f = $totalCountSubQuery->getFilter();
		unset($f['ACTIVE']);
		$totalCountSubQuery->setFilter($f);

		$calc->query()->addSelect(new ExpressionField('ACTIVE_COUNT', '(' . $activeCountSubQuery->getQuery() . ')'));
		$calc->query()->addSelect(new ExpressionField('TOTAL_COUNT', '(' . $totalCountSubQuery->getQuery() . ')'));

		if (isset($onBeforeQuery))
		{
			$onBeforeQuery($calc);
		}

		return $calc->query()
			->exec();
	};
	$isPricePropertyDisplayed = array_intersect(['cost', 'costa', 'cost_m2', 'cost_m2_auto'], $arParams['PROPERTY_CODE']);
	$selectPricePropertyIn = static function (array &$properties, $selected, array $allCostProperties = ['cost', 'costa', 'cost_m2', 'cost_m2_auto']) {

		$properties = array_flip($properties);
		$properties = \Citrus\Core\array_replace_keys($properties, array_fill_keys($allCostProperties, $selected));
		$properties = array_flip($properties);

	};

	/** @var array[] $apartmentProperties */
	$apartmentProperties = Iblock::getProperties(Iblock::getId(Iblock::APARTMENTS));
	/** @var array $apartmentDisplayProperties R S R R S R R R R R S R  S R R R S S R R  R R  R R R S S RioS  */
	$apartmentDisplayProperties = array_intersect($arParams['PROPERTY_CODE'], array_merge(array_keys($apartmentProperties), ['costa']));

	$priceProperty = null;
	if ($isPricePropertyDisplayed)
	{
		// region R R R R R R  S R R R S S R R  S  S R R R R  R R  R S R S R R R S R  R R S RioR R S  R S R R S R R R R RioS 
		if (Iblock\OrmPropertyFormatter::showCostM2(!empty($arParams['USING_PRICE_MODE']) ? $arParams['USING_PRICE_MODE'] : 'FLAT_PRICE_MODE'))
		{
			$priceProperty = 'cost_m2';
			$selectPricePropertyIn($apartmentDisplayProperties, $priceProperty);
			$selectPricePropertyIn($arParams['PROPERTY_CODE'], $priceProperty);
		}
		else
		{
			$priceProperty = 'costa';
			$selectPricePropertyIn($apartmentDisplayProperties, $priceProperty);
			$selectPricePropertyIn($arParams['PROPERTY_CODE'], $priceProperty);
		}
		// endregion
	}

	// region 1. R R S R R S RioS R R R R RioR  S R R R S S R  S R R R R R S R  R R  R R R R RioS R R R Rio (S R S R R  \Citrus\Developer\Template\Property)
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
	// endregion


	$displayAsBounds = [
		'cost_m2',
		'costa',
		'common_area',
		'living_area',
		'kitchen_area',
	];

	$calcFields = $apartmentsQuery($arResult['ID'], static function (CalcLinked $calc) use ($apartmentProperties, $apartmentDisplayProperties, $priceProperty) {

		if ($priceProperty == 'costa')
		{
			$calc->addCostAppartments('PROPERTY_costa_VALUE');
		}
		elseif ($priceProperty == 'cost_m2')
		{
			$calc->addCostPerSqm('PROPERTY_cost_m2_VALUE');
		}

		/** @var string $code */
		foreach ($apartmentDisplayProperties as $code)
		{
			if ($apartmentProperties[$code]['MULTIPLE'] != 'Y' && $apartmentProperties[$code]['PROPERTY_TYPE'] != 'F')
			{
				$calc->addPropertyBounds($code);
				$calc->addPropertyValues($code);
			}
		}
	})->fetch();

	$activeCount = (int)$calcFields['ACTIVE_COUNT'];
	$totalCount = (int)$calcFields['TOTAL_COUNT'];

	$propertyFormatter = new Iblock\OrmPropertyFormatter([], Iblock::getId(Iblock::APARTMENTS));
	if ($priceProperty == 'costa')
	{
		$propertyFormatter->mockCostAppartments();
	}
	elseif ($priceProperty == 'cost_m2')
	{
		$propertyFormatter->mockCostPerSqm();
	}
	$propertyFormatter->mockFlatCount(
		$activeCount + $totalCount == 0
			? 0
			: $activeCount . Loc::getMessage("CITRUS_DEVELOPER_FLAT_COUNT_FROM") . $totalCount
	);

	// region 3. R R S R R S RioS R R R R RioR  S R R R S S R  S R R R R R S R  R R  R R R S S RioS S  (S R S R R  \Citrus\Developer\Iblock\OrmPropertyFormatter)
	foreach ($apartmentDisplayProperties as $property)
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

		if (!empty($minVal))
		{
			if (is_array($arResult['DISPLAY_PROPERTIES'][$property]))
			{
				$arResult['DISPLAY_PROPERTIES'][$property] = array_merge(
					$arResult['DISPLAY_PROPERTIES'][$property],
					$propertyFormatter->get('DISPLAY_PROPERTIES.' . $property)
				);
			}
			else
			{
				$arResult['DISPLAY_PROPERTIES'][$property] = $propertyFormatter->get('DISPLAY_PROPERTIES.' . $property);
			}
		}
		else
		{
			// @todo R R S R R R S S Rio R R R R R R RioR  Rio R R R R RioS Rio S S R R S  R S R R R RioR R S S  R R RioR R R R R  R R R R R RioS RioR R  R S  R R R R R R R R R R S S Rio S  R R R S S RioS 
		}
	}
	// endregion
	if (in_array('flats_count', $arParams['PROPERTY_CODE']))
	{
		$arResult['DISPLAY_PROPERTIES']['flats_count'] = $propertyFormatter->get('DISPLAY_PROPERTIES.flats_count');
	}
}
// endregion R R R R R S R R R R  R R R S R R RioR  S R R R S S R  R R S  R S R R S R R R R RioS 

$arResult['PDF'] = \Citrus\Core\Components\Pdf::encodeParams([
	'ID' => $arResult['ID'],
	'IBLOCK_ID' => $arParams["IBLOCK_ID"],
	'PROPERTY_CODE' => $arParams['PROPERTY_CODE'] ?: [],
	'USING_PRICE_MODE' => $arParams['USING_PRICE_MODE'],
	'SHOW_DEACTIVATED' => 'Y',
], 'bitrix:catalog.element', 'pdf_detail');
