@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  <div class="image-cover ed_detail_head lg" style="background:url({{ url('/front/') }}/assets/img/ub.jpg);"
    data-overlay="8">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12">
          <div class="ed_detail_wrap light">
            <ul class="cources_facts_list">
              <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
              <li class="facts-1">{{ $author->name }}</li>
            </ul>
            <div class="ed_header_caption mb-0">
              <h1 class="ed_title mb-0">{{ $author->name }}</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->

  <!-- Content -->
  <section class="bg-light pb-3">
    <div class="container">
      <div class="row">

        <div class="col-lg-12 col-md-12 col-12">

          <!-- all universities -->
          <div class="dashboard_container bg-transparent shadow-0">
            <div class="dashboard_container_body">

              <div id="accordionExample" class="accordion shadow circullum">

                <div class="card mb-3 p-4">

                  <div class="row align-items-center">
                    <div class="col-md-3"><img data-src="{{ userIcon($author->profile_picture) }}"
                        class="rounded img-fluid mb-4"></div>
                    <div class="col-md-9">
                      <h4 class="b-b pb-2 theme-cl">Highlights</h4>
                      {!! $author->highlights !!}
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">

                      <h4 class="b-b pb-2 theme-cl">Education</h4>
                      {!! $author->education !!}

                      <h4 class="b-b pb-2 theme-cl mt-4">Experience</h4>
                      {!! $author->experiance !!}

                    </div>
                  </div>

                </div>
              </div>

            </div>
          </div>

        </div>
      </div>

    </div>
  </section>

  @if ($blogs->count() > 0)
    <section class="bg-light pt-0">
      <div class="container">

        <div class="row justify-content-center">
          <div class="col-lg-12 col-md-12">
            <div class="sec-heading">
              <h2>Recent Articles</h2>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 p-0">

            <div class="container">

              <div class="custom-tab customize-tab tabs_creative mb-0">

                <div class="tab-content" id="myTabContent" style="margin:0px -10px">
                  <div class="tab-pane fade active show pb-0" id="artical1" role="tabpanel"
                    aria-labelledby="artical1-tab" aria-expanded="true">
                    <div class="arrow_slide three_slide arrow_middle">

                      @foreach ($blogs as $row)
                        <div class="singles_items">
                          <div class="education_block_grid style_2">
                            <div class="education_block_thumb n-shadow">
                              <a href="{{ url($row->slug) }}">
                                <img data-src="{{ asset($row->thumbnail_path) }}" class="img-fluid"
                                  alt="{{ $row->title }}">
                              </a>
                              <div class="cources_price">{{ $row->getCategory->category_name }}</div>
                            </div>
                            <div class="education_block_body">
                              <h4 class="bl-title">
                                <a href="{{ url($row->slug) }}">{{ $row->title }}</a>
                              </h4>
                            </div>
                            <div class="cources_info_style3">
                              <ul>
                                <li><i class="ti-calendar mr-2"></i>24 Aug 22</li>
                                {{-- <li><i class="ti-eye mr-2"></i>55 Views</li>
                          <li><i class="ti-star text-warning mr-2"></i>4.7 Rating</li> --}}
                              </ul>
                            </div>
                          </div>
                        </div>
                      @endforeach

                    </div>
                  </div>

                </div>
              </div>

            </div>

          </div>
        </div>

        <div class="row justify-content-center">
          <a href="{{ url('articles') }}" class="btn btn-modern float-none">View all Articals<span><i
                class="fa fa-angle-right"></i></span></a>
        </div>

      </div>
    </section>
  @endif
  <!-- Content -->
@endsection
