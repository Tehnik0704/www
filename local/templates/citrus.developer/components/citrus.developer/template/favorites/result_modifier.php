<?php

use \Citrus\Developer\Iblock;
use Citrus\Core\SolutionFactory;

/** @var array $arParams */

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if (!array_key_exists('PROPERTY_CODE', $arParams))
{
	$arParams['PROPERTY_CODE'] = [];
	foreach (($this->__component->GetParent() ? $this->__component->GetParent()->arParams['FLAT_DETAIL_PROPERTIES'] : []) as $v)
	{
		$arParams['PROPERTY_CODE'][] = $v['code'];
	}
}

if (!array_key_exists('USING_PRICE_MODE', $arParams))
{
	$SettingsTable = SolutionFactory::get()->settings();
	$arParams['USING_PRICE_MODE'] = $SettingsTable::getValue('FLAT_PRICE_MODE');
}

if (empty($arParams['PROPERTY_CODE']) && isset($arParams['PROPERTY_LIST']) && is_array($arParams['PROPERTY_LIST'])) {
	/**
	 * Vivedem v pdf svoystva iz kolonok spiska izbrannogo
	 */
	$arParams['PROPERTY_CODE'] = array_reduce(array_column($arParams['PROPERTY_LIST'], 'code'), function ($acc, $code) {
		if (is_string($code)) {
			$acc = array_merge($acc, explode('|', $code));
		}
		return array_unique($acc);
	}, []);
}

$arResult['PDF'] = \Citrus\Core\Components\Pdf::encodeParams([
	'IBLOCK_ID' => Iblock::getId(Iblock::APARTMENTS),
	'PROPERTY_CODE' => $arParams['PROPERTY_CODE'] ?: [],
	'COMPONENT_TEMPLATE' => 'pdf_detail',
	'SHOW_DEACTIVATED' => 'Y',
	'USING_PRICE_MODE' => $arParams['USING_PRICE_MODE'],
]);

foreach ($arParams['PROPERTY_LIST'] as $i => $prop)
{
	if (($prop['code'] == 'ready_date')
		|| ($prop['code'] == 'flats_count'))
	{
		$arParams['PROPERTY_LIST'][$i]['noSort'] = true;
	}
}

