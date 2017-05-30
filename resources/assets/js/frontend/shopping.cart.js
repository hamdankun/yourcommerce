var _elm = $(document);
var _prevValQty = 1;
_Module = (function($) {
  _onLoaded = function() {

  }
})(jQuery);

_elm.on('click', '.remove-from-cart', function(e) {
  e.preventDefault();
  _this = $(this);
  _this.addClass('disable-link');
  _table = _this.parent().parent().parent();
  _this.html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i>');
  _Cart._deleteCart($(this).data('id'), function() {
    _this.removeClass('disable-link');
    _this.parent().parent().remove();
    _countItem = _table.find('tr').length;
    if (_countItem <= 0) {
      _table.append('<tr><td colspan="7" class="text-center blue-font">No items in the cart</td></tr>');
    }
  });
});

_elm.on('focusin', '.cart-qty', function() {
  _prevValQty = $(this).val();
});

_elm.on('input', '.cart-qty', function() {
  _this = $(this);
  _qty = _this.val();
  _Helper._disableArea(true);
  _Helper._delayAction(function() {

    if ($.isNumeric(_qty) && _qty > 0) {
      _Cart._updateCart(_this.data('id'), { qty: _qty }, function(response) {
        _product = response.data;
        _subTotal = _product.price * _product.qty;
        _this.parent().parent().children('td:eq(5)').html(_Helper._currency(_subTotal, ''));
        _Helper._disableArea(false);
      });
    } else {
      _this.val(($.isNumeric(_prevValQty) ? (_prevValQty > 0 ? _prevValQty : 1) : 1));
      _Helper._disableArea(false);
    }

  })
});

_elm.on('click', '.checkout', function(e) {
  _this = $(this);
  _this.html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
  _this.addClass('disable-link');
});
