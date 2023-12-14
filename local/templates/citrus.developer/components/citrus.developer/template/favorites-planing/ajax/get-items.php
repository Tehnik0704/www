<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader,
    \Bitrix\Main\Application,
    \Bitrix\Main\Context,
    \Bitrix\Main\Request,
    \Bitrix\Main\Localization\Loc;

CModule::IncludeModule("iblock");
$context = Application::getInstance()->getContext();
$request = $context->getRequest();
$id = $request["id"];
$xml_id = $request["xml_id"];
include('pgetblocks.php');
$getDataClass = new PGetBlocksClass($id, $xml_id);
$arData = $getDataClass->getResultData();
echo $arData;
