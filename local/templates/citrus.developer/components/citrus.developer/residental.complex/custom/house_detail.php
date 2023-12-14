<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
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

$this->setFrameMode(true);

use Bitrix\Main\Localization\Loc;
use Citrus\Developer\Iblock\ForeignIblock;
use Citrus\Developer\Iblock;
use Citrus\Core\SolutionFactory;

Loc::loadMessages(__DIR__ . '/element.php');

$APPLICATION->SetTitle($component->getHouse('NAME'));

$SettingsTable = SolutionFactory::get()->settings();
?>

<? #tabs?>
<? $tabs = array();
if ($component->getHouse('PROPERTIES.benefits.VALUE'))
	$tabs[] = array(
		"NAME" => $component->getHouse('PROPERTIES.benefits.NAME'),
		"CODE" => 'benefits',
	);

if ($component->getHouse('DETAIL_TEXT'))
	$tabs[] = array(
		"NAME" => Loc::getMessage("HOUSE_DESCRIPTION_TAB"),
		"CODE" => 'DETAIL_TEXT',
	); ?>
<? if (!empty($tabs)):
	$APPLICATION->SetPageProperty('slider_color', 'light_gray');
	?>
	<?php ob_start() ?>
	<div class="tabs tabs_house">
		<nav class="tabs__nav">
			<? foreach ($tabs as $key => $arTab): ?>
				<a href="javascript:void(0);" class="tabs__link <? if (!$key): ?>_active<? endif; ?>">
					<?= $arTab['NAME'] ?>
				</a>
			<? endforeach; ?>
		</nav>

		<div class="tabs__content">
			<? foreach ($tabs as $key => $arTab): ?>
				<div class="tabs__content-it <? if (!$key): ?>_active<? endif; ?>">
					<? switch ($arTab['CODE']):
						case 'benefits':
							$GLOBALS['FILTER_HOUSE_BENEFITS']['=ID'] = $component->getHouse('PROPERTIES.benefits.VALUE');
							?>
							<? $APPLICATION->IncludeComponent(
								"citrus.developer:complex.news.list",
								".default",
								array(
									"VIEW_TEMPLATE" => "benefits",

									"ACTIVE_DATE_FORMAT" => "d.m.Y",
									"ADD_SECTIONS_CHAIN" => "N",
									"AJAX_MODE" => "N",
									"AJAX_OPTION_ADDITIONAL" => "",
									"AJAX_OPTION_HISTORY" => "N",
									"AJAX_OPTION_JUMP" => "N",
									"AJAX_OPTION_STYLE" => "Y",
									"CACHE_FILTER" => "Y",
									"CACHE_GROUPS" => "Y",
									"CACHE_TIME" => "36000000",
									"CACHE_TYPE" => "A",
									"CHECK_DATES" => "Y",
									"COMPOSITE_FRAME_MODE" => "A",
									"COMPOSITE_FRAME_TYPE" => "AUTO",
									"DETAIL_URL" => "",
									"DISPLAY_BOTTOM_PAGER" => "N",
									"DISPLAY_DATE" => "Y",
									"DISPLAY_NAME" => "Y",
									"DISPLAY_PICTURE" => "Y",
									"DISPLAY_PREVIEW_TEXT" => "Y",
									"DISPLAY_TOP_PAGER" => "N",
									"FIELD_CODE" => array("", ""),
									"FILTER_NAME" => "FILTER_HOUSE_BENEFITS",
									"HIDE_LINK_WHEN_NO_DETAIL" => "N",
									"IBLOCK_ID" => Citrus\Developer\Iblock::getId(Iblock::HOUSE_BENEFITS),
									"IBLOCK_TYPE" => "-",
									"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
									"INCLUDE_SUBSECTIONS" => "Y",
									"MESSAGE_404" => "",
									"NEWS_COUNT" => "20",
									"PAGER_BASE_LINK_ENABLE" => "N",
									"PAGER_DESC_NUMBERING" => "N",
									"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
									"PAGER_SHOW_ALL" => "N",
									"PAGER_SHOW_ALWAYS" => "N",
									"PAGER_TEMPLATE" => ".default",
									"PAGER_TITLE" => "",
									"PARENT_SECTION" => $arResult['PROPERTIES']['jk_description_block']['VALUE'],
									"PARENT_SECTION_CODE" => "",
									"PREVIEW_TRUNCATE_LEN" => "",
									"PROPERTY_CODE" => array("", ""),
									"SET_BROWSER_TITLE" => "N",
									"SET_LAST_MODIFIED" => "N",
									"SET_META_DESCRIPTION" => "N",
									"SET_META_KEYWORDS" => "N",
									"SET_STATUS_404" => "N",
									"SET_TITLE" => "N",
									"SHOW_404" => "N",
									"SORT_BY1" => "SOR",
									"SORT_BY2" => "ID",
									"SORT_ORDER1" => "ASC",
									"SORT_ORDER2" => "ASC",
									"STRICT_SECTION_CHECK" => "N"
								),
								$component,
								array('HIDE_ICONS' => "Y")
							); ?>
							<?
							break;
						case 'DETAIL_TEXT':
							echo $component->getHouse('~DETAIL_TEXT');
							break;
					endswitch; ?>
				</div>
			<? endforeach; ?>
		</div>
	</div>
	<? CJSCore::Init(['tabs']); ?>
	<? $APPLICATION->IncludeComponent(
		"citrus.core:include",
		".default",
		array(
			"TITLE" => Loc::getMessage("HOUSE_TAB_SECTION_TITLE"),
			"AREA_FILE_SHOW" => "html",
			"h" => ".h1",
			"HTML" => ob_get_clean(),
			"PAGE_SECTION" => "Y",
			"COMPONENT_TEMPLATE" => ".default",
			"DATA_SRC" => "house-benefits",
			"BG_COLOR" => "light_gray",
		),
		false
	); ?>

<? endif; ?>

<?
/**
 * @param int $sectionId
 * @return int|null
 * @todo Keshirovaty i vinesti iz shablona
 */
$isEmptySection = function ($sectionId) {
	return $sectionId > 0
		? \CIBlockSection::GetSectionElementsCount($sectionId, ["CNT_ACTIVE" => "Y"]) == 0
		: null;
};
?>

<? $planSection = ForeignIblock::getSectionId($component->getHouse(), Iblock::LAYOUTS) ?>
<? if (!$isEmptySection($planSection)): ?>
	<? $APPLICATION->IncludeComponent(
		"citrus.developer:complex.catalog.section",
		".default",
		array(
			"VIEW_TEMPLATE" => "plans",

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
			"ELEMENT_SORT_FIELD" => "propertysort_rooms",
			"ELEMENT_SORT_FIELD2" => "sort",
			"ELEMENT_SORT_ORDER" => "asc",
			"ELEMENT_SORT_ORDER2" => "desc",
			"ENLARGE_PRODUCT" => "STRICT",
			"FILTER_NAME" => "",
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
			"OFFERS_LIMIT" => "5",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_TITLE" => "",
			"PAGE_ELEMENT_COUNT" => "100",
			"PARTIAL_PRODUCT_PROPERTIES" => "N",
			"PRICE_CODE" => array(),
			"PRICE_VAT_INCLUDE" => "Y",
			"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
			"PRODUCT_ID_VARIABLE" => "id",
			"PRODUCT_PROPERTIES" => array(),
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"PRODUCT_QUANTITY_VARIABLE" => "quantity",
			"PRODUCT_ROW_VARIANTS" => "[]",
			"PROPERTY_CODE" => array("built_year", "ready_quarter", "geodata", "complex", "building_state", "plan", ""),
			"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
			"RCM_TYPE" => "personal",
			"SECTION_CODE" => "",
			"SECTION_ID" => $planSection,
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
			"SHOW_ALL_WO_SECTION" => "N",
			"SHOW_FROM_SECTION" => "N",
			"SHOW_PRICE_COUNT" => "1",
			"SHOW_SLIDER" => "Y",
			"TEMPLATE_THEME" => "blue",
			"USE_ENHANCED_ECOMMERCE" => "N",
			"USE_MAIN_ELEMENT_SECTION" => "N",
			"USE_PRICE_COUNT" => "N",
			"USE_PRODUCT_QUANTITY" => "N",
			"USING_PRICE_MODE" => $SettingsTable::getValue("PLAN_PRICE_MODE"),
			'URL_TEMPLATES_PATH' => $arResult['URL_TEMPLATES_PATH'],
		),
		$component,
		array(
			'HIDE_ICONS' => 'Y'
		)
	); ?>


	<? #chess?>
	<?
	$chess = $APPLICATION->IncludeComponent("citrus.developer:chess", '', [
		"HOUSE_ID" => $component->getHouse('ID'),
		"VIEW_TARGET" => "CHESS",
		"USING_PRICE_MODE" => $SettingsTable::getValue("FLAT_PRICE_MODE"),
	], $component, ['HIDE_ICONS' => 'Y']);
	?>
	<? if ($chess): ?>
		<?php ob_start() ?>
		<div class="chess-legend">
			<div class="chess-legend__it _in-sale">
				<?= Loc::getMessage("HOUSE_CHESS_LEGEND_1") ?>
			</div>
			<div class="chess-legend__it _selected">
				<?= Loc::getMessage("HOUSE_CHESS_LEGEND_2") ?>
			</div>
			<div class="chess-legend__it _disable">
				<?= Loc::getMessage("HOUSE_CHESS_LEGEND_3") ?>
			</div>
			<!-- шахматы -->
			<div class="chess-legend__it cube_vygoda">
				<?= Loc::getMessage("HOUSE_CHESS_LEGEND_4") ?>
			</div>
		</div>
		<?php $sectionLegend = ob_get_clean() ?>
		<?php ob_start() ?>
		<footer class="section-footer">
			<a href="<?= $component->getRouter()->getUrl('select_apartment') ?>" data-object="<?= $arPlan['ID'] ?>"
				class="btn btn-primary btn-stretch">
				<?= Loc::getMessage("HOUSE_CHOSE_FLAT_LINK") ?>
			</a>
		</footer>
		<?php $sectionFooter = ob_get_clean() ?>
		<? $APPLICATION->IncludeComponent(
			"citrus.core:include",
			".default",
			array(
				"TITLE" => Loc::getMessage("HOUSE_CHESS_TITLE"),
				"DESCRIPTION" => Loc::getMessage("HOUSE_CHESS_DESCRIPTION"),
				"LEGEND" => $sectionLegend,
				"HTML_ATTR_ID" => "chess-section",
				"SECTION_HEADER_CLASS" => "_compact",
				"AREA_FILE_SHOW" => "view_content",
				"VIEW_CONTENT_ID" => "CHESS",
				"FOOTER" => $sectionFooter,
				"h" => ".h1",
				"PAGE_SECTION" => "Y",
				"COMPONENT_TEMPLATE" => ".default",
				"DATA_SRC" => "jk-chess",
			),
			false
		); ?>
	<? endif; ?>
<? endif; ?>

<? #photo-progress?>
<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	[
		"PATH" => $templateFolder . "/blocks/photo-progress.php",
		"TITLE" => Loc::getMessage("JK_COURSE"),
		"DESCRIPTION" => Loc::getMessage("JK_COURSE_DESCRIPTION"),
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "clear.php",
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"BG_COLOR" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"WIDGET_REL" => "photo-progress",
		"DATA_SRC" => "house-photo-progress",
	],
	$component
); ?>

<? #docs?>
<? if ($docSectionId = ForeignIblock::getSectionId($component->getHouse(), Iblock::DOCS)): ?>
	<?php
	$docsLogUrl = $arResult['URL_TEMPLATES_PATH']['docslog']
		. substr($APPLICATION->GetCurPageParam("house=" . $docSectionId, ["house"], false),
			strlen($APPLICATION->GetCurPage(false)));
	?>
	<?php ob_start(); ?>
	<?php $resDocs = $APPLICATION->IncludeComponent("bitrix:news.list", "docs", array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => Iblock::DOCS,
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "1",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "",
		"PARENT_SECTION" => $docSectionId,
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "FILE",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N",
		'LOG_PAGE_URL' => $docsLogUrl,
		'ALL_DOCS_PAGE_URL' => $component->getRouter()->getUrl('docs') . '?house=' . $docSectionId,
		'ALL_DOCS_PAGE_URL_TITLE' => Loc::getMessage('HOUSE_ALL_DOCS'),
	),
		$component,
		array('HIDE_ICONS' => 'Y')
	); ?>
	<?php $docsContent = ob_get_clean(); ?>

	<?php if (!empty($resDocs) || $APPLICATION->GetShowIncludeAreas()) { ?>
		<? $APPLICATION->IncludeComponent(
			"citrus.core:include",
			".default",
			array(
				"TITLE" => Loc::getMessage("HOUSE_DOCS_TITLE"),
				"DESCRIPTION" => Loc::getMessage("HOUSE_DOCS_DESCRIPTION"),
				"AREA_FILE_SHOW" => "html",
				"h" => ".h1",
				"HTML" => $docsContent,
				"PAGE_SECTION" => "Y",
				"COMPONENT_TEMPLATE" => ".default",
				"DATA_SRC" => "house-docs",
			),
			false
		); ?>
	<?php } ?>

<? endif; ?>

<? require __DIR__ . '/block_contacts.php'; ?>

<? require __DIR__ . '/block_callout.php'; ?>