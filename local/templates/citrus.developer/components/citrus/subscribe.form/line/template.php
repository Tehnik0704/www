<?php

/** @var CBitrixComponent $component Tekushtiy vizvanniy komponent */
/** @var CBitrixComponentTemplate $this Tekushtiy shablon (obaekt, opisivayushtiy shablon) */
/** @var array $arResult Massiv rezulytatov raboti komponenta */
/** @var array $arParams Massiv vhodyashtih parametrov komponenta, mozhet ispolyzovatysya dlya ucheta zadannih parametrov pri vivode shablona (naprimer, otobrazhenii detalynih izobrazheniy ili ssilok). */
/** @var string $templateFile Puty k shablonu otnositelyno kornya sayta, naprimer /bitrix/components/bitrix/iblock.list/templates/.default/template.php) */
/** @var string $templateName Imya shablona komponenta (naprimer: .default) */
/** @var string $templateFolder Puty k papke s shablonom ot DOCUMENT_ROOT (naprimer /bitrix/components/bitrix/iblock.list/templates/.default) */
/** @var array $templateData Massiv dlya zapisi, obratite vnimanie, takim obrazom mozhno peredaty dannie iz template.php v fayl component_epilog.php, prichem eti dannie popadayut v kesh, t.k. fayl component_epilog.php ispolnyaetsya na kazhdom hite */
/** @var string $parentTemplateFolder Papka roditelyskogo shablona. Dlya podklyucheniya dopolnitelynih izobrazheniy ili skriptov (resursov) udobno ispolyzovaty etu peremennuyu. Ee nuzhno vstavlyaty dlya formirovaniya polnogo puti otnositelyno papki shablona */
/** @var string $componentPath Puty k papke s komponentom ot DOCUMENT_ROOT (napr. /bitrix/components/bitrix/iblock.list) */

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;

if (method_exists($this, 'setFrameMode')) {
	$this->setFrameMode(true);
}

if ($arResult['ACTION']['status']=='error') {
	ShowError($arResult['ACTION']['message']);
} elseif ($arResult['ACTION']['status']=='ok') {
	ShowNote($arResult['ACTION']['message']);
}
?>

<section class="section section-color-site">
    <div class="w">
        <div class="subscribe">
            <div class="subscribe__text">
                <div class="subscribe__text-1 font-2"><?= Loc::getMessage("CITRUS_SUBSCRIBE_TITLE1") ?></div>
                <div class="subscribe__text-2"><?= Loc::getMessage("CITRUS_SUBSCRIBE_TITLE2") ?></div>
            </div>

            <form action="<?= POST_FORM_ACTION_URI?>" method="post" id="citrus_subscribe_form" class="subscribe-form">
                <?= bitrix_sessid_post()?>
                <input type="hidden" name="citrus_subscribe" value="Y" />
                <input type="hidden" name="charset" value="<?= SITE_CHARSET?>" />
                <input type="hidden" name="site_id" value="<?= SITE_ID?>" />
                <input type="hidden" name="citrus_format" value="<?= $arParams['FORMAT']?>" />
                <input type="hidden" name="citrus_not_confirm" value="<?= $arParams['NO_CONFIRMATION']?>" />
                <input type="hidden" name="citrus_key" value="<?= md5($arParams['JS_KEY'].$arParams['NO_CONFIRMATION'])?>" />
                <input type="hidden" name="fz152" value="Y">
                <? if ($arParams['HIDDEN_ANTI_SPAM'] !== "N"): ?>
					<input type="hidden" name="GIFT" value="Y">
				<? endif; ?>

                <div class="input-container">

                    <div class="subscribe-row">
                        <input data-valid="required email" class="subscribe-input" type="text" name="citrus_email" value="" placeholder="<?=GetMessage("CITRUS_SUBSCRIBE_PLACEHOLDER")?>" />
                        <button class="btn btn-white" type="submit" name="citrus_submit" id="citrus_subscribe_submit" value="<?=GetMessage("CITRUS_SUBSCRIBE_BUTTON")?>" data-noLoad="true"><span class="display-sm-n icon-mail"></span><span class="display-xs-n display-sm-i"><?= Loc::getMessage("CITRUS_SUBSCRIBE_BTN") ?></span></button>
                    </div>

                    <div class="error help-block"></div>
                </div>
            </form>

            <div id="citrus_subscribe_res" class="subscribe-message" style="display: none;"></div>
        </div><!-- .subscribe -->
    </div>

    <div class="subscribe-footer">
        <div class="w"><?= Loc::getMessage("CITRUS_SUBSCRIBE_FZ152_NOTICE") ?>
            <a href="<?=SITE_DIR?>agreement/" target="_blank"><?= Loc::getMessage("CITRUS_SUBSCRIBE_FZ152_LINK") ?></a></div>
    </div>
</section>
