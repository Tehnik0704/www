<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();/** @var array $arParams */
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

<?if(!empty($arResult['ITEMS'])):?>


			<div class="p__swiper catalog-slider _nav-offset _pagination-hide-nav" id="<?=$arResult['COMPONENT_ID'] ?>">
				<div class="swiper-pagination swiper-pagination--lines"></div>
			    <div class="swiper-container">
			        <div class="swiper-wrapper" data-catalog-view="cards">
				        <?foreach($arResult["ITEMS"] as $i => $arItem ):?>
					        <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
					        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM'))); ?>
			            <div class="swiper-slide catalog-card-container" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

				            <?$APPLICATION->IncludeComponent(
					            "citrus.developer:template",
					            "catalog-card",
					            array(
			                        'DATA'=> $arItem,
			                        'SHOW_INFO' => $arParams['SHOW_INFO'],
						            "URL_TEMPLATES_PATH" => $arParams['URL_TEMPLATES_PATH'],
						            "USING_PRICE_MODE" => $arParams["USING_PRICE_MODE"],
			                    ),
					            $component,
					            array("HIDE_ICONS" => "Y")
				            );?>

			            </div>
			            <?endforeach;?>
			        </div>
			    </div><!-- .swiper-container -->

			    <div class="swiper-button-prev"><span class="icon-arrow_left"></span></div>
			    <div class="swiper-button-next"><span class="icon-arrow_right"></span></div>

			    <script>
			        ;(function(){
				        var componentId = '#<?=$arResult['COMPONENT_ID']?> ';

				        // http://idangero.us/swiper/api/
				        new Swiper(componentId+'.swiper-container', {
					        watchOverflow: true,

					        // Navigation arrows
					        navigation: {
						        nextEl: componentId+'.swiper-button-next',
						        prevEl: componentId+'.swiper-button-prev',
					        },
					        pagination: {
						        el: componentId+'.swiper-pagination',
						        clickable: true,
						        renderBullet: swiperRenderBullets,
					        },
					        slidesPerView: 'auto',
					        spaceBetween: 30,
					        breakpoints: {
						        480: {
							        slidesPerView: 1,
							        spaceBetween: 0
						        }
					        },
					        on: {
						        init: function () {
							        $(componentId + '.js-equal-height').responsiveEqualHeightGrid();
							        resizeSliderContainer.call(this);
						        },
						        resize: resizeSliderContainer,
					        }
				        });
			        }());
			    </script>
			</div><!-- .catalog-slider -->

			<?if($arParams['SHOW_MORE'] !== 'N' && $arResult['LIST_PAGE_URL']):?>
			    <div class="section-footer">
			        <a class="btn btn-primary" href="<?=$arResult['LIST_PAGE_URL']?>"><?= Loc::getMessage("ALL")?> <?=$arParams['PAGER_TITLE']?></a>
			    </div>
			<?endif;?>

<?endif;?>
