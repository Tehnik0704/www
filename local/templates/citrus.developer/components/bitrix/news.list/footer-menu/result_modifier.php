<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Citrus\Developer\Components\JkFormatter;

if(!$arParams['LIST_PAGE_URL'] || !$arParams['LIST_NAME']) {
	$arParams['LIST_PAGE_URL'] = \Citrus\Developer\TemplateHelper::preparePath($arResult['LIST_PAGE_URL']);
	$arParams['LIST_NAME'] = $arResult['NAME'];
}

/**
 * $arParams['JK_TEMPLATE'] === 'Y' -- spisok domov, inache spisok ZhK
 */
if ($arParams['JK_TEMPLATE'] === 'Y' && class_exists('Citrus\\Developer\\Components\\ResidentalComplex\\Component')) {
	array_walk($arResult['ITEMS'], function(&$arItem){
		$arItem['DETAIL_PAGE_URL'] = \Citrus\Developer\Components\ResidentalComplex\Component::getInstance()->getRouter()->getUrl(
			'house_detail',
			array(
				'HOUSE_CODE' => $arItem['CODE'],
				'HOUSE_ID' => $arItem['ID']
			)
		);
	});
}
else
{
	array_walk($arResult['ITEMS'], function(&$arItem)
	{
		$arItem['NAME'] = JkFormatter::format('#TYPE_FULL# &laquo;#NAME#&raquo;', $arItem);
	});
}
