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

?>

<?if($arResult['PROPERTIES']['DOCS']['VALUE']):?>

		<ul class="checked-list">
			<?foreach ( $arResult['PROPERTIES']['DOCS']['VALUE'] as $key => $doc):?>
				<li><b><?=$doc?></b>
					<?=$arResult['PROPERTIES']['DOCS']['DESCRIPTION'][$key]?>
				</li>
			<?endforeach;?>
		</ul>

<?endif;?>
