<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

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
/** @var \Citrus\Developer\Components\Chess\ChessComponent $component */

use Bitrix\Main\Localization\Loc;

if ($arParams["VIEW_TARGET"]) {
	$this->SetViewTarget($arParams['VIEW_TARGET']);
}
?>

<div id="chess"></div>

<? #vuejs template?>
<script type="text/x-template" id="chess-template">
	<div id="chess">
		<div
			class="p__swiper chess-slider _nav-offset _pagination-top _pagination-hide-nav"
			title=""
		>
			<div class="chess-slider__inner">
				<div class="floors-list _left">
					<div class="floors-list__floor" v-for="floorIndex in arSectionFloors">
						<span class="foors-list__floor-number">{{floorIndex}}</span>
						<span class="foors-list__floor-text"><?= Loc::getMessage("CITRUS_DEVELOPER_CHESS_FLOOR") ?></span>
					</div>
				</div>
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<div class="swiper-slide"
							 :data-slide-index="sectionIndex"
							 v-for="(section, sectionIndex) in items"
						>
							<div :class="[
									'chess-section',
									{ 'chess-section-flatnotfound': !hasSelectedFlats(sectionIndex) }
								]"
								:id="section.editId"
							>
								<div class="chess-section__name">
									<div class="chess-section__name-text">{{ section.name }}</div>
								</div>

								<div class="chess-floor"
									 v-for="floorIndex in arSectionFloors"
									 :class="{
									'_empty': floorIndex > section.floorsCount,
									'_edit': false,
								 }">
									<template v-if="section.floorsCount">
										<div
											:class="['chess-flat',
											'chess-flat-id-' + flat.id,
											{ '_disable': !flat.active },
											{ '_selected': isSelectedPlan(flat) },
											{ '_new': flat.new },
											{ 'cube_vygoda': flat.vygoda != 0 }
										]"
											v-for="(flat, flatIndex) in getFlats(sectionIndex, floorIndex)"
											:data-tippy-template = "flat.active ?
											'chess-'+sectionIndex+floorIndex+flatIndex : ''"
											ref="flats"
											:id="flat.editId"
										>
											<a :href="flat.link" class="chess-flat__link" v-if="!isMobile && flat.active"></a>
											
											<div class="mychess">

															<div 
																 v-for="(propValue, propName) in flat.properties" class="mychess_prop">
																<div v-html="propValue"></div>
															</div>
											</div>

											<div style="display: none;"
												 v-if="flat.active"
												 :id="'chess-'+sectionIndex+floorIndex+flatIndex">
												<div class="chess-tippy" >
													<div class="chess-tippy__header font-2">{{flat.name}}</div>
													<div class="chess-tippy__properties" v-if="flat.properties">
														<div 
														:class = "(propName == 'Выгода')?'vygoda':'chess-tippy__property'"
															 v-for="(propValue, propName) in flat.properties">
															<div class="chess-tippy__property-name">{{propName}}:</div>
															<div class="chess-tippy__property-value" v-html="propValue"></div>
														</div>
													</div>
													<div class="chess-tippy__footer">
														<a :href="flat.link" class="btn btn-white btn-tippy">
															<?= Loc::getMessage("CITRUS_DEVELOPER_CHESS_FLAT_MORE") ?>
														</a>
													</div>
												</div>
											</div>
										</div>
									</template>
								</div><!-- .chess-floor -->
							</div><!-- .chess-section -->
						</div><!-- .swiper-slide -->
					</div><!-- .swiper-wrapper -->
				</div><!-- .swiper-container -->

				<div class="floors-list _right">
					<div class="floors-list__floor" v-for="floorIndex in arSectionFloors">
						<span class="foors-list__floor-number">{{floorIndex}}</span>
						<span class="foors-list__floor-text"><?= Loc::getMessage("CITRUS_DEVELOPER_CHESS_FLOOR") ?></span>
					</div>
				</div>
			</div><!-- .chess-swiper__inner -->

			<div class="swiper-pagination swiper-pagination--lines"></div>

			<div class="swiper-button-prev"><span class="icon-arrow_left"></span></div>
			<div class="swiper-button-next"><span class="icon-arrow_right"></span></div>
		</div><!-- .chess -->

	</div>

</script>

<script>
	; (function () {
		BX.message({ 'chessSection': "<?= Loc::getMessage("CHESS_SECTION_TITLE") ?>" });
		new Vue({
			el: '#chess',
			data: <?= \Bitrix\Main\Web\Json::encode(
				[
					'items' => $arResult['SECTIONS'],
					'selectedPlans' => $arResult['SELECTED_PLANS'],
				]
			); ?>,
			template: '<vue-chess :items="items" :selectedPlans="selectedPlans" />',
		});
	}());
</script>

<style>
	.vygoda {
		color: red;
		display: flex;
		justify-content: space-between;
		font-size: 20px !important;
	}

	.cube_vygoda {
		border: 3px double blue;
		line-height: 30px;
	}
</style>