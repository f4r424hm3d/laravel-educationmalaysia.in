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
        <!-- NOTIFICATION FIELD START -->
        <x-FrontResultNotification></x-FrontResultNotification>
        <!-- NOTIFICATION FIELD END -->
        <div class="infoContent mt-0">
          <form action="{{ url('student/change-password') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $student->id }}">
            <div class="row">
              <div class="col-md-12">
                <h2>Change Password</h2>
              </div>
              <div class="col-md-4"></div>
              <div class="col-md-4">
                <label>Password <span class="red">*</span></label>
                <input name="old_password" type="password" placeholder="Enter Current Password" required>
                <span class="text-danger">
                  @error('old_password')
                  {{ $message }}
                  @enderror
                </span>
              </div>
              <div class="col-md-4"></div>
              <div class="col-md-4"></div>
              <div class="col-md-4">
                <label>Enter New Password</label>
                <input name="new_password" type="password" placeholder="Enter New Password" required>
                <span class="text-danger">
                  @error('new_password')
                  {{ $message }}
                  @enderror
                </span>
              </div>
              <div class="col-md-4"></div>
              <div class="col-md-4"></div>
              <div class="col-md-4">
                <label>Confirm New Password</label>
                <input name="confirm_new_password" type="password" placeholder="Confirm New Password" required>
                <span class="text-danger">
                  @error('confirm_new_password')
                  {{ $message }}
                  @enderror
                </span>
              </div>
              <div class="col-md-4"></div>
              <div class="col-md-12"><button class="saveBtn">Save</button><button class="cancelBtn">Cancel</button>
              </div>
            </div>
          </form>
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
