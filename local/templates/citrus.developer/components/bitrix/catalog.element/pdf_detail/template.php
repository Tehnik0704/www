<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

use	Bitrix\Main\Localization\Loc;
use Citrus\Developer\Iblock;
use Citrus\Developer\Template\HeaderContent;
use Citrus\Developer\Template\Property;
use Citrus\Developer\Theme;
use Citrus\Core\SolutionFactory;

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

$showCostM2 = Iblock\OrmPropertyFormatter::showCostM2(!empty($arParams['USING_PRICE_MODE'])?
	$arParams['USING_PRICE_MODE'] : 'FLAT_PRICE_MODE');

// nook add image title from SEO module
$addImage = function($id, $title='', $alt='') use (&$images, $arResult, $arParams)
{
	$pic = CFile::GetFileArray($id);
	if ($pic)
	{
		$preview = CFile::ResizeImageGet($id, Array('width' => 320, 'height' => 290), BX_RESIZE_IMAGE_PROPORTIONAL, $bInitSizes = true);
		$preview["src"] = $arParams['debug'] ? $preview["src"] : $_SERVER["DOCUMENT_ROOT"] . $preview["src"]; // FIX dompdf needs full path
		$previewMin = CFile::ResizeImageGet($id, Array('width' => 103, 'height' => 85), BX_RESIZE_IMAGE_EXACT, $bInitSizes = true);
		$previewMin['src'] = $arParams['debug'] ? $previewMin["src"] : $_SERVER["DOCUMENT_ROOT"] . $previewMin["src"]; // FIX dompdf needs full path
		$images[] = array(
			'id' => 'img' . $id,
			'src' => $arParams['debug'] ? $pic["SRC"] : $_SERVER["DOCUMENT_ROOT"] . $pic["SRC"], // FIX dompdf needs full path
			'width' => $pic['WIDTH'],
			'height' => $pic['HEIGHT'],
			'preview' => $preview,
			'previewMin' => $previewMin,
			'alt' => ($alt <> '') ? $alt : $arResult['NAME'],
			'title' => ($title <> '') ? $title : $arResult['NAME'],
		);
	}
};

$images = array();
if (is_array($arResult["DETAIL_PICTURE"]))
	$addImage($arResult["DETAIL_PICTURE"]["ID"], $arResult["DETAIL_PICTURE"]["TITLE"], $arResult["DETAIL_PICTURE"]["ALT"]);
elseif (is_array($arResult["PREVIEW_PICTURE"]))
	$addImage($arResult["PREVIEW_PICTURE"]["ID"], $arResult["PREVIEW_PICTURE"]["TITLE"], $arResult["PREVIEW_PICTURE"]["ALT"]);
if (is_array($arResult["PROPERTIES"]["photo"]['VALUE']))
	foreach ($arResult["PROPERTIES"]["photo"]['VALUE'] as $key => $id)
	{
		$addImage($id, $arResult["PROPERTIES"]["photo"]['DESCRIPTION'][$key]);
	}

$detailText = (trim(strip_tags($arResult["DETAIL_TEXT"])) <> '') ? $arResult["DETAIL_TEXT"] : ((trim(strip_tags($arResult["PREVIEW_TEXT"])) <> '') ? $arResult["PREVIEW_TEXT"] : false);

$theme = new Theme(SITE_ID, null, null, 'main-template');

$logo = HeaderContent::getLogoImage();
$logo = $arParams['debug'] ? $logo : $_SERVER["DOCUMENT_ROOT"].$logo;

$SettingsTable = SolutionFactory::get(SITE_ID)->settings();
?>
<?$manager = $arResult['CONTACT'];
$contactProperty = new Property($manager);
$contactPrintPropertyKeys = array_diff(
	array_keys($manager['PROPERTIES']),
	['DEPARTMENT', 'POSITION']
);
?>

<style>
	<?if ($arParams['debug']) :?>
	@font-face {
		font-family: "DejaVuSans";
		src: url("<?=$templateFolder?>/fonts/DejaVuSans.ttf");
	}
	body {
		font-family: "DejaVuSans", Helvetica, sans-serif;
		width: 716px;
		margin: auto;
		padding: 10px;
		line-height: 1.6;
	}
	.contact-footer {
		bottom: 0 !important;
		left: 0;
		right: 0;
		margin-left: auto;
		margin-right: auto;
		width: 716px !important;
	}
	<?endif;?>
	<?= Bitrix\Main\IO\File::getFileContents(__DIR__.'/style.css')?>
</style>

<?# footer pered kontentom https://github.com/dompdf/dompdf/issues/1190 ?>
<div class="contact-footer">
	<div class="contact-content">
		<div class="contact-content__photo contact-content__td">
			<img src="<?=$manager['PREVIEW_PICTURE']['src']?>"
			     width="<?=$manager['PREVIEW_PICTURE']['width']?>"
			     height="<?=$manager['PREVIEW_PICTURE']['height']?>"
			     alt="">
		</div>
		<div class="contact-content__name-block contact-content__td">
			<div class="contact-content__name">
				<?=$manager['NAME']?>
			</div>
			<div class="contact-content__position">
				<?=$contactProperty->getValue('POSITION')?>
			</div>
		</div>
		<?if($contactProperty->hasValue($contactPrintPropertyKeys)):?>
		<div class="contact-content__properties contact-content__td">
			<?foreach ( $contactPrintPropertyKeys as $propertyCode):?>
			<div class="contact-property__it">
				<? $i = 0;
				$arPrintValues = [];
				foreach ($contactProperty->getArValues($propertyCode) as $key => $value):
					$printValue = '
							<span class="contact-property__value-it__value">'.
								$contactProperty->formatValue($propertyCode, $value).
							'</span>';

					if($description = $contactProperty->getDescription($propertyCode,$key)) {
						$printValue .= '<span class="contact-property__value-it__description">('.$description.')</span>';
					}
					$arPrintValues[] = $printValue;
					?>
				<?endforeach;?>
				<?=implode(', ', $arPrintValues)?>
			</div>
			<?endforeach;?>
		</div>
		<?endif;?>
	</div>
</div>

<div class="object">
	<table class="object-top">
		<tr>
			<td class="col-t left">
                <div class="header-logo">
					<span class="logo-image">
						<?php if ($logo) { ?>
							<img src="<?=$logo ?>" alt="" style="max-width:<?=$SettingsTable::getValue('LOGO_SHOW_TEXT') === 'Y' ? '70px' : '240px'?>">
						<?php } ?>
					</span>
	                <?if($SettingsTable::getValue('LOGO_SHOW_TEXT') === 'Y' && $arCompanyName = HeaderContent::getSplitCompanyName()):?>
		                <span class="logo__text">
							<span class="logo__text-1"><?=$arCompanyName[0]?></span>
	                        <span class="logo__text-2"><?=$arCompanyName[1]?></span>

			                <?if($SettingsTable::getValue('DESCRIPTION')):?>
				                <span class="logo__description"><?=TruncateText($SettingsTable::getValue('DESCRIPTION'), 30)?></span>
			                <?endif;?>
	                    </span>
	                <?endif;?>
                </div>
			</td>
			<td class="col-t right">
				<div class="header-phone-number"><?= $arResult['OFFICE']['PROPERTIES']['PHONE']['VALUE'][0] ?></div>
				<div style="color:#<?=$theme->getColor()?>;" class="header-email"><?= $arResult['OFFICE']['PROPERTIES']['EMAIL']['VALUE'][0] ?></div>
			</td>
		</tr>
	</table>
	<div class="jk-line" style="background-color: #<?=$theme->getColor()?>;">
		<div class="jk-line__left"><div class="jk-line__title"><?=Loc::getMessage("PDF_DETAIL_JK")?> "<?=TruncateText($arResult['JK']['NAME'], 18)?>"</div></div>
		<div class="jk-line__right"><a class="jk-line__link" href="<?=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}"?>"><?=$_SERVER['HTTP_HOST']?></a></div>
	</div>

	<div class="wrapper">
		<table class="object-content">
	        <tr>
	            <td colspan="2">
	                <h1 class="content-title"><?= $arResult["NAME"] ?></h1>
		            <div class="section-description"><?=$arResult['HOUSE']['ADDRESS']?></div>
	            </td>
	        </tr>
	        <tr class="row-wrapper">
	            <td class="col-t col-galery">
	                <div class="object-gallery">
		                <?$firstImage = array_shift($images) ;?>
	                    <img src="<?= $firstImage["preview"]["src"] ?>">
					</div>
					<div class="object-gallery-previews">
						<?php foreach (array_slice($images, 0, 3) as $image)
						{
							?>
								<div class="object-gallery-preview">
									<img src="<?= $image["previewMin"]["src"] ?>">
								</div>
							<?php
						}
						?>
	                </div>
	            </td>
	            <td class="col-t">
					<div class="catalog-detail__right">
						<div class="h4 catalog-detail__properties-title"><?= Loc::getMessage("PROPERTIES_TITLE_".$arParams['IBLOCK_CODE']) ?></div>

						<div class="catalog-detail__properties">
							<?if($arResult['IS_LAYOUT']):?>
							    <?foreach ($arParams['PROPERTY_CODE'] as $code):
									$property = $arResult['DISPLAY_PROPERTIES'][$code];
									if (!is_array($property) || !$property['VALUE'])
									{
										continue;
									}
									?>
									<div class="catalog-detail__property">
										<div class="catalog-detail__property-name"><?=$property['NAME']?></div>
										<div class="catalog-detail__property-value">
											<div class="catalog-detail__property-value__inner"><?=$property['DISPLAY_VALUE']?></div>
										</div>
									</div>
								<?endforeach;?>
							<?else:?>
								<?
								$property = new Property($arResult);
								$printPropertyKeys = array_diff($arParams['PROPERTY_CODE'], Iblock\PropertyFormatter::$excludeProperties);

								$planProperty = new Property($arResult['PLAN']);
								foreach ($printPropertyKeys as $propertyKey):
									?>
									<?if($planProperty->hasValue($propertyKey) || $property->hasValue($propertyKey)):?>
										<div class="catalog-detail__property" data-code="<?=$propertyKey?>">
											<div class="catalog-detail__property-name"><?= $property->getName($propertyKey) ?: $planProperty->getName($propertyKey) ?></div>
											<div class="catalog-detail__property-value">
												<div class="catalog-detail__property-value__inner">
													<?=$property->hasValue($propertyKey) ?
														$property->getFormatValue($propertyKey) :
														$planProperty->getFormatValue($propertyKey);
													?></div>
											</div>
										</div>
									<?endif;?>
								<?endforeach;?>
							<?endif;?>

						</div><!-- .catalog-detail__properties -->

						<?if(!$arResult['IS_LAYOUT'] && !is_array($arParams['ADDITIONAL'])):?>
							<?php
							if ($showCostM2)
							{
								$price = $property->getValue('cost_m2') ?: $planProperty->getValue('cost_m2');
							}
							else
							{
								$price = $property->getValue('cost') ?: $planProperty->getValue('cost');
							}
							?>
							<?if($price):?>
								<div class="catalog-detail__price">
									<span class="price-value"><?=$property->formatPrice($price)?></span>
									<span class="price-currency"><?=$property->getHint('cost')?></span><?= $showCostM2 ?>
								</div>
							<?endif;?>
						<?endif;?>
					</div>
	            </td>
	        </tr>

	    </table>

		<?if($detailText):?>
			<div class="detail-text">
				<h2><?= Loc::getMessage("PDF_DETAIL_TEXT_TITLE") ?></h2>
				<div class="object-text"><?= $detailText ?></div>
			</div>
		<?endif;?>

		<?if(!empty($arParams['ADDITIONAL']) && is_array($arParams['ADDITIONAL'])):?>
			<div class="mortgage">
				<div class="mortgage-title"><?= Loc::getMessage("PDF_MORTGAGE_TITLE") ?></div>

				<div class="mortgage-content">
					<div class="mortgage-table">

						<?foreach ( $arParams['ADDITIONAL'] as $mortgage):?>
							<div class="mortgage-row">
								<div class="mortgage-name"><?=$mortgage['name']?>: </div>
								<div class="mortgage-value"><?=$mortgage['value']?></div>
							</div>
						<?endforeach;?>
					</div>
				</div><!-- .mortgage-content -->
			</div>
		<?endif;?>
	</div>
</div>
