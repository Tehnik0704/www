<?php

use Bitrix\Main\Localization\Loc;

$APPLICATION->SetPageProperty('SHOW_TITLE', 'N');
$APPLICATION->SetTitle(Loc::getMessage('JK_SECTION_COMPANY_TITLE'));

?>

<? $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"about-company",
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
		"ELEMENT_CODE" => "company",
		"ELEMENT_ID" => "",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"IBLOCK_ID" => "developer_info",
		"IBLOCK_TYPE" => "info",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => Loc::getMessage('JK_SECTION_COMPANY_PAGER_TITLE'),
		"PROPERTY_CODE" => array(
			0 => "DESCRIPTION",
			1 => "NUMBERS",
			2 => "DOCS",
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
		"COMPONENT_TEMPLATE" => "about-company"
	),
	false
);?>

<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"TITLE" => Loc::getMessage('JK_SECTION_COMPANY_BLOCK2_TITLE'),
		"DESCRIPTION" =>  Loc::getMessage('JK_SECTION_COMPANY_BLOCK2_DESCR'),
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"BG_COLOR" => "N",
		"DATA_SRC" => "company-progress",

		"AREA_FILE_SHOW" => "component",
		"_COMPONENT" => "bitrix:news.list",
		"_COMPONENT_TEMPLATE" => "achivements",

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
		"IBLOCK_ID" => "developer_achievements",	// Kod informatsionnogo bloka
		"IBLOCK_TYPE" => "content",	// Tip informatsionnogo bloka (ispolyzuetsya tolyko dlya proverki)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Vklyuchaty infoblok v tsepochku navigatsii
		"INCLUDE_SUBSECTIONS" => "Y",	// Pokazivaty elementi podrazdelov razdela
		"MESSAGE_404" => "",	// Soobshtenie dlya pokaza (po umolchaniyu iz komponenta)
		"NEWS_COUNT" => "20",	// Kolichestvo novostey na stranitse
		"PAGER_BASE_LINK_ENABLE" => "N",	// Vklyuchity obrabotku ssilok
		"PAGER_DESC_NUMBERING" => "N",	// Ispolyzovaty obratnuyu navigatsiyu
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Vremya keshirovaniya stranits dlya obratnoy navigatsii
		"PAGER_SHOW_ALL" => "N",	// Pokazivaty ssilku "Vse"
		"PAGER_SHOW_ALWAYS" => "N",	// Vivodity vsegda
		"PAGER_TEMPLATE" => ".default",	// Shablon postranichnoy navigatsii
		"PAGER_TITLE" => Loc::getMessage('JK_SECTION_COMPANY_BLOCK2_PAGER_TITLE'),	// Nazvanie kategoriy
		"PARENT_SECTION" => "",	// ID razdela
		"PARENT_SECTION_CODE" => "",	// Kod razdela
		"PREVIEW_TRUNCATE_LEN" => "",	// Maksimalynaya dlina anonsa dlya vivoda (tolyko dlya tipa tekst)
		"PROPERTY_CODE" => array(	// Svoystva
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Ustanavlivaty zagolovok okna brauzera
		"SET_LAST_MODIFIED" => "N",	// Ustanavlivaty v zagolovkah otveta vremya modifikatsii stranitsi
		"SET_META_DESCRIPTION" => "N",	// Ustanavlivaty opisanie stranitsi
		"SET_META_KEYWORDS" => "N",	// Ustanavlivaty klyuchevie slova stranitsi
		"SET_STATUS_404" => "N",	// Ustanavlivaty status 404
		"SET_TITLE" => "N",	// Ustanavlivaty zagolovok stranitsi
		"SHOW_404" => "N",	// Pokaz spetsialynoy stranitsi
		"SORT_BY1" => "SORT",	// Pole dlya pervoy sortirovki novostey
		"SORT_BY2" => "ACTIVE_FROM",	// Pole dlya vtoroy sortirovki novostey
		"SORT_ORDER1" => "ASC",	// Napravlenie dlya pervoy sortirovki novostey
		"SORT_ORDER2" => "DESC",	// Napravlenie dlya vtoroy sortirovki novostey
		"STRICT_SECTION_CHECK" => "N",	// Strogaya proverka razdela dlya pokaza spiska
	),
	false
); ?>

<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"TITLE" => Loc::getMessage('JK_SECTION_COMPANY_BLOCK3_TITLE'),
		"DESCRIPTION" =>  Loc::getMessage('JK_SECTION_COMPANY_BLOCK3_DESCR'),
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"DATA_SRC" => "company-team",

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
		"DISPLAY_BOTTOM_PAGER" => "N",	// Vivodity pod spiskom
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
		"NEWS_COUNT" => "3",	// Kolichestvo novostey na stranitse
		"PAGER_BASE_LINK_ENABLE" => "N",	// Vklyuchity obrabotku ssilok
		"PAGER_DESC_NUMBERING" => "N",	// Ispolyzovaty obratnuyu navigatsiyu
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Vremya keshirovaniya stranits dlya obratnoy navigatsii
		"PAGER_SHOW_ALL" => "N",	// Pokazivaty ssilku "Vse"
		"PAGER_SHOW_ALWAYS" => "N",	// Vivodity vsegda
		"PAGER_TEMPLATE" => ".default",	// Shablon postranichnoy navigatsii
		"PAGER_TITLE" => Loc::getMessage('JK_SECTION_COMPANY_BLOCK3_PAGER_TITLE'),	// Nazvanie kategoriy
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
		"SET_TITLE" => "N",	// Ustanavlivaty zagolovok stranitsi
		"SHOW_404" => "N",	// Pokaz spetsialynoy stranitsi
		"SORT_BY1" => "propertysort_DEPARTMENT",	// Pole dlya pervoy sortirovki novostey
		"SORT_BY2" => "SORT",	// Pole dlya vtoroy sortirovki novostey
		"SORT_ORDER1" => "ASC",	// Napravlenie dlya pervoy sortirovki novostey
		"SORT_ORDER2" => "ASC",	// Napravlenie dlya vtoroy sortirovki novostey
		"STRICT_SECTION_CHECK" => "N",	// Strogaya proverka razdela dlya pokaza spiska
		"SPLIT_SECTION" => "N", //razbivaty po otdelam
	),
	false
); ?>

<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"TITLE" => Loc::getMessage('JK_SECTION_COMPANY_BLOCK4_TITLE'),
		"DESCRIPTION" =>  Loc::getMessage('JK_SECTION_COMPANY_BLOCK4_DESCR'),
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"DATA_SRC" => "company-reviews",

		"AREA_FILE_SHOW" => "component",
		"_COMPONENT" => "bitrix:news.list",
		"_COMPONENT_TEMPLATE" => "reviews",

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
		"IBLOCK_ID" => "developer_reviews",	// Kod informatsionnogo bloka
		"IBLOCK_TYPE" => "content",	// Tip informatsionnogo bloka (ispolyzuetsya tolyko dlya proverki)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Vklyuchaty infoblok v tsepochku navigatsii
		"INCLUDE_SUBSECTIONS" => "Y",	// Pokazivaty elementi podrazdelov razdela
		"MESSAGE_404" => "",	// Soobshtenie dlya pokaza (po umolchaniyu iz komponenta)
		"NEWS_COUNT" => "20",	// Kolichestvo novostey na stranitse
		"PAGER_BASE_LINK_ENABLE" => "N",	// Vklyuchity obrabotku ssilok
		"PAGER_DESC_NUMBERING" => "N",	// Ispolyzovaty obratnuyu navigatsiyu
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Vremya keshirovaniya stranits dlya obratnoy navigatsii
		"PAGER_SHOW_ALL" => "N",	// Pokazivaty ssilku "Vse"
		"PAGER_SHOW_ALWAYS" => "N",	// Vivodity vsegda
		"PAGER_TEMPLATE" => ".default",	// Shablon postranichnoy navigatsii
		"PAGER_TITLE" => Loc::getMessage('JK_SECTION_COMPANY_BLOCK4_PAGER_TITLE'),	// Nazvanie kategoriy
		"PARENT_SECTION" => "",	// ID razdela
		"PARENT_SECTION_CODE" => "",	// Kod razdela
		"PREVIEW_TRUNCATE_LEN" => "",	// Maksimalynaya dlina anonsa dlya vivoda (tolyko dlya tipa tekst)
		"PROPERTY_CODE" => array(	// Svoystva
			0 => "COMPLEX",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Ustanavlivaty zagolovok okna brauzera
		"SET_LAST_MODIFIED" => "N",	// Ustanavlivaty v zagolovkah otveta vremya modifikatsii stranitsi
		"SET_META_DESCRIPTION" => "N",	// Ustanavlivaty opisanie stranitsi
		"SET_META_KEYWORDS" => "N",	// Ustanavlivaty klyuchevie slova stranitsi
		"SET_STATUS_404" => "N",	// Ustanavlivaty status 404
		"SET_TITLE" => "N",	// Ustanavlivaty zagolovok stranitsi
		"SHOW_404" => "N",	// Pokaz spetsialynoy stranitsi
		"SORT_BY1" => "SORT",	// Pole dlya pervoy sortirovki novostey
		"SORT_BY2" => "ACTIVE_FROM",	// Pole dlya vtoroy sortirovki novostey
		"SORT_ORDER1" => "ASC",	// Napravlenie dlya pervoy sortirovki novostey
		"SORT_ORDER2" => "DESC",	// Napravlenie dlya vtoroy sortirovki novostey
		"STRICT_SECTION_CHECK" => "N",	// Strogaya proverka razdela dlya pokaza spiska
	),
	false
); ?>

<? $APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	array(
		"TITLE" => Loc::getMessage('JK_SECTION_COMPANY_BLOCK5_TITLE'),
		"DESCRIPTION" =>  Loc::getMessage('JK_SECTION_COMPANY_BLOCK5_DESCR'),
		"PAGE_SECTION" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"BG_COLOR" => "GRAY",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DATA_SRC" => "company-partners",

		"AREA_FILE_SHOW" => "component",
		"_COMPONENT" => "bitrix:news.list",
		"_COMPONENT_TEMPLATE" => "partners_carousel",

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
		"IBLOCK_ID" => "developer_partners",	// Kod informatsionnogo bloka
		"IBLOCK_TYPE" => "content",	// Tip informatsionnogo bloka (ispolyzuetsya tolyko dlya proverki)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Vklyuchaty infoblok v tsepochku navigatsii
		"INCLUDE_SUBSECTIONS" => "Y",	// Pokazivaty elementi podrazdelov razdela
		"MESSAGE_404" => "",	// Soobshtenie dlya pokaza (po umolchaniyu iz komponenta)
		"NEWS_COUNT" => "20",	// Kolichestvo novostey na stranitse
		"PAGER_BASE_LINK_ENABLE" => "N",	// Vklyuchity obrabotku ssilok
		"PAGER_DESC_NUMBERING" => "N",	// Ispolyzovaty obratnuyu navigatsiyu
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Vremya keshirovaniya stranits dlya obratnoy navigatsii
		"PAGER_SHOW_ALL" => "N",	// Pokazivaty ssilku "Vse"
		"PAGER_SHOW_ALWAYS" => "N",	// Vivodity vsegda
		"PAGER_TEMPLATE" => ".default",	// Shablon postranichnoy navigatsii
		"PAGER_TITLE" => "",	// Nazvanie kategoriy
		"PARENT_SECTION" => "",	// ID razdela
		"PARENT_SECTION_CODE" => "",	// Kod razdela
		"PREVIEW_TRUNCATE_LEN" => "",	// Maksimalynaya dlina anonsa dlya vivoda (tolyko dlya tipa tekst)
		"PROPERTY_CODE" => array(	// Svoystva
			0 => "STATUS",
			1 => "LOCATION",
		),
		"SET_BROWSER_TITLE" => "N",	// Ustanavlivaty zagolovok okna brauzera
		"SET_LAST_MODIFIED" => "N",	// Ustanavlivaty v zagolovkah otveta vremya modifikatsii stranitsi
		"SET_META_DESCRIPTION" => "N",	// Ustanavlivaty opisanie stranitsi
		"SET_META_KEYWORDS" => "N",	// Ustanavlivaty klyuchevie slova stranitsi
		"SET_STATUS_404" => "N",	// Ustanavlivaty status 404
		"SET_TITLE" => "N",	// Ustanavlivaty zagolovok stranitsi
		"SHOW_404" => "N",	// Pokaz spetsialynoy stranitsi
		"SORT_BY1" => "SORT",	// Pole dlya pervoy sortirovki novostey
		"SORT_BY2" => "ACTIVE_FROM",	// Pole dlya vtoroy sortirovki novostey
		"SORT_ORDER1" => "ASC",	// Napravlenie dlya pervoy sortirovki novostey
		"SORT_ORDER2" => "DESC",	// Napravlenie dlya vtoroy sortirovki novostey
		"STRICT_SECTION_CHECK" => "N",	// Strogaya proverka razdela dlya pokaza spiska
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
