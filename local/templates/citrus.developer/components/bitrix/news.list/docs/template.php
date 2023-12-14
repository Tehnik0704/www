<?php

use Bitrix\Main\Localization\Loc;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

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

$tmpSection = end($arResult['SECTION']['PATH']);

$mainButtonsAreaId = "photo_progerss_list_" . $tmpSection['ID'];
$mainButtons = CIBlock::GetPanelButtons(
	$tmpSection['IBLOCK_ID'],
	0,
	$tmpSection['ID'],
	array("SECTION_BUTTONS" => false, "SESSID" => false)
);
$this->AddEditAction(
	$mainButtonsAreaId,
	$mainButtons["edit"]["add_element"]["ACTION_URL"],
	$mainButtons["edit"]["add_element"]["TITLE"]
);
?>

<?if($APPLICATION->GetShowIncludeAreas() || !empty($arResult["ITEMS"])):?>
    <div class="docs" id="<?= $this->GetEditAreaID($mainButtonsAreaId) ?>">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
        <div class="doc-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="row row-grid">
                <div class="col-lg-4">
                    <div class="doc-item__name h3">
		                <?=$arItem['NAME']?>
                    </div>
                </div><!-- .col -->
                <div class="col-lg-8">
                    <div class="row row-grid">
                        <?foreach ( $arItem['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE'] as $arFile):?>
                            <div class="col-sm-6">
                                 <?$APPLICATION->IncludeComponent(
                                   "citrus.developer:template",
                                   "docs",
                                   array('DATA'=> $arFile),
                                   $component,
                                   array("HIDE_ICONS" => "Y")
                                 );?>
                            </div><!-- col -->
                        <?endforeach;?>
                    </div><!-- .row -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .doc-item -->
	<?endforeach;?>
    </div><!-- .docs -->
<?endif;?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>


<?php if (!empty($arParams['ALL_DOCS_PAGE_URL'])) { ?>
	<footer class="section-footer">
		<a href="<?= $arParams['LOG_PAGE_URL'] ?>" class="btn btn-more btn-stretch"><?= Loc::getMessage('CITRUS_DEVELOPER_DOCSLOG_BTN_TITLE')?></a>
		<a href="<?= $arParams['ALL_DOCS_PAGE_URL'] ?>"
		   class="btn btn-more btn-stretch">
			<?= $arParams['ALL_DOCS_PAGE_URL_TITLE'] ?>
		</a>
	</footer>
<?php } else { ?>
	<center>
		<br>
		<a href="<?= $arParams['LOG_PAGE_URL'] ?>" class="btn btn-more" style="width:auto;"><?= Loc::getMessage('CITRUS_DEVELOPER_DOCSLOG_BTN_TITLE')?></a>
	</center>
<?php } ?>
