<?
// 
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$link_1 = SITE_DIR . 'zhilye-kompleksy/';
$link_1_title = 'наши проекты';
if ($APPLICATION->GetPageProperty('JK_TEMPLATE', 0)) {
    $link_1 = \Citrus\Developer\RouterFactory::residentalComplex()->getUrl('about');
	$link_1_title = 'наши дома';
}

$APPLICATION->SetPageProperty("SHOW_TITLE", 'N');
$APPLICATION->SetTitle("404 Not Found");?>

<section class="section _with-padding section-color-n">
	<div class="w">
		<div class="section-inner">
		<? $APPLICATION->IncludeComponent(
			"citrus.developer:template",
			"page-404",
			array(
				'LINK_1' => $link_1,
				'LINK_1_TITLE' => $link_1_title,
			),
			$component,
			array("HIDE_ICONS" => "Y")
		);?>
		</div>
	</div>
</section>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
