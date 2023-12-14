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

<section class="section section-color-n _with-padding">
    <div class="w">
        <div class="section-inner">
            <div class="section__header">
                <h1><?=$arResult['NAME']?></h1>
                <div class="section-description"><?=$arResult['PROPERTIES']['DESCRIPTION']['VALUE']?></div>
            </div>

            <div class="row row-grid row-reverse">
                <div class="col-lg-5 col-dt-4">
                    <div class="about-list js-company-animate">
                        <?foreach ( $arResult['PROPERTIES']['NUMBERS']['VALUE'] as $key => $value):?>
                            <div class="about-it">
                                <div class="about-it__number js-number-animate"><?=$value?></div>
                                <div class="about-it__description"><?=$arResult['PROPERTIES']['NUMBERS']['DESCRIPTION'][$key]?></div>
                            </div>
                        <?endforeach;?>
                    </div><!-- .about-list -->

                    <script>
                       ;(function(){
	                       /*animate*/
	                       var $companyAnimateBlock = $('.js-company-animate');
	                       var $numbers = $companyAnimateBlock.find('.js-number-animate');

	                       $companyAnimateBlock.on("inView", function () {
		                       $(this).addClass('_animated');
		                       if (!BX.browser.IsMobile()) {
			                       $numbers.each(function () {
				                       var numAnim = new CountUp($(this).get(0), 0, +$(this).html(), 0, 1.5, {
					                       useEasing: false
				                       });
				                       numAnim.start();
			                       });
		                       }
	                       });
	                       new inView($companyAnimateBlock, {
		                       'once': true,
		                       'minHeightPercent': 60
	                       });
                       }());
                    </script>
                </div>
                <div class="col-lg-7 col-dt-8">
                    <?=isset($arResult['FIELDS']['PREVIEW_TEXT']) ? $arResult['FIELDS']['PREVIEW_TEXT'] : $arResult['DETAIL_TEXT']?>

                    <?if(is_array($arResult['DISPLAY_PROPERTIES']['DOCS']['FILE_VALUE']) && !empty($arResult['DISPLAY_PROPERTIES']['DOCS']['FILE_VALUE'])):?>
                        <p class="indent"></p>
                        <div class="row row-grid">
		                    <?foreach ( $arResult['DISPLAY_PROPERTIES']['DOCS']['FILE_VALUE'] as $arFile):?>
                                <div class="col-xs-12">
				                    <?$APPLICATION->IncludeComponent(
					                    "citrus.developer:template",
					                    "docs",
					                    array('DATA'=> $arFile),
					                    $component,
					                    array("HIDE_ICONS" => "Y")
				                    );?>
                                </div>
		                    <?endforeach;?>
                        </div>
                    <?endif;?>
                </div>
            </div>
        </div>
    </div>
</section>
