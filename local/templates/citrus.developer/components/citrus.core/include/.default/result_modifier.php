<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Citrus\Core\SolutionFactory;
use Citrus\Developer\Components\DeveloperSettingsWidgetComponent;

CBitrixComponent::includeComponentClass('citrus.developer:settings.widget');

$arResult['ACTIVE'] = true;
$arResult['CAN_EDIT'] = $APPLICATION->GetUserRight('citrus.arealty') >= 'W'
	|| DeveloperSettingsWidgetComponent::$wasIncluded;

if (!empty($arParams['WIDGET_REL']) && is_array($arParams['WIDGET_REL']))
{
	$hiddenNum = 0;
	$SettingsTable = SolutionFactory::get(SITE_ID)->settings();
	$blocksSetting = $SettingsTable::getValue('BLOCKS', SITE_ID, false);
	foreach ($arParams['WIDGET_REL'] as $blockWidgetRel)
	{
		if ($blocksSetting[$blockWidgetRel] === false)
		{
			$hiddenNum++;
		}
	}
	$arResult['ACTIVE'] = $hiddenNum < count($arParams['WIDGET_REL']);
}
else if ($arParams['WIDGET_REL'])
{
	if (!empty($arParams['JK_SETTINGS']))
	{
		$arResult['ACTIVE'] = in_array($arParams['WIDGET_REL'], $arParams['JK_SETTINGS']);
	}
	else
	{
		$SettingsTable = SolutionFactory::get()->settings();
		/**
		 * Kastomnie bloki (dobavlennie v shablone, naprimer), budut otsutstvovaty v znachenii po umolchaniyu.
		 * Bloaki nuzhno po umolchaniyu pokazivaty
		 *
		 * Viklyuchennie bloki budut === false, novie kastomnie   null
		 */
		$blocksSetting = $SettingsTable::getValue('BLOCKS', SITE_ID, false) ?: [];
		$arResult['ACTIVE'] = (!isset($blocksSetting[$arParams['WIDGET_REL']])
			|| ($blocksSetting[$arParams['WIDGET_REL']] !== false));
	}
}

if (!empty($arResult['CONTENTBLOCK']['TITLE']))
{
	$arParams['TITLE'] = $arResult['CONTENTBLOCK']['TITLE'];
	$arParams['~TITLE'] = $arResult['CONTENTBLOCK']['TITLE'];
}
if (!empty($arResult['CONTENTBLOCK']['DESCRIPTION']))
{
	$arParams['DESCRIPTION'] = $arResult['CONTENTBLOCK']['DESCRIPTION'];
	$arParams['~DESCRIPTION'] = $arResult['CONTENTBLOCK']['DESCRIPTION'];
}
if (!empty($arResult['CONTENTBLOCK']['BIG_DESCRIPTION']))
{
	$arParams['BIG_DESCRIPTION'] = $arResult['CONTENTBLOCK']['BIG_DESCRIPTION'];
	$arParams['~BIG_DESCRIPTION'] = $arResult['CONTENTBLOCK']['BIG_DESCRIPTION'];
}
if (!empty($arResult['CONTENTBLOCK']['TEXTP']))
{
	$arParams['TEXTP'] = $arResult['CONTENTBLOCK']['TEXTP'];
	$arParams['~TEXTP'] = $arResult['CONTENTBLOCK']['TEXTP'];
}
