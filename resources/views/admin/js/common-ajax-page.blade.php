<script>
  getData();

  function getData(page) {
    if (page) {
      page = page;
    } else {
      var page = '{{ $page_no ?? 1 }}';
    }
    return new Promise(function(resolve, reject) {
      //$("#migrateBtn").text('Migrating...');
      setTimeout(() => {
        $.ajax({
          url: "{{ aurl($page_route . '/get-data') }}",
          method: "GET",
          data: {
            page: page,
          },
          success: function(data) {
            $("#trdata").html(data);
          }
        });
      });
    });
  }


  function printErrorMsg(msg) {
    $.each(msg, function(key, value) {
      $("#" + key + "-err").text(value);
    });
  }

  $(document).ready(function() {
    $(document).on('click', '.pagination a', function(event) {
      event.preventDefault();
      var page = $(this).attr('href').split('page=')[1];
      getData(page);
    });

    $('#dataForm').on('submit', function(event) {
      event.preventDefault();
      $(".errSpan").text('');
      $.ajax({
        url: "{{ aurl($page_route . '/store-ajax/') }}",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
          if ($.isEmptyObject(data.error)) {
            if (data.hasOwnProperty('success')) {
              Swal.fire({
                title: 'Success',
                text: data.success,
                icon: 'success',
                confirmButtonText: 'OK'
              });
              getData();
              $('#dataForm')[0].reset();
              CKEDITOR.instances.description.setData('');
            }
          } else {
            printErrorMsg(data.error);
            Swal.fire({
              title: 'Failed',
              text: 'Some error occurred. Please check the errors and try again.',
              icon: 'error',
              confirmButtonText: 'OK'
            });
          }
        }
      });
    });
  });
</script>
