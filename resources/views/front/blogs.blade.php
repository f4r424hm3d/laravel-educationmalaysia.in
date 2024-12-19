@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <!-- Top header-->
  <!-- Breadcrumb -->
  <div class="image-cover ed_detail_head lg" style="background:url({{ url('/front/') }}/assets/img/ub.jpg);"
    data-overlay="8">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12">
          <div class="ed_detail_wrap light">
            <ul class="cources_facts_list">
              <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
              <li class="facts-1">Get Info</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->
  <!-- Content -->
  <section>
    <div class="container">
      <div class="row">
        @foreach ($blogs as $row)
          <div class="col-md-4">
            <div class="singles_items p-0">
              <div class="education_block_grid style_2">
                <div class="education_block_thumb n-shadow">
                  <a
                    href="{{ route('blog.detail', ['category_slug' => $row->category->slug, 'slug' => $row->slug . '-' . $row->id]) }}">
                    <img data-src="{{ asset($row->imgpath) }}" class="img-fluid" alt="{{ $row->headline }}">
                  </a>
                  <div class="cources_price"><a
                      href="{{ route('blog.category', ['category_slug' => $row->category->slug]) }}">{{ $row->category->cate_name }}</a>
                  </div>
                </div>
                <div class="education_block_body">
                  <h4 class="bl-title">
                    <a
                      href="{{ route('blog.detail', ['category_slug' => $row->category->slug, 'slug' => $row->slug . '-' . $row->id]) }}">{{ $row->headline }}</a>
                  </h4>
                </div>
                <div class="cources_info_style3">
                  <ul>
                    <li><i class="ti-calendar mr-2"></i>{{ getFormattedDate($row->updated_at, 'd M, Y') }}</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        @endforeach

      </div>
      {!! $blogs->links('pagination::bootstrap-4') !!}
    </div>
  </section>
  <!-- Content -->
@endsection
