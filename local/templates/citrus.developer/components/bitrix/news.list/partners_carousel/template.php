<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

if (empty($arResult['ITEMS'])) return;
?>

<div class="p__swiper partner-list _nav-offset _pagination-hide-nav">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                $this->AddEditAction('partner_' . $arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction('partner_' . $arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

                $arPicture = false;
                $arPicture = $arItem["PREVIEW_PICTURE"] ? $arItem["PREVIEW_PICTURE"] : $arItem["DETAIL_PICTURE"];
                if($arPicture){
                    $arSmallPicture = CFile::ResizeImageGet(
                        $arPicture,
                        array(
                            'width' => intval($arParams['RESIZE_IMAGE_WIDTH']) <= 0 ? 250 : intval($arParams['RESIZE_IMAGE_WIDTH']),
                            'height' => intval($arParams['RESIZE_IMAGE_HEIGHT']) <= 0 ? 250 : intval($arParams['RESIZE_IMAGE_HEIGHT']),
                        ),
                        BX_RESIZE_IMAGE_PROPORTIONAL,
                        $bInitSizes = true
                    );
                }
                ?>
                <?if($arPicture):?>
                    <div class="swiper-slide partner-item" id="<?=$this->GetEditAreaId('partner_' . $arItem['ID']);?>">
                        <img src="<?=$arSmallPicture["src"]?>" alt="<?=($arPicture["ALT"]) ? $arPicture["ALT"] : $arItem["NAME"]?>" title="<?=($arPicture["TITLE"]) ? $arPicture["TITLE"] : $arItem["NAME"]?>">
                    </div>
                <?endif;?>
            <?endforeach;?>
        </div><!-- .swiper-wrapper -->
    </div><!-- .swiper-container -->

	<div class="swiper-pagination swiper-pagination--lines"></div>
    <div class="swiper-button-prev"><span class="icon-arrow_left"></span></div>
    <div class="swiper-button-next"><span class="icon-arrow_right"></span></div>
</div><!-- .partner-list -->
<script>
	;(function(){
		new Swiper(".partner-list .swiper-container", {
			watchOverflow: true,
			// pagination
			pagination: {
				el: '.partner-list .swiper-pagination',
				clickable: true,
				renderBullet: swiperRenderBullets,
			},
			// Navigation arrows
			navigation: {
				nextEl: '.partner-list .swiper-button-next',
				prevEl: '.partner-list .swiper-button-prev',
			},
			slidesPerView: 5,
			spaceBetween: 30,
			breakpoints: {
				1023: {
					slidesPerView: 4,
					spaceBetween: 30,
				},
				767: {
					slidesPerView: 3,
					spaceBetween: 30,
				},
				479: {
					slidesPerView: 2,
					spaceBetween: 20,
				}
			}
		});
	}());
</script>

