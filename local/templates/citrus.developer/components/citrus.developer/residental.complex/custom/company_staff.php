<?php

use Bitrix\Main\Localization\Loc;

$APPLICATION->SetPageProperty('SHOW_TITLE', 'N');
$APPLICATION->SetTitle(Loc::getMessage('JK_SECTION_COMPANY_STAFF_TITLE'));

?>

<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"TITLE" => Loc::getMessage('JK_SECTION_COMPANY_STAFF_BLOCK1_TITLE'),
		"DESCRIPTION" => Loc::getMessage('JK_SECTION_COMPANY_STAFF_BLOCK1_DESCR'),
		"TEXTP" => Loc::getMessage('JK_SECTION_COMPANY_STAFF_BLOCK1_TEXTP'),
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",

		"AREA_FILE_SHOW" => "component",
		"_COMPONENT" => "bitrix:news.list",
		"_COMPONENT_TEMPLATE" => "staff-section",

		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Format pokaza dati
		"ADD_SECTIONS_CHAIN" => "N",	// Vklyuchaty razdel v tsepochku navigatsii
		"AJAX_MODE" => "N",	// Vklyuchity rezhim AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Dopolnitelyniy identifikator
		"AJAX_OPTION_HISTORY" => "N",	// Vklyuchity emulyatsiyu navigatsii brauzera
		"AJAX_OPTION_JUMP" => "N",	// Vklyuchity prokrutku k nachalu komponenta
		"AJAX_OPTION_STYLE" => "Y",	// Vklyuchity podgruzku stiley
		"CACHE_FILTER" => "N",	// Keshirovaty pri ustanovlennom filytre
		"CACHE_GROUPS" => "Y",	// Uchitivaty prava dostupa
		"CACHE_TIME" => "36000000",	// Vremya keshirovaniya (sek.)
		"CACHE_TYPE" => "A",	// Tip keshirovaniya
		"CHECK_DATES" => "Y",	// Pokazivaty tolyko aktivnie na danniy moment elementi
		"COMPOSITE_FRAME_MODE" => "A",	// Golosovanie shablona komponenta po umolchaniyu
		"COMPOSITE_FRAME_TYPE" => "AUTO",	// Soderzhimoe komponenta
		"DETAIL_URL" => "",	// URL stranitsi detalynogo prosmotra (po umolchaniyu - iz nastroek infobloka)
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Vivodity pod spiskom
		"DISPLAY_DATE" => "Y",	// Vivodity datu elementa
		"DISPLAY_NAME" => "Y",	// Vivodity nazvanie elementa
		"DISPLAY_PICTURE" => "Y",	// Vivodity izobrazhenie dlya anonsa
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Vivodity tekst anonsa
		"DISPLAY_TOP_PAGER" => "N",	// Vivodity nad spiskom
		"FIELD_CODE" => array(	// Polya
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",	// Filytr
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Skrivaty ssilku, esli net detalynogo opisaniya
		"IBLOCK_ID" => 'developer_staff',	// Kod informatsionnogo bloka
		"IBLOCK_TYPE" => "content",	// Tip informatsionnogo bloka (ispolyzuetsya tolyko dlya proverki)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Vklyuchaty infoblok v tsepochku navigatsii
		"INCLUDE_SUBSECTIONS" => "Y",	// Pokazivaty elementi podrazdelov razdela
		"MESSAGE_404" => "",	// Soobshtenie dlya pokaza (po umolchaniyu iz komponenta)
		"NEWS_COUNT" => "12",	// Kolichestvo novostey na stranitse
		"PAGER_BASE_LINK_ENABLE" => "N",	// Vklyuchity obrabotku ssilok
		"PAGER_DESC_NUMBERING" => "N",	// Ispolyzovaty obratnuyu navigatsiyu
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Vremya keshirovaniya stranits dlya obratnoy navigatsii
		"PAGER_SHOW_ALL" => "N",	// Pokazivaty ssilku "Vse"
		"PAGER_SHOW_ALWAYS" => "N",	// Vivodity vsegda
		"PAGER_TEMPLATE" => ".default",	// Shablon postranichnoy navigatsii
		"PAGER_TITLE" => Loc::getMessage('JK_SECTION_COMPANY_STAFF_BLOCK1_PAGER_TITLE'),	// Nazvanie kategoriy
		"PARENT_SECTION" => "",	// ID razdela
		"PARENT_SECTION_CODE" => "",	// Kod razdela
		"PREVIEW_TRUNCATE_LEN" => "",	// Maksimalynaya dlina anonsa dlya vivoda (tolyko dlya tipa tekst)
		"PROPERTY_CODE" => array(	// Svoystva
			0 => "DEPARTMENT",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Ustanavlivaty zagolovok okna brauzera
		"SET_LAST_MODIFIED" => "N",	// Ustanavlivaty v zagolovkah otveta vremya modifikatsii stranitsi
		"SET_META_DESCRIPTION" => "N",	// Ustanavlivaty opisanie stranitsi
		"SET_META_KEYWORDS" => "N",	// Ustanavlivaty klyuchevie slova stranitsi
		"SET_STATUS_404" => "N",	// Ustanavlivaty status 404
		"SET_TITLE" => "Y",	// Ustanavlivaty zagolovok stranitsi
		"SHOW_404" => "N",	// Pokaz spetsialynoy stranitsi
		"SORT_BY1" => "propertysort_DEPARTMENT",	// Pole dlya pervoy sortirovki novostey
		"SORT_BY2" => "SORT",	// Pole dlya vtoroy sortirovki novostey
		"SORT_ORDER1" => "ASC",	// Napravlenie dlya pervoy sortirovki novostey
		"SORT_ORDER2" => "ASC",	// Napravlenie dlya vtoroy sortirovki novostey
		"STRICT_SECTION_CHECK" => "N",	// Strogaya proverka razdela dlya pokaza spiska
		"SPLIT_SECTION" => "Y", //razbivaty po otdelam
	),
	false
); ?>

<? $APPLICATION->IncludeComponent(
	"citrus.developer:callout",
	".default",
	array(
		"IBLOCK_ID" => "callout",
		"ID" => "hotite-kvartiry",
		"COMPONENT_TEMPLATE" => "callout",
		"IBLOCK_TYPE" => "info",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
