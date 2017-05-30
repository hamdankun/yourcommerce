_elm = $(document);
_Module = (function($) {
  _onLoaded = function() {
    _Helper._detectErrorImg('img');
  }

  return {
    _onLoaded: _onLoaded
  }
})(jQuery);

_Module._onLoaded();
