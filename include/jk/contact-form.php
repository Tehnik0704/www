
<? $APPLICATION->IncludeComponent(
	"citrus.forms:iblock.element",
	"simple",
	array(
		"AFTER_FORM_TOOLTIP" => "",
		"AGREEMENT_FIELDS" => "",
		"AJAX" => "Y",
		"BEFORE_FORM_TOOLTIP" => "",
		"BUTTON_CLASS" => "btn btn-primary btn-stretch",
		"BUTTON_POSITION" => "CENTER",
		"BUTTON_TITLE" => "отправить сообщение",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"EDIT_ELEMENT" => "N",
		"ELEMENT_ID" => "",
		"ERROR_TEXT" => "",
		"FORM_CLASS" => "",
		"FORM_ID" => "8241cbf433550e7685cfe3c83d4f0690",
		"FORM_PLACE_MODE" => "PAGE",
		"FORM_STYLE" => "WHITE",
		"FORM_TITLE" => "",
		"HIDDEN_ANTI_SPAM" => "Y",
		"IBLOCK_CODE" => "requests",
		"IBLOCK_ID" => "",
		"IBLOCK_TYPE" => "feedback",
		"JQUERY_VALID" => "Y",
		"NOT_CREATE_ELEMENT" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"REDIRECT_AFTER_SUCCESS" => "N",
		"SAVE_SESSION" => "Y",
		"SEND_MESSAGE" => "Y",
		"SUCCESS_TEXT" => "",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "1",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"USE_GOOGLE_RECAPTCHA" => "N",
		"USE_SERVER_VALIDATE" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"FIELDS" => array(
			"group_1512567418272" => array(
				"ORIGINAL_TITLE" => "Новая группа (group_1512567418272)",
				"TITLE" => "",
				"GROUP_FIELD" => "Y",
				"IS_REQUIRED" => "N",
				"HIDE_FIELD" => "N",
				"DEPTH_LAVEL" => "1",
				"CLASS" => "row",
			),
			"group_1512567634841" => array(
				"ORIGINAL_TITLE" => "Новая группа (group_1512567634841)",
				"TITLE" => "",
				"GROUP_FIELD" => "Y",
				"DEPTH_LAVEL" => "2",
				"CLASS" => "col-md-6",
				"IS_REQUIRED" => "N",
				"HIDE_FIELD" => "N",
			),
			"NAME" => array(
				"ORIGINAL_TITLE" => "Название",
				"TITLE" => "Имя",
				"IS_REQUIRED" => "Y",
				"HIDE_FIELD" => "N",
				"TEMPLATE_ID" => ".default",
				"DEFAULT" => "",
			),
			"PROPERTY_email" => array(
				"TITLE" => "Email",
				"IS_REQUIRED" => "N",
				"HIDE_FIELD" => "N",
				"ORIGINAL_TITLE" => "[62] Email",
				"VALIDRULE" => "email",
			),
			"PROPERTY_phone" => array(
				"TITLE" => "Телефон",
				"IS_REQUIRED" => "Y",
				"HIDE_FIELD" => "N",
				"ORIGINAL_TITLE" => "[61] Телефон",
				"TEMPLATE_ID" => "phone",
				"VALIDRULE" => "phone",
			),
			"group_1512567639817" => array(
				"ORIGINAL_TITLE" => "Новая группа (group_1512567639817)",
				"TITLE" => "",
				"GROUP_FIELD" => "Y",
				"DEPTH_LAVEL" => "2",
				"CLASS" => "col-md-6",
				"IS_REQUIRED" => "N",
				"HIDE_FIELD" => "N",
			),
			"PREVIEW_TEXT" => array(
				"ORIGINAL_TITLE" => "Описание для анонса",
				"TITLE" => "Ваше сообщение",
				"IS_REQUIRED" => "N",
				"HIDE_FIELD" => "N",
			),
			"PROPERTY_href" => array(
				"TITLE" => "Страница отправки",
				"IS_REQUIRED" => "N",
				"HIDE_FIELD" => "Y",
				"ORIGINAL_TITLE" => "[58] Страница отправки",
				"DEFAULT" => Citrus\Developer\Helper::getPath(),
			),
		),
		"AGREEMENT_LINK" => "/agreement/",
		"MAIL_EVENT" => "CITRUS_REALTY_NEW_REQUEST",
		"MAILE_EVENT_TEMPLATE" => array(
		),
		"SEND_IMMEDIATE" => "N",
		"EMAIL_TO_VALUE" => "",
		"EMAIL_SUBJECT" => "Новая заявка"
	),
	false
);?>
