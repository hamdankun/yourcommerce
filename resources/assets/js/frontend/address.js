var _elm = $(document);
_Module = (function($) {
  _onLoaded = function() {
    _getCountry();
    _defineValidator($('.form-address'));
  }

  _getCountry = function() {
    _Service._get(_appBaseUrl+'/ajax/country', {}, function(response) {
      if (response.countries) {
        _option = '<option value=""></option>';
        $.each(response.countries, function(key, val) {
          _option += '<option value="'+val.id+'">['+val.code+']-'+val.name+'</option>';
        });
        $('#country').html(_option);
        $('#country').val(_currentCountry).trigger('change');
        _Helper._defineSelect2($('#country'), 'Select Country');
      }
    });
  };

  return {
    _onLoaded: _onLoaded
  }
})(jQuery);

_Module._onLoaded();
