@extends('layouts.frontend')

@section('content')
  <div id="content">
      <div class="container">

          <div class="col-md-12">
              <ul class="breadcrumb">
                  <li><a href="#">Home</a>
                  </li>
                  <li>Order - Finish</li>
              </ul>
          </div>

          <div class="col-md-12" id="checkout">

              <div class="box">
                @if(session()->has('order.created'))
                  <div class="alert alert-{{ session()->get('order.created') ? 'success' : 'danger' }} alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{ session()->get('order.created') ? 'Success' : 'Danger' }}</strong> {{ session()->get('order.message') }}
                  </div>
                @endif
                @if($order)
                  <h2>Your Summary Order</h2>
                  <small>This is your tracking number <a href="#">{{ $order->order_number }}</a>, please use this for tracking your order</small>
                  <div class="push-bottom"></div>
                  <div class="table-responsive">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th colspan="2">Product</th>
                                  <th class="text-center">Quantity</th>
                                  <th>Unit price</th>
                                  <th>Discount</th>
                                  <th colspan="2">Total</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($order->details as $key => $value)
                              <tr>
                                  <td>
                                      <a href="#">
                                          <img data-src="{{ $value->product->images->first()->path  }}" alt="{{ $value->name }}"
                                          class="img-responsive lazy height-auto">
                                      </a>
                                  </td>
                                  <td class="fix-column-name"><a href="#">{{ $value->product->name, 30 }}</a>
                                  </td>
                                  <td class="width-x-small text-center">
                                      {{ $value->qty }}
                                  </td>
                                  <td>{{ currency($value->price, 'blank') }}</td>
                                  <td>Rp. 0</td>
                                  <td>{{ currency($value->total, 'blank') }}</td>
                              </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                              <tr>
                                  <th colspan="5">Total</th>
                                  <th colspan="2">Rp. <span class="grand-total">{{ currency($order->grand_total) }}</span></th>
                              </tr>
                          </tfoot>
                      </table>
                  </div>
                @else
                  <h1 class="text-center">No Overview Order</h1>
                @endif
              </div>
              <!-- /.box -->


          </div>
          <!-- /.col-md-9 -->

          <!-- /.col-md-3 -->

      </div>
      <!-- /.container -->
  </div>
@endsection

@section('scripts')
  <script src="{{ mix('js/frontend/order.preview.js') }}"></script>
@endsection
