<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
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

use Bitrix\Main\Localization\Loc;
use Citrus\Developer\Iblock;

$this->setFrameMode(true);
?>

<div id="planning">
	<div class="favorites-loading">
		<?= Loc::getMessage("PLANNING_LOADING") ?>
	</div>
</div>

<script type="text/x-template" id="planning-template">

	<div class="planning">
		<div class="planning-loading" v-if="!isReady"><?= Loc::getMessage("PLANNING_LOADING") ?></div>

		<template v-if="isReady && items.length">
			<div class="planning__filter">
				<div class="planning__filter-item">
					<div class="planning__filter-title">Подъезд</div>
					<div class="planning__filter-list">
						<template v-for="entrance in filteredEntrances">
							<div class="planning__filter-list-item" 
								:class="{'_selected': isEqual(entrance.id, filterEntrance)}" 
								@click="selectEntrance(entrance)"
							>{{entrance.name}}</div>
						</template>
					</div>
				</div>
				<div class="planning__filter-item">
					<div class="planning__filter-title">Этаж</div>
					<div class="planning__filter-list">
						<template v-for="floor in filteredFloors">
							<div class="planning__filter-list-item" 
								:class="{'_selected': isEqual(floor, filterFloor)}" 
								@click="selectFloor(floor)"
							>{{floor}}</div>
						</template>
					</div>
				</div>
			</div>

			<div class="planning__map">
				<div class="planning__map-svg-wrap">
					<svg class="planning__map-svg"  version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" view-box="0 0 800 600">
						<template v-for="item in filteredItems">
							<path
								class="path h1" 
								:d="item.plan.polygon"
								@click="showModal(item)"
							></path>
						</template>
					</svg>
				</div>
				<img :src="floorPlan" class="planning__map-img">
			</div>

			<div id="modal-plan" class="modal-plan" v-if="visibleModal">
				<div class="modal-plan__content">
					<div class="modal-plan__close" @click="closeModal">&times;</div>
					<div class="plan-content">
						<div class="plan-content__img-wrap">
							<img :src="modalItem.plan.preview" :alt="modalItem.plan.name" class="plan-content__img">
						</div>
						<div class="plan-content__side">
							<div class="plan-content__title">{{modalItem.plan.name}}</div>
							<div class="plan-content__square">Общая площадь: <b>{{modalItem.plan.totalSquare}}</b>&nbsp;м<sup>2</sup></div>
							<div class="plan-content__square vygoda" v-if="modalItem.vygoda != 0">
								Выгода: <b>{{modalItem.vygoda}} руб.</b> 
							</div>
							<div class="plan-content__btn-wrap">
								<a :href="urlDetail" class="btn btn-primary" title="Подробнее">Подробнее</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</template>

	</div>

</script>

<style>
	.vygoda {
		color: red;
	}
</style>


<script>
	(function () {
		new Vue({
			el: '#planning',
			data: {
				templatePath: "<?= $templateFolder; ?>",
				iblockID: "<?= $arParams["APARTMENTS_ID"]; ?>",
				xmlID: "<?= $arParams["XML_ID"]; ?>",
				urlTemplate: "<?= $arParams["URL_TEMPLATE_PATH"]; ?>"

			},
			template: '<planning :templatePath="templatePath" :iblockID="iblockID" :xmlID="xmlID" :urlTemplate="urlTemplate" />',
		});
	}());
</script>