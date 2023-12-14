<?php

use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Citrus\Core\Components\Pdf;
use Citrus\Developer\Helper;

define('STOP_STATISTICS', true); // otklyuchaem moduly veb-analitiki
define("NO_KEEP_STATISTIC", true);  // otklyuchaem moduly veb-analitiki
define("NO_AGENT_CHECK", true); // otklyuchaem obrabotku agentov
define("DisableEventsCheck", true); // zapret na otpravku neotpravlennih pochtovih soobshteniy iz BD https://dev.1c-bitrix.ru/api_help/main/general/mailevents.php
define("BX_COMPRESSION_DISABLED", true);

require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php";
if (isset($_REQUEST['icalculator']))
{
	$APPLICATION->SetTitle("Ипотечный калькулятор");
}
else
{
	$APPLICATION->SetTitle("Отправить презентацию");
}

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

try
{
    $arParams = Pdf::decodeParams($_REQUEST['params']);

    if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
        $arParams['ID'] = array_map(function($item){
            if ((int) $item <= 0)
            {
                throw new RuntimeException('Wrong id: ' . var_export($item, 1));
            }

            return (int) $item;
        }, explode(',', $_REQUEST['id']));
    }

	/**
	 * @todo Sohranyaty tsenu v zakodirovannom $arParams
	 */
    if (isset($_REQUEST['price'])  && !empty($_REQUEST['price']))
	{
		$arParams['PRICE'] = (int)$_REQUEST['price'];
	}
    elseif (isset($arParams['PRICE']) && (int)$arParams['PRICE'] > 0)
    {
	    $price = (int)$arParams['PRICE'];
	    $arParams = array_diff_key($arParams, ['PRICE' => 1]);
    }
    else
    {
        $price = 3000000;
    }
}
catch (RuntimeException $e)
{
    ShowError($e->getMessage());
    return;
}

ob_start();

?>

<?php if (isset($_REQUEST['icalculator'])) { ?>
	<? $APPLICATION->IncludeComponent(
		"citrus:realty.mortgage",
		"vue-mortgage",
		array(
			"COMPONENT_TEMPLATE" => ".default",
            "CURRENCY" => "",
			"DISCOUNT_PERCENT" => "0.5",
			"DEFAULT_FULL_PRICE" => $price,
			"DEFAULT_FIRST_PRICE" => "450000",
			"DEFAULT_FIRST_PRICE_UNITS" => "R",
			"DEFAULT_PERCENT" => "11.5",
			"DEFAULT_YEAR" => "15",
			"SHOW_OVERPAYMENT_BLOCK" => "Y",
			"SHOW_BANK_LOGOS" => "Y",
			"RESULT_DECLAIMER" => "",
		),
		false
	); ?>
<?php } ?>

		<? $APPLICATION->IncludeComponent(
			"citrus.forms:iblock.element",
			"simple",
			array(
				"COMPONENT_TEMPLATE" => "simple",
				"NOT_CREATE_ELEMENT" => "N",
				"REDIRECT_AFTER_SUCCESS" => "N",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"EDIT_ELEMENT" => "N",
				"ELEMENT_ID" => "",
				"IBLOCK_TYPE" => "feedback",
				"IBLOCK_ID" => "",
				"IBLOCK_CODE" => "icalculator",
				"USE_SERVER_VALIDATE" => "N",
				"SAVE_SESSION" => "Y",
				"FORM_ID" => "ad161ea5f445977e64fcbf64e29c2c8c",
				"FIELDS" => array(
					"NAME" => array(
						"ORIGINAL_TITLE" => "Название",
						"TITLE" => "Email",
						"IS_REQUIRED" => "Y",
						"HIDE_FIELD" => "N",
						"VALIDRULE" => "email",
					),
					"PDF_PARAMS" => array(
						"TITLE" => "Данные для pdf",
						"IS_REQUIRED" => "N",
						"HIDE_FIELD" => "Y",
						"ORIGINAL_TITLE" => "Данные",
						"TEMPLATE_ID" => "text",
						"DEFAULT" => Pdf::encodeParams($arParams, $arParams['COMPONENT'], $arParams['COMPONENT_TEMPLATE']),
					),
					"PDF_ADDITIONAL" => array(
						"TITLE" => "Дополнительные данные для пдф для pdf",
						"IS_REQUIRED" => "N",
						"HIDE_FIELD" => "Y",
						"ORIGINAL_TITLE" => "Данные",
						"TEMPLATE_ID" => "text",
						"DEFAULT" => "",
					),
					"PROPERTY_href" => array(
						"TITLE" => "Отправлено со страницы",
						"IS_REQUIRED" => "N",
						"HIDE_FIELD" => "Y",
						"ORIGINAL_TITLE" => "[54] Отправлено со страницы",
						"DEFAULT" => Helper::getPath(),
					),
					"PROPERTY_item" => array(
						"TITLE" => "Элемент",
						"IS_REQUIRED" => "N",
						"HIDE_FIELD" => "Y",
						"ORIGINAL_TITLE" => "[333] Элемент",
						"DEFAULT" => $arParams['ID'],
					),
					"PREVIEW_TEXT" => array(
						"ORIGINAL_TITLE" => "Описание для анонса",
						"TITLE" => "Расчет ипотеки",
						"IS_REQUIRED" => "N",
						"HIDE_FIELD" => "N",
						"CLASS" => "js-mortgage-textarea-container hidden",
						"DEFAULT" => "---\n",
					),
				),
				"SEND_MESSAGE" => "Y",
				"FORM_CLASS" => "citrus-form_inline",
				"FORM_PLACE_MODE" => "PAGE",
				"FORM_STYLE" => "WHITE",
				"BUTTON_POSITION" => "LEFT",
				"BUTTON_CLASS" => "",
				"AGREEMENT_FIELDS" => "",
				"USER_CONSENT" => "Y",
				"USER_CONSENT_ID" => "0",
				"USER_CONSENT_IS_CHECKED" => "Y",
				"USER_CONSENT_IS_LOADED" => "N",
				"USE_GOOGLE_RECAPTCHA" => "N",
				"FORM_TITLE" => "",
				"SUCCESS_TEXT" => "Презентация успешно отправлена!",
				"ERROR_TEXT" => "",
				"BUTTON_TITLE" => "",
				"BEFORE_FORM_TOOLTIP" => "",
				"AFTER_FORM_TOOLTIP" => "",
				"AJAX" => "Y",
				"JQUERY_VALID" => "Y",
				"HIDDEN_ANTI_SPAM" => "Y",
				"COMPOSITE_FRAME_MODE" => "A",
				"COMPOSITE_FRAME_TYPE" => "AUTO",
				"AGREEMENT_LINK" => "/agreement/",
				"AGREEMENT_POSITION" => "UNDER_BUTTON",
				"FORM_MOD" => "INLINE",
				"MAIL_EVENT" => "CITRUS_REALTY_PDF_SEND",
				"MAILE_EVENT_TEMPLATE" => array(),
				"SEND_IMMEDIATE" => "N",
				"EMAIL_TO_VALUE" => "",
				"EMAIL_SUBJECT" => ""
			),
			false
		);?>

		<p class="form-sign ta-xs-c">Обработка запроса может занять некоторое время. Пожалуйста, подождите.</p>

		<?if(isset($_REQUEST['icalculator'])):?>
			<script>
				BX.addCustomEvent('mortgageUpdate', function (data) {
					if (typeof data !== 'undefined')
						$('[name="FIELDS[PDF_ADDITIONAL]"]').val(JSON.stringify(data));
				});
			</script>
		<?endif;?>

<?$APPLICATION->IncludeComponent(
    "citrus.core:include",
    "popup_wrapper",
    array(
        "AREA_FILE_SHOW" => "HTML",
        "HTML" => ob_get_clean(),
        "MODAL_CONTAINER_CLASS" => isset($_REQUEST['icalculator']) ? 'modal-icalculator' : 'modal-pdf',
        "_POPUP_WRAPPER_SHOULD_INCLUDE_FOOTER" => false,
    ),
    false,
    ['HIDE_ICONS' => 'Y']
);?><?php

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php";
