_Home = (function() {

  _onLoaded = function() {
    _getHotProduct();
  }

  _getHotProduct = function() {
    $.ajax({
      type: 'GET',
      url: '/ajax/highlight-product/hot',
      dataType: 'json',
      success: function(response) {
        if (response.data) {
          _data = response.data;
          if (_data.length > 0) {
            _setEmpty();
            $.each(_data, function(key, val) {
              _appendProduct(val);
            });
            _setOwlCarousel();
          } else {
            $('div.loading-product').hide();
            $('div.not-available-content').show();
          }
        }
      },
      error: function(response) {

      }
    });
  }

  _setEmpty = function() {
    $('div.product-slider').html('');
  }

  _setOwlCarousel = function() {
      $('.product-slider').owlCarousel({
      	navigation: true, // Show next and prev buttons
      	slideSpeed: 300,
      	paginationSpeed: 400,
      	afterInit: function() {
      	    $('.product-slider .item').css('visibility', 'visible');
      	}
      });
  }

  _appendProduct = function(product) {
    _baseUrl = window.location.href+'images/';
    _front = _defineImage(product.images, 'front');
    _back = _defineImage(product.images, 'back');
    _flags = _defineFlag(product.new);
    _pathCategory = product.categories;
    _urlPath = _appBaseUrl+'/s/'+_pathCategory.join('/')+'/'+product.slug;
    _element = $('<div class="item">'
          +'<div class="product">'
              +'<div class="flip-container">'
                  +'<div class="flipper">'
                      +'<div class="front">'
                          +'<a href="'+_urlPath+'">'
                              +'<img src="'+_front+'" alt="" class="img-responsive lazy img-front img-item-height">'
                          +'</a>'
                      +'</div>'
                      +'<div class="back">'
                          +'<a href="'+_urlPath+'">'
                              +'<img src="'+_back+'" alt="" class="img-responsive lazy img-back img-item-height">'
                          +'</a>'
                      +'</div>'
                  +'</div>'
              +'</div>'
              +'<a href="'+_urlPath+'" class="invisible">'
                  +'<img src="'+_front+'" alt="" class="img-responsive lazy img-invisible img-item-height">'
              +'</a>'
              +'<div class="text">'
                  +'<h3><a href="'+_urlPath+'">'+product.name+'</a></h3>'
                  +'<p class="price">'+_Helper._currency(product.price, 'Rp.')+'</p>'
              +'</div>'
              +_flags
          +'</div>'
      +'</div>');
    $('div.product-slider').append(_element);
    _Helper._detectErrorImg(_element.find('.img-front'));
    _Helper._detectErrorImg(_element.find('.img-back'));
    _Helper._detectErrorImg(_element.find('.img-invisible'));

  }

  return {
    _onLoaded: _onLoaded
  }
})();

_Home._onLoaded();
