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
?>

<?if(!empty($arResult['ITEMS'])):?>
	<div class="benefit-list">
		<div class="row row-grid">
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
			<div class="col-md-6 col-lg-3">
				<div class="benefit-it" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="benefit-it__icon">
						<img class="benefit-it__icon-img" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="">
					</div>
					<div class="benefit-it__text">
						<?=$arItem['NAME']?>
					</div>
				</div>
			</div>
			<?endforeach;?>
		</div>
	</div><!-- .benefit-list -->
<?endif;?>