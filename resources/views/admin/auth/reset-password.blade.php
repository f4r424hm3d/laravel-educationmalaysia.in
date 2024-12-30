<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Admin Login | {{ config('app.name') }}</title>
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
                <p>
                  <b>Password Requirements:</b> Minimum 8 characters, including both uppercase and lowercase letters, at
                  least
                  one number, and one special character (e.g., @, #, $).
                </p>
                <!-- NOTIFICATION FIELD START -->
                <x-ResultNotificationField></x-ResultNotificationField>
                <!-- NOTIFICATION FIELD END -->
                <div class="auth-content my-auto">
                  <form method="post" action="{{ aurl('reset-password') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $_GET['uid'] }}">
                    <input type="hidden" name="remember_token" value="{{ $_GET['token'] }}">
                    <div class="mb-3">
                      <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                          <label class="form-label">New Password</label>
                        </div>
                      </div>
                      <div class="input-group auth-pass-inputgroup">
                        <input type="password" name="new_password" class="form-control" placeholder="Enter New Password"
                          aria-label="Password" aria-describedby="password-addon" />
                      </div>
                      @error('new_password')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <div class="d-flex align-items-start">
                        <label class="form-label">Confirm New Password</label>
                      </div>
                      <div class="input-group auth-pass-inputgroup">
                        <input type="password" name="confirm_new_password" class="form-control"
                          placeholder="Enter New Password" aria-label="Password" aria-describedby="password-addon" />
                      </div>
                      @error('confirm_new_password')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">
                        Update Password
                      </button>
                    </div>
                  </form>

                  <div class="mt-5 text-center">
                    <p class="text-muted mb-0">
                      <a href="{{ aurl('login') }}/" class="text-primary fw-semibold">
                        Login
                      </a>
                    </p>
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

<!-- Mirrored from themesbrand.com/minia/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Jan 2022 11:42:20 GMT -->

</html>
