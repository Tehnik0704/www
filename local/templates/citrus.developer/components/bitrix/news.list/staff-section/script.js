
$(function(){
	$('.staff-item').hover(
		function () {
			$( this )
				.addClass('_hover')
				.find('.properties').stop( true, true ).slideDown(200);
		},
		function () {
			if (window.innerWidth > 480)
				$( this )
					.removeClass('_hover')
					.find('.properties').stop( true, true ).slideUp(200);
		}
	);
});