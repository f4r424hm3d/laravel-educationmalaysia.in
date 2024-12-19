@php
  $page = Request::segment(3);
@endphp
<div data-gssticky="1" class="addSticky">
  <div class="container">
    <div class="new-links">
      <ul class="vertically-scrollbar">
        <li class="{{ $page == '' ? 'active' : '' }}">
          <a href="{{ route('university.overview', ['university_slug' => $university->uname]) }}">Overview</a>
        </li>
        @if ($university->programs->count() > 0)
          <li class="{{ $page == 'courses' ? 'active' : '' }}">
            <a href="{{ route('university.courses', ['university_slug' => $university->uname]) }}">Courses</a>
          </li>
        @endif
        @if ($university->photos->count() > 0)
          <li class="{{ $page == 'gallery' ? 'active' : '' }}"><a
              href="{{ route('university.gallery', ['university_slug' => $university->uname]) }}">Gallery</a></li>
        @endif
        @if ($university->photos->count() > 0)
          <li class="{{ $page == 'video' ? 'active' : '' }}"><a
              href="{{ route('university.video', ['university_slug' => $university->uname]) }}">Videos</a></li>
        @endif
        @if ($university->reviews->count() > 0)
          <li class="{{ $page == 'reviews' ? 'active' : '' }}"><a
              href="{{ route('university.reviews', ['university_slug' => $university->uname]) }}">Reviews</a>
          </li>
        @endif
      </ul>
    </div>
  </div>
</div>
