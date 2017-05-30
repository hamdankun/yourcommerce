<div class="box-footer">
    @foreach($box_button as $key => $value)
      @if($loop->first)
        <div class="pull-left">
            <a href="{{ $key }}" class="btn btn-default disabled-when" data-trigger="click"><i class="fa fa-chevron-left"></i>{{ $value }}</a>
        </div>
      @else
        <div class="pull-right">
            <button type="submit" disable="false" class="btn btn-primary {{ $key }} disabled-when" data-trigger="click">{{ $value }}<i class="fa fa-chevron-right"></i>
            </button>
        </div>
      @endif
    @endforeach
</div>
