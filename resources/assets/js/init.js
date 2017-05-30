var _delayProses = false;
window.paceOptions = paceOptions = {
  // Disable the 'elements' source
  elements: false,
  restartOnRequestAfter: false
}

_App = (function() {
  _onInit = function() {
    _callLazyLoad();
    _peaceJs();
  }

  _callLazyLoad = function() {
    $('img.lazy').lazy();
  }

  _peaceJs = function() {
    $(document).ajaxStart(function() {
      Pace.restart()
    });
  }

  return {
    _onInit : _onInit,
    _callLazyLoad: _callLazyLoad
  }
})();

_App._onInit();

// helpers function
_Helper = (function() {

  _currency = function(nominal, type) {
    _n = String(nominal).split('').reverse().join("");
    _n2 = _n.replace(/\d\d\d(?!$)/g, "$&,");
    return type +' '+ _n2.split('').reverse().join('');
  }


  _defineImage = function(images, type) {
    _images = images.filter(function(image) {
      return image.type === type;
    });
    _first = function(image) { return !!image }
    _image = _images.find(_first);

    if (_image) {
      _path = _image.path;
    } else {
      _path = '/images/default.jpg';
    }

    return _path
  }

  _defineFlag = function(newItem) {
    _flags = '<div class="ribbon sale">'
                      +'<div class="theribbon">SALE</div>'
                      +'<div class="ribbon-background"></div>'
                  +'</div>';

    if (newItem) {
      _flags += '<div class="ribbon new">'
          +'<div class="theribbon">NEW</div>'
          +'<div class="ribbon-background"></div>'
      +'</div>';
    }

    return _flags;
  }

  _scrollTop = function(number) {
    $("body").animate({ scrollTop: number === undefined ? 0 : number }, 600);
  }

  _detectErrorImg = function(selector) {
    $(selector).on('error', function() {
      $(this).attr('src', _appBaseUrl+'/images/default.jpg');
    });
  }

  _isEmpty = function (obj) {
    for(_prop in obj) {
      if(obj.hasOwnProperty(_prop))
        return false;
    }
    return true;
  }

  _delayAction = function(callback, delay) {

    if (_delayProses) {
      clearTimeout(_delayProses);
    }

    _delayProses = setTimeout(function () {
      callback();
    }, delay ? delay : 500);
  }

  _disableArea = function(disable) {
    if (disable) {
      $(document).find('a').addClass('disable-link');
      $(document).find('button').prop('disabled', true);
    } else {
      $(document).find('a').removeClass('disable-link');
      $(document).find('button').prop('disabled', false);
    }
  }

  _defineSelect2 = function(selector, placeholder) {
    selector.select2({
      placeholder: placeholder,
      allowClear: true
    });
  }

  _disableBtn = function(selector) {
    selector.addClass('disable-link').html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
  }

  return {
    _currency: _currency,
    _defineFlag: _defineFlag,
    _defineImage: _defineImage,
    _scrollTop: _scrollTop,
    _detectErrorImg: _detectErrorImg,
    _isEmpty: _isEmpty,
    _delayAction: _delayAction,
    _disableArea: _disableArea,
    _defineSelect2: _defineSelect2,
    _disableBtn: _disableBtn
  }

})();

// service ajax
_Service = (function() {
  _ajax = function(url, method, data, onSuccess, onError, dataType) {

    _method = method;

    if ($.inArray(method, ['PUT', 'DELETE']) >= 0) {
      method = 'POST';
    }


    if (method === 'POST') {
      data['_token'] = $('meta[name="csrf-token"]').attr('content');
      data['_method'] = _method;
    }

    $.ajax({
      type: method,
      url: url,
      dataType: dataType === undefined ? 'json' : dataType,
      data: data,
      success: onSuccess,
      error: onError
    });
  }

  _get = function(url, parameters, onSuccess, onError, dataType) {
    return _ajax(url, 'GET', parameters, onSuccess, onError, dataType);
  }

  _post = function(url, data, onSuccess, onError, dataType) {
    return _ajax(url, 'POST', data, onSuccess, onError, dataType);
  }

  _put = function(url, data, onSuccess, onError, dataType) {
    return _ajax(url, 'PUT', data, onSuccess, onError, dataType);
  }

  _delete = function(url, parameters, onSuccess, onError, dataType) {
    return _ajax(url, 'DELETE', parameters, onSuccess, onError, dataType);
  }

  return {
    _ajax: _ajax,
    _get: _get,
    _post: _post,
    _put: _put,
    _delete: _delete
  }
})();


$(document).on('click', '.disabled-when[data-trigger=click]', function(e) {
  _Helper._disableBtn($(this));
});
