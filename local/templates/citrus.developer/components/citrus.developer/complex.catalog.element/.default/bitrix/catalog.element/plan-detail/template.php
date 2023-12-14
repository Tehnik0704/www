<?php

use Bitrix\Main\Localization\Loc;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

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

$property = new \Citrus\Developer\Template\Property($arResult);
$houseProperty = new \Citrus\Developer\Template\Property($arResult['HOUSE']);
?>

<section class="section _with-padding section-color-n">
    <div class="w">
        <div class="section-inner">
            <header class="section__header">
                <h1><?=!empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
		                ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
		                : $arResult['NAME']?></h1>
                <div class="section-description"><?= Loc::getMessage("PLAN_DESCRIPTION")?></div>
            </header>
	        
            <div class="catalog-detail plan-catalog-detail">
                <div class="catalog-detail__left p__swiper">
                    <div class="catalog-detail__image-container">

                        <div class="image-actions print-hidden<?=($arParams['NON_RESIDENTAL'] ? ' image-actions--few-items' : '')?>">
                            <a href="<?=SITE_DIR?>ajax/pdf.php"
                               data-modal-params="<?=$arResult['PDF']?>"
                               data-toggle="modal"
                               class="image-actions__link"
                            >
                                <span class="image-actions__link-icon"><i class="icon-mail-2"></i></span>
                                <span class="image-actions__link-text"><?= Loc::getMessage("FLAT_SEND_EMAIL_LINK") ?></span>
                            </a>
                            <a href="javascript:void(0);" onclick="print()" class="image-actions__link">
                                <span class="image-actions__link-icon"><i class="icon-print"></i></span>
                                <span class="image-actions__link-text"><?=($isNonResidental ? Loc::getMessage("ROOM_PRINT_LINK") : Loc::getMessage("FLAT_PRINT_LINK"))?></span>
                            </a>
                            <a href="javascript:void(0);"
                               class="image-actions__link js-add-to-favorites<?=($arParams['NON_RESIDENTAL'] ? ' hidden' : '')?>"
                               data-id="<?=$arResult['ID']?>"
                            >
                                <span class="image-actions__link-icon">
	                                <i class="in-favorite icon-heart-del"></i>
	                                <i class="not-in-favorite icon-heart"></i>
                                </span>
	                            <span class="image-actions__link-text">
		                            <span class="in-favorite"><?=Loc::getMessage('FLAT_REMOVE_FROM_FAVORITE')?></span>
		                            <span class="not-in-favorite"><?= Loc::getMessage("FLAT_ADD_FAVORITE") ?></span>
	                            </span>
                            </a>
                        </div>
 
	                    <div class="plan-images">
		                    <div class="plan-images-wrapper">
			                    <?if(empty($arResult['GALLERY'])):?>
			                        <div class="swiper-slide catalog-detail__image-link img-placeholder"></div>
			                    <?endif;?>
			                    <?foreach ( $arResult['GALLERY'] as $galleryItem):?>
				                    <a class="swiper-slide catalog-detail__image-link photoswipe" data-size="<?=$galleryItem['WIDTH']?>x<?=$galleryItem['HEIGHT']?>"
				                       href="<?=$galleryItem['SRC']?>">
					                    <img class="catalog-detail__image" src="<?=$galleryItem['MIN']['src']?>" alt="">
				                    </a>
			                    <?endforeach;?>
		                    </div>
		                    <?if(!empty($arResult['GALLERY'])):?>
		                    <span class="icon-zoom catalog-detail__image-zoom-icon print-hidden"></span>
		                    <?endif;?>
	                    </div><!-- .swiper-container -->
                    </div>
	                <div class="swiper-pagination"></div>
	                <script>
		                ;(function(){
			                // http://idangero.us/swiper/api/
			                var swiper = new Swiper('.catalog-detail__left .swiper-container', {
				                watchOverflow: true,
				                // pagination
				                pagination: {
					                el: '.catalog-detail__left .swiper-pagination',
					                clickable: true,
					                renderBullet: swiperRenderBullets,
				                },
				               navigation: {
					               nextEl: '.plans-slider .swiper-button-next',
					               prevEl: '.plans-slider .swiper-button-prev',
				               },
			                });

			                $('.photoswipe').initPhotoSwipe({
				                events: {
					                afterChange: function() {
						                var index = this.getCurrentIndex();
						                var slide = swiper.slides[index];
						                if ( !$(slide).hasClass('swiper-slide-visible')) swiper.slideTo(index, 0);
					                }
				                },
				                loop: false,
				                bgOpacity: .8
			                });
		                }());
	                </script>

                </div><!-- .catalog-detail__left -->
                <div class="catalog-detail__right">
                    <div class="h3 catalog-detail__properties-title"><?= Loc::getMessage("PLAN_PROPERTIES") ?></div>

	                <a href="<?=$arResult['JK']['DETAIL_PAGE_URL']?>"
	                   class="catalog-detail__jk-link print-hidden"
	                >
		                <?=\Citrus\Developer\Components\JkFormatter::format('#TYPE_SHORT# &laquo;#NAME#&raquo;', $arResult['JK'])?>
	                </a>

                    <div class="catalog-detail__properties">
                        <div class="catalog-detail__property">
                            <div class="catalog-detail__property-name">
                                <a href="<?=$arResult['HOUSE']['DETAIL_PAGE_URL']?>"><?=$arResult['HOUSE']['NAME']?></a>
                            </div>
                            <div class="catalog-detail__property-value"><div class="catalog-detail__property-value__inner"><?=$houseProperty->getFormatValue('geodata')?></div></div>
                        </div>
                        <?php
                        foreach ($arParams['PROPERTY_CODE'] as $code)
                        {
                        	$property = $arResult['DISPLAY_PROPERTIES'][$code];
                        	if (!is_array($property) || !$property['VALUE'])
	                        {
	                        	continue;
	                        }
                            ?>
                            <div class="catalog-detail__property">
                                <div class="catalog-detail__property-name"><?=$property['NAME']?></div>
                                <div class="catalog-detail__property-value"><div class="catalog-detail__property-value__inner"><?=$property['DISPLAY_VALUE']?></div></div>
                            </div>
                            <?php
                        }
                        ?>
                    </div><!-- .catalog-detail__properties -->

	                <?if($arResult['DETAIL_TEXT']):?>
		                <div class="catalog-detail__description">
			                <div class="h3"><?= Loc::getMessage("PLAN_DETAIL_TEXT_TITLE") ?></div>
			                <div class="catalog-detail__description-text">
				                <?=$arResult['DETAIL_TEXT']?>
			                </div>
		                </div>
	                <?endif;?>
                </div><!-- .catalog-detail__right -->

            </div><!-- .catalog-detail -->

        </div><!-- .section-inner -->
    </div><!-- .w -->
</section>
