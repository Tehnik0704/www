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

$isGrid = count($arResult["ITEMS"]) > 1;

$iconMap = array(
	'SOC_FB' => 'icon-fb',
	'SOC_VK' => 'icon-vk',
	'SOC_YOUTUBE' => 'icon-yt',
	'SOC_TW' => 'icon-tw',
	'SOC_INSTAGRAM' => 'icon-instagram',
	'SOC_ODNOKLASSNIKI' => 'icon-odnoklassniki',
);

$mode = $arParams['MODE']?:
	(count($arResult["ITEMS"]) === 1 ? 'grid-one' : 'grid')
?>

<div class="office-list <?='_mode-'.$mode?>">
	<?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>

    <div class="office" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <?if( $arParams['DISPLAY_PICTURE']=== 'Y' && $arItem['PREVIEW_PICTURE']['SRC'] && $mode === 'grid-one'):?>
            <div class="office__img _big"><img src="<?=$arItem['PREVIEW_PICTURE']['MIN']['src']?>" alt=""></div>
        <?endif;?>

        <div class="office__info">
	        <?if($arParams['DISPLAY_NAME'] === 'Y'):?>
		        <h3 class="office__name"><?=$arItem['NAME']?></h3>
	        <?endif;?>

	        <?if( $arParams['DISPLAY_PICTURE']=== 'Y' && $arItem['PREVIEW_PICTURE']['SRC'] && $mode):?>
                <div class="office__img _in-info"><img src="<?=$arItem['PREVIEW_PICTURE']['MIN']['src']?>" alt=""></div>
	        <?endif;?>

	        <?$APPLICATION->IncludeComponent(
		        "citrus.developer:template",
		        "properties",
		        array(
		        	'ITEM' => $arItem,
		        	'PROPERTIES'=> array_keys(array_diff_key(
		        		$arItem['DISPLAY_PROPERTIES'],
				        $arResult['SOC_PROPERTIES'],
				        array('MAIN' => 1)
			        )),
		        ),
		        $component,
		        array("HIDE_ICONS" => "Y")
	        );?>
	        
	        <?if(!empty($arResult['SOC_PROPERTIES'])):?>
	            <div class="soc-list <?if($mode !== 'footer'):?>soc-list_colored<?endif;?>">
		            <?foreach ( $arResult['SOC_PROPERTIES'] as $propertyCode => $arSoc):?>
			            <a href="<?=$arSoc['VALUE']?>" class="soc-it _<?=$arSoc['SOC']?>"><span class="<?=$iconMap[$propertyCode]?>"></span></a>
		            <?endforeach;?>
	            </div>
	        <?endif;?>

        </div><!-- .office__info -->
    </div><!-- .office -->

    <?endforeach;?>
</div><!-- .office-list -->
