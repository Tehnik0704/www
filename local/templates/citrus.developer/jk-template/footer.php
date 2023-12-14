<?php

use Bitrix\Main\Localization\Loc;
use Citrus\Developer\Components\JkFormatter;
use Citrus\Developer\Iblock\ForeignIblock;
use Citrus\Developer\Iblock;

Loc::loadMessages($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/footer.php');

/**
 * @var $complex Citrus\Developer\Components\ResidentalComplex\Component
 */
$complex = Citrus\Developer\Components\ResidentalComplex\Component::getInstance();
$arJk = $complex->getJhk();
$arOffice = $complex->getOffice();
$router = $complex->getRouter();

?>

<div class="footer__top print-hidden">
	<div class="row">
		<div class="col-md-6 col-lg-6">
			<?$APPLICATION->IncludeComponent(
				"bitrix:menu",
				"footer-menu",
				Array(
					"ALLOW_MULTI_SELECT" => "N",
					"CHILD_MENU_TYPE" => "left",
					"DELAY" => "N",
					"MAX_LEVEL" => "1",
					"MENU_CACHE_GET_VARS" => array(""),
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_TYPE" => "N",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"ROOT_MENU_TYPE" => "jk",
					"USE_EXT" => "N"
				)
			);?>
		</div>
		<div class="display-xs-n display-lg-b col-lg-4" style="display:none;">
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"footer-menu",
				Array(
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"CACHE_GROUPS" => "Y",
					"CACHE_TIME" => "300",
					"CACHE_TYPE" => "A",
					"COMPOSITE_FRAME_MODE" => "A",
					"COMPOSITE_FRAME_TYPE" => "AUTO",
					"DETAIL_URL" => "",
					"FIELD_CODE" => array("", ""),
					"IBLOCK_ID" => Iblock::getId(Iblock::HOUSES),
					"IBLOCK_TYPE" => "realty",
					"NEWS_COUNT" => "4",
					"SORT_BY1" => "SORT",
					"SORT_BY2" => "ACTIVE_FROM",
					"SORT_ORDER1" => "ASC",
					"SORT_ORDER2" => "DESC",
					"LIST_NAME" => JkFormatter::format(Loc::getMessage("FOOTER_MENU_LIST_NAME"), $arJk),
					"LIST_PAGE_URL" => $router->getUrl('about'),
					"JK_TEMPLATE" => "Y",
					"PARENT_SECTION" => ForeignIblock::getSectionId($complex->getJhk(), Iblock::HOUSES),
					"SET_TITLE" => "N",
				)
			);?>
		</div>

		<div class="col-md-6 col-lg-6 footer__column_contacts">
			<div class="footer__column-title"><?=Loc::getMessage("CITRUS_TEMPLATE_FOOTER_CONTACT_TITLE")?></div>
			<?$GLOBALS['FILTER_JK_OFFICE']['ID'] = $arOffice['ID']?>
			<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"offices", 
	array(
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
			0 => "NAME",
			1 => "",
		),
		"FILTER_NAME" => "FILTER_JK_OFFICE",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => Iblock::getId(Iblock::OFFICES),
		"IBLOCK_TYPE" => "company",
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
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "geodata",
			2 => "PHONE",
			3 => "TIMETABLE",
			4 => "EMAIL",
			5 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "offices",
		"MODE" => "footer"
	),
	false
);?>
		</div>
	</div>
</div>
