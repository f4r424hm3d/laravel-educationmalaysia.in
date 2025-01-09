<div class="row">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-header">
        <span style="float:left;">
          <a href="{{ aurl('university-overview/' . $university->id) }}"
            class="btn btn-xs btn{{ $page_route == 'university-overview' ? '' : '-outline' }}-primary">Overview</a>

          <a href="{{ aurl('university-programs/' . $university->id) }}"
            class="btn btn-xs btn{{ $page_route == 'university-programs' ? '' : '-outline' }}-primary">Courses</a>

          <a href="{{ aurl('university-photos/' . $university->id) }}"
            class="btn btn-xs btn{{ $page_route == 'university-photos' ? '' : '-outline' }}-primary">Gallery</a>

          <a href="{{ aurl('university-videos/' . $university->id) }}"
            class="btn btn-xs btn{{ $page_route == 'university-videos' ? '' : '-outline' }}-primary">Videos</a>

          <a href="{{ aurl('university-facilities/' . $university->id) }}"
            class="btn btn-xs btn{{ $page_route == 'university-facilities' ? '' : '-outline' }}-primary">Facilities</a>

        </span>
      </div>
    </div>
  </div>
</div>
