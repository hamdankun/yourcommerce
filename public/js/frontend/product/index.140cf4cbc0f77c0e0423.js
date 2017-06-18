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
/******/ 	return __webpack_require__(__webpack_require__.s = 9);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/frontend/product/index.js":
/***/ (function(module, exports) {

var _elm = $(document);
var _perPage = 16;
var _sortingBy = 'new';
_Module = function ($) {

  _onLoaded = function _onLoaded() {
    _getProductByCategory({ page: 1, per_page: 16, sorting_by: _sortingBy });
    _ProductService._getCategory();
  };

  _getProductByCategory = function _getProductByCategory(config) {
    _pageLoader(true);
    $('div.products .content').html();
    _Service._get(_appBaseUrl + '/ajax/product/category/' + _category, config, function (response) {
      if (response) {
        _product = response.data;
        $('div.products .content').html('');
        if (_product.data.length) {
          $.each(_product.data, function (key, value) {
            _appendProduct(value);
          });
          _initPagination(_product);
        } else {
          $('div.not-available-content').fadeIn();
        }
        _pageLoader(false);
      }
    });
  };

  _initPagination = function _initPagination(product, onInit) {
    $('.pagination').twbsPagination({
      totalPages: product.last_page,
      visiblePages: 7,
      startPage: product.current_page,
      onPageClick: function onPageClick(event, page) {
        _Helper._scrollTop(50);
        _getProductByCategory({ page: page, per_page: _perPage, sorting_by: _sortingBy });
      }
    });
  };

  _pageLoader = function _pageLoader(status) {
    if (status) {
      $('div.overlay').fadeIn();
    } else {
      $('div.overlay').fadeOut();
    }
  };

  _appendProduct = function _appendProduct(product) {
    _front = _Helper._defineImage(product.images, 'front');
    _back = _Helper._defineImage(product.images, 'back');
    _flags = _Helper._defineFlag(product.new);
    _urlAction = _pathCategory + '/' + product.slug;
    _element = $('<div class="col-md-4 col-sm-6">' + '<div class="product">' + '<div class="flip-container">' + '<div class="flipper">' + '<div class="front">' + '<a href="' + _urlAction + '">' + '<img src="' + _front + '" alt="" class="img-responsive img-front">' + '</a>' + '</div>' + '<div class="back">' + '<a href="' + _urlAction + '">' + '<img src="' + _back + '" alt="" class="img-responsive img-back">' + '</a>' + '</div>' + '</div>' + '</div>' + '<a href="' + _urlAction + '" class="invisible">' + '<img src="' + _front + '" alt="" class="img-responsive img-invisible">' + '</a>' + '<div class="text">' + '<h3><a href="' + _urlAction + '">' + product.name + '</a></h3>' + '<p class="price">' + _Helper._currency(product.price, 'Rp.') + '</p>' + '<p class="buttons">' + '<a href="' + _urlAction + '" class="btn btn-default disabled-when" data-trigger="click">View detail</a>' + '<a href="#" data-slug="' + product.slug + '" class="btn btn-primary add-to-cart ><i class="fa fa-shopping-cart"></i>Add to cart</a>' + '</p>' + '</div>' + '</div>' + '</div>');
    $('div.products .content').append(_element);
    _Helper._detectErrorImg(_element.find('.img-front'));
    _Helper._detectErrorImg(_element.find('.img-back'));
    _Helper._detectErrorImg(_element.find('.img-invisible'));
  };

  _refreshProduct = function _refreshProduct(config) {
    $('.pagination').twbsPagination('destroy');
    _perPage = config.per_page === undefined ? _perPage : config.per_page;
    _sortingBy = config.sorting_by === undefined ? _sortingBy : config.sorting_by;
    _getProductByCategory({ page: 1, per_page: _perPage, sorting_by: _sortingBy });
  };

  return {
    _onLoaded: _onLoaded,
    _refreshProduct: _refreshProduct
  };
}(jQuery);

_Module._onLoaded();

_elm.on('click', 'div.show-options a', function (e) {
  e.preventDefault();
  _this = $(this);
  _this.parent().find('a').removeClass('btn-primary');
  _this.addClass('btn-primary');
  _Module._refreshProduct({ per_page: _this.data('show') });
});

_elm.on('change', '.sort-by', function () {
  _Module._refreshProduct({ sorting_by: $(this).val() });
});

/***/ }),

/***/ 9:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/frontend/product/index.js");


/***/ })

/******/ });