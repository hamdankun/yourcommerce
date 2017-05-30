@extends('layouts.frontend')

@section('js-variables')
  var _category = '{{ $category }}';
  var breadcrumbs = JSON.parse('{!! json_encode($breadcrumbs) !!}');
  var _pathCategory = _appBaseUrl+'/s/'+breadcrumbs.join('/');
@endsection

@section('content')
<div id="content">
    <div class="container">

        @include('layouts.partials._breadcrumbs')
        @include('layouts.partials._filter')

        <div class="col-md-9">
            <div class="box">
                <h1>{{ $box_title }}</h1>
                <p>In our Ladies department we offer wide selection of the best products we have found and carefully selected worldwide.</p>
            </div>

            @include('layouts.partials._sorting')
            <div class="row products">

                <div class="content"></div>

                <div class="not-available-content" hidden>
                  <h1>Whoops! Product Not Available</h1>
                </div>
                <!-- /.col-md-4 -->
                <div class="overlay">
                  <img src="{{ asset('images/loading.gif') }}" alt="Load Content">
                </div>
            </div>
            <!-- /.products -->

            <div class="pages">
                <ul class="pagination"></ul>
            </div>

        </div>
        <!-- /.col-md-9 -->
    </div>
    <!-- /.container -->
</div>
<!-- /#content -->
@endsection

@section('scripts')
  <script src="{{ asset('js/plugins/jquery.twbsPagination.min.js') }}"></script>
  <script src="{{ mix('js/frontend/product/index.js') }}"></script>
@endsection
