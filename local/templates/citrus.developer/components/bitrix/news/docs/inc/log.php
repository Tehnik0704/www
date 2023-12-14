
<? $APPLICATION->IncludeComponent(
	"citrus.developer:docslog",
	"",
	array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_CODE" => $arParams["SECTION_CODE"],
		"SECTION_ID" => "",
		"ITEMS_PER_PAGE" => "20",
	),
	false
); ?>
