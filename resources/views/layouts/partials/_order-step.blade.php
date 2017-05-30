<ul class="nav nav-pills nav-justified">
    @foreach($step_lists as $key => $value)
      <li class="{{ !$value['disabled'] ? $value['class'] : 'disabled' }}"><a href="{{ !$value['disabled'] ? $value['link'] : '#' }}"><i class="fa {{ $value['icon'] }}"></i><br>{{ $value['name'] }}</a>
      </li>
    @endforeach
</ul>
