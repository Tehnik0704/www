
/**
 * helpers
 */
;(function () {
	//swiper helper function
	{
		// swiper param pagination: { renderBullet: swiperRenderBullets }
		window.swiperRenderBullets = function (index, className) {
			var maxWidth = (100/this.slides.length).toFixed(6),
				style = 'max-width: calc( '+maxWidth+'% - 8px );';
			return '<span style="'+ style +'" class="' + className + '"></span>';
		};

		window.resizeSliderContainer = function () {
			if (!this.slidesSizesGrid.length) return;

			var sum = 0;
			for (var i = 0; i < this.slidesSizesGrid.length; i++) {
				sum += this.slidesSizesGrid[i];
			}
			sum += +this.params.spaceBetween * (this.slidesSizesGrid.length - 1);

			this.$wrapperEl.css('width', sum+'px');
		};
	}

	window.smoothScroll = function ($target, params) {
		$target = typeof $target === 'string' ? $($target) : $target;
		var params = $.extend({
			offsetTop: 0,
			duration: 400,
		}, params);
		if($target.length) $("html, body").animate({ scrollTop: $target.offset().top - params.offsetTop }, params.duration );
	};

	window.clickOff = function ( $el, callback ) {
		if( !$el ) return false;
		$(document).on('click', function (e) {
			if ($el.has(e.target).length === 0 && !$el.is(e.target)){
				callback($el);
			}
		});
	};
}());

$(function(){
	$(document)
		.on('click', '[data-dismiss="modal"]', function(e) {
			e.preventDefault();
			$.magnificPopup.close();
		});
});

(function() {
	var throttle = function(type, name, obj) {
		obj = obj || window;
		var running = false;
		var func = function() {
			if (running) { return; }
			running = true;
			requestAnimationFrame(function() {
				obj.dispatchEvent(new CustomEvent(name));
				running = false;
			});
		};
		obj.addEventListener(type, func);
	};

	/* init - you can init any event */
	throttle("resize", "optimizedResize");
})();
// handle event


$(function(){
	'use strict';

	// header and menu
	{
		var $menuWrapper = $('.main-menu-w'),
			$overlay = $('.content-overlay');

		$('.js-toggle-menu').on('click', function(event) {
			event.preventDefault();
			$menuWrapper.addClass('_active');
			$overlay.addClass('_active');
			$('body').addClass('_overflow');
		});
		$overlay.on('click', function(event) {
			event.preventDefault();
			$menuWrapper.removeClass('_active');
			$overlay.removeClass('_active');
			$('body').removeClass('_overflow');
		});


		var checkFixedHeader = function () {
			var scrollTop = $(window).scrollTop();
			var $hFixed = $('.js-header-fixed'),
				$fixedMenu = $('.jk-menu-fixed');

			if($hFixed.length) {
				var hTop = $('header.h').offset().top;
				$hFixed[ scrollTop > hTop ? 'addClass':'removeClass']('_fixed');
				$hFixed[ scrollTop > (hTop + 400) ? 'addClass':'removeClass']('_min');
			}
			if($fixedMenu.length) {
				var menuTop = $fixedMenu.offset().top;
				$fixedMenu[ scrollTop > menuTop ? 'addClass':'removeClass']('_fixed');
			}
		};
		checkFixedHeader();

		$(document).on('scroll', checkFixedHeader);
		window.addEventListener("optimizedResize", checkFixedHeader);
	}
});
