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
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/frontend/home.js":
/***/ (function(module, exports) {

_Home = function () {

  _onLoaded = function _onLoaded() {
    _getHotProduct();
  };

  _getHotProduct = function _getHotProduct() {
    $.ajax({
      type: 'GET',
      url: '/ajax/highlight-product/hot',
      dataType: 'json',
      success: function success(response) {
        if (response.data) {
          _data = response.data;
          if (_data.length > 0) {
            _setEmpty();
            $.each(_data, function (key, val) {
              _appendProduct(val);
            });
            _setOwlCarousel();
          } else {
            $('div.loading-product').hide();
            $('div.not-available-content').show();
          }
        }
      },
      error: function error(response) {}
    });
  };

  _setEmpty = function _setEmpty() {
    $('div.product-slider').html('');
  };

  _setOwlCarousel = function _setOwlCarousel() {
    $('.product-slider').owlCarousel({
      navigation: true, // Show next and prev buttons
      slideSpeed: 300,
      paginationSpeed: 400,
      afterInit: function afterInit() {
        $('.product-slider .item').css('visibility', 'visible');
      }
    });
  };

  _appendProduct = function _appendProduct(product) {
    _baseUrl = window.location.href + 'images/';
    _front = _defineImage(product.images, 'front');
    _back = _defineImage(product.images, 'back');
    _flags = _defineFlag(product.new);
    _pathCategory = product.categories;
    _urlPath = _appBaseUrl + '/s/' + _pathCategory.join('/') + '/' + product.slug;
    _element = $('<div class="item">' + '<div class="product">' + '<div class="flip-container">' + '<div class="flipper">' + '<div class="front">' + '<a href="' + _urlPath + '">' + '<img src="' + _front + '" alt="" class="img-responsive lazy img-front img-item-height">' + '</a>' + '</div>' + '<div class="back">' + '<a href="' + _urlPath + '">' + '<img src="' + _back + '" alt="" class="img-responsive lazy img-back img-item-height">' + '</a>' + '</div>' + '</div>' + '</div>' + '<a href="' + _urlPath + '" class="invisible">' + '<img src="' + _front + '" alt="" class="img-responsive lazy img-invisible img-item-height">' + '</a>' + '<div class="text">' + '<h3><a href="' + _urlPath + '">' + product.name + '</a></h3>' + '<p class="price">' + _Helper._currency(product.price, 'Rp.') + '</p>' + '</div>' + _flags + '</div>' + '</div>');
    $('div.product-slider').append(_element);
    _Helper._detectErrorImg(_element.find('.img-front'));
    _Helper._detectErrorImg(_element.find('.img-back'));
    _Helper._detectErrorImg(_element.find('.img-invisible'));
  };

  return {
    _onLoaded: _onLoaded
  };
}();

_Home._onLoaded();

/***/ }),

/***/ 5:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/frontend/home.js");


/***/ })

/******/ });