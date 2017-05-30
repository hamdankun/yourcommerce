@extends('layouts.frontend')

@section('content')
  <div id="content">
      <div class="container">

          <div class="col-md-12">
              <ul class="breadcrumb">
                  <li><a href="#">Home</a>
                  </li>
                  <li>Checkout - Payment method</li>
              </ul>
          </div>

          <div class="col-md-9" id="checkout">

              <div class="box">
                  <form method="post" action="{{ route('order.step-3') }}">
                    {{ csrf_field() }}
                      <h1>Checkout - Payment method</h1>
                      @include('layouts.partials._order-step')
                      <div class="content">
                          <div class="row">
                              @if(count($payment_methods) > 0)
                                @foreach($payment_methods->chunk(2) as $key => $chunk)
                                  @php
                                    $first = $key == 0 ? true : false;
                                  @endphp
                                    @foreach($chunk as $key => $value)
                                    @php
                                      if (session()->has('biodata.payment_method') && session()->get('biodata.payment_method') === $value->id) {
                                        $checked = true;
                                        $first = false;
                                      } else {
                                        $checked = false;
                                      }
                                    @endphp
                                      <div class="col-sm-6">
                                          <div class="box shipping-method">

                                              <h4>{{ $value->name }}</h4>

                                              <p>{{ str_limit($value->description, 100) }}</p>

                                              <div class="box-footer text-center">
                                                  <input type="radio" name="payment_method" {{ ($first && $loop->first) || $checked ? 'checked' : '' }} value="{{ $value->id }}">
                                              </div>
                                          </div>
                                      </div>
                                    @endforeach
                                    <div class="clearfix"></div>
                                @endforeach
                              @endif
                          </div>
                          <!-- /.row -->

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
  <script src="{{ mix('js/frontend/payment.method.js') }}"></script>
@endsection
