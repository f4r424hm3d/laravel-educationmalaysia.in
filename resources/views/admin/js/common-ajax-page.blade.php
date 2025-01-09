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
  // DELETE ROW
  function deleteData(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "{{ url('admin/' . $page_route . '/delete') }}" + "/" + id,
          success: function(data) {
            if (data.success == true) {
              getData();
              Swal.fire('Deleted!', 'Your record has been deleted.', 'success');
            }
          }
        });
      }
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
              CKEDITOR.instances.description.setData('');
              setEditorBlank();
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
