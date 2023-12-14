<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

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

if ($arParams["VIEW_TARGET"])
{
	$this->SetViewTarget($arParams['VIEW_TARGET']);
}

if (empty($arResult["ITEMS"]))
{
	return;
}

$mainButtons = CIBlock::GetPanelButtons(
	$arResult["ITEMS"][0]["IBLOCK_ID"],
	0,
	$arResult["ITEMS"][0]["IBLOCK_SECTION_ID"],
	array("SECTION_BUTTONS" => false, "SESSID" => false)
);
$mainButtonsAreaId = "jk_photo_progras_slider_" . $arResult["ITEMS"][0]["IBLOCK_SECTION_ID"];

?>

<div class="p__swiper photo-progress _nav-offset _pagination-hide-nav"
		id="<?= $this->GetEditAreaID($mainButtonsAreaId) ?>">
	<?php
	$this->AddEditAction(
		$mainButtonsAreaId,
		$mainButtons["edit"]["add_element"]["ACTION_URL"],
		$mainButtons["edit"]["add_element"]["TITLE"]
	);
	?>

    <div class="swiper-container">
        <div class="swiper-wrapper">
	        <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>

            <div class="swiper-slide photo-progress__slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	            <?$APPLICATION->IncludeComponent(
		            "citrus.developer:template",
		            "photo-progress-card",
		            array(
			            'DATA' => $arItem,
		            ),
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
		    new Swiper('.photo-progress .swiper-container', {
			    watchOverflow: true,
			    // pagination
			    pagination: {
				    el: '.photo-progress .swiper-pagination',
				    clickable: true,
				    renderBullet: swiperRenderBullets,
			    },
			    // Navigation arrows
			    navigation: {
				    nextEl: '.photo-progress .swiper-button-next',
				    prevEl: '.photo-progress .swiper-button-prev',
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
</div><!-- .photo-progress -->

