@extends('backend.layouts.main')
@push('title')
<title>{{ $page_title }}</title>
@endpush
@section('main-section')
<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18">{{ $page_title }}</h4>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="{{ url('/admin/') }}"><i class="mdi mdi-home-outline"></i></a></li>
              <li class="breadcrumb-item"><a href="{{ url('/admin/companies/') }}">Company</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12">
        {{-- @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif --}}
        <!-- NOTIFICATION FIELD START -->
        <x-ResultNotificationField></x-ResultNotificationField>
        <!-- NOTIFICATION FIELD END -->
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">
              {{ $title }} Record
              <span style="float:right;">
                <button class="btn btn-sm btn-info tglBtn">+</button>
                <button class="btn btn-sm btn-info tglBtn hide-this">-</button>
              </span>
            </h4>
          </div>
          <div class="card-body {{ $ft=='edit'?'':'hide-thi' }}" id="tblCDiv">
            <form action="{{ $url }}" class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
              @csrf
              <input type="hidden" name="client_id" value="<?php echo $client->id; ?>">
              <div class="row">
                <div class="col-md-3 col-sm-12 mb-3">
                  <x-SelectField label="Select Company" name="company_id" id="company_id" savev="id" showv="name"
                    :list="$companies" :ft="$ft" :sd="$sd"></x-SelectField>
                </div>
                <div class="col-md-4 col-sm-12 mb-3">
                  <x-InputField type="text" label="Subject" name="subject" id="subject" :ft="$ft" :sd="$sd">
                  </x-InputField>
                </div>
                <div class="col-md-2 col-sm-12 mb-3">
                  <x-InputField type="date" label="Invoice Date" name="invoice_date" id="invoice_date" :ft="$ft"
                    :sd="$sd">
                  </x-InputField>
                </div>
                <div class="col-md-3 col-sm-12 mb-3">
                  <x-InputField type="text" label="Reference Number" name="reference_number" id="reference_number"
                    :ft="$ft" :sd="$sd">
                  </x-InputField>
                </div>
                <div class="col-md-3 col-sm-12 mb-3">
                  <x-StaticSelectField label="Tax Type" name="tax_type" id="tax_type" savev="id" showv="name"
                    :list="$taxTypes" :ft="$ft" :sd="$sd"></x-StaticSelectField>
                </div>
                <div class="col-md-3 col-sm-12 mb-3">
                  <x-InputField type="number" label="Tax" name="tax" id="tax" :ft="$ft" :sd="$sd" step="any">
                  </x-InputField>
                </div>
                <div class="col-md-3 col-sm-12 mb-3">
                  <x-InputField type="text" label="Currency" name="currency" id="currency" :ft="$ft" :sd="$sd">
                  </x-InputField>
                </div>
                <div class="col-md-3 col-sm-12 mb-3">
                  <x-InputField type="text" label="Invoice No" name="invoice_no" id="invoice_no" :ft="$ft" :sd="$sd">
                  </x-InputField>
                </div>
                <div class="col-md-12 col-sm-12 mb-3">
                  <x-TextareaField label="Term & Condition" name="term_condition" id="term_condition" :ft="$ft"
                    :sd="$sd">
                  </x-TextareaField>
                </div>
              </div>
              <hr>
              <h3>Items</h3>
              <div class="field_wrapper2">
                <div class="row">
                  <div class="form-group col-md-3 col-sm-12">
                    <label>Description</label>
                    <input type="text" class="form-control" name="description[]" id="description" required>
                  </div>
                  <div class="form-group col-md-3 col-sm-12">
                    <label>Qty</label>
                    <input type="text" class="form-control" name="qty[]" id="qty" required>
                  </div>
                  <div class="form-group col-md-2 col-sm-12">
                    <label>Amount</label>
                    <input type="number" class="form-control" name="amount[]" id="amount" required>
                  </div>
                  <div class="form-group col-md-2 col-sm-12">
                    <a data-toggle="tooltip" href="javascript:void()" class="btn btn-sm btn-info add_button2 col-btn"
                      title="add row">Add More</a>
                  </div>
                </div>
              </div>
              <hr>
              <h3>Instalment</h3>
              <div class="field_wrapper">
                <div class="row">
                  <div class="form-group col-md-3 col-sm-12">
                    <label>Description</label>
                    <input type="text" class="form-control" name="description2[]">
                  </div>
                  <div class="form-group col-md-2 col-sm-12">
                    <label>Amount (%)</label>
                    <input type="number" class="form-control" name="amount2[]" id="amount">
                  </div>
                  <div class="form-group col-md-2 col-sm-12">
                    <a data-toggle="tooltip" href="javascript:void()" class="btn btn-sm btn-info add_button col-btn"
                      title="add row">Add More</a>
                  </div>
                </div>
              </div>
              <br>
              @if ($ft == 'add')
              <button type="reset" class="btn btn-sm btn-warning  mr-1"><i class="ti-trash"></i> Reset</button>
              @endif
              @if ($ft == 'edit')
              <a href="{{ aurl($page_route) }}" class="btn btn-sm btn-info "><i class="ti-trash"></i> Cancel</a>
              @endif
              <button class="btn btn-sm btn-primary" type="submit">Submit</button>
            </form>
          </div>
        </div>
        <!-- end card -->
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">
              {{ $page_title }} List
            </h4>
          </div>
          <div class="card-body">
            <table id="datatable" class="table table-bordered dt-responsive nowra w-100">
              <thead>
                <tr>
                  <th>S.No.</th>
                  <th>Invoice No</th>
                  <th>Invoice To</th>
                  <th>Subject</th>
                  <th>Date</th>
                  <th>Mail</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                $i=1;
                @endphp
                @foreach ($invoices as $row)
                <tr id="row{{ $row->id }}">
                  <td>{{ $i }}</td>
                  <td>{{$row->invoice_no}}</td>
                  <td>{{$row->invoice_to}}</td>
                  <td>{{$row->subject}}</td>
                  <td>{{$row->invoice_date}}</td>
                  <td>

                    @if ($row->getMails->count()>0)
                    <button type="button" class="btn btn-xs btn-outline-info waves-effect waves-light"
                      data-bs-toggle="modal" data-bs-target="#DesModalScrollable{{ $row->id }}">View</button>
                    <div class="modal fade" id="DesModalScrollable{{ $row->id }}" tabindex="-1" role="dialog"
                      aria-labelledby="desModalScrollableTitle{{ $row->id }}" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="desModalScrollableTitle{{ $row->id }}">
                              Mail List
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th>S. N.</th>
                                  <th>Date</th>
                                  <th>Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                @php
                                $j=1;
                                @endphp
                                @foreach ($row->getMails as $maild)
                                <tr>
                                  <td>{{ $j }}</td>
                                  <td>{{ getFormattedDate($maild->created_at,'d M Y - h:i:s A') }}</td>
                                  <td>
                                    @if ($maild->status==1)
                                    <span class="badge bg-success">Seen</span> at {{
                                    getFormattedDate($maild->updated_at,'d M Y - h:i:s A') }}
                                    @else
                                    <span class="btn btn-sm btn-warning">Not Seen</span>
                                    @endif
                                  </td>
                                </tr>
                                @php
                                $j++;
                                @endphp
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif

                    {{-- <a target="_blank" href="{{ aurl('invoice/send-mail/'.$row->id) }}" data-toggle="tooltip"
                      class="btn btn-sm btn-success" title="Send invoice on mail">Send
                      Mail</a> --}}

                  </td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn btn-soft-success waves-effect waves-light dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bx bx-dots-horizontal-rounded"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                          <a class="dropdown-item text-primary" target="_blank"
                            href="{{ aurl('invoice/copy/'.$row->id) }}" data-toggle="tooltip"
                            title="Copy Invoice">Copy</a>
                        </li>
                        <li>
                          <a class="dropdown-item text-primary" target="_blank"
                            href="{{ aurl('invoice/view/'.$row->id) }}" data-toggle="tooltip"
                            title="View Invoice">View</a>
                        </li>
                        <li>
                          <a class="dropdown-item text-primary" target="_blank"
                            href="{{ aurl('invoice/print/'.$row->id) }}" data-toggle="tooltip"
                            title="Print Invoice">Print</a>
                        </li>
                        <li>
                          <a class="dropdown-item text-primary" target="_blank"
                            href="{{ aurl('invoice/receipt/'.$row->id) }}" data-toggle="tooltip"
                            title="Invoice Receipts">Receipts @if ($row->getReceipt->count()>0)
                            <span class="badge bg-success ms-1">{{ $row->getReceipt->count() }}</span>
                            @endif</a>
                        </li>
                        <li>
                          <a class="dropdown-item text-danger" href="javascript:void()"
                            onclick="DeleteAjax('{{ $row->id }}')">
                            <i class="fa fa-trash" aria-hidden="true"></i> Delete
                          </a>
                        </li>
                        @if ($row->getClient->email!=null)
                        @if ($row->getMails->count()==0)
                        <li>
                          <div id="sendMailBtn{{ $row->id }}">
                            <a class="dropdown-item text-success" onclick="sendMail('{{ $row->id }}')"
                              data-toggle="tooltip" title="Send invoice on mail">Send Mail</a>
                          </div>
                        </li>

                        @endif
                        @endif

                      </ul>
                    </div>
                  </td>
                </tr>
                @php
                $i++;
                @endphp
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function sendMail(invoice_id) {
    //alert(invoice_id)
    $('#sendMailBtn'+invoice_id).html('<span class="btn btn-sm btn-info">Sending...</span>');
    $.ajax({
        url: "{{ aurl('invoice/send-mail/') }}" + "/" + invoice_id,
        success: function(data) {
          //alert(data);
          if (data == '1') {
            var h = 'Success';
            var msg = 'Mail sent successfully.';
            var type = 'success';
            $('#sendMailBtn'+invoice_id).html('<span class="btn btn-sm btn-success">Sent</span>');
            $('#toastMsg').text(msg);
            $('#liveToast').show();
            showToastr(h, msg, type);
          }
        }
      });
  }

  CKEDITOR.replace("term_condition");

  $(document).ready(function() {
      var maxField = 30; //Input fields increment limitation
      var addButton = $('.add_button'); //Add button selector
      var wrapper = $('.field_wrapper'); //Input field wrapper
      var fieldHTML = '<div class="row"><div class="form-group col-md-3 col-sm-12"><label class="form-label sr-onl" for="description">Description</label><input type="text" class="form-control" name="description2[]" id="description"></div><div class="form-group col-md-2 col-sm-12"><label class="form-label sr-onl" for="amount">Amount</label><input type="number" class="form-control" name="amount2[]" id="amount"></div><div class="form-group col-md-2 col-sm-12"><a data-toggle="tooltip" href="javascript:void()" class="btn btn-danger btn-sm remove_button col-btn" title="Remove">Remove</a></div><div class="row">';
      // New input field html
      var x = 1; //Initial field counter is 1
      //Once add button is clicked
      $(addButton).click(function() {
          //Check maximum number of input fields
          if (x < maxField) {
              x++; //Increment field counter
              $(wrapper).append(fieldHTML); //Add field html
          }
      });
      //Once remove button is clicked
      $(wrapper).on('click', '.remove_button', function(e) {
          e.preventDefault();
          // $(this).parent().parent('div').remove(); //Remove field html
          $(this).closest(".row").remove();
          x--; //Decrement field counter
      });
  });

  $(document).ready(function() {
      var maxField = 30; //Input fields increment limitation
      var addButton = $('.add_button2'); //Add button selector
      var wrapper = $('.field_wrapper2'); //Input field wrapper
      var fieldHTML = '<div class="row"><div class="form-group col-md-3 col-sm-12"><label>Description</label><input type="text" class="form-control" name="description[]" id="description"></div><div class="form-group col-md-3 col-sm-12"><label>qty</label><input type="text" class="form-control" name="qty[]" id="qty"></div><div class="form-group col-md-2 col-sm-12"><label>Amount</label><input type="number" class="form-control" name="amount[]" id="amount"></div><div class="form-group col-md-2 col-sm-12"><a data-toggle="tooltip" href="javascript:void()" class="btn btn-danger btn-sm remove_button2 col-btn" title="Remove">Remove</a></div><div class="row">';
      // New input field html
      var x = 1; //Initial field counter is 1
      //Once add button is clicked
      $(addButton).click(function() {
          //Check maximum number of input fields
          if (x < maxField) {
              x++; //Increment field counter
              $(wrapper).append(fieldHTML); //Add field html
          }
      });
      //Once remove button is clicked
      $(wrapper).on('click', '.remove_button2', function(e) {
          e.preventDefault();
          // $(this).parent().parent('div').remove(); //Remove field html
          $(this).closest(".row").remove();
          x--; //Decrement field counter
      });
  });

  function incfun() {
    $('#add-inv-btn').toggle();
    $('#view-inv-btn').toggle();
    $('#invtbl').toggle();
    $('#invform').toggle();
  }

  function DeleteAjax(id) {
    //alert(id);
    var cd = confirm("Are you sure ?");
    if (cd == true) {
      $.ajax({
        url: "{{ url('admin/'.$page_route.'/delete') }}" + "/" + id,
        success: function(data) {
          if (data == '1') {
            var h = 'Success';
            var msg = 'Record deleted successfully';
            var type = 'success';
            $('#row' + id).remove();
            $('#toastMsg').text(msg);
            $('#liveToast').show();
            showToastr(h, msg, type);
          }
        }
      });
    }
  }
</script>
@endsection
