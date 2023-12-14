<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

?>

<?if (!empty($arResult)):?>

<menu class="footer-menu">
<?
$previousLevel = 0;
foreach($arResult as $arItem):?>
    <?
        $liClass = array('footer-menu__li');
        if ($arItem["SELECTED"]) $liClass[] = '_selected';
    ?>
    <li class="<?=implode(' ', $liClass)?>">
        <a href="<?=$arItem["LINK"]?>" class="footer-menu__link">
            <?=$arItem["TEXT"]?>
        </a>
    </li>
<?endforeach?>

</menu>
<?endif?>