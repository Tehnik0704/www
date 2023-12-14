<?
/**
 * @var array $arResult
 * @var object $arResult[PARENT] Citrus\Developer\Components\ResidentalComplex\Component
 */

use Bitrix\Main\Localization\Loc;?>
<? $APPLICATION->IncludeComponent(
	"citrus.developer:template",
	"infrastructure",
	array(
		'DATA' => $arResult['PARENT']->getJhk()
	),
	$arResult['PARENT']
); ?>
<footer class="section-footer"><a href="<?=$arResult['PARENT']->getRouter()->getUrl('select_apartment')?>" class="btn btn-primary"><?= Loc::getMessage("JK_SELECT_APARTMENT_LINK") ?></a></footer>
