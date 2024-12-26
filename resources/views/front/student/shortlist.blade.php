@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <!-- Content -->
  <section class="gray pt-5">
    <div class="container-fluid">
      <div class="row">
        @include('front.student.profile-sidebar')
        <div class=" col-lg-9 col-md-9 col-sm-12">
          <div class="infoContent mt-0">
            <div class="row">
              <div class="col-md-12">
                <h2>Your Shortlisted Programs</h2>
              </div>
            </div>
            @if ($rows->count() > 0)
              <div class="dashboard_container mt-3">
                <div class="dashboard_container_body">

                  @foreach ($rows as $row)
                    <div class="dashboard_single_course align-items-center" id="programItem{{ $row->id }}">
                      <div class="dashboard_single_course_caption p-0">
                        <div class="dashboard_single_course_head">
                          <div class="dashboard_single_course_head_flex">
                            <h4 class="dashboard_course_title">{{ $row->universityProgram->course_name }}</h4>
                          </div>
                          <div class="dc_head_right">
                            <div class="dropdown">
                              <a class="btn btn-theme text-white rounded dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Download"><span
                                  class="d-none d-sm-inline">Downlaod</span></a>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" x-placement="bottom-start">
                                <a class="dropdown-item" href="#">Brochure</a>
                                <a class="dropdown-item" href="#">Fee Structure</a>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row align-items-center">
                          <div class="col-md-7">
                            <div class="row">
                              <div class="col-md-3 col-6 mt-1 mb-1"><span class="theme-cl">Study Mode:</span><br>
                                {{ $row->universityProgram->study_mode }}
                              </div>
                              <div class="col-md-3 col-6 mt-1 mb-1"><span class="theme-cl">Duration:</span><br>
                                {{ $row->universityProgram->duration ?? 'N/A' }}
                              </div>
                              <div class="col-md-3 col-6 mt-1 mb-1"><span class="theme-cl">Deadline:</span><br>
                                {{ $row->universityProgram->application_deadline ?? 'N/A' }}
                              </div>
                              <div class="col-md-3 col-6 mt-1 mb-1">Intake:<br>
                                <strong>{{ $row->universityProgram->intake ?? 'N/A' }}</strong>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12 mt-1"><span class="theme-cl">
                              Exams Accepted:</span><br>{{ json_to_string($row->universityProgram->exam_accepted) }}
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach

                </div>
              </div>
            @else
              <div class="row justify-content-center">
                <div class="col-md-5">
                  <p>Nothing to show yet. You haven't applied to any colleges.</p>

                </div>
              </div>
            @endif
            <div class="row justify-content-center mt-3">
              <a href="{{ url('courses-in-malaysia') }}" class="btn btn-modern float-none">
                Browse Colleges<span><i class="ti-arrow-right"></i></span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Content -->
  <script>
    jQuery(document).ready(function($) {
      $(function() {
        $(".scrollTo a").click(function(e) {
          var destination = $(this).attr('href');
          $(".scrollTo li").removeClass('active');
          $(this).parent().addClass('active');

          $('html, body').animate({
            scrollTop: $(destination).offset().top - 90
          }, 500);
        });
      });
      var totalHeight = $('#myHeader').height() + $('.proHead').height();
      $(window).scroll(function() {
        if ($(this).scrollTop() > totalHeight) {
          $('.proHead').addClass('sticky');
        } else {
          $('.proHead').removeClass('sticky');
        }
      })
    });
  </script>
  <script>
    $(document).on('click', '#close-preview', function() {
      $('.image-preview').popover('hide');
      // Hover befor close the preview
      $('.image-preview').hover(
        function() {
          $('.image-preview').popover('show');
        },
        function() {
          $('.image-preview').popover('hide');
        }
      );
    });

    $(function() {
      // Create the close button
      var closebtn = $('<button/>', {
        type: "button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
      });
      closebtn.attr("class", "close pull-right");
      // Set the popover default content
      $('.image-preview').popover({
        trigger: 'manual',
        html: true,
        title: "<strong>Preview</strong>" + $(closebtn)[0].outerHTML,
        content: "There's no image",
        placement: 'bottom'
      });
      // Clear event
      $('.image-preview-clear').click(function() {
        $('.image-preview').attr("data-content", "").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse");
      });
      // Create the preview image
      $(".image-preview-input input:file").change(function() {
        var img = $('<img/>', {
          id: 'dynamic',
          width: 250,
          height: 200
        });
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function(e) {
          $(".image-preview-input-title").text("Change");
          $(".image-preview-clear").show();
          $(".image-preview-filename").val(file.name);
          img.attr('src', e.target.result);
          $(".image-preview").attr("data-content", $(img)[0].outerHTML).popover("show");
        }
        reader.readAsDataURL(file);
      });
    });
  </script>
  <script>
    $("#upload").click(function() {
      $("#upload-file").trigger('click');
    });
  </script>
@endsection
