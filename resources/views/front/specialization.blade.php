@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  <div class="new-top-header">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-8">
					<h2 class="malaysia-student">Accounting Finance Course in Malaysia : Complete Guide for International Students </h2> 
				</div>
				<div class="col-md-4">
											<img src="https://www.educationmalaysia.in/assets/web/images/em-cource-img-lite.webp" alt="accounting finance in Malaysia" class="initial loading" data-was-processed="true">
									</div>
			</div>
		</div>
	</div>
  <!-- style="background:url({{ url('/front/') }}/assets/img/ub.jpg);" -->
  <div class="image-cover ed_detail_head lg"
    data-overlay="8">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12">
          <div class="ed_detail_wrap light">
            <ul class="cources_facts_list">
              <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
              <li class="facts-1">Specialization</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->
  <!-- Content -->
  <section class="main-specialization examslead ">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 mb-3">
          <div class="sec-heading">
            <h2>Study <span class="theme-cl1">Abroad Exams</span> with Education Malaysia</h2>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach ($specializations as $row)
          <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-4 col-12">
            <div class="exaams">
            <a href="{{ route('specialization.detail', ['slug' => $row->slug]) }}" target="_blank">
              <div class="fuc-box">
                <p class="card-body">{{ $row->name }} <i class="fa fa-angle-right"></i>
                </p>
              </div>
            </a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  <!-- Content -->
@endsection
