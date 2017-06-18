@extends('layouts.frontend')

@section('content')
<div id="content">
    <div class="container">

        <div class="col-md-12">

            <ul class="breadcrumb">
                <li><a href="#">Home</a>
                </li>
                <li>Register Success / Sign in</li>
            </ul>

        </div>

        <div class="col-md-6">
            <div class="box">
                <h3>{{ session()->get('member.message') }}</h3>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>
                @if($member)
                  <h3>Your member account :</h3>
                  <form class="form-horizontal">
                    <div class="form-group">
                      <label class="control-label col-sm-3">Name</label>
                      <div class="col-sm-8">
                        <p class="form-control-static">{{ $member->name }}</p>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3">Username</label>
                      <div class="col-sm-8">
                        <p class="form-control-static">{{ $member->user->username }}</p>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3">Email</label>
                      <div class="col-sm-8">
                        <p class="form-control-static">{{ $member->user->email }}</p>
                      </div>
                    </div>
                  </form>
                @endif
                <hr>
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
