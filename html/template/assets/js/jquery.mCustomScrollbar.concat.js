! function(e) {
    "function" == typeof define && define.amd ? define(["jquery"], e) : "object" == typeof exports ? module.exports = e : e(jQuery)
}(function(e) {
    function t(t) {
        var r = t || window.event,
            l = s.call(arguments, 1),
            c = 0,
            u = 0,
            h = 0,
            f = 0,
            m = 0,
            p = 0;
        if (t = e.event.fix(r), t.type = "mousewheel", "detail" in r && (h = -1 * r.detail), "wheelDelta" in r && (h = r.wheelDelta), "wheelDeltaY" in r && (h = r.wheelDeltaY), "wheelDeltaX" in r && (u = -1 * r.wheelDeltaX), "axis" in r && r.axis === r.HORIZONTAL_AXIS && (u = -1 * h, h = 0), c = 0 === h ? u : h, "deltaY" in r && (h = -1 * r.deltaY, c = h), "deltaX" in r && (u = r.deltaX, 0 === h && (c = -1 * u)), 0 !== h || 0 !== u) {
            if (1 === r.deltaMode) {
                var g = e.data(this, "mousewheel-line-height");
                c *= g, h *= g, u *= g
            } else if (2 === r.deltaMode) {
                var v = e.data(this, "mousewheel-page-height");
                c *= v, h *= v, u *= v
            }
            if (f = Math.max(Math.abs(h), Math.abs(u)), (!i || i > f) && (i = f, n(r, f) && (i /= 40)), n(r, f) && (c /= 40, u /= 40, h /= 40), c = Math[c >= 1 ? "floor" : "ceil"](c / i), u = Math[u >= 1 ? "floor" : "ceil"](u / i), h = Math[h >= 1 ? "floor" : "ceil"](h / i), d.settings.normalizeOffset && this.getBoundingClientRect) {
                var x = this.getBoundingClientRect();
                m = t.clientX - x.left, p = t.clientY - x.top
            }
            return t.deltaX = u, t.deltaY = h, t.deltaFactor = i, t.offsetX = m, t.offsetY = p, t.deltaMode = 0, l.unshift(t, c, u, h), a && clearTimeout(a), a = setTimeout(o, 200), (e.event.dispatch || e.event.handle).apply(this, l)
        }
    }

    function o() {
        i = null
    }

    function n(e, t) {
        return d.settings.adjustOldDeltas && "mousewheel" === e.type && t % 120 === 0
    }
    var a, i, r = ["wheel", "mousewheel", "DOMMouseScroll", "MozMousePixelScroll"],
        l = "onwheel" in document || document.documentMode >= 9 ? ["wheel"] : ["mousewheel", "DomMouseScroll", "MozMousePixelScroll"],
        s = Array.prototype.slice;
    if (e.event.fixHooks)
        for (var c = r.length; c;) e.event.fixHooks[r[--c]] = e.event.mouseHooks;
    var d = e.event.special.mousewheel = {
        version: "3.1.12",
        setup: function() {
            if (this.addEventListener)
                for (var o = l.length; o;) this.addEventListener(l[--o], t, !1);
            else this.onmousewheel = t;
            e.data(this, "mousewheel-line-height", d.getLineHeight(this)), e.data(this, "mousewheel-page-height", d.getPageHeight(this))
        },
        teardown: function() {
            if (this.removeEventListener)
                for (var o = l.length; o;) this.removeEventListener(l[--o], t, !1);
            else this.onmousewheel = null;
            e.removeData(this, "mousewheel-line-height"), e.removeData(this, "mousewheel-page-height")
        },
        getLineHeight: function(t) {
            var o = e(t),
                n = o["offsetParent" in e.fn ? "offsetParent" : "parent"]();
            return n.length || (n = e("body")), parseInt(n.css("fontSize"), 10) || parseInt(o.css("fontSize"), 10) || 16
        },
        getPageHeight: function(t) {
            return e(t).height()
        },
        settings: {
            adjustOldDeltas: !0,
            normalizeOffset: !0
        }
    };
    e.fn.extend({
        mousewheel: function(e) {
            return e ? this.bind("mousewheel", e) : this.trigger("mousewheel")
        },
        unmousewheel: function(e) {
            return this.unbind("mousewheel", e)
        }
    })
}), ! function(e) {
    "undefined" != typeof module && module.exports ? module.exports = e : e(jQuery, window, document)
}(function(e) {
    ! function(t) {
        var o = "function" == typeof define && define.amd,
            n = "undefined" != typeof module && module.exports,
            a = "https:" == document.location.protocol ? "https:" : "http:",
            i = "cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.12/jquery.mousewheel.min.js";
        o || (n ? require("jquery-mousewheel")(e) : e.event.special.mousewheel || e("head").append(decodeURI("%3Cscript src=" + a + "//" + i + "%3E%3C/script%3E"))), t()
    }(function() {
        var t, o = "mCustomScrollbar",
            n = "mCS",
            a = ".mCustomScrollbar",
            i = {
                setTop: 0,
                setLeft: 0,
                axis: "y",
                scrollbarPosition: "inside",
                scrollInertia: 950,
                autoDraggerLength: !0,
                alwaysShowScrollbar: 0,
                snapOffset: 0,
                mouseWheel: {
                    enable: !0,
                    scrollAmount: "auto",
                    axis: "y",
                    deltaFactor: "auto",
                    disableOver: ["select", "option", "keygen", "datalist", "textarea"]
                },
                scrollButtons: {
                    scrollType: "stepless",
                    scrollAmount: "auto"
                },
                keyboard: {
                    enable: !0,
                    scrollType: "stepless",
                    scrollAmount: "auto"
                },
                contentTouchScroll: 25,
                advanced: {
                    autoScrollOnFocus: "input,textarea,select,button,datalist,keygen,a[tabindex],area,object,[contenteditable='true']",
                    updateOnContentResize: !0,
                    updateOnImageLoad: !0,
                    autoUpdateTimeout: 60
                },
                theme: "light",
                callbacks: {
                    onTotalScrollOffset: 0,
                    onTotalScrollBackOffset: 0,
                    alwaysTriggerOffsets: !0
                }
            }, r = 0,
            l = {}, s = window.attachEvent && !window.addEventListener ? 1 : 0,
            c = !1,
            d = ["mCSB_dragger_onDrag", "mCSB_scrollTools_onDrag", "mCS_img_loaded", "mCS_disabled", "mCS_destroyed", "mCS_no_scrollbar", "mCS-autoHide", "mCS-dir-rtl", "mCS_no_scrollbar_y", "mCS_no_scrollbar_x", "mCS_y_hidden", "mCS_x_hidden", "mCSB_draggerContainer", "mCSB_buttonUp", "mCSB_buttonDown", "mCSB_buttonLeft", "mCSB_buttonRight"],
            u = {
                init: function(t) {
                    var t = e.extend(!0, {}, i, t),
                        o = h.call(this);
                    if (t.live) {
                        var s = t.liveSelector || this.selector || a,
                            c = e(s);
                        if ("off" === t.live) return void m(s);
                        l[s] = setTimeout(function() {
                            c.mCustomScrollbar(t), "once" === t.live && c.length && m(s)
                        }, 500)
                    } else m(s);
                    return t.setWidth = t.set_width ? t.set_width : t.setWidth, t.setHeight = t.set_height ? t.set_height : t.setHeight, t.axis = t.horizontalScroll ? "x" : p(t.axis), t.scrollInertia = t.scrollInertia > 0 && t.scrollInertia < 17 ? 17 : t.scrollInertia, "object" != typeof t.mouseWheel && 1 == t.mouseWheel && (t.mouseWheel = {
                        enable: !0,
                        scrollAmount: "auto",
                        axis: "y",
                        preventDefault: !1,
                        deltaFactor: "auto",
                        normalizeDelta: !1,
                        invert: !1
                    }), t.mouseWheel.scrollAmount = t.mouseWheelPixels ? t.mouseWheelPixels : t.mouseWheel.scrollAmount, t.mouseWheel.normalizeDelta = t.advanced.normalizeMouseWheelDelta ? t.advanced.normalizeMouseWheelDelta : t.mouseWheel.normalizeDelta, t.scrollButtons.scrollType = g(t.scrollButtons.scrollType), f(t), e(o).each(function() {
                        var o = e(this);
                        if (!o.data(n)) {
                            o.data(n, {
                                idx: ++r,
                                opt: t,
                                scrollRatio: {
                                    y: null,
                                    x: null
                                },
                                overflowed: null,
                                contentReset: {
                                    y: null,
                                    x: null
                                },
                                bindEvents: !1,
                                tweenRunning: !1,
                                sequential: {},
                                langDir: o.css("direction"),
                                cbOffsets: null,
                                trigger: null
                            });
                            var a = o.data(n),
                                i = a.opt,
                                l = o.data("mcs-axis"),
                                s = o.data("mcs-scrollbar-position"),
                                c = o.data("mcs-theme");
                            l && (i.axis = l), s && (i.scrollbarPosition = s), c && (i.theme = c, f(i)), v.call(this), e("#mCSB_" + a.idx + "_container img:not(." + d[2] + ")").addClass(d[2]), u.update.call(null, o)
                        }
                    })
                },
                update: function(t, o) {
                    var a = t || h.call(this);
                    return e(a).each(function() {
                        var t = e(this);
                        if (t.data(n)) {
                            var a = t.data(n),
                                i = a.opt,
                                r = e("#mCSB_" + a.idx + "_container"),
                                l = [e("#mCSB_" + a.idx + "_dragger_vertical"), e("#mCSB_" + a.idx + "_dragger_horizontal")];
                            if (!r.length) return;
                            a.tweenRunning && V(t), t.hasClass(d[3]) && t.removeClass(d[3]), t.hasClass(d[4]) && t.removeClass(d[4]), S.call(this), _.call(this), "y" === i.axis || i.advanced.autoExpandHorizontalScroll || r.css("width", x(r.children())), a.overflowed = B.call(this), O.call(this), i.autoDraggerLength && b.call(this), C.call(this), M.call(this);
                            var s = [Math.abs(r[0].offsetTop), Math.abs(r[0].offsetLeft)];
                            "x" !== i.axis && (a.overflowed[0] ? l[0].height() > l[0].parent().height() ? T.call(this) : (Q(t, s[0].toString(), {
                                dir: "y",
                                dur: 0,
                                overwrite: "none"
                            }), a.contentReset.y = null) : (T.call(this), "y" === i.axis ? k.call(this) : "yx" === i.axis && a.overflowed[1] && Q(t, s[1].toString(), {
                                dir: "x",
                                dur: 0,
                                overwrite: "none"
                            }))), "y" !== i.axis && (a.overflowed[1] ? l[1].width() > l[1].parent().width() ? T.call(this) : (Q(t, s[1].toString(), {
                                dir: "x",
                                dur: 0,
                                overwrite: "none"
                            }), a.contentReset.x = null) : (T.call(this), "x" === i.axis ? k.call(this) : "yx" === i.axis && a.overflowed[0] && Q(t, s[0].toString(), {
                                dir: "y",
                                dur: 0,
                                overwrite: "none"
                            }))), o && a && (2 === o && i.callbacks.onImageLoad && "function" == typeof i.callbacks.onImageLoad ? i.callbacks.onImageLoad.call(this) : 3 === o && i.callbacks.onSelectorChange && "function" == typeof i.callbacks.onSelectorChange ? i.callbacks.onSelectorChange.call(this) : i.callbacks.onUpdate && "function" == typeof i.callbacks.onUpdate && i.callbacks.onUpdate.call(this)), q.call(this)
                        }
                    })
                },
                scrollTo: function(t, o) {
                    if ("undefined" != typeof t && null != t) {
                        var a = h.call(this);
                        return e(a).each(function() {
                            var a = e(this);
                            if (a.data(n)) {
                                var i = a.data(n),
                                    r = i.opt,
                                    l = {
                                        trigger: "external",
                                        scrollInertia: r.scrollInertia,
                                        scrollEasing: "mcsEaseInOut",
                                        moveDragger: !1,
                                        timeout: 60,
                                        callbacks: !0,
                                        onStart: !0,
                                        onUpdate: !0,
                                        onComplete: !0
                                    }, s = e.extend(!0, {}, l, o),
                                    c = j.call(this, t),
                                    d = s.scrollInertia > 0 && s.scrollInertia < 17 ? 17 : s.scrollInertia;
                                c[0] = F.call(this, c[0], "y"), c[1] = F.call(this, c[1], "x"), s.moveDragger && (c[0] *= i.scrollRatio.y, c[1] *= i.scrollRatio.x), s.dur = d, setTimeout(function() {
                                    null !== c[0] && "undefined" != typeof c[0] && "x" !== r.axis && i.overflowed[0] && (s.dir = "y", s.overwrite = "all", Q(a, c[0].toString(), s)), null !== c[1] && "undefined" != typeof c[1] && "y" !== r.axis && i.overflowed[1] && (s.dir = "x", s.overwrite = "none", Q(a, c[1].toString(), s))
                                }, s.timeout)
                            }
                        })
                    }
                },
                stop: function() {
                    var t = h.call(this);
                    return e(t).each(function() {
                        var t = e(this);
                        t.data(n) && V(t)
                    })
                },
                disable: function(t) {
                    var o = h.call(this);
                    return e(o).each(function() {
                        var o = e(this);
                        o.data(n) && (o.data(n), q.call(this, "remove"), k.call(this), t && T.call(this), O.call(this, !0), o.addClass(d[3]))
                    })
                },
                destroy: function() {
                    var t = h.call(this);
                    return e(t).each(function() {
                        var a = e(this);
                        if (a.data(n)) {
                            var i = a.data(n),
                                r = i.opt,
                                l = e("#mCSB_" + i.idx),
                                s = e("#mCSB_" + i.idx + "_container"),
                                c = e(".mCSB_" + i.idx + "_scrollbar");
                            r.live && m(r.liveSelector || e(t).selector), q.call(this, "remove"), k.call(this), T.call(this), a.removeData(n), K(this, "mcs"), c.remove(), s.find("img." + d[2]).removeClass(d[2]), l.replaceWith(s.contents()), a.removeClass(o + " _" + n + "_" + i.idx + " " + d[6] + " " + d[7] + " " + d[5] + " " + d[3]).addClass(d[4])
                        }
                    })
                }
            }, h = function() {
                return "object" != typeof e(this) || e(this).length < 1 ? a : this
            }, f = function(t) {
                var o = ["rounded", "rounded-dark", "rounded-dots", "rounded-dots-dark"],
                    n = ["rounded-dots", "rounded-dots-dark", "3d", "3d-dark", "3d-thick", "3d-thick-dark", "inset", "inset-dark", "inset-2", "inset-2-dark", "inset-3", "inset-3-dark"],
                    a = ["minimal", "minimal-dark"],
                    i = ["minimal", "minimal-dark"],
                    r = ["minimal", "minimal-dark"];
                t.autoDraggerLength = e.inArray(t.theme, o) > -1 ? !1 : t.autoDraggerLength, t.autoExpandScrollbar = e.inArray(t.theme, n) > -1 ? !1 : t.autoExpandScrollbar, t.scrollButtons.enable = e.inArray(t.theme, a) > -1 ? !1 : t.scrollButtons.enable, t.autoHideScrollbar = e.inArray(t.theme, i) > -1 ? !0 : t.autoHideScrollbar, t.scrollbarPosition = e.inArray(t.theme, r) > -1 ? "outside" : t.scrollbarPosition
            }, m = function(e) {
                l[e] && (clearTimeout(l[e]), K(l, e))
            }, p = function(e) {
                return "yx" === e || "xy" === e || "auto" === e ? "yx" : "x" === e || "horizontal" === e ? "x" : "y"
            }, g = function(e) {
                return "stepped" === e || "pixels" === e || "step" === e || "click" === e ? "stepped" : "stepless"
            }, v = function() {
                var t = e(this),
                    a = t.data(n),
                    i = a.opt,
                    r = i.autoExpandScrollbar ? " " + d[1] + "_expand" : "",
                    l = ["<div id='mCSB_" + a.idx + "_scrollbar_vertical' class='mCSB_scrollTools mCSB_" + a.idx + "_scrollbar mCS-" + i.theme + " mCSB_scrollTools_vertical" + r + "'><div class='" + d[12] + "'><div id='mCSB_" + a.idx + "_dragger_vertical' class='mCSB_dragger' style='position:absolute;' oncontextmenu='return false;'><div class='mCSB_dragger_bar' /></div><div class='mCSB_draggerRail' /></div></div>", "<div id='mCSB_" + a.idx + "_scrollbar_horizontal' class='mCSB_scrollTools mCSB_" + a.idx + "_scrollbar mCS-" + i.theme + " mCSB_scrollTools_horizontal" + r + "'><div class='" + d[12] + "'><div id='mCSB_" + a.idx + "_dragger_horizontal' class='mCSB_dragger' style='position:absolute;' oncontextmenu='return false;'><div class='mCSB_dragger_bar' /></div><div class='mCSB_draggerRail' /></div></div>"],
                    s = "yx" === i.axis ? "mCSB_vertical_horizontal" : "x" === i.axis ? "mCSB_horizontal" : "mCSB_vertical",
                    c = "yx" === i.axis ? l[0] + l[1] : "x" === i.axis ? l[1] : l[0],
                    u = "yx" === i.axis ? "<div id='mCSB_" + a.idx + "_container_wrapper' class='mCSB_container_wrapper' />" : "",
                    h = i.autoHideScrollbar ? " " + d[6] : "",
                    f = "x" !== i.axis && "rtl" === a.langDir ? " " + d[7] : "";
                i.setWidth && t.css("width", i.setWidth), i.setHeight && t.css("height", i.setHeight), i.setLeft = "y" !== i.axis && "rtl" === a.langDir ? "989999px" : i.setLeft, t.addClass(o + " _" + n + "_" + a.idx + h + f).wrapInner("<div id='mCSB_" + a.idx + "' class='mCustomScrollBox mCS-" + i.theme + " " + s + "'><div id='mCSB_" + a.idx + "_container' class='mCSB_container' style='position:relative; top:" + i.setTop + "; left:" + i.setLeft + ";' dir=" + a.langDir + " /></div>");
                var m = e("#mCSB_" + a.idx),
                    p = e("#mCSB_" + a.idx + "_container");
                "y" === i.axis || i.advanced.autoExpandHorizontalScroll || p.css("width", x(p.children())), "outside" === i.scrollbarPosition ? ("static" === t.css("position") && t.css("position", "relative"), t.css("overflow", "visible"), m.addClass("mCSB_outside").after(c)) : (m.addClass("mCSB_inside").append(c), p.wrap(u)), w.call(this);
                var g = [e("#mCSB_" + a.idx + "_dragger_vertical"), e("#mCSB_" + a.idx + "_dragger_horizontal")];
                g[0].css("min-height", g[0].height()), g[1].css("min-width", g[1].width())
            }, x = function(t) {
                return Math.max.apply(Math, t.map(function() {
                    return e(this).outerWidth(!0)
                }).get())
            }, _ = function() {
                var t = e(this),
                    o = t.data(n),
                    a = o.opt,
                    i = e("#mCSB_" + o.idx + "_container");
                a.advanced.autoExpandHorizontalScroll && "y" !== a.axis && i.css({
                    position: "absolute",
                    width: "auto"
                }).wrap("<div class='mCSB_h_wrapper' style='position:relative; left:0; width:999999px;' />").css({
                    width: Math.ceil(i[0].getBoundingClientRect().right + .4) - Math.floor(i[0].getBoundingClientRect().left),
                    position: "relative"
                }).unwrap()
            }, w = function() {
                var t = e(this),
                    o = t.data(n),
                    a = o.opt,
                    i = e(".mCSB_" + o.idx + "_scrollbar:first"),
                    r = te(a.scrollButtons.tabindex) ? "tabindex='" + a.scrollButtons.tabindex + "'" : "",
                    l = ["<a href='#' class='" + d[13] + "' oncontextmenu='return false;' " + r + " />", "<a href='#' class='" + d[14] + "' oncontextmenu='return false;' " + r + " />", "<a href='#' class='" + d[15] + "' oncontextmenu='return false;' " + r + " />", "<a href='#' class='" + d[16] + "' oncontextmenu='return false;' " + r + " />"],
                    s = ["x" === a.axis ? l[2] : l[0], "x" === a.axis ? l[3] : l[1], l[2], l[3]];
                a.scrollButtons.enable && i.prepend(s[0]).append(s[1]).next(".mCSB_scrollTools").prepend(s[2]).append(s[3])
            }, S = function() {
                var t = e(this),
                    o = t.data(n),
                    a = e("#mCSB_" + o.idx),
                    i = t.css("max-height") || "none",
                    r = -1 !== i.indexOf("%"),
                    l = t.css("box-sizing");
                if ("none" !== i) {
                    var s = r ? t.parent().height() * parseInt(i) / 100 : parseInt(i);
                    "border-box" === l && (s -= t.innerHeight() - t.height() + (t.outerHeight() - t.innerHeight())), a.css("max-height", Math.round(s))
                }
            }, b = function() {
                var t = e(this),
                    o = t.data(n),
                    a = e("#mCSB_" + o.idx),
                    i = e("#mCSB_" + o.idx + "_container"),
                    r = [e("#mCSB_" + o.idx + "_dragger_vertical"), e("#mCSB_" + o.idx + "_dragger_horizontal")],
                    l = [a.height() / i.outerHeight(!1), a.width() / i.outerWidth(!1)],
                    c = [parseInt(r[0].css("min-height")), Math.round(l[0] * r[0].parent().height()), parseInt(r[1].css("min-width")), Math.round(l[1] * r[1].parent().width())],
                    d = s && c[1] < c[0] ? c[0] : c[1],
                    u = s && c[3] < c[2] ? c[2] : c[3];
                r[0].css({
                    height: d,
                    "max-height": r[0].parent().height() - 10
                }).find(".mCSB_dragger_bar").css({
                    "line-height": c[0] + "px"
                }), r[1].css({
                    width: u,
                    "max-width": r[1].parent().width() - 10
                })
            }, C = function() {
                var t = e(this),
                    o = t.data(n),
                    a = e("#mCSB_" + o.idx),
                    i = e("#mCSB_" + o.idx + "_container"),
                    r = [e("#mCSB_" + o.idx + "_dragger_vertical"), e("#mCSB_" + o.idx + "_dragger_horizontal")],
                    l = [i.outerHeight(!1) - a.height(), i.outerWidth(!1) - a.width()],
                    s = [l[0] / (r[0].parent().height() - r[0].height()), l[1] / (r[1].parent().width() - r[1].width())];
                o.scrollRatio = {
                    y: s[0],
                    x: s[1]
                }
            }, y = function(e, t, o) {
                var n = o ? d[0] + "_expanded" : "",
                    a = e.closest(".mCSB_scrollTools");
                "active" === t ? (e.toggleClass(d[0] + " " + n), a.toggleClass(d[1]), e[0]._draggable = e[0]._draggable ? 0 : 1) : e[0]._draggable || ("hide" === t ? (e.removeClass(d[0]), a.removeClass(d[1])) : (e.addClass(d[0]), a.addClass(d[1])))
            }, B = function() {
                var t = e(this),
                    o = t.data(n),
                    a = e("#mCSB_" + o.idx),
                    i = e("#mCSB_" + o.idx + "_container"),
                    r = null == o.overflowed ? i.height() : i.outerHeight(!1),
                    l = null == o.overflowed ? i.width() : i.outerWidth(!1);
                return [r > a.height(), l > a.width()]
            }, T = function() {
                var t = e(this),
                    o = t.data(n),
                    a = o.opt,
                    i = e("#mCSB_" + o.idx),
                    r = e("#mCSB_" + o.idx + "_container"),
                    l = [e("#mCSB_" + o.idx + "_dragger_vertical"), e("#mCSB_" + o.idx + "_dragger_horizontal")];
                if (V(t), ("x" !== a.axis && !o.overflowed[0] || "y" === a.axis && o.overflowed[0]) && (l[0].add(r).css("top", 0), Q(t, "_resetY")), "y" !== a.axis && !o.overflowed[1] || "x" === a.axis && o.overflowed[1]) {
                    var s = dx = 0;
                    "rtl" === o.langDir && (s = i.width() - r.outerWidth(!1), dx = Math.abs(s / o.scrollRatio.x)), r.css("left", s), l[1].css("left", dx), Q(t, "_resetX")
                }
            }, M = function() {
                function t() {
                    r = setTimeout(function() {
                        e.event.special.mousewheel ? (clearTimeout(r), L.call(o[0])) : t()
                    }, 100)
                }
                var o = e(this),
                    a = o.data(n),
                    i = a.opt;
                if (!a.bindEvents) {
                    if (D.call(this), i.contentTouchScroll && R.call(this), E.call(this), i.mouseWheel.enable) {
                        var r;
                        t()
                    }
                    P.call(this), H.call(this), i.advanced.autoScrollOnFocus && z.call(this), i.scrollButtons.enable && U.call(this), i.keyboard.enable && X.call(this), a.bindEvents = !0
                }
            }, k = function() {
                var t = e(this),
                    o = t.data(n),
                    a = o.opt,
                    i = n + "_" + o.idx,
                    r = ".mCSB_" + o.idx + "_scrollbar",
                    l = e("#mCSB_" + o.idx + ",#mCSB_" + o.idx + "_container,#mCSB_" + o.idx + "_container_wrapper," + r + " ." + d[12] + ",#mCSB_" + o.idx + "_dragger_vertical,#mCSB_" + o.idx + "_dragger_horizontal," + r + ">a"),
                    s = e("#mCSB_" + o.idx + "_container");
                a.advanced.releaseDraggableSelectors && l.add(e(a.advanced.releaseDraggableSelectors)), o.bindEvents && (e(document).unbind("." + i), l.each(function() {
                    e(this).unbind("." + i)
                }), clearTimeout(t[0]._focusTimeout), K(t[0], "_focusTimeout"), clearTimeout(o.sequential.step), K(o.sequential, "step"), clearTimeout(s[0].onCompleteTimeout), K(s[0], "onCompleteTimeout"), o.bindEvents = !1)
            }, O = function(t) {
                var o = e(this),
                    a = o.data(n),
                    i = a.opt,
                    r = e("#mCSB_" + a.idx + "_container_wrapper"),
                    l = r.length ? r : e("#mCSB_" + a.idx + "_container"),
                    s = [e("#mCSB_" + a.idx + "_scrollbar_vertical"), e("#mCSB_" + a.idx + "_scrollbar_horizontal")],
                    c = [s[0].find(".mCSB_dragger"), s[1].find(".mCSB_dragger")];
                "x" !== i.axis && (a.overflowed[0] && !t ? (s[0].add(c[0]).add(s[0].children("a")).css("display", "block"), l.removeClass(d[8] + " " + d[10])) : (i.alwaysShowScrollbar ? (2 !== i.alwaysShowScrollbar && c[0].css("display", "none"), l.removeClass(d[10])) : (s[0].css("display", "none"), l.addClass(d[10])), l.addClass(d[8]))), "y" !== i.axis && (a.overflowed[1] && !t ? (s[1].add(c[1]).add(s[1].children("a")).css("display", "block"), l.removeClass(d[9] + " " + d[11])) : (i.alwaysShowScrollbar ? (2 !== i.alwaysShowScrollbar && c[1].css("display", "none"), l.removeClass(d[11])) : (s[1].css("display", "none"), l.addClass(d[11])), l.addClass(d[9]))), a.overflowed[0] || a.overflowed[1] ? o.removeClass(d[5]) : o.addClass(d[5])
            }, I = function(e) {
                var t = e.type;
                switch (t) {
                    case "pointerdown":
                    case "MSPointerDown":
                    case "pointermove":
                    case "MSPointerMove":
                    case "pointerup":
                    case "MSPointerUp":
                        return e.target.ownerDocument !== document ? [e.originalEvent.screenY, e.originalEvent.screenX, !1] : [e.originalEvent.pageY, e.originalEvent.pageX, !1];
                    case "touchstart":
                    case "touchmove":
                    case "touchend":
                        var o = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0],
                            n = e.originalEvent.touches.length || e.originalEvent.changedTouches.length;
                        return e.target.ownerDocument !== document ? [o.screenY, o.screenX, n > 1] : [o.pageY, o.pageX, n > 1];
                    default:
                        return [e.pageY, e.pageX, !1]
                }
            }, D = function() {
                function t(e) {
                    var t = m.find("iframe");
                    if (t.length) {
                        var o = e ? "auto" : "none";
                        t.css("pointer-events", o)
                    }
                }

                function o(e, t, o, n) {
                    if (m[0].idleTimer = u.scrollInertia < 233 ? 250 : 0, a.attr("id") === f[1]) var i = "x",
                    r = (a[0].offsetLeft - t + n) * d.scrollRatio.x;
                    else var i = "y",
                    r = (a[0].offsetTop - e + o) * d.scrollRatio.y;
                    Q(l, r.toString(), {
                        dir: i,
                        drag: !0
                    })
                }
                var a, i, r, l = e(this),
                    d = l.data(n),
                    u = d.opt,
                    h = n + "_" + d.idx,
                    f = ["mCSB_" + d.idx + "_dragger_vertical", "mCSB_" + d.idx + "_dragger_horizontal"],
                    m = e("#mCSB_" + d.idx + "_container"),
                    p = e("#" + f[0] + ",#" + f[1]),
                    g = u.advanced.releaseDraggableSelectors ? p.add(e(u.advanced.releaseDraggableSelectors)) : p;
                p.bind("mousedown." + h + " touchstart." + h + " pointerdown." + h + " MSPointerDown." + h, function(o) {
                    if (o.stopImmediatePropagation(), o.preventDefault(), $(o)) {
                        c = !0, s && (document.onselectstart = function() {
                            return !1
                        }), t(!1), V(l), a = e(this);
                        var n = a.offset(),
                            d = I(o)[0] - n.top,
                            h = I(o)[1] - n.left,
                            f = a.height() + n.top,
                            m = a.width() + n.left;
                        f > d && d > 0 && m > h && h > 0 && (i = d, r = h), y(a, "active", u.autoExpandScrollbar)
                    }
                }).bind("touchmove." + h, function(e) {
                    e.stopImmediatePropagation(), e.preventDefault();
                    var t = a.offset(),
                        n = I(e)[0] - t.top,
                        l = I(e)[1] - t.left;
                    o(i, r, n, l)
                }), e(document).bind("mousemove." + h + " pointermove." + h + " MSPointerMove." + h, function(e) {
                    if (a) {
                        var t = a.offset(),
                            n = I(e)[0] - t.top,
                            l = I(e)[1] - t.left;
                        if (i === n) return;
                        o(i, r, n, l)
                    }
                }).add(g).bind("mouseup." + h + " touchend." + h + " pointerup." + h + " MSPointerUp." + h, function(e) {
                    a && (y(a, "active", u.autoExpandScrollbar), a = null), c = !1, s && (document.onselectstart = null), t(!0)
                })
            }, R = function() {
                function o(e) {
                    if (!ee(e) || c || I(e)[2]) return void(t = 0);
                    t = 1, S = 0, b = 0, C.removeClass("mCS_touch_action");
                    var o = k.offset();
                    d = I(e)[0] - o.top, u = I(e)[1] - o.left, A = [I(e)[0], I(e)[1]]
                }

                function a(e) {
                    if (ee(e) && !c && !I(e)[2] && (e.stopImmediatePropagation(), !b || S)) {
                        p = G();
                        var t = M.offset(),
                            o = I(e)[0] - t.top,
                            n = I(e)[1] - t.left,
                            a = "mcsLinearOut";
                        if (D.push(o), R.push(n), A[2] = Math.abs(I(e)[0] - A[0]), A[3] = Math.abs(I(e)[1] - A[1]), y.overflowed[0]) var i = O[0].parent().height() - O[0].height(),
                        r = d - o > 0 && o - d > -(i * y.scrollRatio.y) && (2 * A[3] < A[2] || "yx" === B.axis);
                        if (y.overflowed[1]) var l = O[1].parent().width() - O[1].width(),
                        h = u - n > 0 && n - u > -(l * y.scrollRatio.x) && (2 * A[2] < A[3] || "yx" === B.axis);
                        r || h ? (e.preventDefault(), S = 1) : (b = 1, C.addClass("mCS_touch_action")), _ = "yx" === B.axis ? [d - o, u - n] : "x" === B.axis ? [null, u - n] : [d - o, null], k[0].idleTimer = 250, y.overflowed[0] && s(_[0], E, a, "y", "all", !0), y.overflowed[1] && s(_[1], E, a, "x", L, !0)
                    }
                }

                function i(e) {
                    if (!ee(e) || c || I(e)[2]) return void(t = 0);
                    t = 1, e.stopImmediatePropagation(), V(C), m = G();
                    var o = M.offset();
                    h = I(e)[0] - o.top, f = I(e)[1] - o.left, D = [], R = []
                }

                function r(e) {
                    if (ee(e) && !c && !I(e)[2]) {
                        e.stopImmediatePropagation(), S = 0, b = 0, g = G();
                        var t = M.offset(),
                            o = I(e)[0] - t.top,
                            n = I(e)[1] - t.left;
                        if (!(g - p > 30)) {
                            x = 1e3 / (g - m);
                            var a = "mcsEaseOut",
                                i = 2.5 > x,
                                r = i ? [D[D.length - 2], R[R.length - 2]] : [0, 0];
                            v = i ? [o - r[0], n - r[1]] : [o - h, n - f];
                            var d = [Math.abs(v[0]), Math.abs(v[1])];
                            x = i ? [Math.abs(v[0] / 4), Math.abs(v[1] / 4)] : [x, x];
                            var u = [Math.abs(k[0].offsetTop) - v[0] * l(d[0] / x[0], x[0]), Math.abs(k[0].offsetLeft) - v[1] * l(d[1] / x[1], x[1])];
                            _ = "yx" === B.axis ? [u[0], u[1]] : "x" === B.axis ? [null, u[1]] : [u[0], null], w = [4 * d[0] + B.scrollInertia, 4 * d[1] + B.scrollInertia];
                            var C = parseInt(B.contentTouchScroll) || 0;
                            _[0] = d[0] > C ? _[0] : 0, _[1] = d[1] > C ? _[1] : 0, y.overflowed[0] && s(_[0], w[0], a, "y", L, !1), y.overflowed[1] && s(_[1], w[1], a, "x", L, !1)
                        }
                    }
                }

                function l(e, t) {
                    var o = [1.5 * t, 2 * t, t / 1.5, t / 2];
                    return e > 90 ? t > 4 ? o[0] : o[3] : e > 60 ? t > 3 ? o[3] : o[2] : e > 30 ? t > 8 ? o[1] : t > 6 ? o[0] : t > 4 ? t : o[2] : t > 8 ? t : o[3]
                }

                function s(e, t, o, n, a, i) {
                    e && Q(C, e.toString(), {
                        dur: t,
                        scrollEasing: o,
                        dir: n,
                        overwrite: a,
                        drag: i
                    })
                }
                var d, u, h, f, m, p, g, v, x, _, w, S, b, C = e(this),
                    y = C.data(n),
                    B = y.opt,
                    T = n + "_" + y.idx,
                    M = e("#mCSB_" + y.idx),
                    k = e("#mCSB_" + y.idx + "_container"),
                    O = [e("#mCSB_" + y.idx + "_dragger_vertical"), e("#mCSB_" + y.idx + "_dragger_horizontal")],
                    D = [],
                    R = [],
                    E = 0,
                    L = "yx" === B.axis ? "none" : "all",
                    A = [],
                    P = k.find("iframe"),
                    z = ["touchstart." + T + " pointerdown." + T + " MSPointerDown." + T, "touchmove." + T + " pointermove." + T + " MSPointerMove." + T, "touchend." + T + " pointerup." + T + " MSPointerUp." + T];
                k.bind(z[0], function(e) {
                    o(e)
                }).bind(z[1], function(e) {
                    a(e)
                }), M.bind(z[0], function(e) {
                    i(e)
                }).bind(z[2], function(e) {
                    r(e)
                }), P.length && P.each(function() {
                    e(this).load(function() {
                        W(this) && e(this.contentDocument || this.contentWindow.document).bind(z[0], function(e) {
                            o(e), i(e)
                        }).bind(z[1], function(e) {
                            a(e)
                        }).bind(z[2], function(e) {
                            r(e)
                        })
                    })
                })
            }, E = function() {
                function o() {
                    return window.getSelection ? window.getSelection().toString() : document.selection && "Control" != document.selection.type ? document.selection.createRange().text : 0
                }

                function a(e, t, o) {
                    d.type = o && i ? "stepped" : "stepless", d.scrollAmount = 10, Y(r, e, t, "mcsLinearOut", o ? 60 : null)
                }
                var i, r = e(this),
                    l = r.data(n),
                    s = l.opt,
                    d = l.sequential,
                    u = n + "_" + l.idx,
                    h = e("#mCSB_" + l.idx + "_container"),
                    f = h.parent();
                h.bind("mousedown." + u, function(e) {
                    t || i || (i = 1, c = !0)
                }).add(document).bind("mousemove." + u, function(e) {
                    if (!t && i && o()) {
                        var n = h.offset(),
                            r = I(e)[0] - n.top + h[0].offsetTop,
                            c = I(e)[1] - n.left + h[0].offsetLeft;
                        r > 0 && r < f.height() && c > 0 && c < f.width() ? d.step && a("off", null, "stepped") : ("x" !== s.axis && l.overflowed[0] && (0 > r ? a("on", 38) : r > f.height() && a("on", 40)), "y" !== s.axis && l.overflowed[1] && (0 > c ? a("on", 37) : c > f.width() && a("on", 39)))
                    }
                }).bind("mouseup." + u, function(e) {
                    t || (i && (i = 0, a("off", null)), c = !1)
                })
            }, L = function() {
                function t(t, n) {
                    if (V(o), !A(o, t.target)) {
                        var r = "auto" !== i.mouseWheel.deltaFactor ? parseInt(i.mouseWheel.deltaFactor) : s && t.deltaFactor < 100 ? 100 : t.deltaFactor || 100;
                        if ("x" === i.axis || "x" === i.mouseWheel.axis) var d = "x",
                        u = [Math.round(r * a.scrollRatio.x), parseInt(i.mouseWheel.scrollAmount)], h = "auto" !== i.mouseWheel.scrollAmount ? u[1] : u[0] >= l.width() ? .9 * l.width() : u[0], f = Math.abs(e("#mCSB_" + a.idx + "_container")[0].offsetLeft), m = c[1][0].offsetLeft, p = c[1].parent().width() - c[1].width(), g = t.deltaX || t.deltaY || n;
                        else var d = "y",
                        u = [Math.round(r * a.scrollRatio.y), parseInt(i.mouseWheel.scrollAmount)], h = "auto" !== i.mouseWheel.scrollAmount ? u[1] : u[0] >= l.height() ? .9 * l.height() : u[0], f = Math.abs(e("#mCSB_" + a.idx + "_container")[0].offsetTop), m = c[0][0].offsetTop, p = c[0].parent().height() - c[0].height(), g = t.deltaY || n;
                        "y" === d && !a.overflowed[0] || "x" === d && !a.overflowed[1] || ((i.mouseWheel.invert || t.webkitDirectionInvertedFromDevice) && (g = -g), i.mouseWheel.normalizeDelta && (g = 0 > g ? -1 : 1), (g > 0 && 0 !== m || 0 > g && m !== p || i.mouseWheel.preventDefault) && (t.stopImmediatePropagation(), t.preventDefault()), Q(o, (f - g * h).toString(), {
                            dir: d
                        }))
                    }
                }
                if (e(this).data(n)) {
                    var o = e(this),
                        a = o.data(n),
                        i = a.opt,
                        r = n + "_" + a.idx,
                        l = e("#mCSB_" + a.idx),
                        c = [e("#mCSB_" + a.idx + "_dragger_vertical"), e("#mCSB_" + a.idx + "_dragger_horizontal")],
                        d = e("#mCSB_" + a.idx + "_container").find("iframe");
                    d.length && d.each(function() {
                        e(this).load(function() {
                            W(this) && e(this.contentDocument || this.contentWindow.document).bind("mousewheel." + r, function(e, o) {
                                t(e, o)
                            })
                        })
                    }), l.bind("mousewheel." + r, function(e, o) {
                        t(e, o)
                    })
                }
            }, W = function(e) {
                var t = null;
                try {
                    var o = e.contentDocument || e.contentWindow.document;
                    t = o.body.innerHTML
                } catch (n) {}
                return null !== t
            }, A = function(t, o) {
                var a = o.nodeName.toLowerCase(),
                    i = t.data(n).opt.mouseWheel.disableOver,
                    r = ["select", "textarea"];
                return e.inArray(a, i) > -1 && !(e.inArray(a, r) > -1 && !e(o).is(":focus"))
            }, P = function() {
                var t = e(this),
                    o = t.data(n),
                    a = n + "_" + o.idx,
                    i = e("#mCSB_" + o.idx + "_container"),
                    r = i.parent(),
                    l = e(".mCSB_" + o.idx + "_scrollbar ." + d[12]);
                l.bind("touchstart." + a + " pointerdown." + a + " MSPointerDown." + a, function(e) {
                    c = !0
                }).bind("touchend." + a + " pointerup." + a + " MSPointerUp." + a, function(e) {
                    c = !1
                }).bind("click." + a, function(n) {
                    if (e(n.target).hasClass(d[12]) || e(n.target).hasClass("mCSB_draggerRail")) {
                        V(t);
                        var a = e(this),
                            l = a.find(".mCSB_dragger");
                        if (a.parent(".mCSB_scrollTools_horizontal").length > 0) {
                            if (!o.overflowed[1]) return;
                            var s = "x",
                                c = n.pageX > l.offset().left ? -1 : 1,
                                u = Math.abs(i[0].offsetLeft) - .9 * c * r.width()
                        } else {
                            if (!o.overflowed[0]) return;
                            var s = "y",
                                c = n.pageY > l.offset().top ? -1 : 1,
                                u = Math.abs(i[0].offsetTop) - .9 * c * r.height()
                        }
                        Q(t, u.toString(), {
                            dir: s,
                            scrollEasing: "mcsEaseInOut"
                        })
                    }
                })
            }, z = function() {
                var t = e(this),
                    o = t.data(n),
                    a = o.opt,
                    i = n + "_" + o.idx,
                    r = e("#mCSB_" + o.idx + "_container"),
                    l = r.parent();
                r.bind("focusin." + i, function(o) {
                    var n = e(document.activeElement),
                        i = r.find(".mCustomScrollBox").length,
                        s = 0;
                    n.is(a.advanced.autoScrollOnFocus) && (V(t), clearTimeout(t[0]._focusTimeout), t[0]._focusTimer = i ? (s + 17) * i : 0, t[0]._focusTimeout = setTimeout(function() {
                        var e = [oe(n)[0], oe(n)[1]],
                            o = [r[0].offsetTop, r[0].offsetLeft],
                            i = [o[0] + e[0] >= 0 && o[0] + e[0] < l.height() - n.outerHeight(!1), o[1] + e[1] >= 0 && o[0] + e[1] < l.width() - n.outerWidth(!1)],
                            c = "yx" !== a.axis || i[0] || i[1] ? "all" : "none";
                        "x" === a.axis || i[0] || Q(t, e[0].toString(), {
                            dir: "y",
                            scrollEasing: "mcsEaseInOut",
                            overwrite: c,
                            dur: s
                        }), "y" === a.axis || i[1] || Q(t, e[1].toString(), {
                            dir: "x",
                            scrollEasing: "mcsEaseInOut",
                            overwrite: c,
                            dur: s
                        })
                    }, t[0]._focusTimer))
                })
            }, H = function() {
                var t = e(this),
                    o = t.data(n),
                    a = n + "_" + o.idx,
                    i = e("#mCSB_" + o.idx + "_container").parent();
                i.bind("scroll." + a, function(t) {
                    (0 !== i.scrollTop() || 0 !== i.scrollLeft()) && e(".mCSB_" + o.idx + "_scrollbar").css("visibility", "hidden")
                })
            }, U = function() {
                var t = e(this),
                    o = t.data(n),
                    a = o.opt,
                    i = o.sequential,
                    r = n + "_" + o.idx,
                    l = ".mCSB_" + o.idx + "_scrollbar",
                    s = e(l + ">a");
                s.bind("mousedown." + r + " touchstart." + r + " pointerdown." + r + " MSPointerDown." + r + " mouseup." + r + " touchend." + r + " pointerup." + r + " MSPointerUp." + r + " mouseout." + r + " pointerout." + r + " MSPointerOut." + r + " click." + r, function(n) {
                    function r(e, o) {
                        i.scrollAmount = a.snapAmount || a.scrollButtons.scrollAmount, Y(t, e, o)
                    }
                    if (n.preventDefault(), $(n)) {
                        var l = e(this).attr("class");
                        switch (i.type = a.scrollButtons.scrollType, n.type) {
                            case "mousedown":
                            case "touchstart":
                            case "pointerdown":
                            case "MSPointerDown":
                                if ("stepped" === i.type) return;
                                c = !0, o.tweenRunning = !1, r("on", l);
                                break;
                            case "mouseup":
                            case "touchend":
                            case "pointerup":
                            case "MSPointerUp":
                            case "mouseout":
                            case "pointerout":
                            case "MSPointerOut":
                                if ("stepped" === i.type) return;
                                c = !1, i.dir && r("off", l);
                                break;
                            case "click":
                                if ("stepped" !== i.type || o.tweenRunning) return;
                                r("on", l)
                        }
                    }
                })
            }, X = function() {
                function t(t) {
                    function n(e, t) {
                        r.type = i.keyboard.scrollType, r.scrollAmount = i.snapAmount || i.keyboard.scrollAmount, "stepped" === r.type && a.tweenRunning || Y(o, e, t)
                    }
                    switch (t.type) {
                        case "blur":
                            a.tweenRunning && r.dir && n("off", null);
                            break;
                        case "keydown":
                        case "keyup":
                            var l = t.keyCode ? t.keyCode : t.which,
                                s = "on";
                            if ("x" !== i.axis && (38 === l || 40 === l) || "y" !== i.axis && (37 === l || 39 === l)) {
                                if ((38 === l || 40 === l) && !a.overflowed[0] || (37 === l || 39 === l) && !a.overflowed[1]) return;
                                "keyup" === t.type && (s = "off"), e(document.activeElement).is(u) || (t.preventDefault(), t.stopImmediatePropagation(), n(s, l))
                            } else if (33 === l || 34 === l) {
                                if ((a.overflowed[0] || a.overflowed[1]) && (t.preventDefault(), t.stopImmediatePropagation()), "keyup" === t.type) {
                                    V(o);
                                    var h = 34 === l ? -1 : 1;
                                    if ("x" === i.axis || "yx" === i.axis && a.overflowed[1] && !a.overflowed[0]) var f = "x",
                                    m = Math.abs(c[0].offsetLeft) - .9 * h * d.width();
                                    else var f = "y",
                                    m = Math.abs(c[0].offsetTop) - .9 * h * d.height();
                                    Q(o, m.toString(), {
                                        dir: f,
                                        scrollEasing: "mcsEaseInOut"
                                    })
                                }
                            } else if ((35 === l || 36 === l) && !e(document.activeElement).is(u) && ((a.overflowed[0] || a.overflowed[1]) && (t.preventDefault(), t.stopImmediatePropagation()), "keyup" === t.type)) {
                                if ("x" === i.axis || "yx" === i.axis && a.overflowed[1] && !a.overflowed[0]) var f = "x",
                                m = 35 === l ? Math.abs(d.width() - c.outerWidth(!1)) : 0;
                                else var f = "y",
                                m = 35 === l ? Math.abs(d.height() - c.outerHeight(!1)) : 0;
                                Q(o, m.toString(), {
                                    dir: f,
                                    scrollEasing: "mcsEaseInOut"
                                })
                            }
                    }
                }
                var o = e(this),
                    a = o.data(n),
                    i = a.opt,
                    r = a.sequential,
                    l = n + "_" + a.idx,
                    s = e("#mCSB_" + a.idx),
                    c = e("#mCSB_" + a.idx + "_container"),
                    d = c.parent(),
                    u = "input,textarea,select,datalist,keygen,[contenteditable='true']",
                    h = c.find("iframe"),
                    f = ["blur." + l + " keydown." + l + " keyup." + l];
                h.length && h.each(function() {
                    e(this).load(function() {
                        W(this) && e(this.contentDocument || this.contentWindow.document).bind(f[0], function(e) {
                            t(e)
                        })
                    })
                }), s.attr("tabindex", "0").bind(f[0], function(e) {
                    t(e)
                })
            }, Y = function(t, o, a, i, r) {
                function l(e) {
                    var o = "stepped" !== h.type,
                        n = r ? r : e ? o ? p / 1.5 : g : 1e3 / 60,
                        a = e ? o ? 7.5 : 40 : 2.5,
                        s = [Math.abs(f[0].offsetTop), Math.abs(f[0].offsetLeft)],
                        d = [c.scrollRatio.y > 10 ? 10 : c.scrollRatio.y, c.scrollRatio.x > 10 ? 10 : c.scrollRatio.x],
                        u = "x" === h.dir[0] ? s[1] + h.dir[1] * d[1] * a : s[0] + h.dir[1] * d[0] * a,
                        m = "x" === h.dir[0] ? s[1] + h.dir[1] * parseInt(h.scrollAmount) : s[0] + h.dir[1] * parseInt(h.scrollAmount),
                        v = "auto" !== h.scrollAmount ? m : u,
                        x = i ? i : e ? o ? "mcsLinearOut" : "mcsEaseInOut" : "mcsLinear",
                        _ = e ? !0 : !1;
                    return e && 17 > n && (v = "x" === h.dir[0] ? s[1] : s[0]), Q(t, v.toString(), {
                        dir: h.dir[0],
                        scrollEasing: x,
                        dur: n,
                        onComplete: _
                    }), e ? void(h.dir = !1) : (clearTimeout(h.step), void(h.step = setTimeout(function() {
                        l()
                    }, n)))
                }

                function s() {
                    clearTimeout(h.step), K(h, "step"), V(t)
                }
                var c = t.data(n),
                    u = c.opt,
                    h = c.sequential,
                    f = e("#mCSB_" + c.idx + "_container"),
                    m = "stepped" === h.type ? !0 : !1,
                    p = u.scrollInertia < 26 ? 26 : u.scrollInertia,
                    g = u.scrollInertia < 1 ? 17 : u.scrollInertia;
                switch (o) {
                    case "on":
                        if (h.dir = [a === d[16] || a === d[15] || 39 === a || 37 === a ? "x" : "y", a === d[13] || a === d[15] || 38 === a || 37 === a ? -1 : 1], V(t), te(a) && "stepped" === h.type) return;
                        l(m);
                        break;
                    case "off":
                        s(), (m || c.tweenRunning && h.dir) && l(!0)
                }
            }, j = function(t) {
                var o = e(this).data(n).opt,
                    a = [];
                return "function" == typeof t && (t = t()), t instanceof Array ? a = t.length > 1 ? [t[0], t[1]] : "x" === o.axis ? [null, t[0]] : [t[0], null] : (a[0] = t.y ? t.y : t.x || "x" === o.axis ? null : t, a[1] = t.x ? t.x : t.y || "y" === o.axis ? null : t), "function" == typeof a[0] && (a[0] = a[0]()), "function" == typeof a[1] && (a[1] = a[1]()), a
            }, F = function(t, o) {
                if (null != t && "undefined" != typeof t) {
                    var a = e(this),
                        i = a.data(n),
                        r = i.opt,
                        l = e("#mCSB_" + i.idx + "_container"),
                        s = l.parent(),
                        c = typeof t;
                    o || (o = "x" === r.axis ? "x" : "y");
                    var d = "x" === o ? l.outerWidth(!1) : l.outerHeight(!1),
                        h = "x" === o ? l[0].offsetLeft : l[0].offsetTop,
                        f = "x" === o ? "left" : "top";
                    switch (c) {
                        case "function":
                            return t();
                        case "object":
                            var m = t.jquery ? t : e(t);
                            if (!m.length) return;
                            return "x" === o ? oe(m)[1] : oe(m)[0];
                        case "string":
                        case "number":
                            if (te(t)) return Math.abs(t);
                            if (-1 !== t.indexOf("%")) return Math.abs(d * parseInt(t) / 100);
                            if (-1 !== t.indexOf("-=")) return Math.abs(h - parseInt(t.split("-=")[1]));
                            if (-1 !== t.indexOf("+=")) {
                                var p = h + parseInt(t.split("+=")[1]);
                                return p >= 0 ? 0 : Math.abs(p)
                            }
                            if (-1 !== t.indexOf("px") && te(t.split("px")[0])) return Math.abs(t.split("px")[0]);
                            if ("top" === t || "left" === t) return 0;
                            if ("bottom" === t) return Math.abs(s.height() - l.outerHeight(!1));
                            if ("right" === t) return Math.abs(s.width() - l.outerWidth(!1));
                            if ("first" === t || "last" === t) {
                                var m = l.find(":" + t);
                                return "x" === o ? oe(m)[1] : oe(m)[0]
                            }
                            return e(t).length ? "x" === o ? oe(e(t))[1] : oe(e(t))[0] : (l.css(f, t), void u.update.call(null, a[0]))
                    }
                }
            }, q = function(t) {
                function o() {
                    return clearTimeout(f[0].autoUpdate), 0 === s.parents("html").length ? void(s = null) : void(f[0].autoUpdate = setTimeout(function() {
                        return h.advanced.updateOnSelectorChange && (m = r(), m !== w) ? (l(3), void(w = m)) : (h.advanced.updateOnContentResize && (p = [f.outerHeight(!1), f.outerWidth(!1), v.height(), v.width(), _()[0], _()[1]], (p[0] !== S[0] || p[1] !== S[1] || p[2] !== S[2] || p[3] !== S[3] || p[4] !== S[4] || p[5] !== S[5]) && (l(p[0] !== S[0] || p[1] !== S[1]), S = p)), h.advanced.updateOnImageLoad && (g = a(), g !== b && (f.find("img").each(function() {
                            i(this)
                        }), b = g)), void((h.advanced.updateOnSelectorChange || h.advanced.updateOnContentResize || h.advanced.updateOnImageLoad) && o()))
                    }, h.advanced.autoUpdateTimeout))
                }

                function a() {
                    var e = 0;
                    return h.advanced.updateOnImageLoad && (e = f.find("img").length), e
                }

                function i(t) {
                    function o(e, t) {
                        return function() {
                            return t.apply(e, arguments)
                        }
                    }

                    function n() {
                        this.onload = null, e(t).addClass(d[2]), l(2)
                    }
                    if (e(t).hasClass(d[2])) return void l();
                    var a = new Image;
                    a.onload = o(a, n), a.src = t.src
                }

                function r() {
                    h.advanced.updateOnSelectorChange === !0 && (h.advanced.updateOnSelectorChange = "*");
                    var t = 0,
                        o = f.find(h.advanced.updateOnSelectorChange);
                    return h.advanced.updateOnSelectorChange && o.length > 0 && o.each(function() {
                        t += e(this).height() + e(this).width()
                    }), t
                }

                function l(e) {
                    clearTimeout(f[0].autoUpdate), u.update.call(null, s[0], e)
                }
                var s = e(this),
                    c = s.data(n),
                    h = c.opt,
                    f = e("#mCSB_" + c.idx + "_container");
                if (t) return clearTimeout(f[0].autoUpdate), void K(f[0], "autoUpdate");
                var m, p, g, v = f.parent(),
                    x = [e("#mCSB_" + c.idx + "_scrollbar_vertical"), e("#mCSB_" + c.idx + "_scrollbar_horizontal")],
                    _ = function() {
                        return [x[0].is(":visible") ? x[0].outerHeight(!0) : 0, x[1].is(":visible") ? x[1].outerWidth(!0) : 0]
                    }, w = r(),
                    S = [f.outerHeight(!1), f.outerWidth(!1), v.height(), v.width(), _()[0], _()[1]],
                    b = a();
                o()
            }, N = function(e, t, o) {
                return Math.round(e / t) * t - o
            }, V = function(t) {
                var o = t.data(n),
                    a = e("#mCSB_" + o.idx + "_container,#mCSB_" + o.idx + "_container_wrapper,#mCSB_" + o.idx + "_dragger_vertical,#mCSB_" + o.idx + "_dragger_horizontal");
                a.each(function() {
                    J.call(this)
                })
            }, Q = function(t, o, a) {
                function i(e) {
                    return s && c.callbacks[e] && "function" == typeof c.callbacks[e]
                }

                function r() {
                    return [c.callbacks.alwaysTriggerOffsets || _ >= w[0] + b, c.callbacks.alwaysTriggerOffsets || -C >= _]
                }

                function l() {
                    var e = [f[0].offsetTop, f[0].offsetLeft],
                        o = [v[0].offsetTop, v[0].offsetLeft],
                        n = [f.outerHeight(!1), f.outerWidth(!1)],
                        i = [h.height(), h.width()];
                    t[0].mcs = {
                        content: f,
                        top: e[0],
                        left: e[1],
                        draggerTop: o[0],
                        draggerLeft: o[1],
                        topPct: Math.round(100 * Math.abs(e[0]) / (Math.abs(n[0]) - i[0])),
                        leftPct: Math.round(100 * Math.abs(e[1]) / (Math.abs(n[1]) - i[1])),
                        direction: a.dir
                    }
                }
                var s = t.data(n),
                    c = s.opt,
                    d = {
                        trigger: "internal",
                        dir: "y",
                        scrollEasing: "mcsEaseOut",
                        drag: !1,
                        dur: c.scrollInertia,
                        overwrite: "all",
                        callbacks: !0,
                        onStart: !0,
                        onUpdate: !0,
                        onComplete: !0
                    }, a = e.extend(d, a),
                    u = [a.dur, a.drag ? 0 : a.dur],
                    h = e("#mCSB_" + s.idx),
                    f = e("#mCSB_" + s.idx + "_container"),
                    m = f.parent(),
                    p = c.callbacks.onTotalScrollOffset ? j.call(t, c.callbacks.onTotalScrollOffset) : [0, 0],
                    g = c.callbacks.onTotalScrollBackOffset ? j.call(t, c.callbacks.onTotalScrollBackOffset) : [0, 0];
                if (s.trigger = a.trigger, (0 !== m.scrollTop() || 0 !== m.scrollLeft()) && (e(".mCSB_" + s.idx + "_scrollbar").css("visibility", "visible"), m.scrollTop(0).scrollLeft(0)), "_resetY" !== o || s.contentReset.y || (i("onOverflowYNone") && c.callbacks.onOverflowYNone.call(t[0]), s.contentReset.y = 1), "_resetX" !== o || s.contentReset.x || (i("onOverflowXNone") && c.callbacks.onOverflowXNone.call(t[0]), s.contentReset.x = 1), "_resetY" !== o && "_resetX" !== o) {
                    switch (!s.contentReset.y && t[0].mcs || !s.overflowed[0] || (i("onOverflowY") && c.callbacks.onOverflowY.call(t[0]), s.contentReset.x = null), !s.contentReset.x && t[0].mcs || !s.overflowed[1] || (i("onOverflowX") && c.callbacks.onOverflowX.call(t[0]), s.contentReset.x = null), c.snapAmount && (o = N(o, c.snapAmount, c.snapOffset)), a.dir) {
                        case "x":
                            var v = e("#mCSB_" + s.idx + "_dragger_horizontal"),
                                x = "left",
                                _ = f[0].offsetLeft,
                                w = [h.width() - f.outerWidth(!1), v.parent().width() - v.width()],
                                S = [o, 0 === o ? 0 : o / s.scrollRatio.x],
                                b = p[1],
                                C = g[1],
                                B = b > 0 ? b / s.scrollRatio.x : 0,
                                T = C > 0 ? C / s.scrollRatio.x : 0;
                            break;
                        case "y":
                            var v = e("#mCSB_" + s.idx + "_dragger_vertical"),
                                x = "top",
                                _ = f[0].offsetTop,
                                w = [h.height() - f.outerHeight(!1), v.parent().height() - v.height()],
                                S = [o, 0 === o ? 0 : o / s.scrollRatio.y],
                                b = p[0],
                                C = g[0],
                                B = b > 0 ? b / s.scrollRatio.y : 0,
                                T = C > 0 ? C / s.scrollRatio.y : 0
                    }
                    S[1] < 0 || 0 === S[0] && 0 === S[1] ? S = [0, 0] : S[1] >= w[1] ? S = [w[0], w[1]] : S[0] = -S[0], t[0].mcs || (l(), i("onInit") && c.callbacks.onInit.call(t[0])), clearTimeout(f[0].onCompleteTimeout), (s.tweenRunning || !(0 === _ && S[0] >= 0 || _ === w[0] && S[0] <= w[0])) && (Z(v[0], x, Math.round(S[1]), u[1], a.scrollEasing), Z(f[0], x, Math.round(S[0]), u[0], a.scrollEasing, a.overwrite, {
                        onStart: function() {
                            a.callbacks && a.onStart && !s.tweenRunning && (i("onScrollStart") && (l(), c.callbacks.onScrollStart.call(t[0])), s.tweenRunning = !0, y(v), s.cbOffsets = r())
                        },
                        onUpdate: function() {
                            a.callbacks && a.onUpdate && i("whileScrolling") && (l(), c.callbacks.whileScrolling.call(t[0]))
                        },
                        onComplete: function() {
                            if (a.callbacks && a.onComplete) {
                                "yx" === c.axis && clearTimeout(f[0].onCompleteTimeout);
                                var e = f[0].idleTimer || 0;
                                f[0].onCompleteTimeout = setTimeout(function() {
                                    i("onScroll") && (l(), c.callbacks.onScroll.call(t[0])), i("onTotalScroll") && S[1] >= w[1] - B && s.cbOffsets[0] && (l(), c.callbacks.onTotalScroll.call(t[0])), i("onTotalScrollBack") && S[1] <= T && s.cbOffsets[1] && (l(), c.callbacks.onTotalScrollBack.call(t[0])), s.tweenRunning = !1, f[0].idleTimer = 0, y(v, "hide")
                                }, e)
                            }
                        }
                    }))
                }
            }, Z = function(e, t, o, n, a, i, r) {
                function l() {
                    S.stop || (x || m.call(), x = G() - v, s(), x >= S.time && (S.time = x > S.time ? x + h - (x - S.time) : x + h - 1, S.time < x + 1 && (S.time = x + 1)), S.time < n ? S.id = f(l) : g.call())
                }

                function s() {
                    n > 0 ? (S.currVal = u(S.time, _, b, n, a), w[t] = Math.round(S.currVal) + "px") : w[t] = o + "px", p.call()
                }

                function c() {
                    h = 1e3 / 60, S.time = x + h, f = window.requestAnimationFrame ? window.requestAnimationFrame : function(e) {
                        return s(), setTimeout(e, .01)
                    }, S.id = f(l)
                }

                function d() {
                    null != S.id && (window.requestAnimationFrame ? window.cancelAnimationFrame(S.id) : clearTimeout(S.id), S.id = null)
                }

                function u(e, t, o, n, a) {
                    switch (a) {
                        case "linear":
                        case "mcsLinear":
                            return o * e / n + t;
                        case "mcsLinearOut":
                            return e /= n, e--, o * Math.sqrt(1 - e * e) + t;
                        case "easeInOutSmooth":
                            return e /= n / 2, 1 > e ? o / 2 * e * e + t : (e--, -o / 2 * (e * (e - 2) - 1) + t);
                        case "easeInOutStrong":
                            return e /= n / 2, 1 > e ? o / 2 * Math.pow(2, 10 * (e - 1)) + t : (e--, o / 2 * (-Math.pow(2, -10 * e) + 2) + t);
                        case "easeInOut":
                        case "mcsEaseInOut":
                            return e /= n / 2, 1 > e ? o / 2 * e * e * e + t : (e -= 2, o / 2 * (e * e * e + 2) + t);
                        case "easeOutSmooth":
                            return e /= n, e--, -o * (e * e * e * e - 1) + t;
                        case "easeOutStrong":
                            return o * (-Math.pow(2, -10 * e / n) + 1) + t;
                        case "easeOut":
                        case "mcsEaseOut":
                        default:
                            var i = (e /= n) * e,
                                r = i * e;
                            return t + o * (.499999999999997 * r * i + -2.5 * i * i + 5.5 * r + -6.5 * i + 4 * e)
                    }
                }
                e._mTween || (e._mTween = {
                    top: {},
                    left: {}
                });
                var h, f, r = r || {}, m = r.onStart || function() {}, p = r.onUpdate || function() {}, g = r.onComplete || function() {}, v = G(),
                    x = 0,
                    _ = e.offsetTop,
                    w = e.style,
                    S = e._mTween[t];
                "left" === t && (_ = e.offsetLeft);
                var b = o - _;
                S.stop = 0, "none" !== i && d(), c()
            }, G = function() {
                return window.performance && window.performance.now ? window.performance.now() : window.performance && window.performance.webkitNow ? window.performance.webkitNow() : Date.now ? Date.now() : (new Date).getTime()
            }, J = function() {
                var e = this;
                e._mTween || (e._mTween = {
                    top: {},
                    left: {}
                });
                for (var t = ["top", "left"], o = 0; o < t.length; o++) {
                    var n = t[o];
                    e._mTween[n].id && (window.requestAnimationFrame ? window.cancelAnimationFrame(e._mTween[n].id) : clearTimeout(e._mTween[n].id), e._mTween[n].id = null, e._mTween[n].stop = 1)
                }
            }, K = function(e, t) {
                try {
                    delete e[t]
                } catch (o) {
                    e[t] = null
                }
            }, $ = function(e) {
                return !(e.which && 1 !== e.which)
            }, ee = function(e) {
                var t = e.originalEvent.pointerType;
                return !(t && "touch" !== t && 2 !== t)
            }, te = function(e) {
                return !isNaN(parseFloat(e)) && isFinite(e)
            }, oe = function(e) {
                var t = e.parents(".mCSB_container");
                return [e.offset().top - t.offset().top, e.offset().left - t.offset().left]
            };
        e.fn[o] = function(t) {
            return u[t] ? u[t].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof t && t ? void e.error("Method " + t + " does not exist") : u.init.apply(this, arguments)
        }, e[o] = function(t) {
            return u[t] ? u[t].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof t && t ? void e.error("Method " + t + " does not exist") : u.init.apply(this, arguments)
        }, e[o].defaults = i, window[o] = !0, e(window).load(function() {
            e(a)[o](), e.extend(e.expr[":"], {
                mcsInView: e.expr[":"].mcsInView || function(t) {
                    var o, n, a = e(t),
                        i = a.parents(".mCSB_container");
                    return i.length ? (o = i.parent(), n = [i[0].offsetTop, i[0].offsetLeft], n[0] + oe(a)[0] >= 0 && n[0] + oe(a)[0] < o.height() - a.outerHeight(!1) && n[1] + oe(a)[1] >= 0 && n[1] + oe(a)[1] < o.width() - a.outerWidth(!1)) : void 0
                },
                mcsOverflow: e.expr[":"].mcsOverflow || function(t) {
                    var o = e(t).data(n);
                    return o ? o.overflowed[0] || o.overflowed[1] : void 0
                }
            })
        })
    })
});