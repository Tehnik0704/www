<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Loader;

Loc::loadLanguageFile(__FILE__);

switch (Loader::includeSharewareModule('citrus.developer'))
{
	case Loader::MODULE_DEMO_EXPIRED:
		die(Loc::getMessage("CITRUS_DEVELOPER_MODULE_EXPIRED"));
	case Loader::MODULE_NOT_FOUND:
		die(Loc::getMessage("CITRUS_DEVELOPER_MODULE_NOT_FOUND"));
}

if (!Loader::includeModule('citrus.forms'))
{
	die(Loc::getMessage("CITRUS_FORMS_MODULE_NOT_FOUND"));
}

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/app/plugins.php';

$asset = Asset::getInstance();
// css variables polifill for IE11 https://github.com/jhildenbiddle/css-vars-ponyfill
$asset->addString('<script>
if (BX.browser.DetectIeVersion() >= 9) {
	BX.loadScript("https://unpkg.com/css-vars-ponyfill@1", function () {
		BX.ready(function () {
			cssVars({onlyVars: true})
		});
	});
}
</script>
', \Bitrix\Main\Page\AssetLocation::AFTER_JS);

?>

<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>" class="tag-html">
<head>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta content="on" http-equiv="cleartype">
    <meta content="True" name="HandheldFriendly">
    <meta content="320" name="MobileOptimized">
    <meta name="format-detection" content="telephone=no">
    <meta content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" name="viewport">

    <?php

	$APPLICATION->ShowViewContent('html-head');

    // Assets app/plugins.php
    CJSCore::Init('app');

    $asset = Asset::getInstance();
    $asset->addCss(SITE_TEMPLATE_PATH.'/app/css/print.css', true);?>

	<?$APPLICATION->ShowHead()?>

	<?#fonts?>
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<script>
		// control loading fonts
		// https://github.com/typekit/webfontloader
		var WebFontConfig = {
			classes: false,
			google: {
				families: [
					'Open Sans:300,300i,400,400i,600,600i,700,700i:cyrillic',
					'Merriweather:300,400:cyrillic'
				]
			}
		};
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" async="async"></script>

    <title><?$APPLICATION->ShowTitle()?></title>
    <link rel="stylesheet" href="/local/templates/citrus.developer/app/css/custom.css">
</head>
<body class="tag-body">
    <? $APPLICATION->ShowPanel() ?>

    <?#set in ./main-template/header.php && ./jk-template/header.php ?>
    <?$APPLICATION->ShowViewContent("header");?>
    <?$APPLICATION->ShowViewContent('workarea-start');?>
