<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;

$APPLICATION->SetTitle(Loc::getMessage("FAVORITES_TITLE"));

$this->setFrameMode(true);
?>

<?#favorites?>

			<?php ob_start() ?>
			<?$APPLICATION->IncludeComponent(
				"citrus.developer:template",
				"favorites",
				array(
					'URL_TEMPLATES_PATH' => $arResult['URL_TEMPLATES_PATH'],
					'TEMPLATE' => 'FAVORITES',
					'PROPERTY_LIST' => $arParams['FAVORITES_COLUMN'],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);?>
			<? $APPLICATION->IncludeComponent(
				"citrus.core:include",
				".default",
				array(
					"TITLE" => Loc::getMessage("FAVORITES_TITLE"),
					"DESCRIPTION" => Loc::getMessage("FAVORITES_DESCRIPTION"),
					"AREA_FILE_SHOW" => "html",
					"h" => "h1",
					"HTML" => ob_get_clean(),
					"PAGE_SECTION" => "Y",
					"COMPONENT_TEMPLATE" => ".default",
					"DATA_SRC" => "jk-favorites",
				),
				false
			); ?>

<?require __DIR__ . '/block_contacts.php';?>

<?require __DIR__ . '/block_callout.php';?>
