<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty('SHOW_TITLE', 'N');
$APPLICATION->SetTitle("Проекты");

$isModuleIncluded = CModule::IncludeModule("citrus.developer");
?><? $APPLICATION->IncludeComponent(
	"citrus.developer:residental.complex", 
	"custom", 
	array(
		"SEF_MODE" => "Y",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "Y",
		"SEF_FOLDER" => "/zhilye-kompleksy/",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "Y",
		"FILE_404" => "/404.php",
		"MESSAGE_404" => "",
		"COMPONENT_TEMPLATE" => "custom",
		"USE_ELEMENT_COUNTER" => "Y",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FIELDS" => array(
			0 => array(
				"code" => "common_area",
				"name" => "Общая площадь",
			),
			1 => array(
				"code" => "rooms",
				"name" => "Кол-во комнат",
			),
			2 => array(
				"code" => "floor",
				"name" => "Этаж",
			),
			3 => array(
				"code" => "ss",
				"name" => "Сторона света",
			),
		),
		"FIELDS_ALL_JK" => array(
			0 => array(
				"code" => "section",
				"name" => "Подъезд",
			),
			1 => array(
				"code" => "rooms",
				"name" => "Кол-во комнат (в рекомендованном решении)",
			),
			2 => array(
				"code" => "floor",
				"name" => "Этаж",
			),
			3 => array(
				"code" => "complex",
				"name" => "Жилой дом",
			),
			4 => array(
				"code" => "common_area",
				"name" => "Общая площадь",
			),
			5 => array(
				"code" => "ready_date",
				"name" => "Сдача",
			),
			6 => array(
				"code" => "ss",
				"name" => "Сторона света",
			),
		),
		"FAVORITES_COLUMN" => array(
			0 => array(
				"code" => "common_area|living_area",
				"name" => "Общая|жилая",
			),
			1 => array(
				"code" => "rooms",
				"name" => "Кол-во комнат (в рекомендованном решении)",
			),
			2 => array(
				"code" => "floor|floors",
				"name" => "Этаж|этажей",
			),
			3 => array(
				"code" => "ready_date",
				"name" => "Сдача",
			),
		),
		"PLAN_DETAIL_PROPERTIES" => array(
			0 => array(
				"code" => "rooms",
				"name" => "Количество комнат в рекомендованном планировочном решении",
			),
			1 => array(
				"code" => "common_area",
				"name" => "Общая площадь",
			),
			2 => array(
				"code" => "floor",
				"name" => "Этаж",
			),
			3 => array(
				"code" => "flats_count",
				"name" => "Свободных квартир",
			),
		),
		"FLAT_DETAIL_PROPERTIES" => array(
			0 => array(
				"code" => "common_area",
				"name" => "Общая площадь",
			),
			1 => array(
				"code" => "rooms",
				"name" => "Количество комнат в рекомендованном планировочном решении",
			),
			2 => array(
				"code" => "floor",
				"name" => "Этаж",
			),
		),
		"NON_RESIDENTAL_DETAIL_PROPERTIES" => array(
			0 => array(
				"code" => "commercial_type",
				"name" => "Категория",
			),
			1 => array(
				"code" => "common_area",
				"name" => "Общая площадь",
			),
			2 => array(
				"code" => "floor",
				"name" => "Этаж",
			),
			3 => array(
				"code" => "purpose_warehouse",
				"name" => "Назначение склада",
			),
			4 => array(
				"code" => "publishterms_ignoreservicepackages",
				"name" => "Не использовать пакет размещений при публикации объявления (для Циан)",
			),
			5 => array(
				"code" => "lot_number",
				"name" => "Номер лота",
			),
			6 => array(
				"code" => "garage_features",
				"name" => "Особенности",
			),
			7 => array(
				"code" => "commercial_features",
				"name" => "Особенности нежилого помещения",
			),
			8 => array(
				"code" => "floor_covering",
				"name" => "Покрытие пола",
			),
			9 => array(
				"code" => "distance_to_town",
				"name" => "Расстояние до города, км.",
			),
			10 => array(
				"code" => "commercial_purpose",
				"name" => "Рекомендуемое назначение объекта",
			),
			11 => array(
				"code" => "renovation",
				"name" => "Ремонт",
			),
			12 => array(
				"code" => "wc",
				"name" => "Санузел",
			),
			13 => array(
				"code" => "building_series",
				"name" => "Серия дома",
			),
			14 => array(
				"code" => "condition",
				"name" => "Состояние",
			),
			15 => array(
				"code" => "publishterms_sevices",
				"name" => "Список размещений (для Циан)",
			),
			16 => array(
				"code" => "garage_building_type",
				"name" => "Тип гаража",
			),
			17 => array(
				"code" => "building_type",
				"name" => "Тип дома",
			),
			18 => array(
				"code" => "commercial_building_type",
				"name" => "Тип здания",
			),
			19 => array(
				"code" => "window_type",
				"name" => "Тип окон",
			),
			20 => array(
				"code" => "parking_type",
				"name" => "Тип парковки",
			),
			21 => array(
				"code" => "deal_status_commercial",
				"name" => "Тип сделки",
			),
			22 => array(
				"code" => "commercial_rent_conditions",
				"name" => "Условия аренды",
			),
			23 => array(
				"code" => "publishterms_excludedsevices",
				"name" => "Условия размещения, которые нельзя применять к объявлению (для Циан)",
			),
			24 => array(
				"code" => "taxation_form",
				"name" => "Форма налогообложения арендодателя или продавца",
			),
			25 => array(
				"code" => "commercial_building_features",
				"name" => "Характеристики здания",
			),
			26 => array(
				"code" => "floors",
				"name" => "Этажность",
			),
		),
		"SEF_URL_TEMPLATES" => array(
			"index" => "",
			"section" => "s-#SECTION_ID#/",
			"select_apartment_all" => "select-apartment/",
			"non_residental_all_index" => "non-residental/",
			"non_residental_all_type" => "non-residental/#SECTION_CODE#/",
			"about" => "#ELEMENT_CODE#/",
			"select_apartment" => "#ELEMENT_CODE#/select-apartment/",
			"non_residental_index" => "#ELEMENT_CODE#/non-residental/",
			"non_residental_type" => "#ELEMENT_CODE#/non-residental/#SECTION_CODE#/",
			"non_residental_detail" => "#ELEMENT_CODE#/non-residental/room/#ID#/",
			"mortgage" => "#ELEMENT_CODE#/mortgage/",
			"docs" => "#ELEMENT_CODE#/docs/",
			"docslog" => "#ELEMENT_CODE#/docs/log/",
			"photo_progress" => "#ELEMENT_CODE#/photo-progress/",
			"gallery" => "#ELEMENT_CODE#/gallery/",
			"photo_progress_detail" => "#ELEMENT_CODE#/photo-progress/#PHOTO_ID#/",
			"gallery_detail" => "#ELEMENT_CODE#/gallery/#PHOTO_ID#/",
			"contacts" => "#ELEMENT_CODE#/contacts/",
			"favorites" => "#ELEMENT_CODE#/favorites/",
			"pdf" => "#ELEMENT_CODE#/pdf/",
			"house_detail" => "#ELEMENT_CODE#/house/#HOUSE_CODE#/",
			"plan_detail" => "#ELEMENT_CODE#/house/#HOUSE_CODE#/plan-#PLAN_ID#/",
			"flat_detail" => "#ELEMENT_CODE#/house/#HOUSE_CODE#/flat-#FLAT_ID#/",
			"company" => "#ELEMENT_CODE#/company/",
			"company_staff" => "#ELEMENT_CODE#/company/staff/",
		)
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>