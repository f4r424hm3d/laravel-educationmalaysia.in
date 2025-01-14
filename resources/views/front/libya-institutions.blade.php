@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('main-section')
 <section class="institutes">
 <div class="container">
     <div class="row-institutes">
     <div class="row">
       <div class="col-2 col-sm-12 col-md-2">
        <div class="institues-img">
          <img src="/assets/images/malaysia-uni1.jpeg" class="img-fluid" alt="">
        </div>
        
       </div>
       <div class="col-12 col-sm-12 col-md-10 ">
        <div class="universitynames">
        <h2>University of Malaya (UM)</h2>
        <p> <span>Location:</span> Kuala Lumpur</p>
        </div>
       </div>
        <div class="col-12">
          <ul>
            <li>Malaysia's oldest university, established in 1905.</li>
            <li>Renowned for its research contributions and diverse programs in arts, sciences, and professional disciplines.</li>
          </ul>
        </div>
      </div>
      <button class="featuresoption"> <span></span> Featured </button>
     </div>
     <div class="row-institutes">
     <div class="row">
       <div class="col-2 col-sm-12 col-md-2">
        <div class="institues-img">
          <img src="/assets/images/malaysia-uni1.jpeg" class="img-fluid" alt="">
        </div>
        
       </div>
       <div class="col-12 col-sm-12 col-md-10 ">
        <div class="universitynames">
        <h2>University of Malaya (UM)</h2>
        <p> <span>Location:</span> Kuala Lumpur</p>
        </div>
       </div>
        <div class="col-12">
          <ul>
            <li>Malaysia's oldest university, established in 1905.</li>
            <li>Renowned for its research contributions and diverse programs in arts, sciences, and professional disciplines.</li>
          </ul>
        </div>
       
      </div>
      <button class="featuresoption"> <span></span> Featured </button>
     </div>
     <div class="row-institutes">
     <div class="row">
       <div class="col-2 col-sm-12 col-md-2">
        <div class="institues-img">
          <img src="/assets/images/malaysia-uni1.jpeg" class="img-fluid" alt="">
        </div>
        
       </div>
       <div class="col-12 col-sm-12 col-md-10 ">
        <div class="universitynames">
        <h2>University of Malaya (UM)</h2>
        <p> <span>Location:</span> Kuala Lumpur</p>
        </div>
       </div>
        <div class="col-12">
          <ul>
            <li>Malaysia's oldest university, established in 1905.</li>
            <li>Renowned for its research contributions and diverse programs in arts, sciences, and professional disciplines.</li>
          </ul>
        </div>
       
      </div>
      <button class="featuresoption"> <span></span> Featured </button>
     </div>
    
    </div>
 </section>
@endsection
