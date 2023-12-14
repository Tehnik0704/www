"use strict";

/**
 * Класс для геокодирования списка адресов или координат.
 * @class
 * @name MultiGeocoder
 * @param {Object} [options={}] Дефолтные опции мультигеокодера.
 */
function MultiGeocoder(options) {
    this._options = options || {results: 1};
}

/**
 * Функция множественнеого геокодирования.
 * @function
 * @requires ymaps.util.extend
 * @see http://api.yandex.ru/maps/doc/jsapi/2.x/ref/reference/util.extend.xml
 * @requires ymaps.util.Promise
 * @see http://api.yandex.ru/maps/doc/jsapi/2.x/ref/reference/util.Promise.xml
 * @name MultiGeocoder.geocode
 * @param {Array} requests Массив строк-имен топонимов и/или геометрий точек (обратное геокодирование)
 * @returns {Object} Как и в обычном геокодере, вернем объект-обещание.
 */
MultiGeocoder.prototype.geocode = function (requests, options) {
    var self = this,
        size = requests.length,
        geoObjects = new ymaps.GeoObjectCollection({}),
        promise = new ymaps.vow.Promise(function (resolve, reject) {

            requests.forEach(function (request, index) {
                ymaps.geocode(request, ymaps.util.extend({}, self._options, options))
                    .then(
                        function (response) {
                            var geoObject = response.geoObjects.get(0);
                            if (!geoObject) {
                                --size || resolve({geoObjects: geoObjects});
                                return;
                            }
                            geoObject._idx = index;

                            geoObject && geoObjects.add(geoObject);
                            --size || resolve({geoObjects: geoObjects});
                        },
                        function (err) {
                            console.error(err);
                            reject(err);
                        }
                    );
            });

        });

    return promise;
};

(function( $ ) {

    $.fn.citrusObjectsMap = function(options) {

        var self = this;
        self.options = $.extend( { }, $.fn.citrusObjectsMap.defaults, options );
	    self.$map = $('#' + self.options.id);

        this.createMap = function(objects) {
            var countObjects = objects.length,
                centerCoordinate = (countObjects === 1) ? objects[0].geometry.getCoordinates() : [55.734046, 37.588628];
            
            var map = new ymaps.Map(self.options.id, {
                    center: centerCoordinate,
                    zoom: 16,
                    controls: self.options.controls
                });
            
            if (self.options.touchScroll) {
	            ymapsTouchScroll(map, {
		            textScroll: BX.message('YAMAP_TOUCH_SCROLL__TEXT_SCROLL'),
		            textTouch: BX.message('YAMAP_TOUCH_SCROLL__TEXT_TOUCH')
	            });
            }
	        //map.behaviors.disable(['scrollZoom']);
	
	        if (!countObjects) {
		        // no items found — hide map container
		        self.options.onEmptyObject.call(this);
		        return;
	        }
	
            $(window).resize(function () {
                var $mapContainer = $('#' + self.options.id),
                    $innerNodes = $mapContainer.find('*');

                $innerNodes.hide();
                map.container.fitToViewport();
                $innerNodes.show();
            });

            map.events.add('click', function (e) {
                var map = e.get('target');
                map.balloon && map.balloon.isOpen() ? map.balloon.close() : false;
            });
            
            if (countObjects > 1) {
	            var clusterer = new ymaps.Clusterer({
		            preset: 'islands#' + self.options.theme + 'ClusterIcons',
		            margin: 50,
		            clusterDisableClickZoom: false,
		
		            clusterBalloonContentLayout: 'cluster#balloonCarousel',
		            clusterBalloonPagerType: 'marker',
		            clusterBalloonContentLayoutHeight: 380,
		            clusterBalloonContentLayoutWidth: 190
	            });
	            clusterer.add(objects);
	            clusterer.events.once('optionschange', function () {
		            map.setBounds(clusterer.getBounds(), {
				            checkZoomRange: true,
				            useMapMargin: true
			            }
		            ).then(function() {
			            if (map.getZoom() > 15)
				            map.setZoom(15);
		            });
	            });
	            map.geoObjects.add(clusterer);
            } else {
	            map.geoObjects.add(objects[0]);
            }

            if ('undefined' !== typeof($().citrusRealtyOfficeMapCheckHash)) {
                window.setTimeout($().citrusRealtyOfficeMapCheckHash, 500);
            }
        };

        this.initObject = function(geoObject, info) {
            geoObject.options.set('iconLayout', 'default#image');
            geoObject.options.set('iconImageHref', self.options.assetsPath + '/themes/main-template/' + self.options.theme + '/map-icon.png');
            geoObject.options.set('iconImageSize', [32,52]);
            geoObject.options.set('iconImageOffset', [-16,-48]);
            //geoObject.options.set('balloonCloseButton', false);
            if (info.header)
                geoObject.properties.set('balloonContentHeader', info.header);
            if (info.body)
                geoObject.properties.set('balloonContentBody', info.body);
            if (info.footer)
                geoObject.properties.set('balloonContentFooter', info.footer);

            // global storage for external use
            geoObject._info = info;

            return geoObject;
        };

        ymaps.ready(function() {

            var geoCoderQueue = [],
                geoCoderQueueItem = [],
                objects = [];
            
            $.each(self.options.items, function (index, item) {
                if ( item.coord ) {
                    var geoObject = new ymaps.Placemark(item.coord);
                    objects.push(self.initObject(geoObject, item));
                }
                else {
                    geoCoderQueue.push(item.address);
                    geoCoderQueueItem.push(item);
                }
            });

            if (geoCoderQueue.length) {
                var geoCoder = new MultiGeocoder({});
                geoCoder.geocode(geoCoderQueue)
                    .then(function (res) {
                        res.geoObjects.each(function (obj) {
                            objects.push(self.initObject(obj, geoCoderQueueItem[obj._idx]));
                        });
                        self.createMap(objects);
                    },
                    function(err) {
	                    self.$map.hide();
                        console.error(err);
                    });
            } else {
                self.createMap(objects);
            }
        });

        return this;
    };

    $.fn.citrusObjectsMap.defaults = {
        id: '',
        address: '',
        assetsPath: window.citrusTemplatePath,
        theme: window.citrusTemplateTheme,
        items: [],
        controls: ['smallMapDefaultSet'],
        instance: true,
	    collapseButton: true,
        onEmptyObject: function () {
	        this.$map.hide();
        },
	    touchScroll: false,
    };

}( jQuery ));