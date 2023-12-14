<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// 
use Bitrix\Main\Localization\Loc;
use Citrus\Core\SolutionFactory;
use Citrus\Developer\Template\HeaderContent;

/**
 * $APPLICATION->ShowTitle() replacement
 */
HeaderContent::workarea();

$subTemplatePath = __DIR__."/".($APPLICATION->GetProperty('JK_TEMPLATE', '0') == 1 ? 'jk-template' : 'main-template')."/";
require $subTemplatePath . "header.php";

$SettingsTable = SolutionFactory::get()->settings();

?>

    <footer class="f print-hidden">
        <div class="w">

	        <?require $subTemplatePath."/footer.php"; ?>

            <div class="footer__bot">
                <div class="footer__copy">
                    &copy; <?=date('Y');?> <?=$SettingsTable::getValue('SITE_NAME')?>,<br>
                    <a href="<?=SITE_DIR?>agreement/"><?= Loc::getMessage("FOOTER_POLICY") ?></a>
                </div>
                <div class="footer__developer ta-xs-c ta-md-r">
	                
                    <div id="bx-composite-banner"></div>
                </div>
            </div>
        </div><!-- .w -->
    </footer>
                    <!-- Yandex.Metrika counter -->
                <script type="text/javascript" >
                    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
                        m[i].l=1*new Date();
                        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
                        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
                    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

                    ym(44432851, "init", {
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true
                    });
                </script>
                <noscript><div><img src="https://mc.yandex.ru/watch/44432851" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
                <!-- /Yandex.Metrika counter -->
</body>
</html>
