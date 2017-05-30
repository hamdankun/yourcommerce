@extends('layouts.frontend')

@section('content')
  <div id="content">
      <div class="container">

          <div class="col-md-12">
              <ul class="breadcrumb">
                  <li><a href="#">Home</a>
                  </li>
                  <li>Checkout - Order review</li>
              </ul>
          </div>

          <div class="col-md-9" id="checkout">

              <div class="box">
                  <form method="post" action="{{ route('order.save') }}">
                      <h1>Checkout - Order review</h1>
                      {!! csrf_field() !!}
                      @include('layouts.partials._order-step')
                      <div class="content">
                          <div class="table-responsive">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th colspan="2">Product</th>
                                          <th>Quantity</th>
                                          <th>Unit price</th>
                                          <th>Discount</th>
                                          <th>Total</th>
                                      </tr>
                                  </thead>
                                  <tbody>

                                      @if(Cart::count() > 0)
                                        @foreach(Cart::content() as $key => $value)
                                          <tr>
                                              <td>
                                                  <a href="#">
                                                      <img src="{{ $value->options->has('image') ? $value->options->image : asset('images/default.jpg') }}" alt="White Blouse Armani">
                                                  </a>
                                              </td>
                                              <td class="fix-column-name"><a href="#">{{ $value->name }}</a>
                                              </td>
                                              <td>{{ $value->qty }}</td>
                                              <td>{{ $value->price }}</td>
                                              <td>$0.00</td>
                                              <td>{{ $value->subTotal() }}</td>
                                          </tr>
                                        @endforeach
                                      @endif
                                  </tbody>
                                  <tfoot>
                                      <tr>
                                          <th colspan="5">Total</th>
                                          <th>Rp.{{ Cart::total() }}</th>
                                      </tr>
                                  </tfoot>
                              </table>

                          </div>
                          <!-- /.table-responsive -->
                      </div>
                      <!-- /.content -->
                      @include('layouts.partials._box-footer')
                  </form>
              </div>
              <!-- /.box -->


          </div>
          <!-- /.col-md-9 -->

          <div class="col-md-3">

              <div class="box" id="order-summary">
                  <div class="box-header">
                      <h3>Order summary</h3>
                  </div>
                  <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>

                  <div class="table-responsive">
                      <table class="table">
                          <tbody>
                              <tr>
                                  <td>Order subtotal</td>
                                  <th>$446.00</th>
                              </tr>
                              <tr>
                                  <td>Shipping and handling</td>
                                  <th>$10.00</th>
                              </tr>
                              <tr>
                                  <td>Tax</td>
                                  <th>$0.00</th>
                              </tr>
                              <tr class="total">
                                  <td>Total</td>
                                  <th>$456.00</th>
                              </tr>
                          </tbody>
                      </table>
                  </div>

              </div>

          </div>
          <!-- /.col-md-3 -->

      </div>
      <!-- /.container -->
  </div>
@endsection

@section('scripts')
  <script src="{{ mix('js/frontend/order.preview.js') }}"></script>
@endsection
