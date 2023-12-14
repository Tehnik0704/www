; (function () {
	"use strict";

	Vue.component('planning', {
		template: "#planning-template",
		props: ['templatePath', 'iblockID', 'xmlID', 'urlTemplate'],
		data: function () {
			return {
				items: [],
				isReady: false,
				filterEntrance: undefined,
				filterFloor: undefined,
				visibleModal: false,
				modalItem: {}
			}
		},
		methods: {
			onLoad: function () {
				var self = this;

				bindModalLinks();

			},
			selectEntrance: function (entrance) {
				var self = this;

				if (!_.isEqual(self.filterEntrance, entrance.id)) {
					self.filterEntrance = entrance.id;
					self.filterFloor = _.first(self.filteredFloors);
				}
			},
			selectFloor: function (floor) {
				var self = this;

				if (!_.isEqual(self.filterFloor, floor)) {
					self.filterFloor = floor;
				}
			},
			isEqual: function (x, y) {
				return _.isEqual(x, y);
			},
			showModal: function (item) {
				let self = this;

				if (!_.isEmpty(item)) {
					self.modalItem = item;
					self.visibleModal = true;
				}
			},
			closeModal: function () {
				this.visibleModal = false;
			}
		},
		computed: {
			filteredEntrances: function () {
				let self = this;

				let entrances = _.uniqBy(_.map(self.items, 'entrance'), 'id');
				return _.sortBy(entrances, 'sort');
			},
			filteredFloors: function () {
				let self = this;

				let floors = _.uniq(_.map(self.filteredItemsByEntrance, 'floor'));
				return _.sortBy(floors, [function (o) { return parseInt(o, 10); }]);
			},
			filteredItemsByEntrance: function () {
				let self = this,
					items = _.filter(self.items, function (o) {
						return _.isEqual(o.entrance.id, self.filterEntrance);
					});

				return items;
			},
			filteredItems: function () {
				let self = this;

				return _.filter(self.filteredItemsByEntrance, function (o) {
					return _.isEqual(o.floor, self.filterFloor);
				});
			},
			floorPlan: function () {
				let self = this,
					firstItem = _.first(self.filteredItems);
				return firstItem.plan.floorPlan;
			},
			urlDetail: function () {
				let self = this,
					url;
				if (!_.isEmpty(self.modalItem.plan.url)) {
					url = self.modalItem.plan.url
				} else {
					url = self.urlTemplate;
					url = _.replace(url, '#HOUSE_CODE#', self.modalItem.house.code);
					url = _.replace(url, '#PLAN_ID#', self.modalItem.plan.id);
					url = _.replace(url, '#FLAT_ID#', self.modalItem.id);
				}

				return url;
			}
		},
		mounted: function () {
			let self = this,
				url = self.templatePath,
				data = {
					id: self.iblockID,
					xml_id: self.xmlID
				};

			self.preloader = new Preloader(self.$el, {
				iconStyles: {
					top: '50px',
					bottom: 'auto'
				}
			});

			$.ajax({
				url: url + '/ajax/get-items.php',
				type: 'POST',
				dataType: 'json',
				data: data,
			})
				.done(function (data) {
					self.items = data;
					self.isReady = true;
					self.selectEntrance(_.first(self.filteredEntrances));
				})
				.fail(function () {
					console.log("error load");
				});

			window.onclick = function (event) {
				if (event.target == document.getElementById("modal-plan")) {
					self.closeModal();
				}
			}
			$(document).keyup(function (e) {
				if (e.key === 'Escape') {
					self.closeModal();
				}
			});
		}
	});
}());
