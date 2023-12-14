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

if (empty($arResult['ITEMS'])) return;
?>

<div class="p__swiper reviews-slider _nav-offset _pagination-hide-nav">
    <div class="swiper-container">
        <div class="swiper-wrapper">
	        <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
            <div class="swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="reviews__item">
                    <div class="reviews__item-header">
                        <?if($arItem['PREVIEW_PICTURE']['MIN']['src']):?>
                            <div class="reviews__img-w">
                                <span class="reviews__img" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['MIN']['src']?>);"></span>
                            </div>
                        <?endif;?>

                        <div class="reviews__item-header__content">
                            <div class="reviews__name"><?=$arItem['NAME']?></div>

                            <?if($arItem['DISPLAY_PROPERTIES']['COMPLEX']['DISPLAY_VALUE']):?>
                                <div class="reviews__description">
                                    <?=$arItem['DISPLAY_PROPERTIES']['COMPLEX']['DISPLAY_VALUE']?>
                                </div>
                            <?endif;?>
                        </div>
                    </div>

                    <div class="reviews__text"><?=$arItem['PREVIEW_TEXT']?></div>
                </div>
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
		    new Swiper('.reviews-slider .swiper-container', {
			    watchOverflow: true,

			    // pagination
			    pagination: {
				    el: '.reviews-slider .swiper-pagination',
				    clickable: true,
				    renderBullet: swiperRenderBullets,
			    },
			    // Navigation arrows
			    navigation: {
				    nextEl: '.reviews-slider .swiper-button-next',
				    prevEl: '.reviews-slider .swiper-button-prev',
			    },

			    slidesPerView: 2,
			    spaceBetween: 60,
			    breakpoints: {
				    767: {
					    slidesPerView: 1,
					    spaceBetweenSlides: 0
				    }
			    }
		    });
	    }());
    </script>
</div><!-- .reviews-slider -->

<footer class="section-footer">
    <a href="<?=SITE_DIR?>ajax/review.php" data-toggle="modal" class="btn btn-primary"><?=Loc::getMessage("SEND_REVIEW")?></a>
</footer>

