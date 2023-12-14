<div class="manager-row">
	<div class="manager-left">
		<? $APPLICATION->IncludeComponent(
			"bitrix:news.detail",
			"manager",
			array(
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"ADD_ELEMENT_CHAIN" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"BROWSER_TITLE" => "-",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "Y",
				"COMPOSITE_FRAME_MODE" => "A",
				"COMPOSITE_FRAME_TYPE" => "AUTO",
				"DETAIL_URL" => "",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"DISPLAY_TOP_PAGER" => "N",
				"ELEMENT_CODE" => "",
				"ELEMENT_ID" => $arParams['MANAGER'],
				"FIELD_CODE" => array(
					0 => "PREVIEW_PICTURE",
					1 => "",
				),
				"IBLOCK_ID" => \Citrus\Developer\Iblock::getId(\Citrus\Developer\Iblock::STAFF),
				"IBLOCK_TYPE" => "company",
				"IBLOCK_URL" => "",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"MESSAGE_404" => "",
				"META_DESCRIPTION" => "-",
				"META_KEYWORDS" => "-",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "",
				"PROPERTY_CODE" => array(
					0 => "POSITION",
					1 => "EMAIL",
					2 => "DEPARTMENT",
					3 => "TIMETABLE",
					4 => "PHONE",
					5 => "",
					6 => "",
					7 => "",
					8 => "",
				),
				"SET_BROWSER_TITLE" => "N",
				"SET_CANONICAL_URL" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"STRICT_SECTION_CHECK" => "N",
				"USE_PERMISSIONS" => "N",
				"COMPONENT_TEMPLATE" => ".default"
			),
			$component,
			array(
				'HIDE_ICONS' => 'Y'
			)
		);?>
	</div>
	<div class="manager-right print-hidden">
		<div class="section-footer display-lg-n ta-xs-c">
			<a href="javascript:void(0);" data-href="/ajax/order_call.php" data-toggle="modal" class="btn btn-primary btn-stretch">заказать обратный звонок</a>
		</div>
		<div class="display-xs-n display-lg-b">
			<div class="h3">
				Заказать обратный звонок
			</div>
			<? $APPLICATION->IncludeComponent(
				"citrus.forms:iblock.element",
				"simple",
				Array(
					"AFTER_FORM_TOOLTIP" => "",
					"AGREEMENT_FIELDS" => "Имя, Email, Телефон",
					"AGREEMENT_LINK" => "/agreement/",
					"AJAX" => "Y",
					"ANCHOR_ID" => "",
					"BEFORE_FORM_TOOLTIP" => "",
					"BUTTON_CLASS" => "",
					"BUTTON_POSITION" => "LEFT",
					"BUTTON_TITLE" => "",
					"COMPOSITE_FRAME_MODE" => "A",
					"COMPOSITE_FRAME_TYPE" => "AUTO",
					"EDIT_ELEMENT" => "N",
					"ELEMENT_ID" => "",
					"EMAIL_SUBJECT" => "Заказ звонка",
					"EMAIL_TO_VALUE" => "",
					"ERROR_TEXT" => "",
					"FIELDS" => array("NAME"=>array("ORIGINAL_TITLE"=>"Название","TITLE"=>"Введите имя","IS_REQUIRED"=>"Y","HIDE_FIELD"=>"N",),"PROPERTY_phone"=>array("TITLE"=>"Телефон","IS_REQUIRED"=>"Y","HIDE_FIELD"=>"N","ORIGINAL_TITLE"=>"[45] Телефон","TEMPLATE_ID"=>"phone","VALIDRULE"=>"phone",),"PROPERTY_href"=>array("TITLE"=>"Отправлено со страницы","IS_REQUIRED"=>"N","HIDE_FIELD"=>"Y","ORIGINAL_TITLE"=>"[54] Отправлено со страницы","DEFAULT"=>\Citrus\Developer\Helper::getPath(),),),
					"FORM_CLASS" => "citrus-form_compact",
					"FORM_ID" => "header_order_call_form",
					"FORM_PLACE_MODE" => "PAGE",
					"FORM_STYLE" => "WHITE",
					"FORM_TITLE" => "",
					"HIDDEN_ANTI_SPAM" => "Y",
					"IBLOCK_CODE" => 'order_call',
					"IBLOCK_ID" => "",
					"IBLOCK_TYPE" => "feedback",
					"JQUERY_VALID" => "Y",
					"MAILE_EVENT_TEMPLATE" => array(),
					"MAIL_EVENT" => "CITRUS_REALTY_NEW_REQUEST",
					"NOT_CREATE_ELEMENT" => "N",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"REDIRECT_AFTER_SUCCESS" => "N",
					"SAVE_SESSION" => "Y",
					"SEND_IMMEDIATE" => "N",
					"SEND_MESSAGE" => "Y",
					"SUB_TEXT" => "",
					"SUCCESS_TEXT" => "Спасибо! Вам перезвонят в ближайшее время.",
					"USER_CONSENT" => "N",
					"USER_CONSENT_ID" => "1",
					"USER_CONSENT_IS_CHECKED" => "Y",
					"USER_CONSENT_IS_LOADED" => "N",
					"USER_SERVER_VALIDATE" => "N",
					"USE_GOOGLE_RECAPTCHA" => "N",
					"USE_SERVER_VALIDATE" => "N",
				)
			);?>
		</div>
		<br>
	</div>
</div>
