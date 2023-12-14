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

use Bitrix\Main\Localization\Loc,
	Arrilot\BitrixHermitage\Action;
?>


<div class="manager" id="<?=Action::editIBlockElement($this, $arResult)?>">
    <div class="manager-img-container">
	    <img class="manager-img"
	         src="<?=$arResult['PREVIEW_PICTURE']['MIN']['src']?>"
	         alt="<?=$arResult['PREVIEW_PICTURE']['ALT']?>"
	         title="<?=$arResult['PREVIEW_PICTURE']['TITLE']?>" >
    </div>
    <div class="manager__content">
        <div class="manager__name h3"><?=$arResult['DISPLAY_NAME']?></div>
        <div class="manager__properties">
	        <?$APPLICATION->IncludeComponent(
		        "citrus.developer:template",
		        "properties",
		        array(
			        'ITEM' => $arResult,
			        'PROPERTIES'=> array_diff(
				        array_intersect($arParams['PROPERTY_CODE'], array_keys($arResult['PROPERTIES'])),
				        ['DEPARTMENT', 'POSITION']
			        ),
		        ),
		        $component,
		        array("HIDE_ICONS" => "Y")
	        );?>
        </div>
    </div>
</div>
