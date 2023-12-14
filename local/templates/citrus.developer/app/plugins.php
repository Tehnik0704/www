<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$appPath = SITE_TEMPLATE_PATH . '/app/';
$pluginsPath = $appPath.'js/';
$bowerPath = $pluginsPath.'bower_components/';

$jsMessagesFilePath = SITE_TEMPLATE_PATH .'/lang/ru/js_messages.php';

$arTemplateCoreConfig = array(
	'tabs' => [
		'js' => $pluginsPath.'citrus/tabs/tabs.js',
		'css' => $pluginsPath.'citrus/tabs/tabs.css',
		'rel' => 'jquery',
	],
	'icon' => [
		'css' => [
			$appPath.'icon-fonts/icomoon/icomoon.css',
			$appPath.'icon-fonts/ruble/font-rub.css',
		],
	],
	'app' => [
		'js' => [
			//$appPath.'/plugins.js',
			$appPath.'js/app.js',
		],
		'css' => [
			$appPath.'css/typography.css',
			$appPath.'css/list.css',
			$appPath.'css/btn.css',
			$appPath.'css/layout.css',

			$appPath.'css/modal.css',
			$appPath.'css/map.css',

			$appPath.'css/main.css',
			$appPath.'css/table.css',
		],
		'rel' => array(
			'citrusUI',
			'jquery',
			'icon',
			'inview',
			'citrus.core.popup',
			'citrus.core.embed-responsive'
		),
		'use' => CJSCore::USE_PUBLIC,
		'lang' => $jsMessagesFilePath,
	],
);

CJsCore::Init();
foreach ($arTemplateCoreConfig as $ext => $arExt)
	CJSCore::RegisterExt($ext, $arExt);
