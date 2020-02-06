/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
module.exports = __webpack_require__(6);


/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

Nova.booting(function (Vue, router, store) {
    Vue.component('welcome', __webpack_require__(2));
});

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(3)
/* script */
var __vue_script__ = __webpack_require__(4)
/* template */
var __vue_template__ = __webpack_require__(5)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/Card.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-b9bc2c0a", Component.options)
  } else {
    hotAPI.reload("data-v-b9bc2c0a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 3 */
/***/ (function(module, exports) {

/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file.
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = injectStyles
  }

  if (hook) {
    var functional = options.functional
    var existing = functional
      ? options.render
      : options.beforeCreate

    if (!functional) {
      // inject component registration as beforeCreate hook
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    } else {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return existing(h, context)
      }
    }
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),
/* 4 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "Welcome",

  props: {
    card: Object
  }
});

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "flex justify-center items-centers" }, [
    _c(
      "div",
      { staticClass: "w-full max-w-xl" },
      [
        _c("heading", { staticClass: "flex mb-3" }, [_vm._v("Welcome")]),
        _vm._v(" "),
        _c("p", { staticClass: "text-90 leading-tight mb-8" }, [
          _vm._v(
            "These forms are designed to help us understand your communication needs so we may effectively get your message out to your audience. Should you need any help along the way, or you are not sure what to fill out, please call us at 2204 or email Karla karla.neufeld@cschurch.ca."
          )
        ]),
        _vm._v(" "),
        _c("card", [
          _c(
            "table",
            {
              staticClass: "w-full",
              attrs: { cellpadding: "0", cellspacing: "0" }
            },
            [
              _c("tr", [
                _c(
                  "td",
                  {
                    staticClass: "align-top w-1/2 border-r border-b border-50"
                  },
                  [
                    _c(
                      "router-link",
                      {
                        staticClass: "no-underline dim flex p-6",
                        attrs: { to: { path: "/resources/projects" } }
                      },
                      [
                        _c(
                          "div",
                          [
                            _c(
                              "heading",
                              { staticClass: "mb-3", attrs: { level: 3 } },
                              [_vm._v("Event Request")]
                            ),
                            _vm._v(" "),
                            _c("p", { staticClass: "text-90 leading-normal" }, [
                              _vm._v(
                                "For events you have that you want us to upload to the website and promote in various ways"
                              )
                            ])
                          ],
                          1
                        )
                      ]
                    )
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "td",
                  { staticClass: "align-top w-1/2 border-b border-50" },
                  [
                    _c(
                      "router-link",
                      {
                        staticClass: "no-underline dim flex p-6",
                        attrs: { to: { path: "/resources/projects" } }
                      },
                      [
                        _c(
                          "div",
                          [
                            _c(
                              "heading",
                              { staticClass: "mb-3", attrs: { level: 3 } },
                              [_vm._v("Project Request")]
                            ),
                            _vm._v(" "),
                            _c("p", { staticClass: "text-90 leading-normal" }, [
                              _vm._v(
                                "Non-event related- Like a brochure for ministry fair or a ministry calendar"
                              )
                            ])
                          ],
                          1
                        )
                      ]
                    )
                  ],
                  1
                )
              ]),
              _vm._v(" "),
              _c("tr", [
                _c(
                  "td",
                  {
                    staticClass: "align-top w-1/2 border-r border-b border-50"
                  },
                  [
                    _c(
                      "router-link",
                      {
                        staticClass: "no-underline dim flex p-6",
                        attrs: { to: { path: "/resources/copies" } }
                      },
                      [
                        _c(
                          "div",
                          [
                            _c(
                              "heading",
                              { staticClass: "mb-3", attrs: { level: 3 } },
                              [_vm._v("Copy Request")]
                            ),
                            _vm._v(" "),
                            _c("p", { staticClass: "text-90 leading-normal" }, [
                              _vm._v(
                                "This is your go to form if you need to print, copy, or reprint anything"
                              )
                            ])
                          ],
                          1
                        )
                      ]
                    )
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "td",
                  { staticClass: "align-top w-1/2 border-b border-50" },
                  [
                    _c(
                      "router-link",
                      {
                        staticClass: "no-underline dim flex p-6",
                        attrs: { to: { path: "/resources/video" } }
                      },
                      [
                        _c(
                          "div",
                          [
                            _c(
                              "heading",
                              { staticClass: "mb-3", attrs: { level: 3 } },
                              [_vm._v("Video Request")]
                            ),
                            _vm._v(" "),
                            _c("p", { staticClass: "text-90 leading-normal" }, [
                              _vm._v(
                                "Any video related items- like promo videos, life change videos, etc."
                              )
                            ])
                          ],
                          1
                        )
                      ]
                    )
                  ],
                  1
                )
              ]),
              _vm._v(" "),
              _c("tr", [
                _c(
                  "td",
                  {
                    staticClass: "align-top w-1/2 border-r border-b border-50"
                  },
                  [
                    _c(
                      "router-link",
                      {
                        staticClass: "no-underline dim flex p-6",
                        attrs: { to: { path: "/resources/web_-edits" } }
                      },
                      [
                        _c(
                          "div",
                          [
                            _c(
                              "heading",
                              { staticClass: "mb-3", attrs: { level: 3 } },
                              [_vm._v("Web Edit Request")]
                            ),
                            _vm._v(" "),
                            _c("p", { staticClass: "text-90 leading-normal" }, [
                              _vm._v(
                                "Use this if you need an edit to the website or have an idea for the web"
                              )
                            ])
                          ],
                          1
                        )
                      ]
                    )
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "td",
                  { staticClass: "align-top w-1/2 border-b border-50" },
                  [
                    _c(
                      "router-link",
                      {
                        staticClass: "no-underline dim flex p-6",
                        attrs: { to: { path: "/resources/approvals" } }
                      },
                      [
                        _c(
                          "div",
                          [
                            _c(
                              "heading",
                              { staticClass: "mb-3", attrs: { level: 3 } },
                              [_vm._v("Approval Request")]
                            ),
                            _vm._v(" "),
                            _c("p", { staticClass: "text-90 leading-normal" }, [
                              _vm._v(
                                "Do you have a design we did not create you would like to use? Upload it here, and we will let you know if it needs to be tweaked to represent CSC adequately"
                              )
                            ])
                          ],
                          1
                        )
                      ]
                    )
                  ],
                  1
                )
              ]),
              _vm._v(" "),
              _c("tr", [
                _c(
                  "td",
                  {
                    staticClass: "align-top w-1/2 border-r border-b border-50"
                  },
                  [
                    _c(
                      "router-link",
                      {
                        staticClass: "no-underline dim flex p-6",
                        attrs: { to: { path: "/resources/staffnets" } }
                      },
                      [
                        _c(
                          "div",
                          [
                            _c(
                              "heading",
                              { staticClass: "mb-3", attrs: { level: 3 } },
                              [_vm._v("Staffnet Request")]
                            ),
                            _vm._v(" "),
                            _c("p", { staticClass: "text-90 leading-normal" }, [
                              _vm._v(
                                "Would like something uploaded/changed on staffnet?"
                              )
                            ])
                          ],
                          1
                        )
                      ]
                    )
                  ],
                  1
                ),
                _vm._v(" "),
                _c("td", { staticClass: "align-top w-1/2 border-b border-50" })
              ])
            ]
          )
        ])
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-b9bc2c0a", module.exports)
  }
}

/***/ }),
/* 6 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);