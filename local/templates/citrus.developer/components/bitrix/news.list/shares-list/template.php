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

            <?if(!empty($arResult["ITEMS"])):?>
                <div class="share-list">
                    <?foreach($arResult["ITEMS"] as $arItem):?>
                        <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>

                        <div class="share-row" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                            <?$APPLICATION->IncludeComponent(
                                "citrus.developer:template",
                                "share",
                                array('DATA'=> $arItem),
                                $component,
                                array("HIDE_ICONS" => "Y")
                            );?>
                        </div>

                    <?endforeach;?>
                </div>
            <?endif;?>

            <footer class="section-footer">
                <a href="<?=SITE_DIR?>news-and-shares/" class="btn btn-more btn-stretch"><?=Loc::getMessage("SHARE_BACK")?></a>
            </footer>
