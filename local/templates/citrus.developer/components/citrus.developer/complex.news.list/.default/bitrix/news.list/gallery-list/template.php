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

$mainButtons = CIBlock::GetPanelButtons(
	$arParams["IBLOCK_ID"],
	0,
	$arParams["USE_SECTION_ID"],
	array("SECTION_BUTTONS" => false, "SESSID" => false)
);
$mainButtonsAreaId = "photo_progerss_list_" . $arParams["USE_SECTION_ID"];

?>

<div id="ajax-photo-container">

	<div class="row row-grid"
			id="<?= $this->GetEditAreaID($mainButtonsAreaId) ?>">
		<?php 
		$this->AddEditAction(
			$mainButtonsAreaId,
			$mainButtons["edit"]["add_element"]["ACTION_URL"],
			$mainButtons["edit"]["add_element"]["TITLE"]
		);
		?>
	    <?foreach($arResult["ITEMS"] as $arItem):?>
	        <?
	        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	        ?>
	
	    <div class="col-lg-4 col-sm-6" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	        <?$APPLICATION->IncludeComponent(
	            "citrus.developer:template",
	            "gallery-card",
	            array(
		            'DATA' => $arItem,
	            ),
	            $component,
	            array("HIDE_ICONS" => "Y")
	        );?>
	    </div>
	    <?endforeach;?>
	</div>
</div>
