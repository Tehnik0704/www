;(function () {
  Vue.component('vue-chess', {
    template: "#chess-template",
    props: ['items', 'selectedPlans', 'properties'],
    data: function () {
      return {
        isShowHover: false,
        hoveredFlat: {},
        activeTippy: {},
        isMobile: BX.browser.IsMobile(),
        swiper: {},
      }
    },
    computed: {
      maxSectionFloor: function () {
        var arFloorCount = this.items.reduce(function (arPreviousValue, section) {
          if (section.floorsCount) arPreviousValue.push(section.floorsCount);
          return arPreviousValue;
        }, []);
        return !arFloorCount.length ? 1 : Math.max.apply(null, arFloorCount);
      },
      arSectionFloors: function () {
        var floors = [];
        for (var i = this.maxSectionFloor; i; i--) {
          floors.push(i);
        }
        return floors;
      },
    },
    methods: {
      isSelectedPlan: function (flat) {
        return flat.active && (this.selectedPlans.indexOf(flat.plan) + 1);
      },
      updateSlider: function (fn) {
        var fn = fn || function () {
        };
        this.$nextTick(function () {
          this.swiper.update();
          fn.call(this);
        });
      },
      getFlats: function (sectionIndex, floorIndex) {
        return this.items[sectionIndex]['flats'].filter(function (flat) {
          return +flat.floor === +floorIndex;
        });
      },
      hasSelectedFlats: function (sectionIndex) {
        var sectionsWithSelectedFlats = {};
        if (this.selectedPlans.length == 0) {
          return true;
        }
        for (var i = 0, l = this.items.length; i < l; i++) {
          sectionsWithSelectedFlats[i] = false;
          for (var j = 0, lj = this.items[i]['flats'].length; j < lj; j++) {
            // is selected flat
            if (this.items[i]['flats'][j].active && (this.selectedPlans.indexOf(this.items[i]['flats'][j].plan) + 1)) {
              sectionsWithSelectedFlats[i] = true;
              break;
            }
          }
        }
        return sectionsWithSelectedFlats[sectionIndex];
      },
      moveToSlideWithFirstFlat: function () {
        var result = null;
        if (this.selectedPlans.length == 0) {
          return;
        }
        for (var i = 0, l = this.items.length; i < l; i++) {
          for (var j = 0, lj = this.items[i]['flats'].length; j < lj; j++) {
            // is selected flat
            if (this.items[i]['flats'][j].active && (this.selectedPlans.indexOf(this.items[i]['flats'][j].plan) + 1)) {
              // only first selected flat id in first section
              result = this.items[i]['flats'][j].id;
              break;
            }
          }
          if (result) {
            break;
          }
        }
        if (!result) {
          return;
        }
        // get slide index and move to slide
        var elFlat = document.querySelector('.chess-flat-id-' + result);
        if (elFlat) {
          var elSlide = BX.findParent(elFlat, {class: 'swiper-slide'});
          if (elSlide) {
            var slideIndex = elSlide.getAttribute('data-slide-index');
            this.swiper.slideTo(slideIndex);
          }
        }
      },
    },
    created: function () {

    },
    mounted: function () {
      var self = this;
      if (!this.isEdit && this.$refs.flats) {

        this.$refs.flats.forEach(function (item) {
          var templateId = item.dataset.tippyTemplate;
          if (templateId) {
            tippy(item, {
              html: '#' + templateId,
              placement: window.innerWidth >= 768 ? 'right' : 'bottom',
              arrow: true,
              theme: 'template-color',
              duration: 0,
              //delay: [0, 100000], //for debug
              performance: true,
              trigger: self.isMobile ? 'click' : 'mouseenter focus',
              interactive: true,
              zIndex: 9,
              offset: '8,12',
              onShow: function () {
                self.activeTippy = this._reference._tippy;
              },
              onHide: function () {
                self.activeTippy = {};
              }
            });
          }
        });
      }

      BX.addCustomEvent('plan-filter-add', function (planId) {
        self.selectedPlans.push(+planId);
        self.moveToSlideWithFirstFlat();
      });
      BX.addCustomEvent('plan-filter-remove', function (planId) {
        self.$delete(self.selectedPlans, self.selectedPlans.indexOf(+planId));
        self.moveToSlideWithFirstFlat();
      });

      // http://idangero.us/swiper/api/
      this.swiper = new Swiper('.chess-slider .swiper-container', {
        watchOverflow: true,

        // pagination
        pagination: {
          el: '.chess-slider .swiper-pagination',
          clickable: true,
        },

        simulateTouch: false,

        freeMode: true,

        // Navigation arrows
        navigation: {
          nextEl: '.chess-slider .swiper-button-next',
          prevEl: '.chess-slider .swiper-button-prev',
        },

        slidesPerView: 'auto',
        spaceBetween: 40,
        breakpoints: {
          767: {
            spaceBetween: 20
          },
          1023: {
            spaceBetween: 30
          }
        },
        on: {
          'touchStart': function () {
            if (self.activeTippy.hide) self.activeTippy.hide();
          }
        }
      });

      this.moveToSlideWithFirstFlat();
    }
  });
}());
