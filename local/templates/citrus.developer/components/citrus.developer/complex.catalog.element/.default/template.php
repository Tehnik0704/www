<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

if (!empty($arParams['VIEW_TARGET']))
{
	$this->SetViewTarget($arParams['VIEW_TARGET']);
}

$arResult['RETURN_VALUE'] = $APPLICATION->IncludeComponent(
	'bitrix:catalog.element',
	$arParams['VIEW_TEMPLATE'],
	$arParams,
	$component
);
