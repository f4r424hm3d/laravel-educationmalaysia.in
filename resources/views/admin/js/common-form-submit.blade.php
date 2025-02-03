<script>
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
        url: "{{ aurl($page_route . '/store/') }}",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
          //alert(data);
          if ($.isEmptyObject(data.error)) {
            //alert(data.success);
            if (data.hasOwnProperty('success')) {
              var h = 'Success';
              var msg = data.success;
              var type = 'success';
              getData();
              $('#dataForm')[0].reset();
              setEditorBlank()
            }
          } else {
            //alert(data.error);
            printErrorMsg(data.error);
            var h = 'Failed';
            var msg = 'Some error occured';
            var type = 'danger';
          }
          showToastr(h, msg, type);
        }
      })
    });


  });
</script>
