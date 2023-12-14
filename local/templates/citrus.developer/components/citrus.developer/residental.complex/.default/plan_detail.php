<?php

use Bitrix\Main\Localization\Loc,
Citrus\Developer\Iblock\ForeignIblock;
use Citrus\Developer\Iblock;

$this->setFrameMode(true);

?>

<? #plan-detail?>
<? $planId = $APPLICATION->IncludeComponent(
	"citrus.developer:complex.catalog.element",
	".default",
	array(
		"VIEW_TEMPLATE" => "plan-detail",

		"ACTION_VARIABLE" => "action",
		"ADD_DETAIL_TO_SLIDER" => "N",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BRAND_USE" => "N",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_SECTION_ID_VARIABLE" => "N",
		"COMPATIBLE_MODE" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_PICTURE_MODE" => array("POPUP", "MAGNIFIER"),
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PREVIEW_TEXT_MODE" => "E",
		"ELEMENT_CODE" => $arResult['VARIABLES']['PLAN_CODE'],
		"ELEMENT_ID" => $arResult['VARIABLES']['PLAN_ID'],
		"IBLOCK_ID" => Iblock::getId(Iblock::LAYOUTS),
		"IBLOCK_TYPE" => "realty",
		"IMAGE_RESOLUTION" => "16by9",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"LINK_IBLOCK_ID" => "",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_PROPERTY_SID" => "",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "0",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
		"PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
		"PRODUCT_PROPERTIES" => array(),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PROPERTY_CODE" => array_column($arParams['PLAN_DETAIL_PROPERTIES'], 'code'),
		"SECTION_CODE" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_DEACTIVATED" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_COMMENTS" => "N",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"USE_RATIO_IN_RANGES" => "Y",
		"USE_VOTE_RATING" => "N",
		"USING_PRICE_MODE" => "PLAN_PRICE_MODE",
	),
	$component
); ?>


<? #chess?>
<?
$chess = $APPLICATION->IncludeComponent("citrus.developer:chess", '', [
	"HOUSE_ID" => $component->getHouse('ID'),
	"PLAN_ID" => $planId,
	"VIEW_TARGET" => "CHESS",
	"USING_PRICE_MODE" => "FLAT_PRICE_MODE",
], $component, ['HIDE_ICONS' => 'Y']);
?>
<? if ($chess): ?>
	<section class="section _with-padding section-color-n print-hidden" id="chess-section">
		<div class="w">
			<div class="section-inner">
				<header class="section__header _compact">
					<div class="h1">
						<?= Loc::getMessage("PLAN_CHESS_TITLE", array('#PLAN_NAME#' => $arResult['PLAN']['NAME'])) ?>
					</div>
					<div class="section-legend">
						<div class="chess-legend">
							<div class="chess-legend__it _in-sale">
								<?= Loc::getMessage("PLAN_CHESS_LEGEND_1") ?>
							</div>
							<div class="chess-legend__it _selected">
								<?= Loc::getMessage("PLAN_CHESS_LEGEND_2") ?>
							</div>
							<div class="chess-legend__it _disable">
								<?= Loc::getMessage("PLAN_CHESS_LEGEND_3") ?>
							</div>
						</div>
					</div>
				</header>

				<? $APPLICATION->ShowViewContent('CHESS') ?>

				<footer class="section-footer">
					<a href="<?= SITE_DIR ?>ajax/request.php" data-toggle="modal"
						data-modal-object="<?= $arResult['PLAN']['ID'] ?>" class="btn btn-primary btn-stretch">
						<?= Loc::getMessage("PLAN_DETAIL_ORDER_BTN") ?>
					</a>
				</footer>

			</div><!-- .section-inner -->
		</div><!-- .w -->
	</section>
<? endif; ?>

<?
$GLOBALS['PLAN_LIKE_FILTER'] = array(
	"PROPERTY_rooms_VALUE" => $component->getLayout('PROPERTIES.rooms.VALUE'),
	">PROPERTY_common_area" => $component->getLayout('PROPERTIES.common_area.VALUE') - 5,
	"<PROPERTY_common_area" => $component->getLayout('PROPERTIES.common_area.VALUE') + 5,
	"!ID" => $planId
);
$planSectionForJk = ForeignIblock::getSectionId($component->getJhk(), Iblock::LAYOUTS);
?>
<? #recomend?>

<?php ob_start() ?>
<? $APPLICATION->IncludeComponent(
	"citrus.developer:complex.catalog.section",
	".default",
	array(
		"VIEW_TEMPLATE" => "plans-slider",

		"ACTION_VARIABLE" => "action",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "name",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_ORDER2" => "asc",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILTER_NAME" => "PLAN_LIKE_FILTER",
		"IBLOCK_ID" => Iblock::getId(Iblock::LAYOUTS),
		"IBLOCK_TYPE" => "realty",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "",
		"MESS_BTN_BUY" => "",
		"MESS_BTN_DETAIL" => "",
		"MESS_BTN_SUBSCRIBE" => "",
		"MESS_NOT_AVAILABLE" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "10",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "",
		"PAGE_ELEMENT_COUNT" => "10",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"PROPERTY_CODE" => array("built_year", "ready_quarter", "geodata", "complex", "building_state", "plan", ""),
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_ID" => $planSectionForJk,
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("", ""),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "Y",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"URL_TEMPLATES_PATH" => $arResult['URL_TEMPLATES_PATH'],
		"USING_PRICE_MODE" => "PLAN_PRICE_MODE",
	),
	$component,
	array(
		'HIDE_ICONS' => 'Y'
	)
); ?>
<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"TITLE" => Loc::getMessage("CITRUS_DEVELOPER_PLANS_SLIDER_HEADER"),
		"DESCRIPTION" => Loc::getMessage("CITRUS_DEVELOPER_PLANS_SLIDER_DESCRIPTION"),
		"AREA_FILE_SHOW" => "html",
		"h" => ".h1",
		"HTML" => ob_get_clean(),
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"DATA_SRC" => "plans-slider",
		"CLASS" => "print-hidden",
	),
	false
); ?>

<? require __DIR__ . '/block_contacts.php'; ?>

<? require __DIR__ . '/block_callout.php'; ?>