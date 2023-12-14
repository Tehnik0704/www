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

if (empty($arResult['ITEMS'])) return;
?>

<div class="p__swiper achievements-slider _nav-offset _pagination-hide-nav">
    <div class="swiper-container">
        <div class="swiper-wrapper">
	        <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
            <div class="swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="achievements__item">
                    <div class="achievements__img-w"><span class="achievements__img" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);"></span></div>
                    <div class="achievements__name"><?=$arItem['NAME']?></div>
                    <div class="achievements__text"><?=$arItem['PREVIEW_TEXT']?></div>
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
		   new Swiper('.achievements-slider .swiper-container', {
			   watchOverflow: true,
			   // pagination
			   pagination: {
				   el: '.achievements-slider .swiper-pagination',
				   clickable: true,
				   renderBullet: swiperRenderBullets,
			   },
			   // Navigation arrows
			   navigation: {
				   nextEl: '.achievements-slider .swiper-button-next',
				   prevEl: '.achievements-slider .swiper-button-prev',
			   },

			   slidesPerView: 3,
			   spaceBetween: 30,
			   breakpoints: {
				   480: {
					   slidesPerView: 1,
					   spaceBetweenSlides: 0
				   },
				   1024: {
					   slidesPerView: 2,
					   spaceBetweenSlides: 30
				   }
			   }
		   });
	   }());
    </script>
</div><!-- .achievements-slider -->

