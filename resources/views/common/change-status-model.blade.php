<div class="modal fade" id="changeStatusFollowUp" tabindex="-1" role="dialog" aria-labelledby="changeStatusFollowUpTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changeStatusFollowUpTitle">
          Follow Up
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-body">
            <form id="leadStatusForm" method="post">
              <input type="hidden" id="csId" name="student_id" value="">
              <input type="hidden" id="user_id" name="user_id" value="">
              <div class="row">
                <div class="form-group mb-3 col-md-6">
                  <label>Lead Status <span class="text-danger">*</span></label>
                  <select name="lead_status" id="lead_status" class="form-control " required>
                    <option value="">Select...</option>
                    @foreach ($ls as $row)
                      <option value="<?php echo $row->id; ?>"><?php echo $row->title; ?></option>
                    @endforeach
                  </select>
                </div>
                <div class=" form-group mb-3 col-md-6">
                  <label>Lead Sub Status</label>
                  <select name="lead_sub_status" id="lead_sub_status" class="form-control ">
                    <option value="">Select...</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="form-group mb-3 col-md-12">
                  <label class="form-label" for="next_followup_date">Next Follow up Date <span
                      class="text-danger">*</span></label>
                  <input name="next_followup_date" placeholder="Enter Date" class="form-control" type="date"
                    id="next_followup_date" min="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="form-group mb-3 col-md-6 col-sm-12">
                  <label class="form-label" for="followup_type">Type</label>
                  <select id="followup_type" name="followup_type" class="form-control ">
                    <option value="">Select</option>
                    @foreach ($fuptype as $row)
                      <option value="<?php echo $row->followup_type; ?>"><?php echo $row->followup_type; ?></option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group mb-3 col-md-6 col-sm-12">
                  <label class="form-label" for="followup_status">Status</label>
                  <select id="followup_status" name="followup_status" class="form-control ">
                    <option value="">Select</option>
                    @foreach ($fupstatus as $row)
                      <option value="<?php echo $row->followup_status; ?>"><?php echo $row->followup_status; ?></option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group mb-3 col-md-12 col-sm-12">
                  <label class="form-label sr-only" for="remark">Follow Up Note </label>
                  <textarea rows="2" class="form-control mb-2 mr-sm-2" id="remark" name="remark" placeholder="Add notes"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="form-group mb-3 col-md-12 col-sm-12">
                  <label class="form-label sr-onl" for="comment">comment <span class="text-danger">*</span></label>
                  <textarea rows="6" class="form-control mb-2 mr-sm-2" id="comment" name="comment" placeholder="Add Comment"
                    required></textarea>
                </div>
              </div>
              <div class="row">
                <div class="form-group mb-3 col-md-4">
                  <button type="submit" id="changeStatusForm_btn" class="btn btn-primary mb-2">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#leadStatusForm').on('submit', function(event) {
      event.preventDefault();
      var student_id = $('#csId').val();
      //alert(student_id);
      $.ajax({
        url: "{{ url('common/add-student-follow-up') }}",
        method: "GET",
        data: $(this).serialize(),
        success: function(result) {
          //alert(result);
          $('#leadStatusForm')[0].reset();
          $("#changeStatusFollowUp").modal('hide');
          fetchLastFollowup(student_id);
          if (result == '1') {
            var h = 'Success';
            var msg = 'Status has been updated successfully.';
            var type = 'success';
          } else {
            var h = 'Danger';
            var msg = 'Failed !. Status not changed.';
            var type = 'danger';
          }
          $('#toastMsg').text(msg);
          $('#liveToast').show();
        }
      })
    });

    $('#lead_status').on('change', function(event) {
      var status_id = $('#lead_status').val();
      $.ajax({
        url: "{{ url('common/get-lead-sub-status-by-status') }}",
        method: "GET",
        data: {
          status_id: status_id
        },
        success: function(result) {
          $('#lead_sub_status').html(result);
        }
      })
    });
  });


  function fetchLastFollowup(id) {
    //alert(id);
    if (id != '') {
      $.ajax({
        url: "{{ url('common/get-last-follow-up') }}",
        method: "GET",
        data: {
          student_id: id
        },
        success: function(data) {
          //alert(data);
          $('#followupDiv' + id).html(data);
        }
      });
    }
  }
</script>
