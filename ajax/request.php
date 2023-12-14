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
$APPLICATION->SetTitle("Отправить заявку");

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

?><?$APPLICATION->IncludeComponent(
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
				"ORIGINAL_TITLE" => "[55] Телефон",
				"TEMPLATE_ID" => "phone",
				"VALIDRULE" => "phone",
			),
			"PREVIEW_TEXT" => array(
				"ORIGINAL_TITLE" => "Описание для анонса",
				"TITLE" => "Дополнительная информация",
				"IS_REQUIRED" => "N",
				"HIDE_FIELD" => "N",
				"DESCRIPTION" => "",
			),
			"PROPERTY_href" => array(
				"TITLE" => "Отправлено со страницы",
				"IS_REQUIRED" => "N",
				"HIDE_FIELD" => "Y",
				"ORIGINAL_TITLE" => "[54] Отправлено со страницы",
				"DEFAULT" => Helper::getPath(),
			),
		),
		"FORM_ID" => "qwe123",
		"FORM_STYLE" => "WHITE",
		"FORM_TITLE" => "",
		"IBLOCK_ID" => "",
		"IBLOCK_CODE" => "requests",
		"IBLOCK_TYPE" => "feedback",
		"JQUERY_VALID" => "Y",
		"MAILE_EVENT_TEMPLATE" => array(
		),
		"MAIL_EVENT" => "CITRUS_REALTY_NEW_REQUEST",
		"NOT_CREATE_ELEMENT" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "voprosy-posetiteley",
		"REDIRECT_AFTER_SUCCESS" => "N",
		"SAVE_SESSION" => "Y",
		"SEND_IMMEDIATE" => "N",
		"SEND_MESSAGE" => "Y",
		"SUB_TEXT" => "",
		"SUCCESS_TEXT" => "Спасибо! Вам перезвонят в ближайшее время.",
		"USER_SERVER_VALIDATE" => "N",
		"USE_SERVER_VALIDATE" => "N",
		"AGREEMENT_LINK" => "/agreement/",
		"USE_GOOGLE_RECAPTCHA" => "N",
		"HIDDEN_ANTI_SPAM" => "Y",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "1",
		"EMAIL_TO_VALUE" => "",
		"EMAIL_SUBJECT" => "Новая заявка",
		"FORM_CLASS" => "",
		"FORM_PLACE_MODE" => "PAGE",
		"BUTTON_CLASS" => "",
		"AGREEMENT_FIELDS" => "Имя, Email, Телефон",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
	),
	false,
	$isAjax ? ['HIDE_ICONS' => 'Y'] : []
);?><?php

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php";
