
$(function(){
  BX.addCustomEvent('photo-filter-template-update', function (params) {
    if (params.isAdminPanel == 'Y') {
      var url = params.currentUrl
        + '?house=' + params.house
        + '&quarter=' + params.quarter
        + '&year=' + params.year;
      location.href = url;
      return;
    }
    delete params.isAdminPanel;
    delete params.currentUrl;

		var containerId = 'ajax-photo-container',
			$container = $('#'+containerId);
		
		BX.showWait($container.get(0));
		params['get_ajax_photo'] = 'Y';
		$.ajax({
			url: '',
			type: 'POST',
			dataType: 'html',
			data: params,
		})
		.done(function(data) {
			BX.closeWait($container.get(0));
			$container.html($(data).filter('#ajax-photo-container').html());
		})
		.fail(function() {
			console.log("ajax error");
		})
		.always(function() {
		
		});
	});
});
