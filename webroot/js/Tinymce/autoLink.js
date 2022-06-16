/**
 * Copyright (c) Tiny Technologies, Inc. All rights reserved.
 */
!function() {
    "use strict";
    function k(e) {
        return /^[(\[{ \u00a0]$/.test(e)
    }
    function w(e) {
        return 3 === e.nodeType
    }
    function i(e) {
        return 1 === e.nodeType
    }
    function o(e, t) {
        var n;
        return t < 0 && (t = 0),
        !w(e) || (n = e.data.length) < t && (t = n),
        t
    }
    function y(e, t, n) {
        !i(t) || t.hasChildNodes() ? e.setStart(t, o(t, n)) : e.setStartBefore(t)
    }
    function v(e, t, n) {
        !i(t) || t.hasChildNodes() ? e.setEnd(t, o(t, n)) : e.setEndAfter(t)
    }
    function r(e, t) {
        var n, i, o, r, a, f = e.getParam("autolink_pattern", A), s = e.getParam("default_link_target", !1);
        if (null === e.dom.getParent(e.selection.getNode(), "a[href]")) {
            var d = e.selection.getRng().cloneRange();
            if (d.startOffset < 5) {
                if (!(r = d.endContainer.previousSibling)) {
                    if (!d.endContainer.firstChild || !d.endContainer.firstChild.nextSibling)
                        return;
                    r = d.endContainer.firstChild.nextSibling
                }
                if (y(d, r, a = r.length),
                v(d, r, a),
                d.endOffset < 5)
                    return;
                n = d.endOffset,
                i = r
            } else {
                if (!w(i = d.endContainer) && i.firstChild) {
                    for (; !w(i) && i.firstChild; )
                        i = i.firstChild;
                    w(i) && (y(d, i, 0),
                    v(d, i, i.nodeValue.length))
                }
                n = 1 === d.endOffset ? 2 : d.endOffset - 1 - t
            }
            for (var l = n; y(d, i, 2 <= n ? n - 2 : 0),
            v(d, i, 1 <= n ? n - 1 : 0),
            --n,
            !k(d.toString()) && 0 <= n - 2; )
                ;
            k(d.toString()) ? (y(d, i, n),
            v(d, i, l),
            n += 1) : (0 === d.startOffset ? y(d, i, 0) : y(d, i, n),
            v(d, i, l)),
            u = d.toString(),
            /[?!,.;:]/.test(u.charAt(u.length - 1)) && v(d, i, l - 1);
            var u, c, g, h, C = (u = d.toString().trim()).match(f), m = e.getParam("link_default_protocol", "http", "string");
            C && ((g = c = C[0]).length >= (h = "www.").length && g.substr(0, 0 + h.length) === h ? c = m + "://" + c : -1 === c.indexOf("@") || /^([A-Za-z][A-Za-z\d.+-]*:\/\/)|mailto:/.test(c) || (c = "mailto:" + c),
            o = e.selection.getBookmark(),
            e.selection.setRng(d),
            e.execCommand("createlink", !1, c),
            !1 !== s && e.dom.setAttrib(e.selection.getNode(), "target", s),
            e.selection.moveToBookmark(o),
            e.nodeChanged())
        }
    }
    var e = tinymce.util.Tools.resolve("tinymce.PluginManager")
      , a = tinymce.util.Tools.resolve("tinymce.Env")
      , A = new RegExp("^" + /(?:[A-Za-z][A-Za-z\d.+-]{0,14}:\/\/(?:[-.~*+=!&;:'%@?^${}(),\w]+@)?|www\.|[-;:&=+$,.\w]+@)[A-Za-z\d-]+(?:\.[A-Za-z\d-]+)*(?::\d+)?(?:\/(?:[-+~=.,%()\/\w]*[-+~=%()\/\w])?)?(?:\?(?:[-.~*+=!&;:'%@?^${}(),\/\w]+))?(?:#(?:[-.~*+=!&;:'%@?^${}(),\/\w]+))?/g.source + "$","i");
    e.add("autolink", function(e) {
        var t, n;
        (t = e).on("keydown", function(e) {
            if (13 === e.keyCode)
                return r(t, -1)
        }),
        a.browser.isIE() ? t.on("focus", function() {
            if (!n) {
                n = !0;
                try {
                    t.execCommand("AutoUrlDetect", !1, !0)
                } catch (e) {}
            }
        }) : (t.on("keypress", function(e) {
            if (41 === e.keyCode || 93 === e.keyCode || 125 === e.keyCode)
                return r(t, -1)
        }),
        t.on("keyup", function(e) {
            if (32 === e.keyCode)
                return r(t, 0)
        }))
    })
}();
