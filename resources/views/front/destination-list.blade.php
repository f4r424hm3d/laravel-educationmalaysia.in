@php
  use App\Models\University;
@endphp
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
              <li class="facts-1">All Universities</li>
            </ul>
            <div class="ed_header_caption mb-0">
              <h1 class="ed_title mb-0">Top Universities & Colleges for Study Abroad</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->
  <!-- Content -->
  <section class="bg-light pt-4 pb-4">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-12 col-sm-12">
        </div>
        <div class="col-lg-9 col-md-12 col-12">
          <div class="row align-items-center mb-2">
            <div class="col-lg-8 col-md-8 col-sm-12">
              <h3>Top Universities & Colleges</h3>
            </div>
          </div>
          <!-- all universities -->
          <div class="dashboard_container bg-transparent shadow-0">
            <div class="dashboard_container_body">
              <div id="accordionExample" class="accordion shadow circullum">
                @foreach ($destinations as $row)
                  <div class="card mb-3">
                    <div id="heading{{ $row->destination_id }}"
                      class="card-header bg-white shadow-sm border-0 b-b pl-4 pr-4">
                      <h6 class="mb-0 accordion_title">
                        <a href="javascript:void(0);" onclick="myFunction();" data-toggle="collapse"
                          data-target="#collapse{{ $row->destination_id }}" aria-expanded="true"
                          aria-controls="collapse{{ $row->destination_id }}"
                          class="d-block position-relative collapsible-link py-2 theme-cl1">
                          Universities in {{ $row->getDestination->destination_name }}
                        </a>
                      </h6>
                    </div>
                    <div id="collapse{{ $row->destination_id }}" aria-labelledby="heading{{ $row->destination_id }}"
                      data-parent="#accordionExample" class="collapse show pbm-20">
                      <div class="card-body p-0">
                        <div class="dashboard_single_course align-items-start b-0 pl-1 pr-1">
                          <div class="col-md-9">
                            <div class="dashboard_single_course_caption pl-0">
                              <div class="universities">
                                <ul>
                                  @foreach ($statesAndCities[$row->destination_id]['states'] as $state)
                                    <li><a
                                        href="{{ url($row->getDestination->destination_slug . '/' . $state->state_slug . '-universities') }}">{{ $state->state }}</a>
                                    </li>
                                  @endforeach

                                  {{-- @foreach ($statesAndCities[$row->destination_id]['cities'] as $city)
                                    <li><a
                                        href="{{ url($row->getDestination->destination_slug . '/' . $city->city_slug . '-universities') }}">{{ $city->city }}</a>
                                    </li>
                                  @endforeach --}}
                                </ul>
                              </div>
                              <a href="{{ url($row->getDestination->destination_slug . '/universities') }}"
                                class="btn btn-modern float-left mt-3">View All Universities<span><i
                                    class="ti-arrow-right"></i></span></a>
                            </div>
                          </div>
                          <div class="col-md-3 d-none d-md-block">
                            <img data-src="{{ asset($row->getDestination->thumbnail_path) }}" class="img-fluid"
                              alt="{{ $row->getDestination->destination_name }}">
                          </div>
                        </div>
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
  </section>
  <!-- Content -->
@endsection
