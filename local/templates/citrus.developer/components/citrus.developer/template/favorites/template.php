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

$TEMPLATE = $arParams['TEMPLATE'] ?: 'FAVORITES';

?>

<div id="favorites">
	<div class="favorites-loading"><?= Loc::getMessage("FAVORITES_LOADING") ?></div>
</div>

<script type="text/x-template" id="favorites-template">

	<div class="favorites">

		<div class="favorites-loading" v-if="!isReady"><?= Loc::getMessage("FAVORITES_LOADING") ?></div>

		<p class="clear-favorite" v-if="deletedFlats.length"><i><?= Loc::getMessage("FAVORITE_CLEAR") ?></i></p>

		<div >Количество элементов: {{items.length}}</div>
		<li v-for="item in items">
			<div v-for="(rowValue, rowIndex) in item">{{rowIndex}}:{{rowValue}}</div><br>
		</li>
		
		<template v-if="isReady && items.length">

			<label
				v-if="params.template === 'FAVORITES' && items.length > 1"
				class="square-checkbox favorites__only-change-label"
				:class="{'_disabled':items.length <= 1}">
				<input :disabled="items.length <= 1" type="checkbox" name="" value="1" class="square-checkbox__input"
				       @change="setOnlyChangeOption($event.target)">
				<span class="square-checkbox__checkmark"></span><?= Loc::getMessage("FAVORITES_ONLY_CHANGES") ?>
			</label>
			
			
			
			<div class="favorites-table">
				<div class="favorites-table__left">
					<div class="favorites-th"><?=Loc::getMessage("FAVORITES_NAME_{$TEMPLATE}")?></div>

					<div class="favorites-th" v-for="item in items">
						<a :href="item.DETAIL_PAGE_URL"
						   class="favorites__property-main__image-wrapper"
						   :class="{'img-placeholder':!item.IMAGE}">
							<span :style="item.IMAGE ? 'background-image: url('+item.IMAGE+');' : ''" class="favorites__property-main__image"></span>
						</a>
						<a class="favorites__property-main__name"
						   :href="item.DETAIL_PAGE_URL">{{item.NAME}}</a>
					</div>
				</div><!-- .favorites-table__right -->

				<div class="favorites-table__center" :class="params.template === 'FAVORITES' ? '_with-right-col' : '_no-right-col'">
					<div class="p__swiper favorites-slider">
						<div class="swiper-container">
							<div class="swiper-wrapper">
								<div class="swiper-slide favorites-slide" v-for="propertyData in properties" v-if="withChangeValue(propertyData['code'])">
									<div class="favorites-th" :class="{'_sort': !propertyData['noSort']}" @click.prevent="sort(propertyData)">
										<div class="favorites__property-name-list">
											<div class="favorites__property-name"
											     v-for="propertyName in propertyData['name']">
												{{propertyName}}
											</div>
										</div>
										<div
											class="favorites__sort-icon"
										     :class="[
										        {'_active': (sortProperty === propertyData['code'][0])},
										        {'_desc': (sortProperty === propertyData['code'][0]) && !sortAsc}
										     ]"></div>
									</div>
									<div class="favorites-td" v-for="item in items">
										<div class="favorites__property-value-list">
											<div class="favorites__property-value"
											     v-for="propertyCode in propertyData['code']"
											     v-html="getPropertyValue(item, propertyCode)"
											></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="swiper-scrollbar"></div>
					</div><!-- .p__swiper -->

				</div><!-- .favorites-table__center -->

				<div class="favorites-table__right" v-if="params.template === 'FAVORITES'">
					<div class="favorites-th"></div>
					<div class="favorites-th" v-for="item in items">
						<a
							v-if="item['PROPERTIES']['cost'] && item['PROPERTIES']['cost']['SORT_VALUE']"
							class="favorites-icon icon-calc"
						   href="<?=SITE_DIR?>ajax/pdf.php?icalculator=1"
						   data-toggle="modal"
						   :data-modal-id="item.ID"
						   :data-modal-price="item['PROPERTIES']['cost']['SORT_VALUE']"
						   data-modal-params="<?=$arResult['PDF']?>"></a>
						<a class="favorites-icon icon-close" @click.prevent="remove(item['ID'])" href="javascript:void(0);"></a>
					</div>
				</div><!-- .favorites-table__right -->
			</div><!-- .favorites-table -->

			<paginate
				v-if="pager.pageCount > 1"
				:page-count="pager.pageCount"
				:click-handler="pagerTo"
				:prev-text="'&larr;'"
				:next-text="'&rarr;'"
				:break-view-text="'<?=Loc::getMessage("FAVORITES_PAGINATE_BREAK_TEXT")?>'"
				:next-link-class="'favorites-pager__next'"
				:prev-link-class="'favorites-pager__prev'"
				v-model="page"
				:container-class="'switch favorites-pager'"
				:active-class="'theme--bg-color active'"
			>
			</paginate>

			<div class="section-footer" v-if="params.template === 'FAVORITES'">
				<div class="btn-grid btn-row btn-row--xs-center">
					<a href="<?=SITE_DIR?>ajax/pdf.php"
					   data-toggle="modal"
					   data-modal-params="<?=$arResult['PDF']?>"
					   :data-modal-id="itemIds"
						class="btn btn-more btn-stretch js-citrus-pdf-send"><?= Loc::getMessage("FAVORITES_SEND_EMAIL") ?></a>
					<a href="<?=SITE_DIR?>ajax/request.php" data-toggle="modal" class="btn btn-primary"><?= Loc::getMessage("FAVORITES_SEND_REQUEST") ?></a>
				</div>
			</div>
			<div class="section-footer" v-else-if="!!params.template">
				<a href="<?=SITE_DIR?>ajax/request.php" data-toggle="modal" class="btn btn-primary"><?= Loc::getMessage("FAVORITES_SEND_REQUEST") ?></a>
			</div>
		</template>
		<div class="favorites-empty" v-else-if="isReady">
			<?=Loc::getMessage("FAVORITES_EMPTY_TEXT_{$TEMPLATE}")?>
		</div>
	</div>
</script>

<script>
	;(function(){
		new Vue({
			el: '#favorites',
			data: {
				params: <?=\Bitrix\Main\Web\Json::encode(array(
					'mortgageUrl' => (string) ($arParams['URL_TEMPLATES_PATH']['mortgage']),
					'template' => (string) ($arParams['TEMPLATE']),
				))?>,
				propertyList: <?=\Bitrix\Main\Web\Json::encode($arParams['PROPERTY_LIST'] ?: array())?>
			},
			template: '<favorites :params="params" :propertyList="propertyList"/>',
		});
	}());
</script>
