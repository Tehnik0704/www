<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

use Citrus\Developer\Helper;
?>
<?if(!empty($arResult["ITEMS"])):?>
	<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	$phone = $arItem['PROPERTIES']['PHONE']['VALUE'][0];
	?>
	<a  id="<?=$this->GetEditAreaId($arItem['ID']);?>"
	    href="tel:<?=Helper::clearPhoneNumber($phone)?>"
	    class="h__phone-number display-xs-n display-md-b display-dt-n"><?=$phone?></a>
	<?endforeach;?>
<?endif;?>
