<?php

use Citrus\Developer\Components\ResidentalComplex\Component;
use Citrus\Developer\Iblock;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var Component $complexComponent Kompleksniy komponent ZhK*/
/** @var \Citrus\Core\IncludeComponent $component Komponent citrus.core:include */
/** @var CBitrixComponentTemplate $this Shablon komponenta citrus.core:include */

$complexComponent = $arResult['PARENT'];

$nonResidental = new Iblock\NonResidental(SITE_ID, $complexComponent->getJhk('XML_ID'));
$hasJk = !empty($complexComponent->getJhk('XML_ID'));
$rootSections = $hasJk ? $nonResidental->getComplexTypeSections() : Iblock\NonResidental::getFirstLevelSections($nonResidental->getIblockId());

$showCostM2 = Iblock\OrmPropertyFormatter::showCostM2('NON_RESIDENTAL_PRICE_MODE');
$complexComponent->arParams['NON_RESIDENTAL_FILTER_NAME'] = 'f';
// @todo Podmenyaty tsenu dlya citrus.arealty:catalog.section
if ($complexComponent->useAjaxList)
{
	foreach ($complexComponent->arParams['NON_RESIDENTAL_FIELDS'] ?: [] as $i => $col)
	{
		if ($col['code'] == 'cost_m2')
		{
			if (!$showCostM2)
			{
				$complexComponent->arParams['NON_RESIDENTAL_FIELDS'][$i]['code'] = 'cost';
			}
		}
	}
}

$section = $nonResidental->getSectionForType($complexComponent->getNonResidentalType('ID'));
$sectionId = $section['ID'];
$tableCols = $section['UF_TABLE_COLS'];

foreach ($tableCols as $i => &$col)
{
	if ($col['code'] == 'cost')
	{
		if ($showCostM2)
		{
			$col['code'] = 'cost_m2';
		}
	}
}

$ajaxListFilterParams = $complexComponent->useAjaxList ? [
	"AJAX_LIST_COLUMNS" => $complexComponent->arParams['NON_RESIDENTAL_FIELDS'], // @todo Vozmozhnosty pereopredeleniya kolonok v polyah razdela IB
	"AJAX_LIST_COMPONENT" => 'citrus.developer:non_residental.list',
	"AJAX_LIST_COMPONENT_PARAMS" => [
		'SECTION_ID' => $sectionId,
	],
	"JK_ID" => $complexComponent->getJhk('ID'),
] : [];

?>

<?$APPLICATION->IncludeComponent(
	"citrus.arealty:catalog.section.list",
	"line-sections",
	Array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "Y",
		"IBLOCK_ID" => $nonResidental->getIblockId(),
		"IBLOCK_TYPE" => "realty",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array(
			0 => "PICTURE",
			1 => "",
		),
		"SECTION_ID" => "",
		"SECTION_URL" => $complexComponent->getRouter()->getUrl($hasJk ? 'non_residental_type' : 'non_residental_all_type', ['SECTION_ID' => '#SECTION_ID#', 'SECTION_CODE' => '#SECTION_CODE#']),
		"SECTION_USER_FIELDS" => array(
			0 => "UF_SECTION_COLOR",
			1 => "",
		),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "1",
		"VIEW_MODE" => "LINE",
		"ACTIVE_SECTION" => $complexComponent->getNonResidentalType('CODE'), // podsvetka aktivnogo razdela
		"ALIGN_LEFT" => 'N', // virovnyaty ikonki po levomu krayu
		//'HIDE_EMPTY' => 'Y', // skrivaty pustie razdeli
		"FILTER_IDS" => array_column($rootSections, 'ID'), // pokazaty tolyko razdeli s ukazannimi ID
		"COUNT_ELEMENTS_FROM_IDS" => array_column($nonResidental->getComplexSections(), 'ID'), // podschet kolichestva elementov tolyko iz ukazannih (pod)razdelov
		"NON_RESIDENTAL" => $nonResidental,
	),
	$complexComponent
);?>

<?$APPLICATION->IncludeComponent(
	"citrus.developer:complex.catalog.smart.filter",
	".default",
	$ajaxListFilterParams + array(
		"VIEW_TEMPLATE" => ".default",

		"CACHE_TYPE" => $complexComponent->arParams["CACHE_TYPE"],
		"CACHE_TIME" => $complexComponent->arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $complexComponent->arParams["CACHE_GROUPS"],
		"FILTER_NAME" => $complexComponent->arParams['NON_RESIDENTAL_FILTER_NAME'],
		"FILTER_VIEW_MODE" => "vertical",
		"IBLOCK_ID" => $nonResidental->getIblockId(),
		"IBLOCK_TYPE" => $complexComponent->arParams["IBLOCK_TYPE"],
		"SAVE_IN_SESSION" => "N",
		"SECTION_ID" => $sectionId,
		"TEMPLATE_THEME" => $complexComponent->arParams["TEMPLATE_THEME"],
		"XML_EXPORT" => "Y",
		"PRICE_CODE" => $complexComponent->arParams["PRICE_CODE"],
		"SEF_MODE" => "N",
		"SHOW_COST_M2" => $showCostM2,
	),
	$complexComponent,
	['HIDE_ICONS' => 'Y']
);?>

<?php

if ($complexComponent->useAjaxList)
{
	$APPLICATION->IncludeComponent(
		"citrus.developer:template",
		"favorites",
		array(
			'URL_TEMPLATES_PATH' => $arResult['URL_TEMPLATES_PATH'],
			'TEMPLATE' => 'NON_RESIDENTAL',
			'PROPERTY_LIST' => $complexComponent->arParams['NON_RESIDENTAL_FIELDS'], // @todo Nastroyka poley dlya tablitsi s Nezhiloy nedvizhimostyyu
		),
		false,
		array("HIDE_ICONS" => "Y")
	);
}
else
{
	?><?php
	$citrusSort = $APPLICATION->IncludeComponent(
		"citrus.core:sort",
		".default",
		array(
			"COMPONENT_TEMPLATE" => ".default",
			"IBLOCK_TYPE" => $complexComponent->arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $nonResidental->getIblockId(),
			"SORT_FIELDS" => $arSortFields,
			"DEFAULT_SORT_ORDER" => "DESC",
			"VIEW_LIST" => array(
				0 => "TABLE",
			),
			"VIEW_DEFAULT" => strtoupper($currentSection["UF_TYPE_XML_ID"]),

		),
		$component
	); ?>

	<? $intSectionID = $APPLICATION->IncludeComponent(
		"citrus.arealty:catalog.section",
		".default",
		array(
			"IBLOCK_TYPE" => $complexComponent->arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $nonResidental->getIblockId(),
			"ELEMENT_SORT_FIELD" => ($citrusSort['SORT']['CODE'] == 'PROPERTY_cost_m2')? 'PROPERTY_cost' : $citrusSort["SORT"]["CODE"] ,
			"ELEMENT_SORT_ORDER" => $citrusSort["SORT"]["ORDER"],
			"ELEMENT_SORT_FIELD2" => $complexComponent->arParams["ELEMENT_SORT_FIELD2"],
			"ELEMENT_SORT_ORDER2" => $complexComponent->arParams["ELEMENT_SORT_ORDER2"],
			"PROPERTY_CODE" => ['geodata'],
			"META_KEYWORDS" => $complexComponent->arParams["LIST_META_KEYWORDS"],
			"META_DESCRIPTION" => $complexComponent->arParams["LIST_META_DESCRIPTION"],
			"BROWSER_TITLE" => $complexComponent->arParams["LIST_BROWSER_TITLE"],
			"INCLUDE_SUBSECTIONS" => $complexComponent->arParams["INCLUDE_SUBSECTIONS"],
			"FILTER_NAME" => $complexComponent->arParams['NON_RESIDENTAL_FILTER_NAME'],
			"CACHE_TYPE" => $complexComponent->arParams["CACHE_TYPE"],
			"CACHE_TIME" => $complexComponent->arParams["CACHE_TIME"],
			"CACHE_FILTER" => $complexComponent->arParams["CACHE_FILTER"],
			"CACHE_GROUPS" => $complexComponent->arParams["CACHE_GROUPS"],
			"SET_TITLE" => $complexComponent->arParams["SET_TITLE"],
			"MESSAGE_404" => $complexComponent->arParams["MESSAGE_404"],
			"SET_STATUS_404" => $complexComponent->arParams["SET_STATUS_404"],
			"SHOW_404" => $complexComponent->arParams["SHOW_404"],
			"FILE_404" => $complexComponent->arParams["FILE_404"],
			"PAGE_ELEMENT_COUNT" => $complexComponent->arParams["PAGE_ELEMENT_COUNT"],

			"DISPLAY_TOP_PAGER" => $complexComponent->arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER" => $complexComponent->arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE" => $complexComponent->arParams["PAGER_TITLE"],
			"PAGER_SHOW_ALWAYS" => $complexComponent->arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_TEMPLATE" => $complexComponent->arParams["PAGER_TEMPLATE"],
			"PAGER_DESC_NUMBERING" => $complexComponent->arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME" => $complexComponent->arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $complexComponent->arParams["PAGER_SHOW_ALL"],

			"SECTION_ID" => $sectionId,
			"SECTION_CODE" => '',
			"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
			"ON_DETAIL_URL" => [Component::class, 'onGetNonResidentalDetailUrl'],
			"DETAIL_URL" => $complexComponent->getRouter()->getUrl('non_residental_detail', []),

			"ADD_SECTIONS_CHAIN" => "N",

			"SECTION_USER_FIELDS" => array(),
			"CITRUS_THEME" => (new \Citrus\Developer\Theme())->getId(),
			"EMPTY_LIST_MESSAGE" => $complexComponent->arParams['EMPTY_LIST_MESSAGE'],
			"VIEW_TEMPLATE" => "catalog_table",
			"USE_MAIN_ELEMENT_SECTION" => "Y",

			"IS_DEVELOPER" => "Y",
			"UF_TABLE_COLS" => $tableCols,
		),
		$component
	); ?>
	<?php
}
