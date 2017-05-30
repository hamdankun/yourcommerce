var _elm = $(document);
var _perPage = 16;
var _sortingBy = 'new';
_Module = (function($) {

  _onLoaded = function() {
    _getProductByCategory({page: 1, per_page: 16, sorting_by: _sortingBy});
  }

  _getProductByCategory = function(config) {
    _pageLoader(true);
    $('div.products .content').html();
    _Service._get(_appBaseUrl+'/ajax/product/category/'+_category, config, function(response) {
      if (response) {
        _product = response.data
        $('div.products .content').html('')
        if (_product.data.length) {
          $.each(_product.data, function(key, value) {
            _appendProduct(value);
          });
          _initPagination(_product);
        } else {
          $('div.not-available-content').fadeIn();
        }
        _pageLoader(false);
      }
    });
  }

  _initPagination = function(product, onInit) {
    $('.pagination').twbsPagination({
         totalPages: product.last_page,
         visiblePages: 7,
         startPage: product.current_page,
         onPageClick: function (event, page) {
           _Helper._scrollTop(50);
           _getProductByCategory({page: page, per_page: _perPage, sorting_by: _sortingBy});
         }
     });
  }

  _pageLoader = function(status) {
    if (status) {
      $('div.overlay').fadeIn();
    } else {
      $('div.overlay').fadeOut();
    }
  }

  _appendProduct = function(product) {
    _front = _Helper._defineImage(product.images, 'front');
    _back = _Helper._defineImage(product.images, 'back');
    _flags = _Helper._defineFlag(product.new);
    _urlAction = _pathCategory+'/'+product.slug;
    _element = $('<div class="col-md-4 col-sm-6">'
        +'<div class="product">'
            +'<div class="flip-container">'
                +'<div class="flipper">'
                    +'<div class="front">'
                        +'<a href="'+_urlAction+'">'
                            +'<img src="'+_front+'" alt="" class="img-responsive img-front">'
                        +'</a>'
                    +'</div>'
                    +'<div class="back">'
                        +'<a href="'+_urlAction+'">'
                          +'<img src="'+_back+'" alt="" class="img-responsive img-back">'
                        +'</a>'
                    +'</div>'
                +'</div>'
            +'</div>'
            +'<a href="'+_urlAction+'" class="invisible">'
                +'<img src="'+_front+'" alt="" class="img-responsive img-invisible">'
            +'</a>'
            +'<div class="text">'
                +'<h3><a href="'+_urlAction+'">'+product.name+'</a></h3>'
                +'<p class="price">'+_Helper._currency(product.price, 'Rp.')+'</p>'
                +'<p class="buttons">'
                    +'<a href="'+_urlAction+'" class="btn btn-default">View detail</a>'
                    +'<a href="#" data-slug="'+product.slug+'" class="btn btn-primary add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>'
                +'</p>'
            +'</div>'
        +'</div>'
    +'</div>');
    $('div.products .content').append(_element);
    _Helper._detectErrorImg(_element.find('.img-front'));
    _Helper._detectErrorImg(_element.find('.img-back'));
    _Helper._detectErrorImg(_element.find('.img-invisible'));
  }

  _refreshProduct = function(config) {
    $('.pagination').twbsPagination('destroy');
    _perPage = config.per_page === undefined ? _perPage : config.per_page;
    _sortingBy = config.sorting_by === undefined ? _sortingBy : config.sorting_by;
    _getProductByCategory({page:1, per_page: _perPage, sorting_by: _sortingBy});
  }

  return {
    _onLoaded: _onLoaded,
    _refreshProduct: _refreshProduct
  }

})(jQuery);

_Module._onLoaded();

_elm.on('click', 'div.show-options a', function(e) {
  e.preventDefault();
  _this = $(this);
  _this.parent().find('a').removeClass('btn-primary');
  _this.addClass('btn-primary');
  _Module._refreshProduct({ per_page: _this.data('show') });
});

_elm.on('change', '.sort-by', function() {
  _Module._refreshProduct({ sorting_by: $(this).val() });
});
