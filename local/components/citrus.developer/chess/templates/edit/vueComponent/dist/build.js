!function(t){function s(a){if(e[a])return e[a].exports;var i=e[a]={i:a,l:!1,exports:{}};return t[a].call(i.exports,i,i.exports,s),i.l=!0,i.exports}var e={};s.m=t,s.c=e,s.d=function(t,e,a){s.o(t,e)||Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:a})},s.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return s.d(e,"a",e),e},s.o=function(t,s){return Object.prototype.hasOwnProperty.call(t,s)},s.p="/dist/",s(s.s=1)}([function(t,s,e){"use strict";var a="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t};s.a={name:"vue-chess",props:["items","isEdit","properties","lang"],data:function(){return{sections:{},isShowHover:!1,hoveredFlat:{},isMobile:BX.browser.IsMobile(),swiper:{},forms:{flat:{section:-1,floor:-1,values:{},defaultValues:{active:!0}}},deleteData:{sections:[],flats:[]},ready:!1}},computed:{maxSectionFloor:function(){var t=this.sections.reduce(function(t,s){return s.floorsCount&&t.push(s.floorsCount),t},[]);return t.length?Math.max.apply(null,t):1},arSectionFloors:function(){for(var t=[],s=this.maxSectionFloor;s;s--)t.push(s);return t},postData:function(){var t=this,s=[],e=["id","floor","active","plan","rooms","sort"];return this.sections.forEach(function(a){var i=t.cloneData(a),o=i.flats.filter(function(t){return!t.id||t.changed}),n=o.reduce(function(t,s){var a={};return e.forEach(function(t){return a[t]=s[t]}),t.push(a),t},[]);(n.length||a.changed||!i.id)&&(i.flats=n,s.push(i))}),JSON.stringify(s)},postDeleteData:function(){return JSON.stringify(this.deleteData)}},methods:{cloneData:function(t){var s=this,e=["__ob__","reactiveGetter","reactiveSetter"];if(Array.isArray(t)){var i=[];return t.forEach(function(t,a){e.indexOf(a)>-1||(i[a]=s.cloneData(t))}),i}if("object"===(void 0===t?"undefined":a(t))&&t.toString&&"[object Object]"==t.toString()){var o,n={};for(o in t)e.indexOf(o)>-1||(n[o]=this.cloneData(t[o]));return n}return t},addFlat:function(){var t=this.forms.flat,s=t.values,e={id:0,rooms:1,name:"New flat",active:!!s.active,floor:t.floor||1};if(s.layout){var a={};this.properties.layout.items.forEach(function(t){+t.id==+s.layout&&(a=t)}),a.rooms&&(e.rooms=a.rooms),a.id&&(e.plan=+a.id)}this.sections[t.section].floorsCount||(this.sections[t.section].floorsCount=1),this.sections[t.section].flats||(this.sections[t.section].flats=[]),e.sort=this.updateFlatsSortIndex(t.section,e.floor),this.sections[t.section].flats.push(e),this.updateSlider(),this.forms.flat.values=this.cloneData(this.forms.flat.defaultValues),$.magnificPopup.close()},openAddFlatForm:function(t,s){this.forms.flat.section=t,this.forms.flat.floor=s,$.magnificPopup.open({items:{src:this.$refs["flat-popup"]},mainClass:"full-screen-map mfp-with-zoom",alignTop:!1,showCloseBtn:!1,closeOnContentClick:!1})},closePopup:function(){$.magnificPopup.close(),this.forms.flat.values={}},addSection:function(t){var t=t||{floorsCount:1,flats:[]},s=this.sections.length+1;t.name=this.lang.CHESS_SECTION_TITLE+" "+s,t.id=0,this.sections.push(t),this.updateSlider(function(){this.swiper.slideTo(s)})},deleteSection:function(t){var s=this.sections[t],e=s.flats.reduce(function(t,s){return s.id&&t.push(s.id),t},[]);this.deleteData.flats=this.deleteData.flats.concat(e),s.id&&this.deleteData.sections.push(s.id),this.$delete(this.sections,t),this.updateSlider()},cloneFloor:function(t,s){var e=this.sections[t],a=this.cloneData(this.getFlats(t,s));e.floorsCount++,a=a.map(function(t){return t.id=0,t.editId=0,t.floor=e.floorsCount,t}),e.flats=e.flats.concat(a)},cloneSection:function(t){var s=this.cloneData(this.sections[t]);s.flats=s.flats.map(function(t){return t.id=0,t.editId=0,t}),this.addSection(s)},resetChess:function(){this.sections=this.cloneData(this.items),this.deleteData.sections=[],this.deleteData.flats=[],this.updateSlider()},updateSlider:function(t){var t=t||function(){};this.$nextTick(function(){this.swiper.update(),t.call(this)})},updateFlatsSortIndex:function(t,s){var e=this.getSortedFlats(t,s);return e.forEach(function(t,s){var e=10*(s+1);t.sort!==e&&(t.changed=!0),t.sort=e}),10*(e.length+1)},getSortedFlats:function(t,s){return this.getFlats(t,s).sort(function(t,s){var e=0;return t.sort!==s.sort?e=t.sort>s.sort?1:-1:t.rooms!==s.rooms&&(e=t.sort>s.sort?1:-1),e})},getFlats:function(t,s){return this.sections[t].flats.filter(function(t){return+t.floor==+s})},deleteFloorFlats:function(t,s){var e=this.sections[t];e.changed=!0;var a=e.flats.reduce(function(t,e){return e.floor===s&&e.id&&t.push(e.id),t},[]);this.deleteData.flats=this.deleteData.flats.concat(a);var i=e.flats.filter(function(t){return t.floor!==s});i=i.map(function(t){return t.floor>s&&(t.changed=!0,t.floor--),t}),e.flats=i,e.floorsCount--},deleteFlat:function(t,s){s.id&&this.deleteData.flats.push(s.id);var e=this.sections[t].flats.indexOf(s);this.$delete(this.sections[t].flats,e)},changeSortFlat:function(t,s,e,a){var i=this.getSortedFlats(t,s);this.updateFlatsSortIndex(t,s);var o=i[e];o.changed=!0,a>0?(o.sort+=10,i[e+1].sort-=10,i[e+1].changed=!0):(o.sort-=10,i[e-1].sort+=10,i[e-1].changed=!0)}},created:function(){this.sections=this.cloneData(this.items),this.properties.layout&&this.properties.layout.items&&this.properties.layout.items[0]&&(this.forms.flat.defaultValues.layout=this.properties.layout.items[0].id)},mounted:function(){var t=this;this.forms.flat.values=this.cloneData(this.forms.flat.defaultValues);var s=setInterval(function(){null!==t.$el.offsetParent&&(t.swiper.update(),t.ready=!0,clearInterval(s))},100);this.swiper=new Swiper(".chess-slider .swiper-container",{watchOverflow:!0,simulateTouch:!0,freeMode:!0,navigation:{nextEl:".chess-slider .swiper-button-next",prevEl:".chess-slider .swiper-button-prev"},slidesPerView:"auto",spaceBetween:40,breakpoints:{767:{spaceBetween:20},1023:{spaceBetween:30}},on:{touchStart:function(){}}})}}},function(t,s,e){"use strict";Object.defineProperty(s,"__esModule",{value:!0});var a=e(2);Vue.component("vue-chess",a.a)},function(t,s,e){"use strict";var a=e(0),i=e(4),o=e(3),n=o(a.a,i.a,!1,null,null,null);s.a=n.exports},function(t,s){t.exports=function(t,s,e,a,i,o){var n,r=t=t||{},l=typeof t.default;"object"!==l&&"function"!==l||(n=t,r=t.default);var c="function"==typeof r?r.options:r;s&&(c.render=s.render,c.staticRenderFns=s.staticRenderFns,c._compiled=!0),e&&(c.functional=!0),i&&(c._scopeId=i);var f;if(o?(f=function(t){t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext,t||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),a&&a.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(o)},c._ssrRegister=f):a&&(f=a),f){var d=c.functional,u=d?c.render:c.beforeCreate;d?(c._injectStyles=f,c.render=function(t,s){return f.call(s),u(t,s)}):c.beforeCreate=u?[].concat(u,f):[f]}return{esModule:n,exports:r,options:c}}},function(t,s,e){"use strict";var a=function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",{attrs:{id:"chess"}},[e("div",{staticClass:"p__swiper chess-slider _nav-offset _pagination-top _pagination-hide-nav",class:{_ready:t.ready},attrs:{title:" "}},[e("div",{staticClass:"chess-slider__inner"},[e("div",{staticClass:"floors-list _left"},t._l(t.arSectionFloors,function(s){return e("div",{staticClass:"floors-list__floor"},[e("span",{staticClass:"foors-list__floor-number"},[t._v(t._s(s))]),t._v(" "),e("span",{staticClass:"foors-list__floor-text"},[t._v(t._s(t.lang.CITRUS_DEVELOPER_CHESS_FLOOR))])])})),t._v(" "),e("div",{staticClass:"swiper-container"},[e("div",{staticClass:"swiper-wrapper"},[t._l(t.sections,function(s,a){return t.isEdit||s.flats.length?e("div",{staticClass:"swiper-slide"},[e("div",{staticClass:"chess-section",attrs:{id:s.editId}},[e("div",{staticClass:"chess-section__name"},[e("div",{staticClass:"chess-section__name-text"},[t._v(t._s(s.name))]),t._v(" "),t.isEdit?e("div",{staticClass:"chess-section__edit-links"},[e("a",{staticClass:"chess__section-clone-link",attrs:{href:"javascript:void(0);",title:t.lang.CHESS_CLONE_SECTION_LINK_TITLE},on:{click:function(s){t.cloneSection(a)}}},[e("svg",{staticClass:"svg-icon",attrs:{viewBox:"0 0 511.627 511.627"}},[e("use",{attrs:{"xlink:href":"#icon-copy"}})])]),t._v(" "),e("a",{staticClass:"chess__section-clone-link",attrs:{href:"javascript:void(0);",title:t.lang.CHESS_CLONE_SECTION_DELETE_TITLE},on:{click:function(s){t.deleteSection(a)}}},[e("svg",{staticClass:"svg-icon _trash",attrs:{viewBox:"0 0 774.266 774.266"}},[e("use",{attrs:{"xlink:href":"#icon-trash"}})])])]):t._e()]),t._v(" "),t._l(t.arSectionFloors,function(i){return e("div",{staticClass:"chess-floor",class:{_empty:i>s.floorsCount,_edit:t.isEdit}},[s.floorsCount?[t.isEdit?e("div",{staticClass:"chess__floor-edit-area"},[e("a",{staticClass:"chess__floor-edit-link",attrs:{href:"javascript:void(0);"},on:{click:function(s){t.cloneFloor(a,i)}}},[e("svg",{staticClass:"svg-icon chess__floor-edit-link__icon",attrs:{viewBox:"0 0 511.627 511.627"}},[e("use",{attrs:{"xlink:href":"#icon-copy"}})]),t._v(" "),e("span",{staticClass:"chess__floor-edit-link__title"},[t._v(t._s(t.lang.CHESS_CLONE_FLOOR_LINK))])]),t._v(" "),e("a",{staticClass:"chess__floor-edit-link _delete",attrs:{href:"javascript:void(0);"},on:{click:function(s){t.deleteFloorFlats(a,i)}}},[e("svg",{staticClass:"svg-icon chess__floor-edit-link__icon icon-trash",attrs:{viewBox:"0 0 774.266 774.266"}},[e("use",{attrs:{"xlink:href":"#icon-trash"}})]),t._v(" "),e("span",{staticClass:"chess__floor-edit-link__title"},[t._v(t._s(t.lang.CHESS_CLONE_FLOOR_DELETE))])])]):t._e(),t._v(" "),t._l(t.getSortedFlats(a,i),function(s,o){return e("div",{ref:"flats",refInFor:!0,class:["chess-flat",{_disable:!s.active},{_new:!s.id},{_first:!o},{_last:t.getSortedFlats(a,i).length===o+1}],attrs:{id:s.editId}},[t._v("\n\t\t\t\t\t\t\t\t\t\t\t"+t._s(s.rooms)),+s.rooms&&s.rooms==+s.rooms?[t._v(t._s(t.lang.CHESS_K))]:t._e(),t._v(" "),o?e("a",{staticClass:"chess-flat__sort-left",attrs:{href:"javascript:void(0);"},on:{click:function(s){t.changeSortFlat(a,i,o,-1)}}}):t._e(),t._v(" "),o+1<t.getSortedFlats(a,i).length?e("a",{staticClass:"chess-flat__sort-right",attrs:{href:"javascript:void(0);"},on:{click:function(s){t.changeSortFlat(a,i,o,1)}}}):t._e(),t._v(" "),e("a",{staticClass:"chess-flat__delete-flat",attrs:{title:t.lang.CHESS_DELETE_FLAT_TITLE,href:"javascript:void(0);"},on:{click:function(e){e.preventDefault(),t.deleteFlat(a,s)}}},[e("svg",{staticClass:"svg-icon",attrs:{viewBox:"0 0 357 357"}},[e("use",{attrs:{"xlink:href":"#icon-close"}})])])],2)})]:t._e(),t._v(" "),t.isEdit&&(i<=s.floorsCount||!s.floorsCount&&1===i)?e("div",{staticClass:"chess-flat _add-flat-block"},[e("a",{staticClass:"add-flat-link",attrs:{href:"javascript:void(0);"},on:{click:function(s){t.openAddFlatForm(a,i)}}},[e("svg",{staticClass:"svg-icon",attrs:{viewBox:"0 0 24 24"}},[e("use",{attrs:{"xlink:href":"#icon-plus"}})])])]):t._e()],2)})],2)]):t._e()}),t._v(" "),t.isEdit?e("a",{staticClass:"swiper-slide add-section-slide",attrs:{href:"javascript:void(0);"},on:{click:function(s){s.preventDefault(),t.addSection()}}},[e("span",{staticClass:"add-section-link__icon"},[e("svg",{staticClass:"svg-icon",attrs:{viewBox:"0 0 24 24"}},[e("use",{attrs:{"xlink:href":"#icon-plus"}})])]),t._v(" "),e("span",{staticClass:"add-section-link__text"},[t._v(t._s(t.lang.CHESS_ADD_SECTION_LINK))])]):t._e()],2)]),t._v(" "),e("div",{staticClass:"floors-list _right"},t._l(t.arSectionFloors,function(s){return e("div",{staticClass:"floors-list__floor"},[e("span",{staticClass:"foors-list__floor-number"},[t._v(t._s(s))]),t._v(" "),e("span",{staticClass:"foors-list__floor-text"},[t._v(t._s(t.lang.CITRUS_DEVELOPER_CHESS_FLOOR))])])}))]),t._v(" "),e("div",{staticClass:"swiper-pagination swiper-pagination--lines"}),t._v(" "),t._m(0),t._v(" "),t._m(1)]),t._v(" "),t.isEdit?e("div",{staticClass:"chess-data-form"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.postData,expression:"postData"}],attrs:{name:"chess-edit",type:"hidden"},domProps:{value:t.postData},on:{input:function(s){s.target.composing||(t.postData=s.target.value)}}}),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.postDeleteData,expression:"postDeleteData"}],attrs:{name:"chess-delete",type:"hidden"},domProps:{value:t.postDeleteData},on:{input:function(s){s.target.composing||(t.postDeleteData=s.target.value)}}}),t._v(" "),e("a",{attrs:{href:"javascript:void(0);"},on:{click:function(s){t.resetChess()}}},[t._v(t._s(t.lang.CHESS_DATA_FORM_CANCEL_BUTTN))])]):t._e(),t._v(" "),t.isEdit?e("div",{staticClass:"chess__forms"},[e("div",{ref:"flat-popup",staticClass:"modal-content chess__popup"},[e("div",{staticClass:"modal-header"},[e("div",{staticClass:"modal-title"},[t._v(t._s(t.lang.CHESS_ADD_FLAT_FORM_TITLE))]),t._v(" "),e("a",{staticClass:"modal-close-btn",attrs:{href:"javascript:void(0);","data-dismiss":"modal"},on:{click:function(s){s.preventDefault(),t.closePopup()}}},[e("svg",{staticClass:"svg-icon",attrs:{viewBox:"0 0 357 357"}},[e("use",{attrs:{"xlink:href":"#icon-close"}})]),t._v(" "),e("span",{staticClass:"icon-close"})])]),t._v(" "),e("div",{staticClass:"modal-body"},[t.properties?e("form",{ref:"flat-popup-form",staticClass:"chess-edit-form",attrs:{action:""}},[t._l(t.properties,function(s,a){return e("div",{staticClass:"chess-edit-form__field",attrs:{"data-type":s.type,"data-code":a}},[e("div",{staticClass:"chess-edit-form__field-title"},[t._v(t._s(s.name)+": ")]),t._v(" "),e("div",{staticClass:"chess-edit-form__field-values"},["list"===s.type?t._l(s.items,function(s,i){return e("label",{staticClass:"field-plan"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.forms.flat.values[a],expression:"forms.flat.values[fieldCode]"}],staticClass:"field-plan__input",attrs:{name:a,type:"radio"},domProps:{value:s.id,checked:t._q(t.forms.flat.values[a],s.id)},on:{change:function(e){t.$set(t.forms.flat.values,a,s.id)}}}),t._v(" "),e("span",{staticClass:"field-plan__image-wrapper"},[e("span",{staticClass:"field-plan__image",style:{"background-image":"url("+s.image+")"}})]),t._v(" "),e("span",{staticClass:"field-plan__name"},[t._v(t._s(s.name))])])}):"bool"===s.type?[e("label",{staticClass:"field-checkbox square-checkbox"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.forms.flat.values[a],expression:"forms.flat.values[fieldCode]"}],staticClass:"square-checkbox__input",attrs:{type:"checkbox",name:a,value:"Y"},domProps:{checked:Array.isArray(t.forms.flat.values[a])?t._i(t.forms.flat.values[a],"Y")>-1:t.forms.flat.values[a]},on:{change:function(s){var e=t.forms.flat.values[a],i=s.target,o=!!i.checked;if(Array.isArray(e)){var n=t._i(e,"Y");i.checked?n<0&&t.$set(t.forms.flat.values,a,e.concat(["Y"])):n>-1&&t.$set(t.forms.flat.values,a,e.slice(0,n).concat(e.slice(n+1)))}else t.$set(t.forms.flat.values,a,o)}}}),t._v(" "),e("span",{staticClass:"square-checkbox__checkmark"}),t._v(" "),e("span",{staticClass:"field-checkbox__label"},[t._v(t._s(t.lang.CHESS_FORM_BOOL_LABEL))])])]:t._e()],2)])}),t._v(" "),e("div",{staticClass:"chess-edit-form__footer"},[e("a",{staticClass:"chess-btn _secondary",attrs:{href:"javascript:void(0);"},on:{click:function(s){t.closePopup()}}},[t._v(t._s(t.lang.CHESS_FORM_CANCEL_BUTTON))]),t._v(" "),e("button",{staticClass:"chess-btn _primary",attrs:{type:"submit"},on:{click:function(s){s.preventDefault(),t.addFlat()}}},[t._v(t._s(t.lang.CHESS_FORM_SUBMIT_BUTTON))])])],2):t._e()])])]):t._e()])},i=[function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",{staticClass:"swiper-button-prev"},[e("span",{staticClass:"icon-arrow_left"})])},function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",{staticClass:"swiper-button-next"},[e("span",{staticClass:"icon-arrow_right"})])}],o={render:a,staticRenderFns:i};s.a=o}]);
//# sourceMappingURL=build.js.map