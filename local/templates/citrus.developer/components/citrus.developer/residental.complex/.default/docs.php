<?

use Citrus\Developer\Iblock;
use Citrus\Developer\Iblock\ForeignIblock,
	Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);
$APPLICATION->SetTitle(Loc::getMessage("DOCS_TITLE"));

?>

			<?php ob_start() ?>
			<?$APPLICATION->IncludeComponent(
				"citrus.developer:complex.catalog.section.list",
				".default",
				Array(
					"VIEW_TEMPLATE" => "doc-sections",

					"ADD_SECTIONS_CHAIN" => "N",
					"CACHE_GROUPS" => "Y",
					"CACHE_TIME" => "36000000",
					"CACHE_TYPE" => "A",
					"COMPOSITE_FRAME_MODE" => "A",
					"COMPOSITE_FRAME_TYPE" => "AUTO",
					"COUNT_ELEMENTS" => "N",
					"IBLOCK_ID" => Iblock::getId(Iblock::DOCS),
					"IBLOCK_TYPE" => "content",
					"SECTION_CODE" => "",
					"SECTION_FIELDS" => array("", ""),
					"SECTION_ID" => ForeignIblock::getSectionId($component->getJhk(), Iblock::DOCS),
					"SECTION_URL" => "",
					"SECTION_USER_FIELDS" => array("", ""),
					"SHOW_PARENT_NAME" => "Y",
					"TOP_DEPTH" => "2",
					"VIEW_MODE" => "LINE",
					"SELECTED_SECTION" => $component->getRouter()->getVar('house'),
					"FILTER_NAME" => "SELECTED_SECTION",
				),
				$component,
				array('HIDE_ICONS' => "Y")
			);?>

			<?php if (!empty($GLOBALS['SELECTED_SECTION'])) { ?>

			<?php
				$docsLogUrl = $arResult['URL_TEMPLATES_PATH']['docslog']
					. substr($APPLICATION->GetCurPageParam("house=" . $GLOBALS['SELECTED_SECTION'], ["house"], false),
						strlen($APPLICATION->GetCurPage(false)));
			?>
			<?$APPLICATION->IncludeComponent("bitrix:news.list", "docs",
				Array(
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
					"IBLOCK_ID" => Iblock::getId(Iblock::DOCS),
					"IBLOCK_TYPE" => "content",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"INCLUDE_SUBSECTIONS" => "N",
					"MESSAGE_404" => "",
					"NEWS_COUNT" => "10",
					"PAGER_BASE_LINK_ENABLE" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_TEMPLATE" => ".default",
					"PAGER_TITLE" => "",
					"PARENT_SECTION" => $GLOBALS['SELECTED_SECTION'],
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
					"SET_TITLE" => "Y",
					"SHOW_404" => "N",
					"SORT_BY1" => "SORT",
					"SORT_BY2" => "ACTIVE_FROM",
					"SORT_ORDER1" => "ASC",
					"SORT_ORDER2" => "DESC",
					"STRICT_SECTION_CHECK" => "N",
					"LOG_PAGE_URL" => $docsLogUrl,
				),
				$component,
				array('HIDE_ICONS' => "Y")
			);?>
			<?php } ?>

			<? $APPLICATION->IncludeComponent(
				"citrus.core:include",
				".default",
				array(
					"TITLE" => $APPLICATION->GetTitle(),
					"DESCRIPTION" => Loc::getMessage("JK_DOC_TITLE"),
					"AREA_FILE_SHOW" => "html",
					"h" => "h1",
					"HTML" => ob_get_clean(),
					"PAGE_SECTION" => "Y",
					"COMPONENT_TEMPLATE" => ".default",
					"DATA_SRC" => "jk-docs",
				),
				false
			); ?>

<?require __DIR__ . '/block_callout.php';?>
