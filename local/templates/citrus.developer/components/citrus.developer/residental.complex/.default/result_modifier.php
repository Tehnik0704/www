<?php

/** @var array $arParams Parametri, chtenie, izmenenie. Ne zatragivaet odnoimenniy chlen komponenta, no izmeneniya tut vliyayut na $arParams v fayle template.php. */
/** @var array $arResult Rezulytat, chtenie/izmenenie. Zatragivaet odnoimenniy chlen klassa komponenta. */
/** @var CBitrixComponentTemplate $this Tekushtiy shablon (obaekt, opisivayushtiy shablon) */

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$customPath = $this->__folder . '/' . $this->__page . '_custom.php';
if (file_exists($_SERVER['DOCUMENT_ROOT'] . $customPath))
{
	$this->__page .= '_custom';
	$this->__file = $customPath;
}

/** @var Citrus\Developer\Components\ResidentalComplex\Component $component */
$component = $this->getComponent();
/** @var \Citrus\Developer\Router $router */
$router = $component->getRouter();

\Bitrix\Main\Localization\Loc::loadMessages(__DIR__.'/complex.php');
