@extends('layouts.frontend')

@section('js-variables')
  var _category = '{{ $category }}';
  var breadcrumbs = JSON.parse('{!! json_encode($breadcrumbs) !!}');
  var _pathCategory = _appBaseUrl+'/p/'+breadcrumbs.join('/');
@endsection

@section('content')
<div id="content">
    <div class="container">

        @include('layouts.partials._breadcrumbs')
        @include('layouts.partials._filter')

        <div class="col-md-9">

            <div class="row" id="productMain">
                <div class="col-sm-6">
                    <div id="mainImage">
                        <img data-src="{{ $product->images->first()->path }}" alt="" class="img-responsive lazy">
                    </div>

                    <div class="ribbon sale">
                        <div class="theribbon">SALE</div>
                        <div class="ribbon-background"></div>
                    </div>
                    <!-- /.ribbon -->
                    @if($product->new)
                      <div class="ribbon new">
                          <div class="theribbon">NEW</div>
                          <div class="ribbon-background"></div>
                      </div>
                    @endif
                    <!-- /.ribbon -->

                </div>
                <div class="col-sm-6">
                    <div class="box">
                        <h1 class="text-center">{{ $product->name }}</h1>
                        <p class="goToDescription"><a href="#details" class="scroll-to">Scroll to product details, material & care and sizing</a>
                        </p>
                        <p class="price">{{ currency($product->price, 'ID') }}</p>

                        <p class="text-center buttons">
                            <a href="#" data-slug="{{ $product->slug }}" class="btn btn-primary add-to-cart"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                            <a href="#" data-slug="{{ $product->slug }}" class="btn btn-default add-to-wishlist"><i class="fa fa-heart"></i> Add to wishlist</a>
                        </p>


                    </div>

                    <div class="row" id="thumbs">
                      @foreach($product->images as $key => $image)
                        <div class="col-xs-4">
                            <a href="{{ $image->path }}" class="thumb">
                                <img data-src="{{ $image->path }}" alt="" class="img-responsive lazy height-auto">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>


            <div class="box" id="details">
                <p>

                    {!! $product->description !!}

                    <div class="social">
                        <h4>Show it to your friends</h4>
                        <p>
                            <a href="#" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                        </p>
                    </div>
            </div>

            <div class="row same-height-row">
                <div class="col-md-3 col-sm-6">
                    <div class="box same-height">
                        <h3>You may also like these products</h3>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="product same-height">
                        <div class="flip-container">
                            <div class="flipper">
                                <div class="front">
                                    <a href="detail.html">
                                        <img src="/img/product2.jpg" alt="" class="img-responsive">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="detail.html">
                                        <img src="/img/product2_2.jpg" alt="" class="img-responsive">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a href="detail.html" class="invisible">
                            <img src="/img/product2.jpg" alt="" class="img-responsive">
                        </a>
                        <div class="text">
                            <h3>Fur coat</h3>
                            <p class="price">$143</p>
                        </div>
                    </div>
                    <!-- /.product -->
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="product same-height">
                        <div class="flip-container">
                            <div class="flipper">
                                <div class="front">
                                    <a href="detail.html">
                                        <img src="/img/product1.jpg" alt="" class="img-responsive">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="detail.html">
                                        <img src="/img/product1_2.jpg" alt="" class="img-responsive">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a href="detail.html" class="invisible">
                            <img src="/img/product1.jpg" alt="" class="img-responsive">
                        </a>
                        <div class="text">
                            <h3>Fur coat</h3>
                            <p class="price">$143</p>
                        </div>
                    </div>
                    <!-- /.product -->
                </div>


                <div class="col-md-3 col-sm-6">
                    <div class="product same-height">
                        <div class="flip-container">
                            <div class="flipper">
                                <div class="front">
                                    <a href="detail.html">
                                        <img src="/img/product3.jpg" alt="" class="img-responsive">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="detail.html">
                                        <img src="/img/product3_2.jpg" alt="" class="img-responsive">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a href="detail.html" class="invisible">
                            <img src="/img/product3.jpg" alt="" class="img-responsive">
                        </a>
                        <div class="text">
                            <h3>Fur coat</h3>
                            <p class="price">$143</p>

                        </div>
                    </div>
                    <!-- /.product -->
                </div>

            </div>

            <div class="row same-height-row">
                <div class="col-md-3 col-sm-6">
                    <div class="box same-height">
                        <h3>Products viewed recently</h3>
                    </div>
                </div>


                <div class="col-md-3 col-sm-6">
                    <div class="product same-height">
                        <div class="flip-container">
                            <div class="flipper">
                                <div class="front">
                                    <a href="detail.html">
                                        <img src="/img/product2.jpg" alt="" class="img-responsive">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="detail.html">
                                        <img src="/img/product2_2.jpg" alt="" class="img-responsive">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a href="detail.html" class="invisible">
                            <img src="/img/product2.jpg" alt="" class="img-responsive">
                        </a>
                        <div class="text">
                            <h3>Fur coat</h3>
                            <p class="price">$143</p>
                        </div>
                    </div>
                    <!-- /.product -->
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="product same-height">
                        <div class="flip-container">
                            <div class="flipper">
                                <div class="front">
                                    <a href="detail.html">
                                        <img src="/img/product1.jpg" alt="" class="img-responsive">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="detail.html">
                                        <img src="/img/product1_2.jpg" alt="" class="img-responsive">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a href="detail.html" class="invisible">
                            <img src="/img/product1.jpg" alt="" class="img-responsive">
                        </a>
                        <div class="text">
                            <h3>Fur coat</h3>
                            <p class="price">$143</p>
                        </div>
                    </div>
                    <!-- /.product -->
                </div>


                <div class="col-md-3 col-sm-6">
                    <div class="product same-height">
                        <div class="flip-container">
                            <div class="flipper">
                                <div class="front">
                                    <a href="detail.html">
                                        <img src="/img/product3.jpg" alt="" class="img-responsive">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="detail.html">
                                        <img src="/img/product3_2.jpg" alt="" class="img-responsive">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a href="detail.html" class="invisible">
                            <img src="/img/product3.jpg" alt="" class="img-responsive">
                        </a>
                        <div class="text">
                            <h3>Fur coat</h3>
                            <p class="price">$143</p>

                        </div>
                    </div>
                    <!-- /.product -->
                </div>

            </div>

        </div>
        <!-- /.col-md-9 -->
    </div>
    <!-- /.container -->
</div>
<!-- /#content -->
@endsection

@section('scripts')
  <script src="{{ mix('js/frontend/product/show.js') }}"></script>
@endsection
