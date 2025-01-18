@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('main-section')
<section class="bannerfixed">
  <div class="container">
    <div class="banner-fix">
      <img src="/assets/images/new-banner2.png" class="fix-banners" alt="">
    </div>
  </div>
</section>
  <section class="institutes">
    <div class="container">
      <div class="row-institutes">
        <div class="row">
          <div class="col-2 col-sm-12 col-md-2 mb-4">
            <div class="institues-img">
              <img src="/assets/images/malaysia-uni1.jpeg" class="img-fluid" alt="">
            </div>

          </div>
          <div class="col-12 col-sm-12 col-md-10 mb-4 ">
            <div class="universitynames">
              <h2>University of Malaya (UM)</h2>
              <p> <span>Location:</span> Kuala Lumpur</p>
            </div>
          </div>
          <div class="col-12">
            <p class=" parargraph-more" >
              UKM is located in Bangi, a township just next to Kajang. It is easy to take Commuter train, just about 20
              minutes ride to Kuala Lumpur, the capital of Malaysia. Taxis are plentiful and easy accessible too. Taxi
              will cost you about RM 5.00 per trip to UKM.
              UKM is located in Bangi, a township just next to Kajang. It is easy to take Commuter train, just about 20
              minutes ride to Kuala Lumpur, the capital of Malaysia. Taxis are plentiful and easy accessible too. Taxi
              will cost you about RM 5.00 per trip to UKM.
              UKM is located in Bangi, a township just next to Kajang. It is easy to take Commuter train, just about 20
              minutes ride to Kuala Lumpur, the capital of Malaysia. Taxis are plentiful and easy accessible too. Taxi
              will cost you about RM 5.00 per trip to UKM.

              UKM is located in Bangi, a township just next to Kajang. It is easy to take Commuter train, just about 20
              minutes ride to Kuala Lumpur, the capital of Malaysia. Taxis are plentiful and easy accessible too. Taxi
              will cost you about RM 5.00 per trip to UKM.
              UKM is located in Bangi, a township just next to Kajang. It is easy to take Commuter train, just about 20
              minutes ride to Kuala Lumpur, the capital of Malaysia. Taxis are plentiful and easy accessible too. Taxi
              will cost you about RM 5.00 per trip to UKM.

              UKM is located in Bangi, a township just next to Kajang. It is easy to take Commuter train, just about 20
              minutes ride to Kuala Lumpur, the capital of Malaysia. Taxis are plentiful and easy accessible too. Taxi
              will cost you about RM 5.00 per trip to UKM.UKM is located in Bangi, a township just next to Kajang. It is
              easy to take Commuter train, just about 20 minutes ride to Kuala Lumpur, the capital of Malaysia. Taxis are
              plentiful and easy accessible too. Taxi will cost you about RM 5.00 per trip to UKM.UKM is located in Bangi,
              a township just next to Kajang. It is easy to take Commuter train, just about 20 minutes ride to Kuala
              Lumpur, the capital of Malaysia. Taxis are plentiful and easy accessible too. Taxi will cost you about RM
              5.00 per trip to UKM.
            </p>
            <a class="showbx" href="#">Show More <i class="fa fa-angle-down" aria-hidden="true"></i>
            </a>
            <a class="showbx" href="#">Show Less <i class="fa fa-angle-up" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <button class="featuresoption"> <span></span> Featured </button>
      </div>
    

    </div>
  </section>
@endsection
