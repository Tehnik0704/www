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
                <div class="news-standard">
                    <div class="row">
                        <?foreach($arResult["ITEMS"] as $arItem):?>
                            <?
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <div class="col-lg-4 col-sm-6">
                                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="news-standard__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                    <span class="news-standard__img-container img-placeholder">
                                        <span class="news-standard__img"
                                              <?if($arItem['PREVIEW_PICTURE']['SRC']):?>
                                                  style="background-image: url('<?=$arItem['PREVIEW_PICTURE']['SRC']?>');"
                                              <?endif;?>>
                                        </span>
                                    </span>
                                    <span class="news-standard__content">
                                        <span class="news-standard__name"><?=$arItem['NAME']?></span>
                                        <span class="news-standard__date"><?=$arItem['DISPLAY_ACTIVE_FROM']?></span>
                                    </span>
                                </a><!-- .news-standard__item -->
                            </div>
                        <?endforeach;?>
                    </div><!-- .row -->
                </div><!-- .news-standard -->

                <script>
                    ;(function(){
	                    $('.news-standard').each(function () {
		                    $(this).find('.news-standard__content').responsiveEqualHeightGrid();
	                    });
                    }());
                </script>
            <?endif;?>

            <?if($arParams['DISPLAY_BOTTOM_PAGER']):?>
                <?=$arResult['NAV_STRING']?>
            <?else:?>
                <footer class="section-footer">
                    <a href="<?=$arResult['LIST_PAGE_URL']?>" class="btn btn-more"><?=Loc::getMessage("CITRUS_TEMPLATE_ALL")?> <?=$arParams['PAGER_TITLE']?></a>
                </footer>
            <?endif;?>
