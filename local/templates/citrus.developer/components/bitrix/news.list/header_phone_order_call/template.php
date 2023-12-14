<?php

use Citrus\Developer\Helper;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);

if (empty($arResult['ITEMS']))
{
	return;
}

?>

<?php foreach($arResult["ITEMS"] as $arItem)
{
	$phone = $arItem['PROPERTIES']['PHONE']['VALUE'][0];
?>

	<div class="order-call__phone-number display-md-n">
        <a href="tel:<?= Helper::clearPhoneNumber($phone) ?>" class="header-phone-number"><?= $phone ?></a>
    </div>

<?php } ?>
