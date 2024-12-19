<div class="row">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-header">
        <span style="float:left;">
          <a href="{{ aurl('university-overview/'.$university->id) }}"
            class="btn btn-xs btn{{ $page_route=='university-overview'?'':'-outline' }}-primary">Overview</a>
          <a href="{{ aurl('university-programs/'.$university->id) }}"
            class="btn btn-xs btn{{ $page_route=='university-programs'?'':'-outline' }}-primary">Courses</a>
          <a href="{{ aurl('university-gallery/'.$university->id) }}"
            class="btn btn-xs btn{{ $page_route=='university-gallery'?'':'-outline' }}-primary">Gallery</a>
          <a href="{{ aurl('university-video-gallery/'.$university->id) }}"
            class="btn btn-xs btn{{ $page_route=='university-video-gallery'?'':'-outline' }}-primary">Videos</a>
          <a href="{{ aurl('fees-and-deadline/'.$university->id) }}"
            class="btn btn-xs btn{{ $page_route=='fees-and-deadline'?'':'-outline' }}-primary">Fees & Deadline</a>
          <a href="{{ aurl('university-scholarships/'.$university->id) }}"
            class="btn btn-xs btn{{ $page_route=='university-scholarships'?'':'-outline' }}-primary">Scholarships</a>
          <a href="{{ aurl('other-content/'.$university->id) }}"
            class="btn btn-xs btn{{ $page_route=='other-content'?'':'-outline' }}-primary">Other Content</a>
        </span>
      </div>
    </div>
  </div>
</div>