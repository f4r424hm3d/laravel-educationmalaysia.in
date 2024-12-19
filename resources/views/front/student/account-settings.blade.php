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
              <h2>Account Settings</h2>
            </div>
          </div>

          <div class="row justify-content-center">
            <div class="col-md-6 mt-3">

              <div class="b-all p-4 rounded">

                <div>
                  <span style="font-size:16px">Email Communications</span>
                  <div class="switch2 float-right">
                    <input type="checkbox" id="toggleAll1" />
                    <label for="toggleAll1"></label>
                  </div>
                </div>

                <hr>

                <div>
                  <span style="font-size:16px">SMS Communications</span>
                  <div class="switch2 float-right">
                    <input type="checkbox" id="toggleAll2" />
                    <label for="toggleAll2"></label>
                  </div>
                </div>

              </div>

              <div class="pt-4 pl-2 pb-3 pr-2">

                <div class="row align-items-center">
                  <div class="col-md-7">
                    Are you sure to delete your account?
                  </div>
                  <div class="col-md-5">
                    <a href="#" class="btn btn-modern float-right">
                      Delete <span><i class="ti-trash"></i></span>
                    </a>
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
<!-- Content -->
<script>
  jQuery(document).ready(function ($) {
    $(function () {
      $(".scrollTo a").click(function (e) {
        var destination = $(this).attr('href');
        $(".scrollTo li").removeClass('active');
        $(this).parent().addClass('active');

        $('html, body').animate({
          scrollTop: $(destination).offset().top - 90
        }, 500);
      });
    });
    var totalHeight = $('#myHeader').height() + $('.proHead').height();
    $(window).scroll(function () {
      if ($(this).scrollTop() > totalHeight) {
        $('.proHead').addClass('sticky');
      } else {
        $('.proHead').removeClass('sticky');
      }
    })
  });
</script>

<script>
  $(document).on('click', '#close-preview', function () {
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
      function () {
        $('.image-preview').popover('show');
      },
      function () {
        $('.image-preview').popover('hide');
      }
    );
  });

  $(function () {
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
    $('.image-preview-clear').click(function () {
      $('.image-preview').attr("data-content", "").popover('hide');
      $('.image-preview-filename').val("");
      $('.image-preview-clear').hide();
      $('.image-preview-input input:file').val("");
      $(".image-preview-input-title").text("Browse");
    });
    // Create the preview image
    $(".image-preview-input input:file").change(function () {
      var img = $('<img/>', {
        id: 'dynamic',
        width: 250,
        height: 200
      });
      var file = this.files[0];
      var reader = new FileReader();
      // Set preview image into the popover data-content
      reader.onload = function (e) {
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
  $("#upload").click(function () {
    $("#upload-file").trigger('click');
  });

</script>
@endsection