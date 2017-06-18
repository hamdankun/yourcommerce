@extends('layouts.frontend')

@section('js-variables')

@endsection

@section('content')
<div id="content">
    <div class="container">

        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="{{ route('root') }}">Home</a>
                </li>
                <li>Shopping cart</li>
            </ul>
        </div>

        <div class="col-md-9" id="basket">

            <div class="box">

                <!-- <form method="get" action="{{ route('order.step-1') }}"> -->
                    <h1>Shopping cart</h1>
                    <p class="text-muted">You currently have 3 item(s) in your cart.</p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">Product</th>
                                    <th>Quantity</th>
                                    <th>Unit price</th>
                                    <th>Discount</th>
                                    <th colspan="2">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(Cart::count() > 0)
                                  @foreach(Cart::content() as $key => $value)
                                    <tr>
                                        <td>
                                            <a href="#">
                                                <img data-src="{{ $value->options->has('image') ? $value->options->image : asset('images/default.jpg')  }}" alt="{{ $value->name }}"
                                                class="img-responsive lazy height-auto">
                                            </a>
                                        </td>
                                        <td class="fix-column-name"><a href="#">{{ $value->name, 30 }}</a>
                                        </td>
                                        <td class="width-x-small">
                                            <input type="number" value="{{ $value->qty }}" class="form-control text-center width-large cart-qty" data-id="{{ $value->rowId }}">
                                        </td>
                                        <td>{{ currency($value->price, 'blank') }}</td>
                                        <td>Rp. 0</td>
                                        <td>{{ currency($value->total, 'blank') }}</td>
                                        <td><a href="#" data-id="{{ $value->rowId }}" class="remove-from-cart"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                  @endforeach
                                @else
                                  <tr>
                                      <td colspan="7" class="text-center blue-font">No items in the cart</td>
                                  </tr>
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5">Total</th>
                                    <th colspan="2">Rp. <span class="cart-total">{{ Cart::total() }}</span></th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                    <!-- /.table-responsive -->

                    <div class="box-footer">
                        <div class="pull-left">
                            <a href="{{ $previous_url }}" class="btn btn-default disabled-when" data-trigger="click"><i class="fa fa-chevron-left"></i> Continue shopping</a>
                        </div>
                        <div class="pull-right">
                          @if(Cart::count() > 0)
                            <button class="btn btn-default"><i class="fa fa-refresh"></i> Update basket</button>
                            <a href="{{ route('order.step-1') }}" class="btn btn-primary checkout">Proceed to checkout <i class="fa fa-chevron-right"></i></a>
                          @endif
                        </div>
                    </div>

                <!-- </form> -->

            </div>
            <!-- /.box -->


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


        </div>
        <!-- /.col-md-9 -->

        <div class="col-md-3">
            <div class="box" id="order-summary">
                <div class="box-header">
                    <h3>Order summary</h3>
                </div>
                <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>

                <div class="table-responsive">
                    <table class="table summary-shopping-cart">
                        <tbody>
                            <tr>
                                <td>Order subtotal</td>
                                <th>Rp. <span class="cart-sub-total">{{ Cart::subTotal() }}</span></th>
                            </tr>
                            <tr>
                                <td>Shipping and handling</td>
                                <th>$10.00</th>
                            </tr>
                            <tr>
                                <td>Tax</td>
                                <th>Rp. <span class="cart-tax">{{ Cart::tax() }}</span></th>
                            </tr>
                            <tr class="total">
                                <td>Total</td>
                                <th>Rp. <span class="cart-total">{{ Cart::subTotal() }}</span></th>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>


            <div class="box">
                <div class="box-header">
                    <h4>Coupon code</h4>
                </div>
                <p class="text-muted">If you have a coupon code, please enter it in the box below.</p>
                <form>
                    <div class="input-group">

                        <input type="text" class="form-control">

                        <span class="input-group-btn">

  <button class="btn btn-primary" type="button"><i class="fa fa-gift"></i></button>

    </span>
                    </div>
                    <!-- /input-group -->
                </form>
            </div>

        </div>
        <!-- /.col-md-3 -->

    </div>
    <!-- /.container -->
</div>
@endsection

@section('scripts')
  <script src="{{ mix('js/frontend/shopping.cart.js') }}"></script>
@endsection
