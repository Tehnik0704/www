<?php
CJSCore::Init(['vue', 'swiper', 'favorites', 'equalHeight', 'preloader']);

$asset = \Bitrix\Main\Page\Asset::getInstance();
$asset->addJs($templateFolder . '/vueComponent.js');
$asset->addJs($templateFolder . '/js/lodash.js');

if (Bitrix\Main\Config\Configuration::getValue('citrus_dev') === 'mortgage')
{
	\Bitrix\Main\Page\Asset::getInstance()->addJs('http://localhost:8082/dist/build.js', true);
}
