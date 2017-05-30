@extends('layouts.frontend')

@section('css')
  <link rel="stylesheet" href="{{ asset('js/plugins/select2-4.0.3/dist/css/select2.min.css') }}">
@endsection

@section('js-variables')
  var _currentCountry = {{ session()->has('biodata.country_id') ? session()->get('biodata.country_id') : 0 }}
@endsection

@section('content')
<div id="content">
    <div class="container">

        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="#">Home</a>
                </li>
                <li>Checkout - Address</li>
            </ul>
        </div>

        <div class="col-md-9" id="checkout">
            <div class="box">
                <form method="post" action="{{ route('order.step-1') }}" class="form-address">
                    {!! csrf_field() !!}
                    <h1>Checkout</h1>
                    @include('layouts.partials._order-step')
                    <div class="content">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="firstname">Firstname<span class="required">*</span></label>
                                    <input name="first_name" type="text" class="form-control" id="firstname" autocomplete="off" value="{{ session()->has('biodata.first_name') ? session()->get('biodata.first_name') : '' }}" required>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="lastname">Lastname<span class="required">*</span></label>
                                    <input name="last_name" type="text" class="form-control" id="lastname" autocomplete="off" value="{{ session()->has('biodata.last_name') ? session()->get('biodata.last_name') : '' }}" required>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="company">Company<span class="required">*</span></label>
                                    <input name="company" type="text" class="form-control" id="company" autocomplete="off" value="{{ session()->has('biodata.company') ? session()->get('biodata.company') : '' }}" required>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="street">Street<span class="required">*</span></label>
                                    <input name="address" type="text" class="form-control" id="street" autocomplete="off" value="{{ session()->has('biodata.address') ? session()->get('biodata.address') : '' }}" required>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="city">Company<span class="required">*</span></label>
                                    <input name="company_shipping" type="text" class="form-control" id="city" autocomplete="off" value="{{ session()->has('biodata.company_shipping') ? session()->get('biodata.company_shipping') : '' }}" required>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="zip">ZIP<span class="required">*</span></label>
                                    <input name="zip" type="text" class="form-control" id="zip" autocomplete="off" value="{{ session()->has('biodata.zip') ? session()->get('biodata.zip') : '' }}" required>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="state">City<span class="required">*</span></label>
                                    <input type="text" name="city" class="form-control" id="city" autocomplete="off" value="{{ session()->has('biodata.city') ? session()->get('biodata.city') : '' }}" required>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="country">Country<span class="required">*</span></label>
                                    <select name="country_id" class="form-control" id="country" autocomplete="off" required></select>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="phone">Telephone<span class="required">*</span></label>
                                    <input name="telephone" type="number" class="form-control" id="phone" autocomplete="off" value="{{ session()->has('biodata.telephone') ? session()->get('biodata.telephone') : '' }}" required>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">Email<span class="required">*</span></label>
                                    <input name="email" type="email" class="form-control" id="email" autocomplete="off" value="{{ session()->has('biodata.email') ? session()->get('biodata.email') : '' }}" required>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
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
                                <th>Rp.{{ Cart::subTotal() }}</th>
                            </tr>
                            <tr>
                                <td>Shipping and handling</td>
                                <th>$10.00</th>
                            </tr>
                            <tr>
                                <td>Tax</td>
                                <th>Rp.{{ Cart::tax() }}</th>
                            </tr>
                            <tr class="total">
                                <td>Total</td>
                                <th>Rp.{{ Cart::total() }}</th>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
  <script src="{{ asset('js/plugins/select2-4.0.3/dist/js/select2.min.js') }}"></script>
  <script src="{{ mix('js/frontend/address.js') }}"></script>
@endsection
