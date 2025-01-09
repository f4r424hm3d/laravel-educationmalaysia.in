<script>
  getData();

  function getData(page) {
    if (page) {
      page = page;
    } else {
      var page = '{{ $page_no??1 }}';
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
</script>