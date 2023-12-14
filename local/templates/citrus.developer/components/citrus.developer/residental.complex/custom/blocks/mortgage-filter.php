<?php

$cost = \Bitrix\Main\Context::getCurrent()->getRequest()->get("cost");
$settingsTable = \Citrus\Developer\SolutionFactory::get()->settings();
$currency = $settingsTable::getValue('CURRENCY');

?>

<?$APPLICATION->IncludeComponent(
	"citrus:realty.mortgage",
	"vue-mortgage",
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"DISCOUNT_PERCENT" => "0.5",
		"DEFAULT_FULL_PRICE" => $cost ?:"3000000",
		"DEFAULT_FIRST_PRICE" => "450000",
		"DEFAULT_FIRST_PRICE_UNITS" => "R",
		"DEFAULT_PERCENT" => "11.5",
		"DEFAULT_YEAR" => "15",
		"SHOW_OVERPAYMENT_BLOCK" => "Y",
		"SHOW_BANK_LOGOS" => "Y",
		"RESULT_DECLAIMER" => "",
		"CURRENCY" => "",
		"CURRENT_CURRENCY" => $settingsTable::getValue('CURRENCY'),
	),
	false
);?>
