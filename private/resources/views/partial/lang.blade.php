<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">&nbsp; {{ App\Http\Middleware\Language::getName() }} <b class="caret"></b></a>
  <ul class="dropdown-menu">
    @foreach (App\Http\Middleware\Language::getAll() as $locale=>$name)
      <li><a href="locale/{{ $locale }}">
          @if ($locale==$lang)
            <i class="glyphicon glyphicon-ok"></i>
          @else
            <i class="icon-placeholder"></i>
          @endif
          {{ $name }}
        </a></li>
    @endforeach
  </ul>
</li>
