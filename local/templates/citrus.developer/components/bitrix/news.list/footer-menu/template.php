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
<a href="<?=$arParams['LIST_PAGE_URL']?>" class="footer__column-title"><?=$arParams['LIST_NAME']?></a>

<?if(!empty($arResult["ITEMS"])):?>
    <menu class="footer-projects">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			/*$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));*/
			?>
            <li class="footer-projects__li" >
                - <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="footer-projects__link">
		            <?=$arItem["NAME"]?>
	            </a>
            </li>
		<?endforeach;?>
    </menu>

	<?if($arParams['JK_TEMPLATE'] !== 'Y'):?>
		<a href="<?=$arParams['LIST_PAGE_URL']?>" class="footer-more-projects"><?=Loc::getMessage("CITRUS_FOOTER_MORE_COMPLEX")?></a>
	<?endif;?>
<?endif;?>
