@if ($row->meta_title != null)
  <button type="button" class="btn btn-xs btn-outline-info waves-effect waves-light" data-bs-toggle="modal"
    data-bs-target="#SeoModalScrollable{{ $row->id }}">View</button>
  <div class="modal fade" id="SeoModalScrollable{{ $row->id }}" tabindex="-1" role="dialog"
    aria-labelledby="SeoModalScrollableTitle{{ $row->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="SeoModalScrollableTitle{{ $row->id }}">
            SEO
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h4>Meta Title</h4>
          <p>{!! $row->meta_title !!}</p>
          <h4>Meta Keyword</h4>
          <p>{!! $row->meta_keyword !!}</p>
          <h4>Meta Description</h4>
          <p>{!! $row->meta_description !!}</p>
          <h4>Page Content</h4>
          <p>{!! $row->page_content !!}</p>
          <h4>Seo Rating</h4>
          <p>Rating : {{ $row->seo_rating }} | Best Rating : {{ $row->best_rating }} | Number of
            Review : {{ $row->review_number }}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@else
  Null
@endif
