$(function(){
	//ios safari fix
	$('.mobile-menu .main-menu__link').on('touchend', function(event) {
		$(this).addClass('_hover');
	});
	$(document).on('touchstart', function(event) {
		$('.main-menu__link._hover').removeClass('_hover');
	});
});