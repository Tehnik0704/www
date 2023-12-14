<?php

use Bitrix\Main\Loader;

$isAjax = isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest";
if ($isAjax)
{
	require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
	$APPLICATION->SetTitle("");
	require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . '/functions.php');
}
else
{
	require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
}

if (isset($_REQUEST['items']) && is_array($_REQUEST['items']))
{
	$GLOBALS['JSON_FILTER']['ID'] = array_map(function ($val) {
		return (int)$val;
	}, $_REQUEST['items']);
}
if (isset($_REQUEST['properties']) && is_array($_REQUEST['properties']))
{
	$arProperties = array_map(function ($val) {
		return htmlspecialchars($val);
	}, $_REQUEST['properties']);
}
else
{
	$arProperties = ['cost'];
}
if (!Loader::includeModule("citrus.developer"))
{
	return;
}

$arParams = [
	'FILTER_NAME' => 'JSON_FILTER',
	'PROPERTIES' => $arProperties,
];
if (!empty($_REQUEST['SORT']))
{
	$arParams['CUSTOM_SORT'] = $_REQUEST['SORT'];
}
if (!empty($_REQUEST['ORDER']))
{
	$arParams['CUSTOM_SORT_ORDER'] = $_REQUEST['ORDER'];
}

echo $APPLICATION->IncludeComponent("citrus.developer:flats.list", $isAjax ? 'json' : '.default', $arParams, $component, ['HIDE_ICONS' => 'Y']);

if ($isAjax)
{
	require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
}
else
{
	require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
}?>
