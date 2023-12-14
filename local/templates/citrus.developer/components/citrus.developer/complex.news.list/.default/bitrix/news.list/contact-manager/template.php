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

use Bitrix\Main\Localization\Loc;

foreach ($arResult['ITEMS'] as $arItem)
{
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>

<h3 class="manager-title"><?= Loc::getMessage("CITRUS_DEVELOPER_CONTACT_MANAGER") ?></h3>
<div class="manager" id="<?= $this->GetEditAreaId($arItem['ID']);?>">
    <div class="manager-img-container">
        <div class="manager-img" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['MIN']['src']?>);"></div>
    </div>
    <div class="manager__content">
        <div class="manager__name h3"><?=$arItem['DISPLAY_NAME']?></div>
        <div class="manager__properties">
	        <?$APPLICATION->IncludeComponent(
		        "citrus.developer:template",
		        "properties",
		        array(
			        'ITEM'=> $arItem,
			        'PROPERTIES' => array_diff(
				        array_intersect($arParams['PROPERTY_CODE'], array_keys($arItem['PROPERTIES'])),
			            ['DEPARTMENT', 'POSITION']
			        )
		        ),
		        $component,
		        array("HIDE_ICONS" => "Y")
	        );?>
        </div>
	    <div class="manager__btn">
			<a href="<?=SITE_DIR?>ajax/order_call.php" class="btn btn-primary btn-small" data-toggle="modal"><?=
				Loc::getMessage('CITRUS_DEVELOPER_CONTACT_MANAGER_BTN') ?></a>
	    </div>
    </div>
</div>

<?php break; } ?>
