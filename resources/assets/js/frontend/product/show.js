_Module = (function($) {
  _onLoaded = function() {
    _ProductService._getCategory();
  }

  return {
    _onLoaded: _onLoaded
  }
})(jQuery);


_Module._onLoaded();
