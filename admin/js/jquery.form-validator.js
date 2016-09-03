/**
 *  JQUERY-FORM-VALIDATOR
 *
 *  @website by 
 *  @license MIT
 *  @version 2.2.8
 */
! function(a) {
    "use strict";
    var b = a(window),
        c = function(b) {
            if (b.valAttr("error-msg-container")) return a(b.valAttr("error-msg-container"));
            var c = b.parent();
            if (!c.hasClass("form-group") && !c.closest("form").hasClass("form-horizontal")) {
                var d = c.closest(".form-group");
                if (d.length) return d.eq(0)
            }
            return c
        },
        d = function(a, b) {
            a.addClass(b.errorElementClass).removeClass("valid"), c(a).addClass(b.inputParentClassOnError).removeClass(b.inputParentClassOnSuccess), "" !== b.borderColorOnError && a.css("border-color", b.borderColorOnError)
        },
        e = function(b, d) {
            b.each(function() {
                var b = a(this);
                f(b, "", d, d.errorMessagePosition), b.removeClass("valid").removeClass(d.errorElementClass).css("border-color", ""), c(b).removeClass(d.inputParentClassOnError).removeClass(d.inputParentClassOnSuccess).find("." + d.errorMessageClass).remove()
            })
        },
        f = function(d, e, f, g) {
            var h = document.getElementById(d.attr("name") + "_err_msg"),
                i = function(a) {
                    b.trigger("validationErrorDisplay", [d, a]), a.html(e)
                };
            if (h) i(a(h));
            else if ("object" == typeof g) {
                var j = !1;
                if (g.find("." + f.errorMessageClass).each(function() {
                        return this.inputReferer == d[0] ? (j = a(this), !1) : void 0
                    }), j) e ? i(j) : j.remove();
                else {
                    var k = a('<div class="' + f.errorMessageClass + '"></div>');
                    i(k), k[0].inputReferer = d[0], g.prepend(k)
                }
            } else {
                var l = c(d),
                    k = l.find("." + f.errorMessageClass + ".help-block");
                0 == k.length && (k = a("<span></span>").addClass("help-block").addClass(f.errorMessageClass), k.appendTo(l)), i(k)
            }
        },
        g = function(b, c, d, e) {
            var f, g = e.errorMessageTemplate.messages.replace(/\{errorTitle\}/g, c),
                h = [];
            a.each(d, function(a, b) {
                h.push(e.errorMessageTemplate.field.replace(/\{msg\}/g, b))
            }), g = g.replace(/\{fields\}/g, h.join("")), f = e.errorMessageTemplate.container.replace(/\{errorMessageClass\}/g, e.errorMessageClass), f = f.replace(/\{messages\}/g, g), b.children().eq(0).before(f)
        };
    a.fn.validateOnBlur = function(b, c) {
        return this.find("*[data-validation]").bind("blur.validation", function() {
            a(this).validateInputOnBlur(b, c, !0, "blur")
        }), c.validateCheckboxRadioOnClick && this.find("input[type=checkbox][data-validation],input[type=radio][data-validation]").bind("click.validation", function() {
            a(this).validateInputOnBlur(b, c, !0, "click")
        }), this
    }, a.fn.validateOnEvent = function(b, c) {
        return this.find("*[data-validation-event]").each(function() {
            var d = a(this),
                e = d.valAttr("event");
            e && d.unbind(e + ".validation").bind(e + ".validation", function() {
                a(this).validateInputOnBlur(b, c, !0, e)
            })
        }), this
    }, a.fn.showHelpOnFocus = function(b) {
        return b || (b = "data-validation-help"), this.find(".has-help-txt").valAttr("has-keyup-event", !1).removeClass("has-help-txt"), this.find("textarea,input").each(function() {
            var c = a(this),
                d = "jquery_form_help_" + (c.attr("name") || "").replace(/(:|\.|\[|\])/g, ""),
                e = c.attr(b);
            e && c.addClass("has-help-txt").unbind("focus.help").bind("focus.help", function() {
                var b = c.parent().find("." + d);
                0 == b.length && (b = a("<span />").addClass(d).addClass("help").addClass("help-block").text(e).hide(), c.after(b)), b.fadeIn()
            }).unbind("blur.help").bind("blur.help", function() {
                a(this).parent().find("." + d).fadeOut("slow")
            })
        }), this
    }, a.fn.validate = function(b, c, d) {
        var e = a.extend({}, a.formUtils.LANG, d || {});
        this.each(function() {
            var d = a(this),
                f = d.closest("form").get(0).validationConfig || {};
            d.one("validation", function(a, c) {
                "function" == typeof b && b(c, this, a)
            }), d.validateInputOnBlur(e, a.extend({}, f, c || {}), !0)
        })
    }, a.fn.willPostponeValidation = function() {
        return (this.valAttr("suggestion-nr") || this.valAttr("postpone") || this.hasClass("hasDatepicker")) && !window.postponedValidation
    }, a.fn.validateInputOnBlur = function(b, g, h, i) {
        if (a.formUtils.eventType = i, this.willPostponeValidation()) {
            var j = this,
                k = this.valAttr("postpone") || 200;
            return window.postponedValidation = function() {
                j.validateInputOnBlur(b, g, h, i), window.postponedValidation = !1
            }, setTimeout(function() {
                window.postponedValidation && window.postponedValidation()
            }, k), this
        }
        b = a.extend({}, a.formUtils.LANG, b || {}), e(this, g);
        var l = this,
            m = l.closest("form"),
            n = (l.attr(g.validationRuleAttribute), a.formUtils.validateInput(l, b, g, m, i));
        return n.isValid ? n.shouldChangeDisplay && (l.addClass("valid"), c(l).addClass(g.inputParentClassOnSuccess)) : n.isValid || (d(l, g), f(l, n.errorMsg, g, g.errorMessagePosition), h && l.unbind("keyup.validation").bind("keyup.validation", function() {
            a(this).validateInputOnBlur(b, g, !1, "keyup")
        })), this
    }, a.fn.valAttr = function(a, b) {
        return void 0 === b ? this.attr("data-validation-" + a) : b === !1 || null === b ? this.removeAttr("data-validation-" + a) : (a.length > 0 && (a = "-" + a), this.attr("data-validation" + a, b))
    }, a.fn.isValid = function(h, i, j) {
        if (a.formUtils.isLoadingModules) {
            var k = this;
            return setTimeout(function() {
                k.isValid(h, i, j)
            }, 200), null
        }
        i = a.extend({}, a.formUtils.defaultConfig(), i || {}), h = a.extend({}, a.formUtils.LANG, h || {}), j = j !== !1, a.formUtils.errorDisplayPreventedWhenHalted && (delete a.formUtils.errorDisplayPreventedWhenHalted, j = !1), a.formUtils.isValidatingEntireForm = !0, a.formUtils.haltValidation = !1;
        var l = function(b, c) {
                a.inArray(b, n) < 0 && n.push(b), o.push(c), c.attr("current-error", b), j && d(c, i)
            },
            m = [],
            n = [],
            o = [],
            p = this,
            q = function(b, c) {
                return "submit" === c || "button" === c || "reset" == c ? !0 : a.inArray(b, i.ignore || []) > -1
            };
        if (j && (p.find("." + i.errorMessageClass + ".alert").remove(), e(p.find("." + i.errorElementClass + ",.valid"), i)), p.find("input,textarea,select").filter(':not([type="submit"],[type="button"])').each(function() {
                var b = a(this),
                    d = b.attr("type"),
                    e = "radio" == d || "checkbox" == d,
                    f = b.attr("name");
                if (!q(f, d) && (!e || a.inArray(f, m) < 0)) {
                    e && m.push(f);
                    var g = a.formUtils.validateInput(b, h, i, p, "submit");
                    g.shouldChangeDisplay && (g.isValid ? g.isValid && (b.valAttr("current-error", !1).addClass("valid"), c(b).addClass(i.inputParentClassOnSuccess)) : l(g.errorMsg, b))
                }
            }), "function" == typeof i.onValidate) {
            var r = i.onValidate(p);
            a.isArray(r) ? a.each(r, function(a, b) {
                l(b.message, b.element)
            }) : r && r.element && r.message && l(r.message, r.element)
        }
        return a.formUtils.isValidatingEntireForm = !1, !a.formUtils.haltValidation && o.length > 0 ? (j && ("top" === i.errorMessagePosition ? g(p, h.errorTitle, n, i) : "custom" === i.errorMessagePosition ? "function" == typeof i.errorMessageCustom && i.errorMessageCustom(p, h.errorTitle, n, i) : a.each(o, function(a, b) {
            f(b, b.attr("current-error"), i, i.errorMessagePosition)
        }), i.scrollToTopOnError && b.scrollTop(p.offset().top - 20)), !1) : (!j && a.formUtils.haltValidation && (a.formUtils.errorDisplayPreventedWhenHalted = !0), !a.formUtils.haltValidation)
    }, a.fn.validateForm = function(a, b) {
        return window.console && "function" == typeof window.console.warn && window.console.warn("Use of deprecated function $.validateForm, use $.isValid instead"), this.isValid(a, b, !0)
    }, a.fn.restrictLength = function(b) {
        return new a.formUtils.lengthRestriction(this, b), this
    }, a.fn.addSuggestions = function(b) {
        var c = !1;
        return this.find("input").each(function() {
            var d = a(this);
            c = a.split(d.attr("data-suggestions")), c.length > 0 && !d.hasClass("has-suggestions") && (a.formUtils.suggest(d, c, b), d.addClass("has-suggestions"))
        }), this
    }, a.split = function(b, c) {
        if ("function" != typeof c) {
            if (!b) return [];
            var d = [];
            return a.each(b.split(c ? c : /[,|\-\s]\s*/g), function(b, c) {
                c = a.trim(c), c.length && d.push(c)
            }), d
        }
        b && a.each(b.split(/[,|\-\s]\s*/g), function(b, d) {
            return d = a.trim(d), d.length ? c(d, b) : void 0
        })
    }, a.validate = function(c) {
        var d = a.extend(a.formUtils.defaultConfig(), {
            form: "form",
            validateOnEvent: !1,
            validateOnBlur: !0,
            validateCheckboxRadioOnClick: !0,
            showHelpOnFocus: !0,
            addSuggestions: !0,
            modules: "",
            onModulesLoaded: null,
            language: !1,
            onSuccess: !1,
            onError: !1,
            onElementValidate: !1
        });
        if (c = a.extend(d, c || {}), c.lang && "en" != c.lang) {
            var f = "lang/" + c.lang + ".js";
            c.modules += c.modules.length ? "," + f : f
        }
        a(c.form).each(function(d, f) {
            f.validationConfig = c;
            var g = a(f);
            b.trigger("formValidationSetup", [g, c]), g.find(".has-help-txt").unbind("focus.validation").unbind("blur.validation"), g.removeClass("has-validation-callback").unbind("submit.validation").unbind("reset.validation").find("input[data-validation],textarea[data-validation]").unbind("blur.validation"), g.bind("submit.validation", function() {
                var b = a(this);
                if (a.formUtils.haltValidation) return !1;
                if (a.formUtils.isLoadingModules) return setTimeout(function() {
                    b.trigger("submit.validation")
                }, 200), !1;
                var d = b.isValid(c.language, c);
                if (a.formUtils.haltValidation) return !1;
                if (!d || "function" != typeof c.onSuccess) return d || "function" != typeof c.onError ? d : (c.onError(b), !1);
                var e = c.onSuccess(b);
                return e === !1 ? !1 : void 0
            }).bind("reset.validation", function() {
                a(this).find("." + c.errorMessageClass + ".alert").remove(), e(a(this).find("." + c.errorElementClass + ",.valid"), c)
            }).addClass("has-validation-callback"), c.showHelpOnFocus && g.showHelpOnFocus(), c.addSuggestions && g.addSuggestions(), c.validateOnBlur && (g.validateOnBlur(c.language, c), g.bind("html5ValidationAttrsFound", function() {
                g.validateOnBlur(c.language, c)
            })), c.validateOnEvent && g.validateOnEvent(c.language, c)
        }), "" != c.modules && a.formUtils.loadModules(c.modules, !1, function() {
            "function" == typeof c.onModulesLoaded && c.onModulesLoaded(), b.trigger("validatorsLoaded", ["string" == typeof c.form ? a(c.form) : c.form, c])
        })
    }, a.formUtils = {
        defaultConfig: function() {
            return {
                ignore: [],
                errorElementClass: "error",
                borderColorOnError: "#b94a48",
                errorMessageClass: "form-error",
                validationRuleAttribute: "data-validation",
                validationErrorMsgAttribute: "data-validation-error-msg",
                errorMessagePosition: "element",
                errorMessageTemplate: {
                    container: '<div class="{errorMessageClass} alert alert-danger">{messages}</div>',
                    messages: "<strong>{errorTitle}</strong><ul>{fields}</ul>",
                    field: "<li>{msg}</li>"
                },
                errorMessageCustom: g,
                scrollToTopOnError: !0,
                dateFormat: "yyyy-mm-dd",
                addValidClassOnAll: !1,
                decimalSeparator: ".",
                inputParentClassOnError: "has-error",
                inputParentClassOnSuccess: "has-success",
                validateHiddenInputs: !1
            }
        },
        validators: {},
        _events: {
            load: [],
            valid: [],
            invalid: []
        },
        haltValidation: !1,
        isValidatingEntireForm: !1,
        addValidator: function(a) {
            var b = 0 === a.name.indexOf("validate_") ? a.name : "validate_" + a.name;
            void 0 === a.validateOnKeyUp && (a.validateOnKeyUp = !0), this.validators[b] = a
        },
        isLoadingModules: !1,
        loadedModules: {},
        loadModules: function(c, d, e) {
            if (void 0 === e && (e = !0), a.formUtils.isLoadingModules) return void setTimeout(function() {
                a.formUtils.loadModules(c, d, e)
            });
            var f = !1,
                g = function(c, d) {
                    var g = a.split(c),
                        h = g.length,
                        i = function() {
                            h--, 0 == h && (a.formUtils.isLoadingModules = !1, e && f && ("function" == typeof e ? e() : b.trigger("validatorsLoaded")))
                        };
                    h > 0 && (a.formUtils.isLoadingModules = !0);
                    var j = "?_=" + (new Date).getTime(),
                        k = document.getElementsByTagName("head")[0] || document.getElementsByTagName("body")[0];
                    a.each(g, function(b, c) {
                        if (c = a.trim(c), 0 == c.length) i();
                        else {
                            var e = d + c + (".js" == c.slice(-3) ? "" : ".js"),
                                g = document.createElement("SCRIPT");
                            e in a.formUtils.loadedModules ? i() : (a.formUtils.loadedModules[e] = 1, f = !0, g.type = "text/javascript", g.onload = i, g.src = e + (".dev.js" == e.slice(-7) ? j : ""), g.onerror = function() {
                                "console" in window && window.console.log && window.console.log("Unable to load form validation module " + e)
                            }, g.onreadystatechange = function() {
                                ("complete" == this.readyState || "loaded" == this.readyState) && (i(), this.onload = null, this.onreadystatechange = null)
                            }, k.appendChild(g))
                        }
                    })
                };
            if (d) g(c, d);
            else {
                var h = function() {
                    var b = !1;
                    return a('script[src*="form-validator"]').each(function() {
                        return b = this.src.substr(0, this.src.lastIndexOf("/")) + "/", "/" == b && (b = ""), !1
                    }), b !== !1 ? (g(c, b), !0) : !1
                };
                h() || a(h)
            }
        },
        validateInput: function(b, c, d, e, f) {
            b.trigger("beforeValidation"), d = d || a.formUtils.defaultConfig(), c = c || a.formUtils.LANG;
            var g = b.val() || "",
                h = {
                    isValid: !0,
                    shouldChangeDisplay: !0,
                    errorMsg: ""
                },
                i = b.valAttr("optional"),
                j = !1,
                k = !1,
                l = !1,
                m = b.valAttr("if-checked");
            if (b.attr("disabled") || !b.is(":visible") && !d.validateHiddenInputs) return h.shouldChangeDisplay = !1, h;
            null != m && (j = !0, l = e.find('input[name="' + m + '"]'), l.prop("checked") && (k = !0));
            var n = !g && "number" == b[0].type;
            if (!g && "true" === i && !n || j && !k) return h.shouldChangeDisplay = d.addValidClassOnAll, h;
            var o = b.attr(d.validationRuleAttribute),
                p = !0;
            return o ? (a.split(o, function(h) {
                0 !== h.indexOf("validate_") && (h = "validate_" + h);
                var i = a.formUtils.validators[h];
                if (!i || "function" != typeof i.validatorFunction) throw new Error('Using undefined validator "' + h + '"');
                "validate_checkbox_group" == h && (b = e.find("[name='" + b.attr("name") + "']:eq(0)"));
                var j = null;
                return ("keyup" != f || i.validateOnKeyUp) && (j = i.validatorFunction(g, b, d, c, e)), j ? void 0 : (p = null, null !== j && (p = b.attr(d.validationErrorMsgAttribute + "-" + h.replace("validate_", "")), p || (p = b.attr(d.validationErrorMsgAttribute), p || (p = c[i.errorMessageKey], p || (p = i.errorMessage)))), !1)
            }, " "), "string" == typeof p ? (b.trigger("validation", !1), h.errorMsg = p, h.isValid = !1, h.shouldChangeDisplay = !0) : null === p ? h.shouldChangeDisplay = d.addValidClassOnAll : (b.trigger("validation", !0), h.shouldChangeDisplay = !0), "function" == typeof d.onElementValidate && null !== p && d.onElementValidate(h.isValid, b, e, p), h) : (h.shouldChangeDisplay = d.addValidClassOnAll, h)
        },
        parseDate: function(b, c) {
            var d, e, f, g, h = c.replace(/[a-zA-Z]/gi, "").substring(0, 1),
                i = "^",
                j = c.split(h || null);
            if (a.each(j, function(a, b) {
                    i += (a > 0 ? "\\" + h : "") + "(\\d{" + b.length + "})"
                }), i += "$", d = b.match(new RegExp(i)), null === d) return !1;
            var k = function(b, c, d) {
                for (var e = 0; e < c.length; e++)
                    if (c[e].substring(0, 1) === b) return a.formUtils.parseDateInt(d[e + 1]);
                return -1
            };
            return f = k("m", j, d), e = k("d", j, d), g = k("y", j, d), 2 === f && e > 28 && (g % 4 !== 0 || g % 100 === 0 && g % 400 !== 0) || 2 === f && e > 29 && (g % 4 === 0 || g % 100 !== 0 && g % 400 === 0) || f > 12 || 0 === f ? !1 : this.isShortMonth(f) && e > 30 || !this.isShortMonth(f) && e > 31 || 0 === e ? !1 : [g, f, e]
        },
        parseDateInt: function(a) {
            return 0 === a.indexOf("0") && (a = a.replace("0", "")), parseInt(a, 10)
        },
        isShortMonth: function(a) {
            return a % 2 === 0 && 7 > a || a % 2 !== 0 && a > 7
        },
        lengthRestriction: function(b, c) {
            var d = parseInt(c.text(), 10),
                e = 0,
                f = function() {
                    var a = b.val().length;
                    if (a > d) {
                        var f = b.scrollTop();
                        b.val(b.val().substring(0, d)), b.scrollTop(f)
                    }
                    e = d - a, 0 > e && (e = 0), c.text(e)
                };
            a(b).bind("keydown keyup keypress focus blur", f).bind("cut paste", function() {
                setTimeout(f, 100)
            }), a(document).bind("ready", f)
        },
        numericRangeCheck: function(b, c) {
            var d = a.split(c),
                e = parseInt(c.substr(3), 10);
            return 1 == d.length && -1 == c.indexOf("min") && -1 == c.indexOf("max") && (d = [c, c]), 2 == d.length && (b < parseInt(d[0], 10) || b > parseInt(d[1], 10)) ? ["out", d[0], d[1]] : 0 === c.indexOf("min") && e > b ? ["min", e] : 0 === c.indexOf("max") && b > e ? ["max", e] : ["ok"]
        },
        _numSuggestionElements: 0,
        _selectedSuggestion: null,
        _previousTypedVal: null,
        suggest: function(c, d, e) {
            var f = {
                    css: {
                        maxHeight: "150px",
                        background: "#FFF",
                        lineHeight: "150%",
                        textDecoration: "underline",
                        overflowX: "hidden",
                        overflowY: "auto",
                        border: "#CCC solid 1px",
                        borderTop: "none",
                        cursor: "pointer"
                    },
                    activeSuggestionCSS: {
                        background: "#E9E9E9"
                    }
                },
                g = function(a, b) {
                    var c = b.offset();
                    a.css({
                        width: b.outerWidth(),
                        left: c.left + "px",
                        top: c.top + b.outerHeight() + "px"
                    })
                };
            e && a.extend(f, e), f.css.position = "absolute", f.css["z-index"] = 9999, c.attr("autocomplete", "off"), 0 === this._numSuggestionElements && b.bind("resize", function() {
                a(".jquery-form-suggestions").each(function() {
                    var b = a(this),
                        c = b.attr("data-suggest-container");
                    g(b, a(".suggestions-" + c).eq(0))
                })
            }), this._numSuggestionElements++;
            var h = function(b) {
                var c = b.valAttr("suggestion-nr");
                a.formUtils._selectedSuggestion = null, a.formUtils._previousTypedVal = null, a(".jquery-form-suggestion-" + c).fadeOut("fast")
            };
            return c.data("suggestions", d).valAttr("suggestion-nr", this._numSuggestionElements).unbind("focus.suggest").bind("focus.suggest", function() {
                a(this).trigger("keyup"), a.formUtils._selectedSuggestion = null
            }).unbind("keyup.suggest").bind("keyup.suggest", function() {
                var b = a(this),
                    d = [],
                    e = a.trim(b.val()).toLocaleLowerCase();
                if (e != a.formUtils._previousTypedVal) {
                    a.formUtils._previousTypedVal = e;
                    var i = !1,
                        j = b.valAttr("suggestion-nr"),
                        k = a(".jquery-form-suggestion-" + j);
                    if (k.scrollTop(0), "" != e) {
                        var l = e.length > 2;
                        a.each(b.data("suggestions"), function(a, b) {
                            var c = b.toLocaleLowerCase();
                            return c == e ? (d.push("<strong>" + b + "</strong>"), i = !0, !1) : void((0 === c.indexOf(e) || l && c.indexOf(e) > -1) && d.push(b.replace(new RegExp(e, "gi"), "<strong>$&</strong>")))
                        })
                    }
                    i || 0 == d.length && k.length > 0 ? k.hide() : d.length > 0 && 0 == k.length ? (k = a("<div></div>").css(f.css).appendTo("body"), c.addClass("suggestions-" + j), k.attr("data-suggest-container", j).addClass("jquery-form-suggestions").addClass("jquery-form-suggestion-" + j)) : d.length > 0 && !k.is(":visible") && k.show(), d.length > 0 && e.length != d[0].length && (g(k, b), k.html(""), a.each(d, function(c, d) {
                        a("<div></div>").append(d).css({
                            overflow: "hidden",
                            textOverflow: "ellipsis",
                            whiteSpace: "nowrap",
                            padding: "5px"
                        }).addClass("form-suggest-element").appendTo(k).click(function() {
                            b.focus(), b.val(a(this).text()), h(b)
                        })
                    }))
                }
            }).unbind("keydown.validation").bind("keydown.validation", function(b) {
                var c, d, e = b.keyCode ? b.keyCode : b.which,
                    g = a(this);
                if (13 == e && null !== a.formUtils._selectedSuggestion) {
                    if (c = g.valAttr("suggestion-nr"), d = a(".jquery-form-suggestion-" + c), d.length > 0) {
                        var i = d.find("div").eq(a.formUtils._selectedSuggestion).text();
                        g.val(i), h(g), b.preventDefault()
                    }
                } else {
                    c = g.valAttr("suggestion-nr"), d = a(".jquery-form-suggestion-" + c);
                    var j = d.children();
                    if (j.length > 0 && a.inArray(e, [38, 40]) > -1) {
                        38 == e ? (null === a.formUtils._selectedSuggestion ? a.formUtils._selectedSuggestion = j.length - 1 : a.formUtils._selectedSuggestion--, a.formUtils._selectedSuggestion < 0 && (a.formUtils._selectedSuggestion = j.length - 1)) : 40 == e && (null === a.formUtils._selectedSuggestion ? a.formUtils._selectedSuggestion = 0 : a.formUtils._selectedSuggestion++, a.formUtils._selectedSuggestion > j.length - 1 && (a.formUtils._selectedSuggestion = 0));
                        var k = d.innerHeight(),
                            l = d.scrollTop(),
                            m = d.children().eq(0).outerHeight(),
                            n = m * a.formUtils._selectedSuggestion;
                        return (l > n || n > l + k) && d.scrollTop(n), j.removeClass("active-suggestion").css("background", "none").eq(a.formUtils._selectedSuggestion).addClass("active-suggestion").css(f.activeSuggestionCSS), b.preventDefault(), !1
                    }
                }
            }).unbind("blur.suggest").bind("blur.suggest", function() {
                h(a(this))
            }), c
        },
        LANG: {
            errorTitle: "Form submission failed!",
            requiredFields: "You have not answered all required fields",
            badTime: "You have not given a correct time",
            badEmail: "Unesite pravu e-mail adresu.",
            badTelephone: "You have not given a correct phone number",
            badSecurityAnswer: "You have not given a correct answer to the security question",
            badDate: "You have not given a correct date",
            lengthBadStart: "The input value must be between ",
            lengthBadEnd: " karaktera.",
            lengthTooLongStart: "The input value is longer than ",
            lengthTooShortStart: "Unesite najmanje  ",
            notConfirmed: "Input values could not be confirmed",
            badDomain: "Incorrect domain value",
            badUrl: "The input value is not a correct URL",
            badCustomVal: "The input value is incorrect",
            andSpaces: " and spaces ",
            badInt: "The input value was not a correct number",
            badSecurityNumber: "Your social security number was incorrect",
            badUKVatAnswer: "Incorrect UK VAT Number",
            badStrength: "The password isn't strong enough",
            badNumberOfSelectedOptionsStart: "You have to choose at least ",
            badNumberOfSelectedOptionsEnd: " answers",
            badAlphaNumeric: "Vrednosti mogu biti unete samo u vidu slova i brojeva, bez specijalnih karaktera. ",
            badAlphaNumericExtra: " and ",
            wrongFileSize: "The file you are trying to upload is too large (max %s)",
            wrongFileType: "Only files of type %s is allowed",
            groupCheckedRangeStart: "Please choose between ",
            groupCheckedTooFewStart: "Please choose at least ",
            groupCheckedTooManyStart: "Please choose a maximum of ",
            groupCheckedEnd: " item(s)",
            badCreditCard: "The credit card number is not correct",
            badCVV: "The CVV number was not correct",
            wrongFileDim: "Incorrect image dimensions,",
            imageTooTall: "the image can not be taller than",
            imageTooWide: "the image can not be wider than",
            imageTooSmall: "the image was too small",
            min: "min",
            max: "max",
            imageRatioNotAccepted: "Image ratio is not be accepted",
            badBrazilTelephoneAnswer: "The phone number entered is invalid",
            badBrazilCEPAnswer: "The CEP entered is invalid",
            badBrazilCPFAnswer: "The CPF entered is invalid"
        }
    }, a.formUtils.addValidator({
        name: "email",
        validatorFunction: function(b) {
            var c = b.toLowerCase().split("@"),
                d = c[0],
                e = c[1];
            if (d && e) {
                if (0 == d.indexOf('"')) {
                    var f = d.length;
                    if (d = d.replace(/\"/g, ""), d.length != f - 2) return !1
                }
                return a.formUtils.validators.validate_domain.validatorFunction(c[1]) && 0 != d.indexOf(".") && "." != d.substring(d.length - 1, d.length) && -1 == d.indexOf("..") && !/[^\w\+\.\-\#\-\_\~\!\$\&\'\(\)\*\+\,\;\=\:]/.test(d)
            }
            return !1
        },
        errorMessage: "",
        errorMessageKey: "badEmail"
    }), a.formUtils.addValidator({
        name: "domain",
        validatorFunction: function(a) {
            return a.length > 0 && a.length <= 253 && !/[^a-zA-Z0-9]/.test(a.slice(-2)) && !/[^a-zA-Z0-9]/.test(a.substr(0, 1)) && !/[^a-zA-Z0-9\.\-]/.test(a) && 1 == a.split("..").length && a.split(".").length > 1
        },
        errorMessage: "",
        errorMessageKey: "badDomain"
    }), a.formUtils.addValidator({
        name: "required",
        validatorFunction: function(b, c, d, e, f) {
            switch (c.attr("type")) {
                case "checkbox":
                    return c.is(":checked");
                case "radio":
                    return f.find('input[name="' + c.attr("name") + '"]').filter(":checked").length > 0;
                default:
                    return "" !== a.trim(b)
            }
        },
        errorMessage: "",
        errorMessageKey: "requiredFields"
    }), a.formUtils.addValidator({
        name: "length",
        validatorFunction: function(b, c, d, e) {
            var f = c.valAttr("length"),
                g = c.attr("type");
            if (void 0 == f) return alert('Please add attribute "data-validation-length" to ' + c[0].nodeName + " named " + c.attr("name")), !0;
            var h, i = "file" == g && void 0 !== c.get(0).files ? c.get(0).files.length : b.length,
                j = a.formUtils.numericRangeCheck(i, f);
            switch (j[0]) {
                case "out":
                    this.errorMessage = e.lengthBadStart + f + e.lengthBadEnd, h = !1;
                    break;
                case "min":
                    this.errorMessage = e.lengthTooShortStart + j[1] + e.lengthBadEnd, h = !1;
                    break;
                case "max":
                    this.errorMessage = e.lengthTooLongStart + j[1] + e.lengthBadEnd, h = !1;
                    break;
                default:
                    h = !0
            }
            return h
        },
        errorMessage: "",
        errorMessageKey: ""
    }), a.formUtils.addValidator({
        name: "url",
        validatorFunction: function(b) {
            var c = /^(https?|ftp):\/\/((((\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])(\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])(\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/(((\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/((\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|\[|\]|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#(((\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i;
            if (c.test(b)) {
                var d = b.split("://")[1],
                    e = d.indexOf("/");
                return e > -1 && (d = d.substr(0, e)), a.formUtils.validators.validate_domain.validatorFunction(d)
            }
            return !1
        },
        errorMessage: "",
        errorMessageKey: "badUrl"
    }), a.formUtils.addValidator({
        name: "number",
        validatorFunction: function(a, b, c) {
            if ("" !== a) {
                var d, e, f = b.valAttr("allowing") || "",
                    g = b.valAttr("decimal-separator") || c.decimalSeparator,
                    h = !1,
                    i = b.valAttr("step") || "",
                    j = !1;
                if (-1 == f.indexOf("number") && (f += ",number"), -1 == f.indexOf("negative") && 0 === a.indexOf("-")) return !1;
                if (f.indexOf("range") > -1 && (d = parseFloat(f.substring(f.indexOf("[") + 1, f.indexOf(";"))), e = parseFloat(f.substring(f.indexOf(";") + 1, f.indexOf("]"))), h = !0), "" != i && (j = !0), "," == g) {
                    if (a.indexOf(".") > -1) return !1;
                    a = a.replace(",", ".")
                }
                if (f.indexOf("number") > -1 && "" === a.replace(/[0-9-]/g, "") && (!h || a >= d && e >= a) && (!j || a % i == 0)) return !0;
                if (f.indexOf("float") > -1 && null !== a.match(new RegExp("^([0-9-]+)\\.([0-9]+)$")) && (!h || a >= d && e >= a) && (!j || a % i == 0)) return !0
            }
            return !1
        },
        errorMessage: "",
        errorMessageKey: "badInt"
    }), a.formUtils.addValidator({
        name: "alphanumeric",
        validatorFunction: function(b, c, d, e) {
            var f = "^([a-zA-Z0-9",
                g = "]+)$",
                h = c.valAttr("allowing"),
                i = "";
            if (h) {
                i = f + h + g;
                var j = h.replace(/\\/g, "");
                j.indexOf(" ") > -1 && (j = j.replace(" ", ""), j += e.andSpaces || a.formUtils.LANG.andSpaces), this.errorMessage = e.badAlphaNumeric + e.badAlphaNumericExtra + j
            } else i = f + g, this.errorMessage = e.badAlphaNumeric;
            return new RegExp(i).test(b)
        },
        errorMessage: "",
        errorMessageKey: ""
    }), a.formUtils.addValidator({
        name: "custom",
        validatorFunction: function(a, b) {
            var c = new RegExp(b.valAttr("regexp"));
            return c.test(a)
        },
        errorMessage: "",
        errorMessageKey: "badCustomVal"
    }), a.formUtils.addValidator({
        name: "date",
        validatorFunction: function(b, c, d) {
            var e = c.valAttr("format") || d.dateFormat || "yyyy-mm-dd";
            return a.formUtils.parseDate(b, e) !== !1
        },
        errorMessage: "",
        errorMessageKey: "badDate"
    }), a.formUtils.addValidator({
        name: "checkbox_group",
        validatorFunction: function(b, c, d, e, f) {
            var g = !0,
                h = c.attr("name"),
                i = a("input[type=checkbox][name^='" + h + "']", f),
                j = i.filter(":checked").length,
                k = c.valAttr("qty");
            if (void 0 == k) {
                var l = c.get(0).nodeName;
                alert('Attribute "data-validation-qty" is missing from ' + l + " named " + c.attr("name"))
            }
            var m = a.formUtils.numericRangeCheck(j, k);
            switch (m[0]) {
                case "out":
                    this.errorMessage = e.groupCheckedRangeStart + k + e.groupCheckedEnd, g = !1;
                    break;
                case "min":
                    this.errorMessage = e.groupCheckedTooFewStart + m[1] + e.groupCheckedEnd, g = !1;
                    break;
                case "max":
                    this.errorMessage = e.groupCheckedTooManyStart + m[1] + e.groupCheckedEnd, g = !1;
                    break;
                default:
                    g = !0
            }
            if (!g) {
                var n = function() {
                    i.unbind("click", n), i.filter("*[data-validation]").validateInputOnBlur(e, d, !1, "blur")
                };
                i.bind("click", n)
            }
            return g
        }
    })
}(jQuery);