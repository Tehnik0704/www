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

<section class="section _with-padding _section-color-n">
	<div class="w">
		<div class="section-inner">
			<header class="section__header">
				<h1><?=$arResult['NAME']?></h1>
			</header>
			
			
				<div class="photo-progress__list__text row">
				    <?=htmlspecialcharsBack($arResult["PROPERTIES"]["PROP_KOD"]["VALUE"]["TEXT"])?>
				</div>
				
			<div class="photo-progress__list row">
				<?foreach ( $arResult['DISPLAY_PROPERTIES']['PHOTO']['FILE_VALUE'] as $arPhoto):?>
					<div class="col-lg-4 col-md-6">
						<a href="<?=$arPhoto['MEDIUM']['src']?>"
						   class="photo-progress__it"
						   data-size="<?=$arPhoto['WIDTH']?>x<?=$arPhoto['HEIGHT']?>"
						   title="<?=$arPhoto['TITLE'] ?: $arResult['NAME'] ?>"
						>
							<img src="<?=$arPhoto['MIN']['src']?>"
							     width="<?=$arPhoto['MIN']['width']?>"
							     height="<?=$arPhoto['MIN']['height']?>"
							     alt="">
						</a>
					</div>
				<?endforeach;?>
			</div>
			
			
			<footer class="section-footer">
				<a
					href="<?=$arParams['URL_TEMPLATES_PATH']['gallery']?>"
					class="btn btn-more btn-stretch"><?=Loc::getMessage("PHOTO_PROGRESS_BACK_BTN")?></a>
			</footer>
		</div>
	</div>
</section>


<script>
	;(function(){
		var $photos = $('.photo-progress__list');

		$photos.masonry();
		$photos.imagesLoaded().progress(function () {
			$photos.masonry('layout');
		});

		$('a.photo-progress__it').initPhotoSwipe({
			loop: false,
			bgOpacity: .8
		});
	}());
</script>
