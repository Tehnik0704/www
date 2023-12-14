<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<?if (!empty($arResult)):
    $selectedItem = array();
    ?>

<nav class="projects-menu">
    <?
    $previousLevel = 0;
    foreach($arResult as $arItem):?>
        <?  $linkClass = array('projects-menu__item');
            if ($arItem["SELECTED"]) {
	            $selectedItem = $arItem;
                $linkClass[] = '_selected';
            } ?>

        <?if($arItem['PARAMS']['SPECIAL'] == "Y"):?>
            <a href="<?=$arItem['LINK']?>" class="<?=implode(' ', $linkClass)?> _spec">
                <span class="projects-menu__item-inner">
                    <span class="projects-menu__item-icon icon-benefit-4"></span>
                    <span class="projects-menu__item-text display-sm-n display-lg-i"><?=$arItem['TEXT']?></span>
                </span>
            </a>
        <?else:?>
            <a href="<?=$arItem['LINK']?>" class="<?=implode(' ', $linkClass)?>">
                <span class="projects-menu__item-inner"><?=$arItem['TEXT']?></span>
            </a>
        <?endif;?>
    <?endforeach?>
</nav>

<a href="javascript:void(0);" class="projects-menu-link">
    <?=$selectedItem['TEXT']?>
</a>

<script>
    ;(function(){
	    $('.projects-menu-link').on('click', function(event) {
		    event.preventDefault();
		    $(this).toggleClass('_active')
			    .prev('.projects-menu').toggleClass('_active');
	    });
    }());
</script>
<?endif?>

