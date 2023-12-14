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
?>

<?if(!empty($arResult["ITEMS"])):?>
    <div class="p__swiper benefits _center">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?foreach($arResult["ITEMS"] as $arItem):?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="swiper-slide">
                        <div class="benefit__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                            <div class="benefit__icon-container">
                                <img class="benefit__icon" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="" title="<?=$arItem['NAME']?>">
                            </div>
                            <div class="benefit__text">
                                <?=$arItem['NAME']?>
                            </div>
                        </div>
                    </div>
                <? endforeach;?>
            </div>
            
            <div class="swiper-pagination swiper-pagination--lines"></div>
        </div><!-- .swiper-container -->
        <script>
            ;(function(){
	            // http://idangero.us/swiper/api/
	            new Swiper('.benefits .swiper-container', {
		            // pagination
		            pagination: {
			            el: '.benefits .swiper-pagination',
			            clickable: true,
			            renderBullet: swiperRenderBullets,
		            },
		            watchOverflow: true,

		            on: {
			            'init': resizeSliderContainer,
			            'resize': resizeSliderContainer,
		            },

		            slidesPerView: 5,
		            spaceBetween: 30,
		            breakpoints: {
			            320: {
				            slidesPerView: 1,
				            spaceBetweenSlides: 10
			            },
			            480: {
				            slidesPerView: 2,
				            spaceBetweenSlides: 15
			            },
			            768: {
				            slidesPerView: 3,
				            spaceBetweenSlides: 20
			            },
			            1023: {
				            slidesPerView: 4,
				            spaceBetweenSlides: 30
			            }
		            }
	            });
            }());
        </script>
    </div><!-- .benefits -->
<?endif;?>