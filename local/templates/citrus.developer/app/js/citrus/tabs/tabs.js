
$(function(){
	"use strict";
	$('.tabs').each(function(index, item) {
		var $tabsContainer = $(this);
		
		$tabsContainer.find('.tabs__link').on('click', function () {
			var $link = $(this);
			if($link.hasClass('_active')) return;
			
			$link.addClass('_active')
				.siblings().removeClass('_active');
			$tabsContainer.find('.tabs__content-it').eq($link.index()).addClass('_active')
				.siblings().removeClass('_active');
		});
	});
});