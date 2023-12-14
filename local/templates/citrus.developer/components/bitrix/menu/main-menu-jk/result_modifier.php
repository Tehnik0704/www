<?php

use Citrus\Developer\Components\ResidentalComplex\Component as JkComplexComponent;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams Parametri, chtenie, izmenenie. Ne zatragivaet odnoimenniy chlen komponenta, no izmeneniya tut vliyayut na $arParams v fayle template.php. */
/** @var array $arResult Rezulytat, chtenie/izmenenie. Zatragivaet odnoimenniy chlen klassa komponenta. */
/** @var CBitrixComponentTemplate $this Tekushtiy shablon (obaekt, opisivayushtiy shablon) */
/** @var CBitrixMenuComponent $component */

if (class_exists(JkComplexComponent::class))
{
	/** @var Citrus\Developer\Components\ResidentalComplex\Component $complex */
	$complex = JkComplexComponent::getInstance();
	$router = $complex->getRouter();
	foreach ($arResult as $key => &$item)
	{
		/**
		 * Ssilka na stranitsu kompleksnogo komponenta v menyu nachinaetsya s @, nuzhno zamenity na URL
		 */
		if (preg_match('!@(.*)!', $item['LINK'], $matches))
		{
			/**
			 * Nekotorie stranitsi mogut bity ne u vseh ZhK (reguliruetsya nastroykoy i dop. logikoy kompleksnogo komponenta),
			 * Proverim esty li stranitsa, skroem esli eio net u dannogo ZhK
			 */
			$vars = [];
			if (!$complex->resolveRouteData($matches[1], $vars))
			{
				/**
				 * Shablon menyu i result_modifier.php ne keshiruetsya, mozhno budet ne ochishtaty kesh pri izmeneniyah v BD
				 */
				unset($arResult[$key]);
				continue;
			}

			try
			{
				$item['LINK'] = $router->getUrl($matches[1]);
			}
			catch (\Bitrix\Main\ArgumentException $e)
			{
				trigger_error(sprintf(
					'Link to unknown complex component page (%s) specified for menu type `%s` (%s)',
					$matches[0],
					$this->getComponent()->arParams['ROOT_MENU_TYPE'],
					$this->getComponent()->arParams['CHILD_MENU_TYPE']
				));
				unset($arResult[$key]);
				continue;
			}
			$item['PARAMS']['page'] = $matches[1];
		}
	}

	$component = $this->getComponent();
	$component->setSelectedItems($arParams['ALLOW_MULTI_SELECT'] == 'Y');
}
