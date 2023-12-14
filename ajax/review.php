<?php

$isAjax = isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest";
if ( $isAjax ) {
	require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
	$APPLICATION->SetTitle("");
} else {
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
}
?>
	<div class="modal-content modal-w-400">
		<div class="modal-header">
			<div class="modal-title">Оставить отзыв</div>
			<?if($isAjax):?>
				<button class="btn modal-close-btn" data-dismiss="modal">
					<span class="icon-close"></span>
				</button>
			<?endif;?>
		</div>
		<div class="modal-body">
			<? $APPLICATION->IncludeComponent(
	"citrus.forms:iblock.element",
	"simple",
	array(
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
				"TITLE" => "Имя",
				"IS_REQUIRED" => "Y",
				"HIDE_FIELD" => "N",
			),
			"PREVIEW_PICTURE" => array(
				"ORIGINAL_TITLE" => "Картинка для анонса",
				"TITLE" => "",
				"IS_REQUIRED" => "N",
				"HIDE_FIELD" => "N",
				"TEMPLATE_ID" => "avatar",
				"PLACEHOLDER" => "Ваше фото",
				"DESCRIPTION" => "Вы можете загрузить фото<br> объемом до 10 мб.",
				"VALIDRULE" => "file",
				"ADDITIONAL" => "filetype=.gif, .jpg, .jpeg, .png;filesize=10mb",
			),
			"PROPERTY_COMPLEX" => array(
				"TITLE" => "",
				"IS_REQUIRED" => "N",
				"HIDE_FIELD" => "N",
				"ORIGINAL_TITLE" => "[63] ЖК",
				"PLACEHOLDER" => "Жилой комплекс",
				"TEMPLATE_ID" => ".default",
			),
			"PREVIEW_TEXT" => array(
				"ORIGINAL_TITLE" => "Описание для анонса",
				"TITLE" => "Отзыв",
				"IS_REQUIRED" => "Y",
				"HIDE_FIELD" => "N",
				"DESCRIPTION" => "",
			),
			"ACTIVE" => array(
				"ORIGINAL_TITLE" => "Активность",
				"TITLE" => "Активность",
				"IS_REQUIRED" => "N",
				"HIDE_FIELD" => "Y",
				"DEFAULT" => "N",
			),
			"ACTIVE_FROM" => array(
				"ORIGINAL_TITLE" => "Начало активности (время)",
				"TITLE" => "Начало активности (время)",
				"IS_REQUIRED" => "N",
				"HIDE_FIELD" => "Y",
				"DEFAULT" => ConvertTimeStamp(time(), 'FULL'),
			),
		),
		"FORM_ID" => "review_form",
		"FORM_STYLE" => "WHITE",
		"FORM_TITLE" => "",
		"IBLOCK_ID" => "",
		"IBLOCK_CODE" => "developer_reviews",
		"IBLOCK_TYPE" => "content",
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
		"SUCCESS_TEXT" => "Спасибо! Ваш отзыв будет добавлен после модерации.",
		"USER_SERVER_VALIDATE" => "N",
		"USE_SERVER_VALIDATE" => "N",
		"AGREEMENT_LINK" => "/agreement/",
		"USE_GOOGLE_RECAPTCHA" => "N",
		"HIDDEN_ANTI_SPAM" => "Y",
		"EMAIL_TO_VALUE" => "",
		"EMAIL_SUBJECT" => "Новый отзыв",
		"FORM_CLASS" => "",
		"FORM_PLACE_MODE" => "PAGE",
		"BUTTON_CLASS" => "",
		"AGREEMENT_FIELDS" => "Имя, Email, Телефон",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "1",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
		</div><!-- .modal-body -->
	</div><!-- .modal-content --><?
if ($isAjax)
	require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
else
	require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");

?>
