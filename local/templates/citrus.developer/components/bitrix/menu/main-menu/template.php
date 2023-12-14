<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

?>

<?if (!empty($arResult)):?>

<menu class="main-menu">
<?
$previousLevel = 0;
foreach($arResult as $arItem):?>
    <?
        $liClass = array('main-menu__li');
        if ($arItem["SELECTED"]) $liClass[] = '_selected';
    ?>
    <li class="<?=implode(' ', $liClass)?>">
        <?#onclick - safari fix for hover?>
        <a onclick="" href="<?=$arItem["LINK"]?>" class="main-menu__link">
            <span onclick=""><?=$arItem["TEXT"]?></span> <span class="main-menu__icon icon-arrow_right"></span>
        </a>
    </li>
<?endforeach?>

</menu>
<?endif?>