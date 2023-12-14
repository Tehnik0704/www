<?php

use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Citrus\Developer\Helper;

define('STOP_STATISTICS', true); // otklyuchaem moduly veb-analitiki
define("NO_KEEP_STATISTIC", true);  // otklyuchaem moduly veb-analitiki
define("NO_AGENT_CHECK", true); // otklyuchaem obrabotku agentov
define("DisableEventsCheck", true); // zapret na otpravku neotpravlennih pochtovih soobshteniy iz BD https://dev.1c-bitrix.ru/api_help/main/general/mailevents.php
define("BX_COMPRESSION_DISABLED", true);

require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php";
$APPLICATION->SetTitle("Заказать звонок");

$isAjax = Context::getCurrent()->getRequest()->isAjaxRequest();
if ($isAjax)
{
	define("PUBLIC_AJAX_MODE", true); // zapret na vivod otladochnoy informatsii, vklyuchaemoy parametrami zaprosa i menyu Otladka
	Helper::initTemplatePlugins();
}
else
{
	require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_after.php";
}

Loader::requireModule("citrus.developer");

?>
<?$APPLICATION->IncludeComponent(
	"citrus.core:include",
	"popup_wrapper",
	array(
		"AREA_FILE_SHOW" => 'component',
		"_COMPONENT" => "citrus.forms:iblock.element",
		"_COMPONENT_TEMPLATE" => "simple",
		"_POPUP_WRAPPER_SHOULD_INCLUDE_FOOTER" => false,

		"AFTER_FORM_TOOLTIP" => "",
		"AJAX" => "Y",
		"ANCHOR_ID" => "",
		"BEFORE_FORM_TOOLTIP" => "",
		"BUTTON_POSITION" => "CENTER",
		"BUTTON_TITLE" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"EDIT_ELEMENT" => "N",
		"ELEMENT_ID" => "",
		"ERROR_TEXT" => "",
		"FIELDS" => array(
			"NAME" => array(
				"ORIGINAL_TITLE" => "Название",
				"TITLE" => "Введите имя",
				"IS_REQUIRED" => "Y",
				"HIDE_FIELD" => "N",
			),
			"PROPERTY_phone" => array(
				"TITLE" => "Телефон",
				"IS_REQUIRED" => "Y",
				"HIDE_FIELD" => "N",
				"ORIGINAL_TITLE" => "[45] Телефон",
				"TEMPLATE_ID" => "phone",
				"VALIDRULE" => "phone",
			),
			"PROPERTY_time_to_call" => array(
				"TITLE" => "",
				"IS_REQUIRED" => "N",
				"HIDE_FIELD" => "N",
				"ORIGINAL_TITLE" => "[46] Время звонка",
				"TEMPLATE_ID" => ".default",
				"DEFAULT" => "",
				"PLACEHOLDER" => "Время звонка",
				"NOFIRSTPLACEHOLDER" => "Y",
			),
			"PROPERTY_href" => array(
				"TITLE" => "Отправлено со страницы",
				"IS_REQUIRED" => "N",
				"HIDE_FIELD" => "Y",
				"ORIGINAL_TITLE" => "[54] Отправлено со страницы",
				"DEFAULT" => \Citrus\Developer\Helper::getPath(),
			),
		),
		"FORM_ID" => "header_order_call_form",
		"FORM_STYLE" => "WHITE",
		"FORM_TITLE" => "",
        "BEFORE_CONTENT" => static function () {
			global $APPLICATION;
			$GLOBALS['FILTER_MAIN_OFFICE']['MAIN_VALUE'] = 'Y';
			?>
			<? $APPLICATION->IncludeComponent("bitrix:news.list", "header_phone_order_call", Array(
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
				"DISPLAY_NAME" => "N",
				"DISPLAY_PICTURE" => "N",
				"DISPLAY_PREVIEW_TEXT" => "N",
				"DISPLAY_TOP_PAGER" => "N",
				"FIELD_CODE" => array(
					0 => "",
					1 => "",
				),
				"FILTER_NAME" => "FILTER_MAIN_OFFICE",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => \Citrus\Developer\Iblock::getId(\Citrus\Developer\Iblock::OFFICES),
				"IBLOCK_TYPE" => "company",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "N",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "5",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "main",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array(
					0 => "geodata",
					1 => "PHONE",
					2 => "TIMETABLE",
					3 => "Email",
					4 => "",
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
			),
				false,
				['HIDE_ICONS' => 'Y']
			);?>
        	<?php
		},
		"IBLOCK_ID" => "",
		"IBLOCK_CODE" => "order_call",
		"IBLOCK_TYPE" => "feedback",
		"JQUERY_VALID" => "Y",
		"MAILE_EVENT_TEMPLATE" => array(
		),
		"NOT_CREATE_ELEMENT" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"REDIRECT_AFTER_SUCCESS" => "N",
		"SAVE_SESSION" => "Y",
		"SEND_IMMEDIATE" => "N",
		"SEND_MESSAGE" => "Y",
		"MAIL_EVENT" => "CITRUS_REALTY_ORDER_CALL",
		"SUB_TEXT" => "",
		"SUCCESS_TEXT" => "Спасибо! Вам перезвонят в ближайшее время.",
		"USER_SERVER_VALIDATE" => "N",
		"USE_SERVER_VALIDATE" => "N",
		"AGREEMENT_LINK" => "/agreement/",
		"EMAIL_TO_VALUE" => "",
		"EMAIL_SUBJECT" => "Заказ звонка",
		"FORM_CLASS" => "",
		"FORM_PLACE_MODE" => "PAGE",
		"BUTTON_CLASS" => "",
		"AGREEMENT_FIELDS" => "Имя, Email, Телефон",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "1",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"USE_GOOGLE_RECAPTCHA" => "N",
		"HIDDEN_ANTI_SPAM" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"FORM_MOD" => "COMPACT"
	),
	false,
	$isAjax ? ['HIDE_ICONS' => 'Y'] : []
);?><?php

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php";
