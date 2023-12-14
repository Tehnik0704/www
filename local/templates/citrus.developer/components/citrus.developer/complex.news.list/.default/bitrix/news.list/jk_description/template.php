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

<div class="jk_icons">
<?foreach($arResult["ITEMS"] as $i => $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

    $property = new \Citrus\Developer\Template\Property($arItem);
    $even = (($i % 2) == 0);
    ?>
    <article class="article qwe <?if($even):?>_reverse<?endif;?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <?if($arItem['PREVIEW_PICTURE']['SRC']):?>
            <div class="article-image-container">
                <img class="article-image" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="">
            </div>
        <?endif;?>

        <div class="article-content">
	        <?if($arParams['SHOW_TITLE'] !== 'N'):?>
		        <h2><?=$arItem['NAME']?></h2>
	        <?endif;?>

            <?if($arItem['PREVIEW_PICTURE']['SRC']):?>
                <img class="article-mobile-image" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="">
            <?endif;?>

            <?=str_replace('#SITE_DIR#', SITE_DIR, $arItem['PREVIEW_TEXT'])?>

			<?if($property->hasValue('LINK_ADDRESS')):?>
				<div class="article-footer">
					<a class="btn btn-primary btn-stretch" href="<?=\Citrus\Developer\TemplateHelper::makeSiteLink($property->getValue('LINK_ADDRESS'))?>">
						<?= $property->getValue('LINK_NAME') ?: Loc::getMessage("JK_DESCRIPTION_LINK_NAME")?>
					</a>
				</div>
			<?endif;?>
        </div>

    </article>
<?endforeach;?>
</div>

