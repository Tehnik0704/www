<div class="row row-grid row-reverse">
	<div class="col-lg-5 col-dt-4">
		<? $APPLICATION->IncludeComponent(
			"citrus.core:include",
			".default",
			array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "clear.php",
				"PATH" => "/include/mp_about-list.php",
				"TITLE" => "",
				"COMPONENT_TEMPLATE" => ".default",
			),
			false
		); ?>
	</div>

	<div class="col-lg-7 col-dt-8">
		<? $APPLICATION->IncludeComponent(
			"citrus.core:include",
			".default",
			array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "clear.php",
				"PATH" => "/include/mp_about.php",
				"TITLE" => "",
				"COMPONENT_TEMPLATE" => ".default",
				"ADDITIONAL_CLASS" => "",
			),
			false
		); ?>
        <br><br>
        <p class="ta-xs-c ta-lg-l"><a href="/company/" class="btn btn-primary">подробнее</a></p>
	</div>
</div>