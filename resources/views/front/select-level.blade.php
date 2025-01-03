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
                        <li class="facts-1"><a href="{{ url('/select-level/') }}">Select Level</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb -->
<!-- Content -->
<section class="levellight">
    <div class="container">
  <div class="text-center con-title mb-5">
  <h2 >Select Your <span>Qualified Level</span></h2>
  </div>
        <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-4">
                <div class="ed-ad-dec">

                    <div class="ed-ad-img">

                        <img class="alluniversty"  src=" {{ asset('assets/images/levels/pre-university-courses.png') }}"
                            alt="pre university">

                    </div>

                    <h4>CERTIFICATE</h4>

                    <p class="jsfy">A certificate course is the shortest course of study. It is designed to give
                        candidate’s
                        proficiency over a single subject area or topic.<br  class="hidden-xs">&nbsp;</p>

                    <a href="<?php echo url('courses/pre-university'); ?>">SELECT</a>

                </div>
            </div>



            <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-4">
                <div class="ed-ad-dec">

                    <div class="ed-ad-img">

                        <img class="alluniversty"   src=" {{ asset('assets/images/levels/under-graduate-courses.png') }}"
                            alt="under grd'">

                    </div>

                    <h4>PRE UNIVERSITY</h4>

                    <p class="jsfy">A candidate who has passed SPM or O-Level exams and is looking for further studies
                        can
                        enroll into a Pre-University preparatory course programme.
                        <!--br / class="hidden-xs">&nbsp;-->
                    </p>

                    <a href="<?php echo url('courses/pre-university'); ?>">SELECT</a>

                </div>
            </div>



            <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-4">
                <div class="ed-ad-dec">

                    <div class="ed-ad-img">

                        <img class="alluniversty"   src=" {{ asset('assets/images/levels/graduadtion.png') }}" 
                            alt=" graduadtion">

                    </div>

                    <h4>DIPLOMA</h4>

                    <p class="jsfy">It can be considered the equivalent of a first year degree & qualification is
                        considered
                        to be higher than Pre-University. It is offered in specific function areas.</p>

                    <a href="<?php echo url('courses/diploma'); ?>">SELECT</a>

                </div>
            </div>


            <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-4">
                <div class="ed-ad-dec">

                    <div class="ed-ad-img">

                        <img class="alluniversty"  src=" {{ asset('assets/images/levels/degree-courses.png') }}" 
                            alt="degree courses">

                    </div>

                    <h4>UNDER GRADUATE</h4>

                    <p class="jsfy">A degree which is the first level of post secondary education a student wishes to
                        pursue.
                        It is a term for a degree gained by a candidate who has completed undergraduate course
                        programmes.</p>

                    <a href="<?php echo url('courses/under-graduate'); ?>">SELECT</a>

                </div>
            </div>



            <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-4">
                <div class="ed-ad-dec">

                    <div class="ed-ad-img">

                        <img class="alluniversty"  src=" {{ asset('assets/images/levels/master-courses.png') }}" 
                            alt="master courses">

                    </div>

                    <h4>POST GRADUATE</h4>

                    <p class="jsfy">Post Graduate Diploma is a version of shorter qualification than a masters degree
                        although
                        at the same scholastic level.<br / class="hidden-xs">&nbsp;</p>

                    <a href="<?php echo url('courses/post-graduate'); ?>">SELECT</a>

                </div>
            </div>



            <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-4">
                <div class="ed-ad-dec">

                    <div class="ed-ad-img">

                        <img class="alluniversty"  src=" {{ asset('assets/images/levels/phd-courses.png') }}" 
                            alt="phd courses">

                    </div>

                    <h4>PhD DOCTORATE</h4>

                    <p class="jsfy">Doctor of Philosophy is also called a PhD in short. Once a candidate completes this
                        degree, they are then qualified to teach any subject they want to at the university level.</p>

                    <a href="<?php echo url('courses/phd'); ?>">SELECT</a>

                </div>
            </div>



        </div>
    </div>
</section>
<!-- Content -->
@endsection