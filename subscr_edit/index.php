<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Редактирование подписки");
?><? $APPLICATION->IncludeComponent("bitrix:subscribe.edit", "subscribe_edit_page", Array(
	"AJAX_MODE" => "Y",	// Vklyuchity rezhim AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Dopolnitelyniy identifikator
		"AJAX_OPTION_HISTORY" => "N",	// Vklyuchity emulyatsiyu navigatsii brauzera
		"AJAX_OPTION_JUMP" => "N",	// Vklyuchity prokrutku k nachalu komponenta
		"AJAX_OPTION_STYLE" => "Y",	// Vklyuchity podgruzku stiley
		"ALLOW_ANONYMOUS" => "Y",	// Razreshity anonimnuyu podpisku
		"CACHE_TIME" => "3600",	// Vremya keshirovaniya (sek.)
		"CACHE_TYPE" => "A",	// Tip keshirovaniya
		"COMPONENT_TEMPLATE" => ".default",
		"SET_TITLE" => "Y",	// Ustanavlivaty zagolovok stranitsi
		"SHOW_AUTH_LINKS" => "Y",	// Pokazivaty ssilki na avtorizatsiyu pri anonimnoy podpiske
		"SHOW_HIDDEN" => "N",	// Pokazaty skritie rubriki podpiski
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
