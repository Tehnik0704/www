<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if (!empty($arParams['BROWSER_TITLE']) && ($arParams['BROWSER_TITLE'] == 'Y'))
{
	if (!empty($arResult['CONTENTBLOCK']['TITLE']))
	{
		$APPLICATION->SetTitle($arResult['CONTENTBLOCK']['TITLE']);
	}
	else
	{
		$APPLICATION->SetTitle($arParams['~TITLE']);
	}
}
