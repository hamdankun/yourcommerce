var _elm = $(document);
_Module = (function($) {

  _onLoaded = function() {
    _Helper._defineValidator($('.form-register'));
  }

  return {
    _onLoaded: _onLoaded
  }
}) (jQuery);

_Module._onLoaded();
