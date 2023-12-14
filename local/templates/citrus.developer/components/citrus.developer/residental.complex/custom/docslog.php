<?php

use Bitrix\Main\Localization\Loc;
use Citrus\Developer\Iblock;

$this->setFrameMode(true);
$APPLICATION->SetTitle(Loc::getMessage("DOCSLOG_TITLE"));
?>

			<?php ob_start() ?>
			<? $APPLICATION->IncludeComponent(
				"citrus.developer:docslog",
				"",
				array(
					"IBLOCK_ID" => Iblock::getId(Iblock::DOCS),
					"SECTION_CODE" => "",
					"SECTION_ID" => $component->getRouter()->getVar('house'),
				),
				false
			); ?>

			<? $APPLICATION->IncludeComponent(
				"citrus.core:include",
				".default",
				array(
					"TITLE" => $APPLICATION->GetTitle(),
					"BIG_DESCRIPTION" => Loc::getMessage("JK_DOC_LOG_BIG_DESCRIPTION"),
					"AREA_FILE_SHOW" => "html",
					"h" => "h1",
					"HTML" => ob_get_clean(),
					"PAGE_SECTION" => "Y",
					"COMPONENT_TEMPLATE" => ".default",
					"DATA_SRC" => "jk-docslog",
				),
				false
			); ?>
