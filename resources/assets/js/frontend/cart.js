var _elm = $(document);
_Cart = (function($) {

  var _refUrl = _appBaseUrl+'/ajax/cart';
  var _cartOverview = $('.cart-overview .navbar-btn span');
  var _cartSubTotal = $('.cart-sub-total');
  var _cartTax = $('.cart-tax');
  var _cartTotal = $('.cart-total');

  _onLoaded = function() {
    _showAllCart();
  }

  _showAllCart = function() {
    _Service._get(_refUrl, {}, function(response) {

      if (response.count) {
        _cartOverview.html(response.count+' items in cart');
      }

      _changeSummary(response);
    });
  }

  _showOneCart = function(rowId) {
    _Service._get(_refUrl+'/'+rowId, {}, function(response) {
      console.log(response);
    });
  }

  _addCart = function(slug, callback) {
    _Service._post(_refUrl, { slug: slug }, function(response) {

      if (response.count) {
        _cartOverview.html(response.count+' items in cart');
        callback(response);
      }

    });
  }

  _updateCart = function(rowId, data, callback) {
    _Service._put(_refUrl+'/'+rowId, data, function(response) {
      _changeSummary(response);
      callback(response);
    });
  }

  _deleteCart = function(rowId, callback) {
    _Service._delete(_refUrl+'/'+rowId, {}, function(response) {
      _changeSummary(response);
      callback(response);
    });
  }

  _destroyCart = function(rowId) {
    _Service._deleteAll(_refUrl+'/'+rowId, {}, function(response) {
      _changeSummary(response);
    });
  }

  _changeSummary = function(cart) {
    if (cart) {
      _cartSubTotal.html(cart.sub_total);
      _cartTax.html(cart.taxt);
      _cartTotal.html(cart.total);
      _cartOverview.html(cart.count+' items in cart');
    }
  }

  return {
    _onLoaded: _onLoaded,
    _showAllCart: _showAllCart,
    _showOneCart: _showOneCart,
    _addCart: _addCart,
    _updateCart: _updateCart,
    _deleteCart: _deleteCart,
    _destroyCart: _destroyCart
  }
})(jQuery);

_Cart._onLoaded();

_elm.on('click', '.add-to-cart', function(e) {
  e.preventDefault();
  _this = $(this);
  _this.addClass('disable-link');
  _Helper._disableBtn(_this);
  _Cart._addCart($(this).data('slug'), function(cart) {
    _this.removeClass('disable-link').html('<i class="fa fa-shopping-cart"></i> Add to cart');
  });
});
