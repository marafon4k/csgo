! function(e) {
  var t = function(e) {
        return e.split("").reverse().join("")
      },
      n = {
        numberStep: function(t, n) {
          var r = Math.floor(t);
          e(n.elem).text(r)
        }
      },
      r = function(e) {
        var t = e.elem;
        t.nodeType && t.parentNode && (t = t._animateNumberSetter, t || (t = n.numberStep), t(e.now, e))
      };
  e.Tween && e.Tween.propHooks ? e.Tween.propHooks.number = {
    set: r
  } : e.fx.step.number = r, e.animateNumber = {
    numberStepFactories: {
      append: function(t) {
        return function(n, r) {
          var o = Math.floor(n);
          e(r.elem).prop("number", n).text(o + t)
        }
      },
      separator: function(n, r) {
        return n = n || " ", r = r || 3,
            function(o, a) {
              var u = Math.floor(o).toString(),
                  i = e(a.elem);
              if (u.length > r) {
                for (var m, p, f, s = u, l = r, c = s.split("").reverse(), u = [], h = 0, b = Math.ceil(s.length / l); b > h; h++) {
                  for (m = "", f = 0; l > f && (p = h * l + f, p !== s.length); f++) m += c[p];
                  u.push(m)
                }
                s = u.length - 1, l = t(u[s]), u[s] = t(parseInt(l, 10).toString()), u = u.join(n), u = t(u)
              }
              i.prop("number", o).text(u)
            }
      }
    }
  }, e.fn.animateNumber = function() {
    for (var t = arguments[0], r = e.extend({}, n, t), o = e(this), a = [r], u = 1, i = arguments.length; i > u; u++) a.push(arguments[u]);
    if (t.numberStep) {
      var m = this.each(function() {
            this._animateNumberSetter = t.numberStep
          }),
          p = r.complete;
      r.complete = function() {
        m.each(function() {
          delete this._animateNumberSetter
        }), p && p.apply(this, arguments)
      }
    }
    return o.animate.apply(o, a)
  }
}(jQuery);