/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
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
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/frontend/cart.js":
/***/ (function(module, exports) {

var _elm = $(document);
_Cart = function ($) {

  var _refUrl = _appBaseUrl + '/ajax/cart';
  var _cartOverview = $('.cart-overview .navbar-btn span');
  var _cartSubTotal = $('.cart-sub-total');
  var _cartTax = $('.cart-tax');
  var _cartTotal = $('.cart-total');

  _onLoaded = function _onLoaded() {
    _showAllCart();
  };

  _showAllCart = function _showAllCart() {
    _Service._get(_refUrl, {}, function (response) {

      if (response.count) {
        _cartOverview.html(response.count + ' items in cart');
      }

      _changeSummary(response);
    });
  };

  _showOneCart = function _showOneCart(rowId) {
    _Service._get(_refUrl + '/' + rowId, {}, function (response) {
      console.log(response);
    });
  };

  _addCart = function _addCart(slug, callback) {
    _Service._post(_refUrl, { slug: slug }, function (response) {

      if (response.count) {
        _cartOverview.html(response.count + ' items in cart');
        callback(response);
      }
    });
  };

  _updateCart = function _updateCart(rowId, data, callback) {
    _Service._put(_refUrl + '/' + rowId, data, function (response) {
      _changeSummary(response);
      callback(response);
    });
  };

  _deleteCart = function _deleteCart(rowId, callback) {
    _Service._delete(_refUrl + '/' + rowId, {}, function (response) {
      _changeSummary(response);
      callback(response);
    });
  };

  _destroyCart = function _destroyCart(rowId) {
    _Service._deleteAll(_refUrl + '/' + rowId, {}, function (response) {
      _changeSummary(response);
    });
  };

  _changeSummary = function _changeSummary(cart) {
    if (cart) {
      _cartSubTotal.html(cart.sub_total);
      _cartTax.html(cart.taxt);
      _cartTotal.html(cart.total);
      _cartOverview.html(cart.count + ' items in cart');
    }
  };

  return {
    _onLoaded: _onLoaded,
    _showAllCart: _showAllCart,
    _showOneCart: _showOneCart,
    _addCart: _addCart,
    _updateCart: _updateCart,
    _deleteCart: _deleteCart,
    _destroyCart: _destroyCart
  };
}(jQuery);

_Cart._onLoaded();

_elm.on('click', '.add-to-cart', function (e) {
  e.preventDefault();
  _this = $(this);
  _this.addClass('disable-link');
  _Helper._disableBtn(_this);
  _Cart._addCart($(this).data('slug'), function (cart) {
    _this.removeClass('disable-link').html('<i class="fa fa-shopping-cart"></i> Add to cart');
  });
});

/***/ }),

/***/ 3:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/frontend/cart.js");


/***/ })

/******/ });