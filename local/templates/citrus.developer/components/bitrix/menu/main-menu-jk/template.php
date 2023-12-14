<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

if (!empty($arResult)):
	
	$arFavorite = array();
	foreach ($arResult as $arItem){
		if ($arItem['PARAMS']['page'] == 'favorites') {
			$arFavorite = $arItem;
		}
	}?>
    <div class="jk-menu-w">
        <div class="w">
            <nav class="jk-menu">
	            <?if($arFavorite):?>
		            <a href="<?=$arItem["LINK"]?>" class="mobile-favorite-link <?=$arItem["SELECTED"] ? '_selected' : ''?>">
			        <span class="mobile-favorite-link__icon">
                        <i class="icon-heart"></i>
                        <span class="mobile-favorite-link__favorites-count js-favorites-count">0</span>
                    </span>
			            <div class="mobile-favorite-link__text"><?=$arItem["TEXT"]?></div>
		            </a>
	            <?endif;?>
				<?php
				foreach ($arResult as $arItem):

					$liClass = array('jk-menu__link', $arItem["SELECTED"] ? '_selected' : '');

                    if ($arItem['PARAMS']['page'] == 'favorites')
                    {
                        $liClass[] = '_favorite';
                        $linkContents = '
                            <span class="jk-menu__favorites-icon">
                                <i class="icon-heart"></i>
                                <span class="jk-menu__favorites-count js-favorites-count">0</span>
                            </span>';
                    }
                    else
                    {
                        $linkContents = $arItem["TEXT"];
                    }

					?><a class="<?=trim(implode(' ', $liClass))?>" href="<?=$arItem["LINK"]?>">
						<?=$linkContents?><span class="jk-menu__icon icon-arrow_right"></span>
					</a><?

                endforeach;
                ?>
	
	            <a href="<?=SITE_DIR?>" class="jk-menu__developer-link">
		            <?if($arCompanyName = \Citrus\Developer\Template\HeaderContent::getSplitCompanyName()):?>
			            <span class="jk-menu__developer-link-text">
                            <span class="jk-menu__developer-link-text-1">На сайт Алтай-Строй</span>
                        </span>
		            <?endif;?>
	            </a>
		           
            </nav>
        </div>
    </div>
	<script>;(function(){
		favorites.updateCount();
	}());</script>
    <?
endif;