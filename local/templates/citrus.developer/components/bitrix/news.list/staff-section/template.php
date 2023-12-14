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

$splitSections = $arParams['SPLIT_SECTION'] !== 'N';

$issetProperties = function ($arProperties = array()) use (&$arItem) {
    $isset = false;
    foreach ($arProperties as $propertyCode) {
        if ($arItem['PROPERTIES'][$propertyCode]['VALUE']) $isset = true;
    }
    return $isset;
};

if (empty($arResult['SECTIONS'])) return;
?>

<div class="staff-sections <?if($splitSections):?>_split-sections<?endif;?>">
    <?foreach ( $arResult['SECTIONS'] as $sectionKey => $arSection):?>
        <div class="staff-section__item">

            <h2 class="staff-section__name"><?=$arSection['NAME']?></h2>

            <div class="staff-section__row">
            <?foreach ( $arSection['ITEMS'] as $arItem):
	            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
                <div class="staff-section__col">
                    <div class="staff-item" onclick="" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
                        <div class="staff-item__image img-placeholder">
                            <span style="background-image: url('<?=$arItem['PREVIEW_PICTURE']["MIN"]['src']?>');"></span>
                        </div>
                        <div class="staff-item__content">
                            <?if($issetProperties(array('EMAIL','TIMETABLE', 'PHONE'))):?>
                                <span class="staff-item__content-icon icon-arrow_top"></span>
                            <?endif;?>

                            <div class="staff-item__content-top">
                                <div class="staff-item__name h3" title="<?=$arItem['NAME']?>"><?=$arItem['DISPLAY_NAME']?></div>

	                            <?if($arItem['PROPERTIES']['POSITION']['VALUE']):?>
                                    <div class="staff-item__position"><?=$arItem['PROPERTIES']['POSITION']['VALUE']?></div>
	                            <?endif;?>
                            </div>

	                        <?$APPLICATION->IncludeComponent(
		                        "citrus.developer:template",
		                        "properties",
		                        array(
		                        	'ITEM' => $arItem,
			                        'PROPERTIES'=> array_diff(
			                        	array_keys($arItem['PROPERTIES']),
				                        ['DEPARTMENT', 'POSITION']
			                        ),
		                        ),
		                        $component,
		                        array("HIDE_ICONS" => "Y")
	                        );?>

                        </div>
                    </div><!-- .staff-item -->
                </div>
            <?endforeach;?>
            </div><!-- .staff-section__items -->
        </div><!-- .staff-sections__item -->
    <?endforeach;?>
</div><!-- .staff-sections -->

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?else:?>
    <footer class="section-footer">
        <div class="btn-row btn-row--xs-center">
            <a href="<?=SITE_DIR?>ajax/request.php" data-toggle="modal" class="btn btn-primary"><?=Loc::getMessage("STAFF_FOOTER_WRITE_FORM_BTN")?></a>
            <a href="<?=$arResult['LIST_PAGE_URL']?>" class="btn btn-more"><?=Loc::getMessage("STAFF_FOOTER_ALL")?> <?=$arParams['PAGER_TITLE']?></a>
        </div>
    </footer>
<?endif;?>

