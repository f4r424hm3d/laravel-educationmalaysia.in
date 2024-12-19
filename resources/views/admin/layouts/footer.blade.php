<footer class="footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <script>
          document.write(new Date().getFullYear());
        </script>
        © Education Malaysia Education
      </div>
      <div class="col-sm-6">
        <div class="text-sm-end d-none d-sm-block">
          Design & Develop by
          <a href="https://www.linkedin.com/in/4hm3df4r42/" class="text-decoration-underline">Mohd Faraz</a>
        </div>
      </div>
    </div>
  </div>
</footer>
</div>
<!-- end main content-->
</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<div class="right-bar">
  <div data-simplebar class="h-100">
    <div class="rightbar-title d-flex align-items-center bg-dark p-3">
      <h5 class="m-0 me-2 text-white">Theme Customizer</h5>

      <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
        <i class="mdi mdi-close noti-icon"></i>
      </a>
    </div>

    <!-- Settings -->
    <hr class="m-0" />

    <div class="p-4">
      <h6 class="mb-3">Layout</h6>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="layout" id="layout-vertical" value="vertical" />
        <label class="form-check-label" for="layout-vertical">Vertical</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="layout" id="layout-horizontal" value="horizontal" />
        <label class="form-check-label" for="layout-horizontal">Horizontal</label>
      </div>

      <h6 class="mt-4 mb-3 pt-2">Layout Mode</h6>

      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="layout-mode" id="layout-mode-light" value="light" />
        <label class="form-check-label" for="layout-mode-light">Light</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="layout-mode" id="layout-mode-dark" value="dark" />
        <label class="form-check-label" for="layout-mode-dark">Dark</label>
      </div>

      <h6 class="mt-4 mb-3 pt-2">Layout Width</h6>

      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="layout-width" id="layout-width-fuild" value="fuild"
          onchange="document.body.setAttribute('data-layout-size', 'fluid')" />
        <label class="form-check-label" for="layout-width-fuild">Fluid</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="layout-width" id="layout-width-boxed" value="boxed"
          onchange="document.body.setAttribute('data-layout-size', 'boxed')" />
        <label class="form-check-label" for="layout-width-boxed">Boxed</label>
      </div>

      <h6 class="mt-4 mb-3 pt-2">Layout Position</h6>

      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="layout-position" id="layout-position-fixed" value="fixed"
          onchange="document.body.setAttribute('data-layout-scrollable', 'false')" />
        <label class="form-check-label" for="layout-position-fixed">Fixed</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="layout-position" id="layout-position-scrollable"
          value="scrollable" onchange="document.body.setAttribute('data-layout-scrollable', 'true')" />
        <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
      </div>

      <h6 class="mt-4 mb-3 pt-2">Topbar Color</h6>

      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="topbar-color" id="topbar-color-light" value="light"
          onchange="document.body.setAttribute('data-topbar', 'light')" />
        <label class="form-check-label" for="topbar-color-light">Light</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="topbar-color" id="topbar-color-dark" value="dark"
          onchange="document.body.setAttribute('data-topbar', 'dark')" />
        <label class="form-check-label" for="topbar-color-dark">Dark</label>
      </div>

      <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Size</h6>

      <div class="form-check sidebar-setting">
        <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-default"
          value="default" onchange="document.body.setAttribute('data-sidebar-size', 'lg')" />
        <label class="form-check-label" for="sidebar-size-default">Default</label>
      </div>
      <div class="form-check sidebar-setting">
        <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-compact"
          value="compact" onchange="document.body.setAttribute('data-sidebar-size', 'md')" />
        <label class="form-check-label" for="sidebar-size-compact">Compact</label>
      </div>
      <div class="form-check sidebar-setting">
        <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-small" value="small"
          onchange="document.body.setAttribute('data-sidebar-size', 'sm')" />
        <label class="form-check-label" for="sidebar-size-small">Small (Icon View)</label>
      </div>

      <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Color</h6>

      <div class="form-check sidebar-setting">
        <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-light" value="light"
          onchange="document.body.setAttribute('data-sidebar', 'light')" />
        <label class="form-check-label" for="sidebar-color-light">Light</label>
      </div>
      <div class="form-check sidebar-setting">
        <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-dark" value="dark"
          onchange="document.body.setAttribute('data-sidebar', 'dark')" />
        <label class="form-check-label" for="sidebar-color-dark">Dark</label>
      </div>
      <div class="form-check sidebar-setting">
        <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-brand" value="brand"
          onchange="document.body.setAttribute('data-sidebar', 'brand')" />
        <label class="form-check-label" for="sidebar-color-brand">Brand</label>
      </div>

      <h6 class="mt-4 mb-3 pt-2">Direction</h6>

      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="layout-direction" id="layout-direction-ltr"
          value="ltr" />
        <label class="form-check-label" for="layout-direction-ltr">LTR</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="layout-direction" id="layout-direction-rtl"
          value="rtl" />
        <label class="form-check-label" for="layout-direction-rtl">RTL</label>
      </div>
    </div>
  </div>
  <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->
<script>
  function showToastr(h, msg, type) {
    if (h == 'Success') {
      $("#smsgd").show();
      $("#smsg").text(msg);
    }
    if (h == 'Failed') {
      $("#emsgd").show();
      $("#emsg").text(msg);
    }
    $('#toastDiv').attr('class', 'align-items-center text-white bg-' + type + ' border-0');
    $('#toastMsg').text(msg);
    $('#liveToast').show();
    setTimeout(() => {
      $('#liveToast').hide();
    }, 5000);
  }

  function closeToastr() {
    $('#liveToast').hide();
  }
</script>
<div class="position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="align-items-center text-white bg-success border-0" id="toastDiv">
      <div class="d-flex">
        <div class="toast-body" id="toastMsg">

        </div>
        <button onclick="closeToastr()" type="button" class="btn-close btn-close-white me-2 m-auto"
          data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>
</div>
<!-- Right bar overlay-->
{{-- <div class="rightbar-overlay"></div> --}}

<!-- JAVASCRIPT -->

<script src="{{ url('backend/') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('backend/') }}/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="{{ url('backend/') }}/assets/libs/simplebar/simplebar.min.js"></script>
<script src="{{ url('backend/') }}/assets/libs/node-waves/waves.min.js"></script>
<script src="{{ url('backend/') }}/assets/libs/feather-icons/feather.min.js"></script>
<!-- pace js -->
<script src="{{ url('backend/') }}/assets/libs/pace-js/pace.min.js"></script>

<!-- apexcharts -->
<script src="{{ url('backend/') }}/assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Plugins js-->
<script src="{{ url('backend/') }}/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js">
</script>
<script
  src="{{ url('backend/') }}/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js">
</script>
<!-- dashboard init -->
<script src="{{ url('backend/') }}/assets/js/pages/dashboard.init.js"></script>
<!-- pristine js -->
<script src="{{ url('backend/') }}/assets/libs/pristinejs/pristine.min.js"></script>
<!-- form validation -->
<script src="{{ url('backend/') }}/assets/js/pages/form-validation.init.js"></script>
<!-- Required datatable js -->
<script src="{{ url('backend/') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('backend/') }}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Responsive examples -->
<script src="{{ url('backend/') }}/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ url('backend/') }}/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<!-- Bootstrap Toasts Js -->
<script src="{{ url('backend/') }}/assets/js/pages/bootstrap-toasts.init.js"></script>
<!-- Datatable init js -->
<script src="{{ url('backend/') }}/assets/js/pages/datatables.init.js"></script>
<!-- JOBBLY NOTIFICATION TOASTER -->
<script src="{{ url('backend/jobbly/') }}/js/pages/toastr.js"></script>
<script src="{{ url('backend/jobbly/') }}/js/pages/notification.js"></script>
<script src="{{ url('backend/jobbly/') }}/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js"></script>
<!-- choices js -->
<script src="{{ url('backend/') }}/assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
<!-- init js -->
<script src="{{ url('backend/') }}/assets/js/pages/form-advanced.init.js"></script>
<script src="{{ url('backend/') }}/assets/js/pages/modal.init.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
  });

  var myModal = document.getElementById('myModal')
  var myInput = document.getElementById('myInput')

  myModal.addEventListener('shown.bs.modal', function() {
    myInput.focus()
  })
</script>
<script src="{{ url('backend/') }}/assets/js/app.js"></script>
<script>
  $(document).ready(function() {
    $('.tglBtn').on('click', function() {
      $('.tglBtn').toggle();
      $('#tblCDiv').toggle();
    });
  });
  $(document).ready(function() {
    $("#expandBtn").on('click', function() {
      $(".formDiv").toggle();
    });
  });
</script>
</body>

</html>
