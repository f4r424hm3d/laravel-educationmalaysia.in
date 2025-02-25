<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-{{ Str::slug($title) }}" role="button">
    <span>{{ $title }}</span>
    <div class="arrow-down"></div>
  </a>
  <div class="dropdown-menu" aria-labelledby="topnav-{{ Str::slug($title) }}">
    @foreach ($links as $link)
    <a href="{{ $link['url'] }}" class="dropdown-item">{{ $link['label'] }}</a>
    @endforeach
  </div>
</li>
