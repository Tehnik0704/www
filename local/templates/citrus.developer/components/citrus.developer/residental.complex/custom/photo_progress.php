<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Citrus\Developer\Components\JkFormatter;
use Citrus\Developer\Iblock;
use \Citrus\Developer\Iblock\ForeignIblock;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

$this->setFrameMode(true);

$APPLICATION->SetTitle(Loc::getMessage("PHOTO_PROGRESS_TITLE"));

$currentUrl = (\CMain::IsHTTPS()? 'https://' : 'http://')
	. (SITE_SERVER_NAME == ''? $_SERVER['SERVER_NAME'] : SITE_SERVER_NAME)
	. $APPLICATION->GetCurPage(false);

?>

<section class="section _with-padding section-color-n">
	<div class="w">
		<div class="section-inner">
			<header class="section__header">
				<h1><?= $APPLICATION->GetTitle() ?></h1>
				<div class="section-description"><?=JkFormatter::format(Loc::getMessage("PHOTO_PROGRESS_DESCRIPTION"), $component->getJhk(), [JkFormatter::CASE_LOWER, \Citrus\Core\Morpher::CASE_R])?></div>
			</header>

			<?#filter?>
			<?$APPLICATION->IncludeComponent(
				"citrus.developer:template",
				"photo-progress-filter",
				array(
					'DATA' => array(
						"JK_ID" => $component->getJhk('ID'),
						"PHOTO_SECTION_ID" => ForeignIblock::getSectionId($component->getJhk(), Iblock::PHOTOS),
						"IS_ADMIN_PANEL" => $APPLICATION->GetShowIncludeAreas()? 'Y' : 'N',
						"CURRENT_URL" =>  $currentUrl,
						"FILTER" => array(
							'year' => !empty($_REQUEST['year'])? $_REQUEST['year'] : '',
							'quarter' => !empty($_REQUEST['quarter'])? $_REQUEST['quarter'] : '',
							'house' => !empty($_REQUEST['house'])? $_REQUEST['house'] : '',
						),
					),
					'FILTER_NAME' => 'PHOTOS_LAST_YEAR'
				),
				false,
				array("HIDE_ICONS" => "Y")
			);?>
			<?
			$GLOBALS['PROGRESS_FILTER'] = $component->makePhotosFilter();
			?>
			<?#progress list?>
			<?$APPLICATION->IncludeComponent(
				"citrus.developer:complex.news.list",
				".default",
				Array(
					"VIEW_TEMPLATE" => "photo-progress-list",

					"ACTIVE_DATE_FORMAT" => "j F Y",
					"ADD_SECTIONS_CHAIN" => "N",
					"AJAX_MODE" => "Y",
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
					"DISPLAY_BOTTOM_PAGER" => "Y",
					"DISPLAY_DATE" => "Y",
					"DISPLAY_NAME" => "Y",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_PREVIEW_TEXT" => "Y",
					"DISPLAY_TOP_PAGER" => "N",
					"FIELD_CODE" => array("", ""),
					"FILTER_NAME" => "PROGRESS_FILTER",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"IBLOCK_ID" => Iblock::getId(Iblock::PHOTOS),
					"IBLOCK_TYPE" => "jhk",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"INCLUDE_SUBSECTIONS" => "N",
					"MESSAGE_404" => "",
					"NEWS_COUNT" => "12",
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
					"PROPERTY_CODE" => array("", "PHOTO", "HOUSE", ""),
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
					"IS_AJAX" => isset($_REQUEST['get_ajax_photo']),
					"USE_SECTION_ID" => $GLOBALS['PROGRESS_FILTER']['SECTION_ID'],
				),
				$component,
				array(
					'HIDE_ICONS' => 'Y'
				)
			);?>

		</div>
	</div>
</section>

<? if (CModule::IncludeModule("subscribe"))	{
	?>
	<?$APPLICATION->IncludeComponent("citrus:subscribe.form", "line", Array(
		"FORMAT" => "text",
		"INC_JQUERY" => "N",
		"NO_CONFIRMATION" => "N",
	),
		false
	);?><?
} ?>
