
;(function () {
	/**
	 * ������ "�������� ���" ����� ������������ ��������� ��������
	 * @param {object} [params] - ���������:
	 * @param {string} params.COMPONENT_ID - ���������� id ����������
	 * @param {int} params.NavPageCount - ���������� ������� $arResult['NAV_RESULT']->NavPageCount
	 * @param {string} params.navNum - ����� ������������ ��������� �� �������� $arResult['NAV_RESULT']->NavNum
	 * @param {function} [params.onAfterAjax] - callback ����� ���������� ���������
	 */
	window.ajaxShowMore = function(params) {
		var $wrapper = $('#'+params.COMPONENT_ID),
			$btn = $('[data-showmore-id="'+params.COMPONENT_ID+'"]'),
			NavPageCount = params.NavPageCount,
			navNum = params.navNum,
			pageCurrent = 1,
			onAfterAjax = params.onAfterAjax || function () {};

		$btn.on('click', function(event) {
			event.preventDefault();

			pageCurrent++;
			if(NavPageCount <= pageCurrent) {
				$btn.addClass('hidden')
					.parent().addClass('hidden');
			}

			BX.showWait($wrapper.get(0));

			var data = {
				'ajax-pager': params.COMPONENT_ID
			};
			data['PAGEN_'+navNum] = pageCurrent;
			$.ajax({
				url: window.location.pathname,
				type: 'GET',
				dataType: 'html',
				data: data,
			})
			.done(function(data) {
				var innerHtml = $('#'+params.COMPONENT_ID, data).html();
				$wrapper.append(innerHtml);
				onAfterAjax();
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				BX.closeWait($wrapper.get(0));
			});
		});
	};
})();