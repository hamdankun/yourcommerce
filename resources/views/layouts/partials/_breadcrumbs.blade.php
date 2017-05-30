<div class="col-md-12">
    <ul class="breadcrumb">
        <li><a href="{{ route('root') }}">Home</a>
        </li>
        @foreach($breadcrumbs as $key => $value)
          <li>{{ ucwords(str_replace('-', ' ', $value)) }}</li>
        @endforeach
    </ul>
</div>
