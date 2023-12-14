<?php

use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

Loc::loadMessages(__FILE__);

$this->setFrameMode(true);

#contacts

if($component->getJhk('PROPERTIES.contact.VALUE')):

    ?><? $APPLICATION->IncludeComponent(
		"citrus.core:include",
		".default",
		array(
			"TITLE" => Loc::getMessage('MANAGER_TITLE'),
			"DESCRIPTION" => Loc::getMessage('MANAGER_DESCRIPTION'),
			"PATH" => SITE_DIR . "include/jk/manager.php",
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "clear.php",
			"PAGE_SECTION" => "Y",
			"COMPONENT_TEMPLATE" => ".default",
			"MANAGER" => $component->getJhk('PROPERTIES.contact.VALUE'),
			"WIDGET_REL" => $component->getRouter()->getCurrentPage() === 'about' ? 'manager' : '',
			"JK_SETTINGS" => $settingsBlocks,
			"DATA_SRC" => "include-jk-manager",
		),
		false,
		array('HIDE_ICONS' => 'Y')
	); ?><?

endif;
