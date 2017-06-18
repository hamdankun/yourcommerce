@extends('layouts.frontend')

@section('content')
<div id="content">
    <div class="container">

        <div class="col-md-12">

            <ul class="breadcrumb">
                <li><a href="#">Home</a>
                </li>
                <li>New account / Sign in</li>
            </ul>

        </div>

        <div class="col-md-6">
            <div class="box">
                <h1>New account</h1>

                <p class="lead">Not our registered customer yet?</p>
                <p>With registration with us new world of fashion, fantastic discounts and much more opens to you! The whole process will not take you more than a minute!</p>
                <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>

                <hr>
                <form action="{{ route('member.register') }}" class="form-register" method="post">
                  {!! csrf_field() !!}
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Name</label>
                        <input type="text" name="name" autocomplete="off" required class="form-control" id="name" value="{{ old('name') }}">
                        <span class="help-block with-errors">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email">Email</label>
                        <input type="email" name="email" autocomplete="off" required class="form-control" id="email" value="{{ old('email') }}">
                        <span class="help-block with-errors">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                        <label for="email">Username</label>
                        <input type="username" pattern="^[A-Za-z][A-Za-z0-9]*$" name="username" autocomplete="off" required class="form-control" id="email" value="{{ old('username') }}">
                        <span class="help-block with-errors">{{ $errors->has('username') ? $errors->first('username') : 'Username cannot contain space and special character seem like comma, Quote, other' }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password">Password</label>
                        <input type="password" name="password" autocomplete="off" required minlength="8" class="form-control" id="password">
                        <span class="help-block with-errors">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary disabled-when" data-trigger="click"><i class="fa fa-user-md"></i> Register</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box">
                <h1>Login</h1>

                <p class="lead">Already our customer?</p>
                <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies
                    mi vitae est. Mauris placerat eleifend leo.</p>

                <hr>

                <form action="customer-orders.html" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
    <!-- /.container -->
</div>
@endsection

@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
  <script src="{{ mix('js/frontend/member.register.js') }}"></script>
@endsection
