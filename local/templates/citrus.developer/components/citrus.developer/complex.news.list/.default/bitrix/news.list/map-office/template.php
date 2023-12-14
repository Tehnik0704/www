<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

use Bitrix\Main\Localization\Loc;

$jsParams = array(
	"id" => $arResult["MAP_ID"], // map container id
	"items" => array(),
	'touchScroll' => true
);

if (!\Citrus\Core\YandexMap::hasKey())
{
	return;
}

?>

<?if(!empty($arResult["ITEMS"])):
	$arItem = $arResult["ITEMS"][0];
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
	<div class="office-map" id="<?= $this->GetEditAreaId($arItem['ID']);?>">
		<div class="row row-grid">
			<div class="col-dt-11"><h3><?= Loc::getMessage("MAP_OFFICE_TITLE") ?></h3></div>
		</div>

		<?foreach($arResult["ITEMS"] as $key => $arItem):?>
			<?
				/**
				 * @var $geodata \Citrus\Yandex\Geo\GeoObject
				 */
				$geodata = $arItem['PROPERTIES']['geodata']['VALUE'];
			?>
			<?
			$jsParams["items"][$key] = array(
				'name' => $arItem["NAME"],
				'address' => (string) $geodata,
				'coor' => ($geodata instanceof \Citrus\Yandex\Geo\GeoObject)? array(
					$geodata->getLatitude(),
					$geodata->getLongitude(),
				) : [],
				'body' => (string) $geodata
			);
			?>
		<?endforeach;?>
		<div class="citrus-objects-map" id="<?=$arResult["MAP_ID"]?>" style="height: 400px ;"></div>
		<script data-src="/bitrix/">
			;(function(){
				$().citrusObjectsMap(<?=CUtil::PhpToJSObject($jsParams)?>);
			}());
		</script>
	</div>
<?endif;?>


