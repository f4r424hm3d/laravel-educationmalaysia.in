<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Sent | {{ config('app.name') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta content="{{ config('app.name') }}" name="description" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{ url('backend/') }}/assets/images/favicon.ico" />

  <!-- preloader css -->
  <link rel="stylesheet" href="{{ url('backend/') }}/assets/css/preloader.min.css" type="text/css" />

  <!-- Bootstrap Css -->
  <link href="{{ url('backend/') }}/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
    type="text/css" />
  <!-- Icons Css -->
  <link href="{{ url('backend/') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  <!-- App Css-->
  <link href="{{ url('backend/') }}/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body>
  <!-- <body data-layout="horizontal"> -->
  <div class="auth-page">
    <div class="container-fluid p-0">
      <div class="row g-0">
        <div class="col-xxl-4 col-lg-4 col-md-12"></div>
        <div class="col-xxl-4 col-lg-4 col-md-12">
          <div class="auth-full-page-content d-flex p-sm-5 p-4">
            <div class="w-100">
              <div class="d-flex flex-column h-100">
                <div class="mb-4 mb-md-5 text-center">
                  <a href="{{ url('/') }}" class="d-block auth-logo">
                    <img src="{{ url('backend/') }}/assets/images/logo-sm.svg" alt="" height="28" />
                    <span class="logo-txt">{{ config('app.name') }}</span>
                  </a>
                </div>
                <!-- NOTIFICATION FIELD START -->
                <x-ResultNotificationField></x-ResultNotificationField>
                <!-- NOTIFICATION FIELD END -->
                <div class="card card-style">
                  <div class="content mb-4">
                    <h4 class="font-600">
                      <center>Email Sent</center>
                    </h4>
                    <p class="opacity-80">
                      <center>
                        We sent an email to <b>{{ session()->get('forget_password_email') }}</b> with a link to get
                        back
                        into your
                        account.
                      </center>
                    </p>
                    <center><a href="{{ aurl('account/password/reset') }}/">Ok</a></center>
                  </div>
                </div>
                <div class="mt-4 mt-md-5 text-center">
                  <p class="mb-0">
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    {{ config('app.name') }}
                  </p>
                </div>
              </div>
            </div>
          </div>
          <!-- end auth full page content -->
        </div>
      </div>
    </div>
  </div>

  <!-- JAVASCRIPT -->
  <script src="{{ url('backend/') }}/assets/libs/jquery/jquery.min.js"></script>
  <script src="{{ url('backend/') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ url('backend/') }}/assets/libs/metismenu/metisMenu.min.js"></script>
  <script src="{{ url('backend/') }}/assets/libs/simplebar/simplebar.min.js"></script>
  <script src="{{ url('backend/') }}/assets/libs/node-waves/waves.min.js"></script>
  <script src="{{ url('backend/') }}/assets/libs/feather-icons/feather.min.js"></script>
  <!-- pace js -->
  <script src="{{ url('backend/') }}/assets/libs/pace-js/pace.min.js"></script>
  <!-- password addon init -->
  <script src="{{ url('backend/') }}/assets/js/pages/pass-addon.init.js"></script>
</body>

</html>
