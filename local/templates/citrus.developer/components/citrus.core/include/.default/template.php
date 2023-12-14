<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

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
/** @var \Citrus\Core\IncludeComponent $component */

$this->setFrameMode(true);

if (($arResult["FILE"] === '' && $arParams['VIEW_CONTENT_ID'] === '') || !$arResult['HAS_CONTENT'])
	return;

	$wrapperAdditionalParameters = '';
	if ($arParams['WIDGET_REL'] && $arResult['CAN_EDIT']) {
	  $wrapperAdditionalParameters = 'data-settings="BLOCKS" data-settings-rel="'.$arParams['WIDGET_REL'].'"';
	  if (!$arResult['ACTIVE']) $wrapperAdditionalParameters .= ' style="display:none;" ';
	}
	if (!empty($arParams["HTML_ATTR_ID"]))
	{
		$wrapperAdditionalParameters = ' id="' . $arParams["HTML_ATTR_ID"] . '"';
	}

	?>
  <? if ($arParams['PAGE_SECTION'] == "Y"):?>
      <?
      $params['h'] = $arParams['h'] ? trim($arParams['h']) : '.h1';
      if(strpos($params['h'], '.') === 0) {
        $params['h'] = str_replace('.','',$params['h']);
        $h = array("<div class='{$params['h']}'>", "</div>");
      } else {
        $h = array("<{$params['h']}>", "</{$params['h']}>");
      }

      $sectionClass = array('section');
      if ($arParams['PADDING'] !== 'N') $sectionClass[] = '_with-padding';
	$arParams['BG_COLOR'] = $arParams['BG_COLOR'] ? $arParams['BG_COLOR'] : 'n';
      $sectionClass[] = 'section-color-'.strtolower($arParams['BG_COLOR']);
      if ($arParams['CLASS']) $sectionClass[] = $arParams['CLASS'];
      ?>
      <section class="<?=implode(' ',$sectionClass)?>" <?=$wrapperAdditionalParameters?>>
          <div class="w">
              <div class="section-inner">
	              <?if(!empty($arParams['HEADER']) && $arParams['HEADER'] == 'N'):?>
		              <?if($arParams['TITLE']):?>
			              <?=$h[0]?><?=$arParams['~TITLE']?><?=$h[1]?>
		              <?endif;?>

		              <?if($arParams['DESCRIPTION']):?>
			              <div class="section-description"><?=$arParams['~DESCRIPTION']?></div>
		              <?endif;?>

		              <?if($arParams['BIG_DESCRIPTION']):?>
			              <div class="section-big-description"><?=$arParams['~BIG_DESCRIPTION']?></div>
		              <?endif;?>
                  <?elseif($arParams['TITLE'] || $arParams['DESCRIPTION']):?>
                      <header class="section__header <?= $arParams['SECTION_HEADER_CLASS'] ?>">
                          <?if($arParams['TITLE']):?>
                              <?=$h[0]?><?=$arParams['~TITLE']?><?=$h[1]?>
                          <?endif;?>

                          <?if($arParams['DESCRIPTION']):?>
                              <div class="section-description"><?=$arParams['~DESCRIPTION']?></div>
                          <?endif;?>

	                      <?if($arParams['BIG_DESCRIPTION']):?>
	                          <div class="section-big-description"><?=$arParams['~BIG_DESCRIPTION']?></div>
	                      <?endif;?>

	                      <?if($arParams['LEGEND']):?>
		                      <div class="section-legend"><?=$arParams['~LEGEND']?></div>
	                      <?endif;?>
                      </header>
                  <?endif;?>
                  <?=$component->showContent()?>
              </div><!-- .section-inner -->
          </div><!-- .w -->
      </section>
  <?else:?>
	  <?if($wrapperAdditionalParameters):?>
		  <div <?=$wrapperAdditionalParameters?>>
	  <?endif;?>
		  <?=$component->showContent()?>
	  <?if($wrapperAdditionalParameters):?>
	      </div>
	  <?endif;?>
  <?endif;?>

