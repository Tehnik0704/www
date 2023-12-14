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
?>

<h3 class="manager-title"><?= Loc::getMessage("CITRUS_DEVELOPER_CONTACT_MANAGER") ?></h3>
<div class="manager">
    <div class="manager-img-container">
        <div class="manager-img" style="background-image: url(<?=$arResult['PREVIEW_PICTURE']['MIN']['src']?>);"></div>
    </div>
    <div class="manager__content">
        <div class="manager__name h3"><?=$arResult['DISPLAY_NAME']?></div>
        <div class="manager__properties">
	        <?$APPLICATION->IncludeComponent(
		        "citrus.developer:template",
		        "properties",
		        array(
			        'ITEM'=> $arResult,
			        'PROPERTIES' => array_diff(
				        array_intersect($arParams['PROPERTY_CODE'], array_keys($arResult['PROPERTIES'])),
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
