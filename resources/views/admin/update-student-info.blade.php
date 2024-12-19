<div class="modal fade" id="DesModalScrollable" tabindex="-1" role="dialog" aria-labelledby="desModalScrollableTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="desModalScrollableTitle">
          Mail List
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editInfoForm" method="post">
          <input type="hidden" id="updinfo_student_id" name="id" value="">
          <div class="row" id="rowDivUpdateInfo">

          </div>
          <div class="row">
            <div class="form-group col-md-4">
              <button id="send_form" type="submit" class="btn btn-sm btn-primary">Save</button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
  function editInfoModelFunc(id) {
    $('#editInfoForm')[0].reset();
    //$('#editInfoForm').reset();
    $('#updinfo_student_id').val(id);
    //alert(id);
    $.ajax({
      url: "{{ aurl('leads/get-quick-info') }}",
      method: "GET",
      data: {
        id: id
      },
      success: function(result) {
        //alert(result);
        $('#rowDivUpdateInfo').html(result);
      }
    })
  }
  $(document).ready(function() {
    $('#editInfoForm').on('submit', function(event) {
      event.preventDefault();
      var id = $('#updinfo_student_id').val();
      var name = $('#name').val();
      var email = $('#email').val();
      var mobile = $('#mobile').val();
      //alert(id + name + email + mobile);
      $.ajax({
        url: "{{ aurl('leads/update-quick-info/') }}/",
        method: "get",
        data: {
          id: id,
          name: name,
          email: email,
          mobile: mobile,
        },
        success: function(result) {
          //alert(result);
          $('#editInfoForm')[0].reset();
          $("#DesModalScrollable").modal('hide');
          fetchLastUpdatedRecord(id);
          if (result == 'success') {
            var h = 'Success';
            var msg = 'Record updated successfully.';
            var type = 'success';
          } else {
            var h = 'Failed';
            var msg = 'Failed !. Some error occured.';
            var type = 'danger';
          }
          $('#toastMsg').text(msg);
          $('#liveToast').show();
          showToastr(h, msg, type);
        }
      })
    });
  });

  function fetchLastUpdatedRecord(id) {
    //alert(id);
    if (id != '') {
      $.ajax({
        url: "{{ aurl('leads/fetch-last-updated-record') }}/" + id,
        method: "get",
        success: function(data) {
          //alert(data);
          $('#contactTd' + id).html(data);
        }
      });
    }
  }
</script>
