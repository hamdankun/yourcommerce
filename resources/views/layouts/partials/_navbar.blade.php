<!-- *** NAVBAR ***
_________________________________________________________ -->

<div class="navbar navbar-default yamm" role="navigation" id="navbar">
    <div class="container">
        <div class="navbar-header">

            <a class="navbar-brand home" href="{{ route('root') }}" data-animate-hover="bounce">
                <img src="{{ asset('img/logo.png') }}" alt="Obaju logo" class="hidden-xs">
                <img src="{{ asset('img/logo-small.png') }}" alt="Obaju logo" class="visible-xs"><span class="sr-only">Obaju - go to homepage</span>
            </a>
            <div class="navbar-buttons">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="fa fa-align-justify"></i>
                </button>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                    <span class="sr-only">Toggle search</span>
                    <i class="fa fa-search"></i>
                </button>
                <a class="btn btn-default navbar-toggle" href="basket.html">
                    <i class="fa fa-shopping-cart"></i>  <span class="hidden-xs">3 items in cart</span>
                </a>
            </div>
        </div>
        <!--/.navbar-header -->

        <div class="navbar-collapse collapse" id="navigation">

            <ul class="nav navbar-nav navbar-left">
                <li class="active"><a href="{{ route('root') }}">Home</a>
                </li>
                  @if(isset($main_categories))
                    @foreach($main_categories as $key => $level1)
                      <li class="dropdown yamm-fw">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">{{$level1->name}} <b class="caret"></b></a>
                          <ul class="dropdown-menu">
                              <li>
                                  <div class="yamm-content">
                                      <div class="row">
                                        @foreach($level1->child as $key => $level2)
                                          <div class="col-sm-3">
                                              <h5>{{ $level2->name }}</h5>
                                              <ul>
                                                @foreach($level2->child as $key => $level3)
                                                  <li><a href="{!! route('product.index', [$level1->slug, $level2->slug, $level3->slug]) !!}">{{$level3->name}}</a></li>
                                                @endforeach
                                              </ul>
                                          </div>
                                        @endforeach
                                      </div>
                                  </div>
                                  <!-- /.yamm-content -->
                              </li>
                          </ul>
                      </li>
                    @endforeach
                  @endif
                  <li class="dropdown yamm-fw">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Template <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="yamm-content">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h5>Shop</h5>
                                        <ul>
                                            <li><a href="index.html">Homepage</a>
                                            </li>
                                            <li><a href="category.html">Category - sidebar left</a>
                                            </li>
                                            <li><a href="category-right.html">Category - sidebar right</a>
                                            </li>
                                            <li><a href="category-full.html">Category - full width</a>
                                            </li>
                                            <li><a href="detail.html">Product detail</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-3">
                                        <h5>User</h5>
                                        <ul>
                                            <li><a href="register.html">Register / login</a>
                                            </li>
                                            <li><a href="customer-orders.html">Orders history</a>
                                            </li>
                                            <li><a href="customer-order.html">Order history detail</a>
                                            </li>
                                            <li><a href="customer-wishlist.html">Wishlist</a>
                                            </li>
                                            <li><a href="customer-account.html">Customer account / change password</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-3">
                                        <h5>Order process</h5>
                                        <ul>
                                            <li><a href="basket.html">Shopping cart</a>
                                            </li>
                                            <li><a href="checkout1.html">Checkout - step 1</a>
                                            </li>
                                            <li><a href="checkout2.html">Checkout - step 2</a>
                                            </li>
                                            <li><a href="checkout3.html">Checkout - step 3</a>
                                            </li>
                                            <li><a href="checkout4.html">Checkout - step 4</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-3">
                                        <h5>Pages and blog</h5>
                                        <ul>
                                            <li><a href="blog.html">Blog listing</a>
                                            </li>
                                            <li><a href="post.html">Blog Post</a>
                                            </li>
                                            <li><a href="faq.html">FAQ</a>
                                            </li>
                                            <li><a href="text.html">Text page</a>
                                            </li>
                                            <li><a href="text-right.html">Text page - right sidebar</a>
                                            </li>
                                            <li><a href="404.html">404 page</a>
                                            </li>
                                            <li><a href="contact.html">Contact</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /.yamm-content -->
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
        <!--/.nav-collapse -->

        <div class="navbar-buttons">

            <div class="navbar-collapse collapse right cart-overview" id="basket-overview">
                <a href="{{ route('order.shopping-cart') }}" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm">0 items in cart</span></a>
            </div>
            <!--/.nav-collapse -->

            <div class="navbar-collapse collapse right" id="search-not-mobile">
                <button type="button" class="btn navbar-btn btn-primary" data-toggle="collapse" data-target="#search">
                    <span class="sr-only">Toggle search</span>
                    <i class="fa fa-search"></i>
                </button>
            </div>

        </div>

        <div class="collapse clearfix" id="search">

            <form class="navbar-form" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-btn">

  <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>

    </span>
                </div>
            </form>

        </div>
        <!--/.nav-collapse -->

    </div>
    <!-- /.container -->
</div>
<!-- /#navbar -->

<!-- *** NAVBAR END *** -->
