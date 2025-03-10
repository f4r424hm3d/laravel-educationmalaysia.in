@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <!-- fist start  -->

  <section class="">
    <div class="bccont">
      <div class="container ">

        <ul class="breadcrumb py-3">
          <li><a class="mx-1" href="{{ url('/') }}">Home</a></li>
          <li> / <span class="mx-1">Universities</span></li>
        </ul>
      </div>
    </div>

    <div class="container">

      <div class="hero-banner-top py-4">
        <img src="{{ asset($banner->bannerpath) }}" class="img-responsive hidden-sm hidden-xs initial loading"
          alt="Top Universities Ranking in Malaysia" style="height:auto!important" data-was-processed="true">
      </div>
    </div>
  </section>

  <!-- fist end  -->

  <section class="browser-all ">
    <div class="container">
      <div class="row justify-content-center ">
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 mb-4 ">
          <div class="browserall">
            <div class="card">
              <img src="{{ asset('assets/images/owl.png') }}" class="study-owl">
              <h2>Public University</h2>
            </div>
            <a href="{{ url('universities/public-institution-in-malaysia') }}" class="new-btn">Browser-all</a>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 mb-4 ">
          <div class="browserall">
            <div class="card">
              <img src="{{ asset('assets/images/owl.png') }}" class="study-owl">
              <h2>Private University</h2>
            </div>
            <a href="{{ url('universities/private-institution-in-malaysia') }}" class="new-btn">Browser-all</a>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 mb-4 ">
          <div class="browserall">
            <div class="card">
              <img src="{{ asset('assets/images/owl.png') }}" class="study-owl">
              <h2>Foreign University</h2>
            </div>
            <a href="{{ url('universities/foreign-universities-in-malaysia') }}" class="new-btn">Browser-all</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- second start -->
  <section>
    <div class="container ">
      <div class="row">
        <div class="col-md-12">
          <div class="cor-con-mid table-res ">
            <div class="cor-p5 university-blades">
              {!! $pageContentTop->description !!}
            </div>
            <h3 class="about-more">Find out more about:</h3>
            <ul class="nav nav-tabs all-mars" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                  aria-controls="home" aria-selected="true">PRIVATE UNIVERSITIES</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                  aria-controls="profile" aria-selected="false">PUBLIC UNIVERSITIES</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                  aria-controls="contact" aria-selected="false">FOREIGN UNIVERSITIES</a>
              </li>
            </ul>
            <div class="tab-content all-mass" id="myTabContent">
              <div class="tab-pane  fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <h3 class="priviate-us">Private Universities in Malaysia</h3>
                <section>
                  <div class="stu-db">
                    <div class=" pg-inn">
                      <div style="overflow-x:auto;" class="all-listst">
                        {!! $pageContentPrivate->description !!}
                      </div>
                    </div>
                  </div>
                </section>
                <div class="text-center">
                  <a href="{{ url('private-institution-in-malaysia') }}" class="new-btn mar10">Browse All Private
                    Universities</a>
                </div>
              </div>
              <div class="tab-pane  fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <h3 class="priviate-us">Public Universities in Malaysia</h3>
                <section>
                  <div class="stu-db">
                    <div class=" pg-inn">
                      <div style="overflow-x:auto;" class="all-listst">
                        {!! $pageContentPublic->description !!}
                      </div>
                    </div>
                  </div>
                </section>
                <div class="text-center">
                  <a href="{{ url('public-institution-in-malaysia') }}" class="new-btn mar10">Browse All Public
                    Universities</a>
                </div>
              </div>
              <div class="tab-pane  fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <h3 class="priviate-us">Foreign Universities in Malaysia</h3>
                <section>
                  <div class="stu-db">
                    <div class=" pg-inn">
                      <div style="overflow-x:auto;" class="all-listst">
                        {!! $pageContentForeign->description !!}
                      </div>
                    </div>
                  </div>
                </section>
                <div class="text-center">
                  <a href="{{ url('foreign-universities-in-malaysia') }}" class="new-btn ">Browse All Foreign
                    Universities</a>
                </div>
              </div>
            </div>

            <div class="cor-p5">
              {!! $pageContentBottom->description !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    function applyFilter(col, val) {
      //alert(col+' '+val);
      if (val != '') {
        $.ajax({
          url: "{{ route('university.list.apply.filter') }}",
          method: "GET",
          data: {
            col: col,
            val: val
          },
          success: function(data) {
            //alert(data);
            window.location.replace(data);
          }
        });
      }
    }
  </script>
@endsection
