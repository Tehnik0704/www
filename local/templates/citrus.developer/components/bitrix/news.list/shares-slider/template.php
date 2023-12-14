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
                    <div class="p__swiper shares-slider _nav-offset">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <?foreach($arResult["ITEMS"] as $arItem):?>
                                    <?
                                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                    ?>
                                    <div class="swiper-slide overflow-h" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
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
                        </div><!-- .swiper-container -->
	                    <div class="swiper-pagination swiper-pagination--lines"></div>
                        <div class="swiper-button-prev"><span class="icon-arrow_left"></span></div>
                        <div class="swiper-button-next"><span class="icon-arrow_right"></span></div>
                        <script>
	                        ;(function(){
		                        // http://idangero.us/swiper/api/
		                        new Swiper('.shares-slider .swiper-container', {
			                        // pagination
			                        pagination: {
				                        el: '.shares-slider .swiper-pagination',
				                        clickable: true,
				                        renderBullet: swiperRenderBullets,
			                        },
			                        // Navigation arrows
			                        navigation: {
				                        nextEl: '.shares-slider .swiper-button-next',
				                        prevEl: '.shares-slider .swiper-button-prev',
			                        }
		                        });
	                        }());
                        </script>
                    </div><!-- .shares-slider -->

                <footer class="section-footer">
                    <a href="<?=$arResult['LIST_PAGE_URL']?>" class="btn btn-more"><?=Loc::getMessage("CITRUS_TEMPLATE_ALL")?> <?=$arParams['PAGER_TITLE']?></a>
                </footer>
            <?endif;?>
