<?php

use Bitrix\Main\Localization\Loc;
use Citrus\Developer\Components\JkFormatter;
use Citrus\Developer\Template\Property;
use Citrus\Developer\Iblock;

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

$showCostM2 = Iblock\OrmPropertyFormatter::showCostM2(!empty($arParams['USING_PRICE_MODE'])?
	$arParams['USING_PRICE_MODE'] : 'FLAT_PRICE_MODE');
$isNonResidental = !empty($arParams['NON_RESIDENTAL']);

?>

<section class="section _with-padding section-color-n">
    <div class="w">
        <div class="section-inner">
            <header class="section__header">
                <h1><?=!empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
		                ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
		                : $arResult['NAME']?></h1>
                <div class="section-description">
	                <?= Loc::getMessage("JK_NAME", array('#JK_NAME#'=> $arResult['JK']['NAME']))?> <?=$arResult['JK']['ADDRESS']?>
                </div>
            </header>

            <div class="catalog-detail flat-catalog-detail">
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

	                    <div class="swiper-container">
		                    <div class="swiper-wrapper">
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
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
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
                    <div class="h3 catalog-detail__properties-title"><?=($isNonResidental ? Loc::getMessage("ROOM_PROPERTIES") : Loc::getMessage("FLAT_PROPERTIES"))?></div>

	                <a href="<?=$arResult['JK']['DETAIL_PAGE_URL']?>"
	                   class="catalog-detail__jk-link print-hidden"
	                >
		                <?=JkFormatter::format('#TYPE_SHORT# &laquo;#NAME#&raquo;', $arResult['JK'])?>
	                </a>

	                <div class="catalog-detail__properties">
	                    <?php
	                    $property = new Property($arResult);
	                    $houseProperty = $isNonResidental ? $property : new \Citrus\Developer\Template\Property($arResult['HOUSE']);

                        ?>
                        <div class="catalog-detail__property">
                            <div class="catalog-detail__property-name">
                                <?php
                                if ($isNonResidental)
                                {
	                                ?><?=$houseProperty->getName('geodata')?><?
                                }
                                else
                                {
                                    ?><a href="<?=$arResult['HOUSE']['DETAIL_PAGE_URL']?>"><?=$arResult['HOUSE']['NAME']?></a><?
                                }
                                ?>
                            </div>
                            <div class="catalog-detail__property-value"><div class="catalog-detail__property-value__inner"><?=$houseProperty->getFormatValue('geodata')?></div></div>
                        </div>

	                    <?php

	                    $printPropertyKeys = array_diff($arParams['PROPERTY_CODE'], Iblock\PropertyFormatter::$excludeProperties);

	                    $planProperty = new Property($arResult['PLAN']);
	                    foreach ($printPropertyKeys as $propertyKey):
		                    ?>
	                        <?if($planProperty->hasValue($propertyKey) || $property->hasValue($propertyKey)):?>
			                    <div class="catalog-detail__property" data-code="<?=$propertyKey?>">
				                    <div class="catalog-detail__property-name"><?=($property->getName($propertyKey) ?: $planProperty->getName($propertyKey))?></div>
				                    <div class="catalog-detail__property-value">
					                    <div class="catalog-detail__property-value__inner">
						                    <?=$property->hasValue($propertyKey) ?
							                    $property->getFormatValue($propertyKey) :
							                    $planProperty->getFormatValue($propertyKey);
							                    ?></div>
				                    </div>
			                    </div>
	                        <?endif;?>
	                    <?endforeach;?>
                    </div><!-- .catalog-detail__properties -->

					<? $vygoda = $arResult["PROPERTIES"]['vygoda']['VALUE'];
					if (!empty($vygoda)) {
						?>
						<div class="h3 vygoda">
						Выгода: <?= number_format($vygoda, 0, '', ' ')  ?> руб.
					</div><?
					}
					?>
					

	                <?if($arResult['DETAIL_TEXT']):?>
		                <div class="catalog-detail__description">
			                <div class="h3"><?=($isNonResidental ? Loc::getMessage("ROOM_DETAIL_TEXT_TITLE") : Loc::getMessage("FLAT_DETAIL_TEXT_TITLE"))?></div>
			                <div class="catalog-detail__description-text">
				                <?=$arResult['DETAIL_TEXT']?>
			                </div>
		                </div>
	                <?endif;?>

	                <?if($arResult['ACTIVE'] === 'Y'):?>
		                <?php
		                    if ($showCostM2)
		                    {
			                    $price = $property->getValue('cost_m2') ?: $planProperty->getValue('cost_m2');
		                    }
		                    else
							{
								$price = $property->getValue('cost') ?: $planProperty->getValue('cost');
		                    }
		                ?>
	                    <?if($price):?>
			                <div class="catalog-detail__price">
				                <span class="price-value"
				                	data-currency-base="<?=$price?>"
							   		data-currency-icon=""
							   		data-currency-noconv="1"></span>
							   	<?= $showCostM2 ?>
			                </div>
			                <script>currency.updateHtml($('.catalog-detail__price'));</script>
	                    <?endif;?>
	                <?else:?>
	                    <div class="catalog-detail__flat-disable-text"><?=($isNonResidental ? Loc::getMessage("ROOM_DISABLE_SORRY_TEXT") : Loc::getMessage("FLAT_DISABLE_SORRY_TEXT"))?></div>
	                <?endif;?>


                    <div class="catalog-detail__order print-hidden">
	                    <a href="<?=SITE_DIR?>ajax/request.php"
	                       data-modal-id="<?=$arResult['ID']?>"
	                       class="btn btn-primary btn-stretch"
	                       data-toggle="modal"><?= $arResult['ACTIVE'] === 'Y' ?
			                    ($isNonResidental ? Loc::getMessage("ROOM_DETAIL_ORDER_LINK") : Loc::getMessage("FLAT_DETAIL_ORDER_LINK")) :
			                    Loc::getMessage("FLAT_DISABLE_DETAIL_ORDER_LINK") ?></a>
	                    <?if($arResult['ACTIVE'] === 'Y'):?>
		                    <a href="<?=SITE_DIR?>ajax/pdf.php?icalculator=1"
		                       data-toggle="modal"
		                       data-modal-params="<?=$arResult['PDF']?>"
		                       class="mortgage-link" >
			                    <span class="mortgage-link__icon icon-calc"></span>
			                    <span class="mortgage-link__text"><?= Loc::getMessage("FLAT_MORTGAGE_LINK") ?></span>
		                    </a>
	                    <?endif;?>
                    </div>
                </div><!-- .catalog-detail__right -->
            </div><!-- .catalog-detail -->

        </div><!-- .section-inner -->
    </div><!-- .w -->
</section>

<?#floor_plan?>
<?if($arResult['PLAN']["PROPERTIES"]['floor_plan']['VALUE']):?>
				<?php ob_start() ?>
				<img src="<?=$arResult['PLAN']["PROPERTIES"]['floor_plan']['VALUE']['src']?>" alt="">

				<footer class="section-footer">
					<a data-toggle="modal"
					   href="<?=SITE_DIR?>ajax/request.php"
					   data-modal-object="<?=$arResult['ID']?>"
					   class="btn btn-primary btn-stretch"><?= $arResult['ACTIVE'] === 'Y' ?
							Loc::getMessage("FLAT_DETAIL_ORDER_LINK") :
							Loc::getMessage("FLAT_DISABLE_DETAIL_ORDER_LINK")
						?></a>
				</footer>
				<? $APPLICATION->IncludeComponent(
					"citrus.core:include",
					".default",
					array(
						"TITLE" => Loc::getMessage("FLAT_DETAIL_PLAN_TITLE"),
						"AREA_FILE_SHOW" => "html",
						"h" => ".h1",
						"HTML" => ob_get_clean(),
						"PAGE_SECTION" => "Y",
						"COMPONENT_TEMPLATE" => ".default",
						"DATA_SRC" => "flat-detail-plan",
						"CLASS" => "print-hidden",
					),
					false
				); ?>
<?endif;?>

<style>
	.vygoda {
		color: red;
		text-transform: none;
	}
</style>