
; (function () {
	"use strict";

	Vue.component('paginate', VuejsPaginate);

	Vue.component('favorites', {
		template: "#favorites-template",
		props: ['params', 'propertyList'],
		data: function () {
			return {
				onlyChange: false,
				items: [],
				isReady: false,
				sortProperty: '',
				sortAsc: true,
				swiper: {},
				popupFlatId: 0,
				popupFlatContent: {},
				deletedFlats: [],
				page: 1,
				pager: {
					pageCount: 1,
					pagerName: ''
				}
			}
		},
		methods: {
			getPropertyValue: function (item, propertyCode) {
				return item['PROPERTIES'][propertyCode] && item['PROPERTIES'][propertyCode]['PRINT_VALUE'] ?
					item['PROPERTIES'][propertyCode]['PRINT_VALUE'] : '&mdash;';
			},
			equalHeight: function () {
				$('.favorites-table__left .favorites-th').each(function (index) {
					var nthIndex = index + 1;
					var $items = $(this)
						.add($('.favorites-slide .favorites-th:nth-child(' + nthIndex + ')'))
						.add($('.favorites-slide .favorites-td:nth-child(' + nthIndex + ')'))
						.add($('.favorites-table__right .favorites-th:nth-child(' + nthIndex + ')'));

					if ($(this).data('grids-event-namespace')) {
						$items.responsiveEqualHeightGridDestroy()
					}
					$items.responsiveEqualHeightGrid();
				});
			},
			onLoad: function () {
				var self = this;

				//self.isReady = true;
				//if(!self.items.length) return;

				bindModalLinks();

				// http://idangero.us/swiper/api/
				self.swiper = new Swiper('.favorites-slider .swiper-container', {
					watchOverflow: true,
					scrollbar: {
						el: '.favorites-slider .swiper-scrollbar',
						draggable: true,
					},
					freeMode: true,
					slidesPerView: 'auto',
					breakpoints: {
						380: {
							slidesPerView: 1,
							freeMode: false
						},
					},
					on: {
						init: self.equalHeight
					},
					freeModeMomentumBounce: false,
					touchReleaseOnEdges: true,
				});

				//todo �� ���������� ������ ������
				//setTimeout(function () { self.swiper.update(); }, 0);
			},
			remove: function (id) {
				var findIndex;
				this.items.forEach(function (item, index) {
					if (item['ID'] === id) findIndex = index;
				});
				if (BX.Citrus.Helpers.isset(findIndex)) this.$delete(this.items, findIndex);
				favorites.remove(id);
			},
			sort: function (propertyData) {
				if (propertyData['noSort']) return;

				if (propertyData['code'][0] === this.sortProperty) {
					this.sortAsc = !this.sortAsc;
				} else {
					this.sortAsc = true;
					this.sortProperty = propertyData['code'][0];
				}
				if (this.pager.pageCount) { this.pagerTo(1); }
			},
			withChangeValue: function (arPropertyCode) {
				if (!this.onlyChange) return true;
				var withChange = false, self = this;

				arPropertyCode.forEach(function (propertyCode) {
					if (withChange) return;

					var previewValue;
					self.items.forEach(function (item) {
						if (withChange) return;

						var currentValue = BX.Citrus.Helpers.isset(item['PROPERTIES'][propertyCode]) ? item['PROPERTIES'][propertyCode]['SORT_VALUE'] : false;
						withChange = BX.Citrus.Helpers.isset(previewValue) && previewValue !== currentValue;
						previewValue = currentValue;
					});
				});

				return withChange;
			},
			setOnlyChangeOption: function (input) {
				var self = this;
				this.onlyChange = input.checked;
				this.$nextTick(function () {
					self.swiper.update();
					//todo �� ���������� ������ ������
					setTimeout(function () {
						self.swiper.update();
					}, 0);
					self.equalHeight();
				});
			},
			clearDeletedFlats: function () {
				var arItemsId = this.items.reduce(function (arr, item) {
					arr.push(item.ID);
					return arr;
				}, []);
				this.deletedFlats = favorites.items.filter(function (favoriteId) {
					return arItemsId.indexOf(favoriteId) < 0;
				});
				favorites.remove(this.deletedFlats);
			},
			loadItems: function (pagerData) {
				var self = this;
				var url = BX.message('SITE_DIR') + 'ajax/get-flats.php';
				var data = { 'items': favorites.items, 'properties': self.getPropertyCodeList, 'clear_cache': 'Y' };
				if (pagerData && pagerData.sort) {
					data['SORT'] = pagerData.sort;
				}
				if (pagerData && pagerData.sortOrder) {
					data['ORDER'] = pagerData.sortOrder;
				}


				$.ajax({
					url: url,
					type: 'GET', //for composite
					dataType: 'json',
					data: data,
				})
					.done(function (data) {
						self.items = data.ITEMS || [];
						if (self.items.length !== favorites.items.length) self.clearDeletedFlats();
						self.isReady = true;
						Vue.nextTick(self.onLoad);
					})
					.fail(function () {
						console.log("error load");
					});

			},
			pagerTo: function (page) {
				var pagerData = {
					pagerName: this.pager.pagerName,
					page: +page,
					sort: this.sortProperty,
					sortOrder: this.sortAsc ? 'ASC' : 'DESC',
				};
				if (this.params.template === 'FAVORITES') {
					this.loadItems(pagerData);
				} else {
					BX.onCustomEvent(pagerData, 'citrus-favorites-pager');
				}
			}
		},
		watch: {
			popupFlatId: function (flatId) {
				var self = this;
				if (!flatId || self.popupFlatContent[self.popupFlatId]) return;
				$.ajax({
					url: BX.message('SITE_DIR') + 'ajax/get-flat-detail.php',
					type: 'POST',
					dataType: 'html',
					data: { 'id': flatId, 'clear_cache': 'Y' },
				})
					.done(function (data) {
						self.$set(self.popupFlatContent, flatId, data);
					})
					.fail(function () {
						console.log("error load");
					});
			}
		},
		computed: {
			properties: function () {
				return this.propertyList.map(function (item) {
					item['name'] = BX.Citrus.Helpers.makeArray(item['name'].split('|'));
					item['code'] = BX.Citrus.Helpers.makeArray(item['code'].split('|'));
					return item;
				});
			},
			getPropertyCodeList: function () {
				var arPropertyCodes = this.propertyList.reduce(function (arr, item) {
					return arr.concat(item['code']);
				}, []);

				if (this.params.template === 'FAVORITES' && arPropertyCodes.indexOf('cost') === -1)
					arPropertyCodes.push('cost');
				return arPropertyCodes;
			},
			itemIds: function () {
				return this.items.reduce(function (ar, item) {
					ar.push(item.ID);
					return ar;
				}, []);
			}
		},
		mounted: function () {
			var self = this, url, data;
			self.sortProperty = self.properties[0]['code'][0];

			self.preloader = new Preloader(self.$el, {
				iconStyles: {
					top: '50px',
					bottom: 'auto'
				}
			});
			BX.addCustomEvent('citrus-filter-start-json-load', function () {
				self.preloader.showLoading();
			});

			if (this.params.template === 'FAVORITES') {
				$(document).keyup(function (e) {
					if (e.key === 'Escape') self.popupFlatId = 0;
				});
				if (!favorites.items.length) {
					self.isReady = true;
					self.onLoad();
					return;
				}
				self.loadItems();
			}

			BX.addCustomEvent('citrus-filter-reload', function (params) {
				params = params || {};
				if (params.hasOwnProperty('ITEMS')) {
					this.ITEMS_LIST = params.ITEMS;
				}
				if (params.hasOwnProperty('PAGER')) {
					this.PAGER = params.PAGER;
				}

				self.items = this.ITEMS_LIST || [];
				self.isReady = true;
				self.preloader.hideLoading();

				if (typeof this.PAGER !== 'undefined') {
					self.page = +this.PAGER.page;
					self.pager.pageCount = +this.PAGER.pageCount;
					self.pager.pagerName = this.PAGER.pageName;
				}

				Vue.nextTick(self.onLoad);
			});
		}
	});
}());
