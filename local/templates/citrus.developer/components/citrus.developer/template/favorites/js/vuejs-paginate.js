!function (e, t) {
  "object" == typeof exports && "object" == typeof module ? module.exports = t() : "function" == typeof define && define.amd ? define([], t) : "object" == typeof exports ? exports.VuejsPaginate = t() : e.VuejsPaginate = t()
}(this, function () {
  return function (e) {
    function t(s) {
      if (n[s]) return n[s].exports;
      var a = n[s] = {exports: {}, id: s, loaded: !1};
      return e[s].call(a.exports, a, a.exports, t), a.loaded = !0, a.exports
    }

    var n = {};
    return t.m = e, t.c = n, t.p = "", t(0)
  }([function (e, t, n) {
    "use strict";

    function s(e) {
      return e && e.__esModule ? e : {default: e}
    }

    var a = n(1), i = s(a);
    e.exports = i.default
  }, function (e, t, n) {
    n(2);
    var s = n(6)(n(7), n(8), "data-v-82963a40", null);
    e.exports = s.exports
  }, function (e, t, n) {
    var s = n(3);
    "string" == typeof s && (s = [[e.id, s, ""]]);
    n(5)(s, {});
    s.locals && (e.exports = s.locals)
  }, function (e, t, n) {
    t = e.exports = n(4)(), t.push([e.id, "a[data-v-82963a40]{cursor:pointer}", ""])
  }, function (e, t) {
    e.exports = function () {
      var e = [];
      return e.toString = function () {
        for (var e = [], t = 0; t < this.length; t++) {
          var n = this[t];
          n[2] ? e.push("@media " + n[2] + "{" + n[1] + "}") : e.push(n[1])
        }
        return e.join("")
      }, e.i = function (t, n) {
        "string" == typeof t && (t = [[null, t, ""]]);
        for (var s = {}, a = 0; a < this.length; a++) {
          var i = this[a][0];
          "number" == typeof i && (s[i] = !0)
        }
        for (a = 0; a < t.length; a++) {
          var r = t[a];
          "number" == typeof r[0] && s[r[0]] || (n && !r[2] ? r[2] = n : n && (r[2] = "(" + r[2] + ") and (" + n + ")"), e.push(r))
        }
      }, e
    }
  }, function (e, t, n) {
    function s(e, t) {
      for (var n = 0; n < e.length; n++) {
        var s = e[n], a = d[s.id];
        if (a) {
          a.refs++;
          for (var i = 0; i < a.parts.length; i++) a.parts[i](s.parts[i]);
          for (; i < s.parts.length; i++) a.parts.push(l(s.parts[i], t))
        } else {
          for (var r = [], i = 0; i < s.parts.length; i++) r.push(l(s.parts[i], t));
          d[s.id] = {id: s.id, refs: 1, parts: r}
        }
      }
    }

    function a(e) {
      for (var t = [], n = {}, s = 0; s < e.length; s++) {
        var a = e[s], i = a[0], r = a[1], o = a[2], l = a[3], u = {css: r, media: o, sourceMap: l};
        n[i] ? n[i].parts.push(u) : t.push(n[i] = {id: i, parts: [u]})
      }
      return t
    }

    function i(e, t) {
      var n = g(), s = C[C.length - 1];
      if ("top" === e.insertAt) s ? s.nextSibling ? n.insertBefore(t, s.nextSibling) : n.appendChild(t) : n.insertBefore(t, n.firstChild), C.push(t); else {
        if ("bottom" !== e.insertAt) throw new Error("Invalid value for parameter 'insertAt'. Must be 'top' or 'bottom'.");
        n.appendChild(t)
      }
    }

    function r(e) {
      e.parentNode.removeChild(e);
      var t = C.indexOf(e);
      t >= 0 && C.splice(t, 1)
    }

    function o(e) {
      var t = document.createElement("style");
      return t.type = "text/css", i(e, t), t
    }

    function l(e, t) {
      var n, s, a;
      if (t.singleton) {
        var i = v++;
        n = h || (h = o(t)), s = u.bind(null, n, i, !1), a = u.bind(null, n, i, !0)
      } else n = o(t), s = c.bind(null, n), a = function () {
        r(n)
      };
      return s(e), function (t) {
        if (t) {
          if (t.css === e.css && t.media === e.media && t.sourceMap === e.sourceMap) return;
          s(e = t)
        } else a()
      }
    }

    function u(e, t, n, s) {
      var a = n ? "" : s.css;
      if (e.styleSheet) e.styleSheet.cssText = b(t, a); else {
        var i = document.createTextNode(a), r = e.childNodes;
        r[t] && e.removeChild(r[t]), r.length ? e.insertBefore(i, r[t]) : e.appendChild(i)
      }
    }

    function c(e, t) {
      var n = t.css, s = t.media, a = t.sourceMap;
      if (s && e.setAttribute("media", s), a && (n += "\n/*# sourceURL=" + a.sources[0] + " */", n += "\n/*# sourceMappingURL=data:application/json;base64," + btoa(unescape(encodeURIComponent(JSON.stringify(a)))) + " */"), e.styleSheet) e.styleSheet.cssText = n; else {
        for (; e.firstChild;) e.removeChild(e.firstChild);
        e.appendChild(document.createTextNode(n))
      }
    }

    var d = {}, p = function (e) {
      var t;
      return function () {
        return "undefined" == typeof t && (t = e.apply(this, arguments)), t
      }
    }, f = p(function () {
      return /msie [6-9]\b/.test(window.navigator.userAgent.toLowerCase())
    }), g = p(function () {
      return document.head || document.getElementsByTagName("head")[0]
    }), h = null, v = 0, C = [];
    e.exports = function (e, t) {
      t = t || {}, "undefined" == typeof t.singleton && (t.singleton = f()), "undefined" == typeof t.insertAt && (t.insertAt = "bottom");
      var n = a(e);
      return s(n, t), function (e) {
        for (var i = [], r = 0; r < n.length; r++) {
          var o = n[r], l = d[o.id];
          l.refs--, i.push(l)
        }
        if (e) {
          var u = a(e);
          s(u, t)
        }
        for (var r = 0; r < i.length; r++) {
          var l = i[r];
          if (0 === l.refs) {
            for (var c = 0; c < l.parts.length; c++) l.parts[c]();
            delete d[l.id]
          }
        }
      }
    };
    var b = function () {
      var e = [];
      return function (t, n) {
        return e[t] = n, e.filter(Boolean).join("\n")
      }
    }()
  }, function (e, t) {
    e.exports = function (e, t, n, s) {
      var a, i = e = e || {}, r = typeof e.default;
      "object" !== r && "function" !== r || (a = e, i = e.default);
      var o = "function" == typeof i ? i.options : i;
      if (t && (o.render = t.render, o.staticRenderFns = t.staticRenderFns), n && (o._scopeId = n), s) {
        var l = o.computed || (o.computed = {});
        Object.keys(s).forEach(function (e) {
          var t = s[e];
          l[e] = function () {
            return t
          }
        })
      }
      return {esModule: a, exports: i, options: o}
    }
  }, function (e, t) {
    "use strict";
    Object.defineProperty(t, "__esModule", {value: !0}), t.default = {
      props: {
        value: {type: Number, default: 1},
        pageCount: {type: Number, required: !0},
        forcePage: {type: Number},
        clickHandler: {
          type: Function, default: function () {
          }
        },
        pageRange: {type: Number, default: 3},
        marginPages: {type: Number, default: 1},
        prevText: {type: String, default: "Prev"},
        nextText: {type: String, default: "Next"},
        breakViewText: {type: String, default: "�"},
        containerClass: {type: String},
        pageClass: {type: String},
        pageLinkClass: {type: String},
        prevClass: {type: String},
        prevLinkClass: {type: String},
        nextClass: {type: String},
        nextLinkClass: {type: String},
        breakViewClass: {type: String},
        breakViewLinkClass: {type: String},
        activeClass: {type: String, default: "active"},
        disabledClass: {type: String, default: "disabled"},
        noLiSurround: {type: Boolean, default: !1},
        firstLastButton: {type: Boolean, default: !1},
        firstButtonText: {type: String, default: "First"},
        lastButtonText: {type: String, default: "Last"},
        hidePrevNext: {type: Boolean, default: !1}
      }, beforeUpdate: function () {
        void 0 !== this.forcePage && this.forcePage !== this.selected && (this.selected = this.forcePage)
      }, computed: {
        selected: function () {
          return this.value
        }, pages: function () {
          var e = this, t = {};
          if (this.pageCount <= this.pageRange) for (var n = 0; n < this.pageCount; n++) {
            var s = {index: n, content: n + 1, selected: n === this.selected - 1};
            t[n] = s
          } else {
            for (var a = Math.floor(this.pageRange / 2), i = function (n) {
              var s = {index: n, content: n + 1, selected: n === e.selected - 1};
              t[n] = s
            }, r = function (e) {
              var n = {disabled: !0, breakView: !0};
              t[e] = n
            }, o = 0; o < this.marginPages; o++) i(o);
            var l = 0;
            this.selected - a > 0 && (l = this.selected - 1 - a);
            var u = l + this.pageRange - 1;
            u >= this.pageCount && (u = this.pageCount - 1, l = u - this.pageRange + 1);
            for (var c = l; c <= u && c <= this.pageCount - 1; c++) i(c);
            l > this.marginPages && r(l - 1), u + 1 < this.pageCount - this.marginPages && r(u + 1);
            for (var d = this.pageCount - 1; d >= this.pageCount - this.marginPages; d--) i(d)
          }
          return t
        }
      }, methods: {
        handlePageSelected: function (e) {
          this.selected !== e && (this.$emit("input", e), this.clickHandler(e))
        }, prevPage: function () {
          this.selected <= 1 || (this.$emit("input", this.selected - 1), this.clickHandler(this.selected - 1))
        }, nextPage: function () {
          this.selected >= this.pageCount || (this.$emit("input", this.selected + 1), this.clickHandler(this.selected + 1))
        }, firstPageSelected: function () {
          return 1 === this.selected
        }, lastPageSelected: function () {
          return this.selected === this.pageCount || 0 === this.pageCount
        }, selectFirstPage: function () {
          this.selected <= 1 || (this.$emit("input", 1), this.clickHandler(1))
        }, selectLastPage: function () {
          this.selected >= this.pageCount || (this.$emit("input", this.pageCount), this.clickHandler(this.pageCount))
        }
      }
    }
  }, function (e, t) {
    e.exports = {
      render: function () {
        var e = this, t = e.$createElement, n = e._self._c || t;
        return e.noLiSurround ? n("div", {class: e.containerClass}, [e.firstLastButton ? n("a", {
          class: [e.pageLinkClass, e.firstPageSelected() ? e.disabledClass : ""],
          attrs: {tabindex: "0"},
          domProps: {innerHTML: e._s(e.firstButtonText)},
          on: {
            click: function (t) {
              e.selectFirstPage()
            }, keyup: function (t) {
              return "button" in t || !e._k(t.keyCode, "enter", 13) ? void e.selectFirstPage() : null
            }
          }
        }) : e._e(), e._v(" "), e.firstPageSelected() && e.hidePrevNext ? e._e() : n("a", {
          class: [e.prevLinkClass, e.firstPageSelected() ? e.disabledClass : ""],
          attrs: {tabindex: "0"},
          domProps: {innerHTML: e._s(e.prevText)},
          on: {
            click: function (t) {
              e.prevPage()
            }, keyup: function (t) {
              return "button" in t || !e._k(t.keyCode, "enter", 13) ? void e.prevPage() : null
            }
          }
        }), e._v(" "), e._l(e.pages, function (t) {
          return [t.breakView ? n("a", {
            class: [e.pageLinkClass, e.breakViewLinkClass, t.disabled ? e.disabledClass : ""],
            attrs: {tabindex: "0"}
          }, [e._t("breakViewContent", [e._v(e._s(e.breakViewText))])], 2) : t.disabled ? n("a", {
            class: [e.pageLinkClass, t.selected ? e.activeClass : "", e.disabledClass],
            attrs: {tabindex: "0"}
          }, [e._v(e._s(t.content))]) : n("a", {
            class: [e.pageLinkClass, t.selected ? e.activeClass : ""],
            attrs: {tabindex: "0"},
            on: {
              click: function (n) {
                e.handlePageSelected(t.index + 1)
              }, keyup: function (n) {
                return "button" in n || !e._k(n.keyCode, "enter", 13) ? void e.handlePageSelected(t.index + 1) : null
              }
            }
          }, [e._v(e._s(t.content))])]
        }), e._v(" "), e.lastPageSelected() && e.hidePrevNext ? e._e() : n("a", {
          class: [e.nextLinkClass, e.lastPageSelected() ? e.disabledClass : ""],
          attrs: {tabindex: "0"},
          domProps: {innerHTML: e._s(e.nextText)},
          on: {
            click: function (t) {
              e.nextPage()
            }, keyup: function (t) {
              return "button" in t || !e._k(t.keyCode, "enter", 13) ? void e.nextPage() : null
            }
          }
        }), e._v(" "), e.firstLastButton ? n("a", {
          class: [e.pageLinkClass, e.lastPageSelected() ? e.disabledClass : ""],
          attrs: {tabindex: "0"},
          domProps: {innerHTML: e._s(e.lastButtonText)},
          on: {
            click: function (t) {
              e.selectLastPage()
            }, keyup: function (t) {
              return "button" in t || !e._k(t.keyCode, "enter", 13) ? void e.selectLastPage() : null
            }
          }
        }) : e._e()], 2) : n("ul", {class: e.containerClass}, [e.firstLastButton ? n("li", {class: [e.pageClass, e.firstPageSelected() ? e.disabledClass : ""]}, [n("a", {
          class: e.pageLinkClass,
          attrs: {tabindex: e.firstPageSelected() ? -1 : 0},
          domProps: {innerHTML: e._s(e.firstButtonText)},
          on: {
            click: function (t) {
              e.selectFirstPage()
            }, keyup: function (t) {
              return "button" in t || !e._k(t.keyCode, "enter", 13) ? void e.selectFirstPage() : null
            }
          }
        })]) : e._e(), e._v(" "), e.firstPageSelected() && e.hidePrevNext ? e._e() : n("li", {class: [e.prevClass, e.firstPageSelected() ? e.disabledClass : ""]}, [n("a", {
          class: e.prevLinkClass,
          attrs: {tabindex: e.firstPageSelected() ? -1 : 0},
          domProps: {innerHTML: e._s(e.prevText)},
          on: {
            click: function (t) {
              e.prevPage()
            }, keyup: function (t) {
              return "button" in t || !e._k(t.keyCode, "enter", 13) ? void e.prevPage() : null
            }
          }
        })]), e._v(" "), e._l(e.pages, function (t) {
          return n("li", {class: [e.pageClass, t.selected ? e.activeClass : "", t.disabled ? e.disabledClass : "", t.breakView ? e.breakViewClass : ""]}, [t.breakView ? n("a", {
            class: [e.pageLinkClass, e.breakViewLinkClass],
            attrs: {tabindex: "0"}
          }, [e._t("breakViewContent", [e._v(e._s(e.breakViewText))])], 2) : t.disabled ? n("a", {
            class: e.pageLinkClass,
            attrs: {tabindex: "0"}
          }, [e._v(e._s(t.content))]) : n("a", {
            class: e.pageLinkClass,
            attrs: {tabindex: "0"},
            on: {
              click: function (n) {
                e.handlePageSelected(t.index + 1)
              }, keyup: function (n) {
                return "button" in n || !e._k(n.keyCode, "enter", 13) ? void e.handlePageSelected(t.index + 1) : null
              }
            }
          }, [e._v(e._s(t.content))])])
        }), e._v(" "), e.lastPageSelected() && e.hidePrevNext ? e._e() : n("li", {class: [e.nextClass, e.lastPageSelected() ? e.disabledClass : ""]}, [n("a", {
          class: e.nextLinkClass,
          attrs: {tabindex: e.lastPageSelected() ? -1 : 0},
          domProps: {innerHTML: e._s(e.nextText)},
          on: {
            click: function (t) {
              e.nextPage()
            }, keyup: function (t) {
              return "button" in t || !e._k(t.keyCode, "enter", 13) ? void e.nextPage() : null
            }
          }
        })]), e._v(" "), e.firstLastButton ? n("li", {class: [e.pageClass, e.lastPageSelected() ? e.disabledClass : ""]}, [n("a", {
          class: e.pageLinkClass,
          attrs: {tabindex: e.lastPageSelected() ? -1 : 0},
          domProps: {innerHTML: e._s(e.lastButtonText)},
          on: {
            click: function (t) {
              e.selectLastPage()
            }, keyup: function (t) {
              return "button" in t || !e._k(t.keyCode, "enter", 13) ? void e.selectLastPage() : null
            }
          }
        })]) : e._e()], 2)
      }, staticRenderFns: []
    }
  }])
});
