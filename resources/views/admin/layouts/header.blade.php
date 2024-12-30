<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  @stack('title')
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta content="Study Abroad Education Malaysia Education" name="description" />
  <meta content="Themesbrand" name="author" />
  <!-- choices css -->
  <link href="{{ url('backend/') }}/assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet"
    type="text/css" />

  <!-- DataTables -->
  <link href="{{ url('backend/') }}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"
    type="text/css" />
  <link href="{{ url('backend/') }}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
    rel="stylesheet" type="text/css" />

  <!-- Responsive datatable examples -->
  <link href="{{ url('backend/') }}/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"
    rel="stylesheet" type="text/css" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{ url('backend/') }}/assets/images/favicon.ico" />

  <!-- plugin css -->
  <link href="{{ url('backend/') }}/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css"
    rel="stylesheet" type="text/css" />

  <!-- Bootstrap Css -->
  <link href="{{ url('backend/') }}/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
    type="text/css" />
  <!-- Icons Css -->
  <link href="{{ url('backend/') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  <!-- App Css-->
  <link href="{{ url('backend/') }}/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
  <script src="{{ url('/') }}/ckeditor/ckeditor.js"></script>
  <script src="{{ url('backend/') }}/assets/libs/jquery/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    .hide-this {
      display: none;
    }

    .f-rgt {
      float: right;
    }

    .btn-xs,
    .btn-group-xs>.btn {
      padding: 1px 5px;
      font-size: 0.8571rem;
      line-height: 1.5;
      border-radius: 3px;
    }

    .float-right {
      float: right;
    }

    .chr {
      margin-top: 3px;
      margin-bottom: 3px
    }

    .just {
      text-align: justify;
      text-justify: inter-word;
    }

    .setBtn {
      margin-top: 31px;
    }

    .card {
      border: 1px solid #6d70738f !important;
    }
  </style>
</head>

<body data-layout="horizontal" data-layout-size="boxed" data-layout-mode="light" data-topbar="dark"
  data-sidebar="light">
  <!-- Begin page -->
  <div id="layout-wrapper">
    <header id="page-topbar">
      <div class="navbar-header">
        <div class="d-flex">
          <!-- LOGO -->
          <div class="navbar-brand-box">
            <a href="{{ url('admin') }}" class="logo logo-dark">
              <span class="logo-sm">
                <img src="{{ url('backend/') }}/assets/images/logo-sm.svg" alt="{{ Config('app.name') }}"
                  height="24" />
              </span>
              <span class="logo-lg">
                <img src="{{ url('backend/') }}/assets/images/logo-sm.svg" alt="{{ Config('app.name') }}"
                  height="24" />
                <span class="logo-txt">Study Abroad</span>
              </span>
            </a>

            <a href="{{ url('admin') }}" class="logo logo-light">
              <span class="logo-sm">
                <img src="{{ url('backend/') }}/assets/images/logo-sm.svg" alt="{{ Config('app.name') }}"
                  height="24" />
              </span>
              <span class="logo-lg">
                <img src="{{ url('backend/') }}/assets/images/logo-sm.svg" alt="{{ Config('app.name') }}"
                  height="24" />
                <span class="logo-txt">Study Abroad</span>
              </span>
            </a>
          </div>
          <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light"
            data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
            <i class="fa fa-fw fa-bars"></i>
          </button>
        </div>

        <div class="d-flex">
          <div class="dropdown d-none d-sm-inline-block">
            <button type="button" class="btn header-item" id="mode-setting-btn">
              <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
              <i data-feather="sun" class="icon-lg layout-mode-light"></i>
            </button>
          </div>
          <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item bg-soft-light border-start border-end"
              id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img class="rounded-circle header-profile-user"
                src="{{ url('backend/') }}/assets/images/users/avatar-1.jpg" alt="Header Avatar" />
              <span class="d-none d-xl-inline-block ms-1 fw-medium">Admin</span>
              <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
              <!-- item-->
              <a class="dropdown-item" href="{{ url('admin/profile') }}">
                <i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i>
                Profile
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ url('admin/logout') }}">
                <i class="mdi mdi-logout font-size-16 align-middle me-1"></i>
                Logout
              </a>
            </div>
          </div>
        </div>
      </div>
    </header>

    <div class="topnav">
      <div class="container">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
          <div class="collapse navbar-collapse" id="topnav-menu-content">
            <ul class="navbar-nav">
              <li class="nav-item dropdown hide-this">
                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">

                  <span data-key="t-extra-pages">
                    Students
                  </span>
                  <div class="arrow-down"></div>
                </a>
                <div class="dropdown-menu" aria-labelledby="topnav-more">
                  <div class="dropdown">
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('leads/') }}" id="topnav-auth"
                      role="button">
                      <span data-key="t-authentication">Students</span>
                    </a>
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('leads/add') }}"
                      id="topnav-auth" role="button">
                      <span data-key="t-authentication">Add Student</span>
                    </a>
                  </div>
                </div>
              </li>
              <li class="nav-item dropdown hide-this">
                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">

                  <span data-key="t-extra-pages">Destinations</span>
                  <div class="arrow-down"></div>
                </a>
                <div class="dropdown-menu" aria-labelledby="topnav-more">
                  <div class="dropdown">
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('Destinations') }}"
                      id="topnav-auth" role="button">
                      <span data-key="t-authentication">Destination</span>
                    </a>
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('destination-articles') }}"
                      id="topnav-auth" role="button">
                      <span data-key="t-authentication">Articles</span>
                    </a>
                  </div>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">

                  <span data-key="t-extra-pages">Programs</span>
                  <div class="arrow-down"></div>
                </a>
                <div class="dropdown-menu" aria-labelledby="topnav-more">
                  <div class="dropdown">
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('Levels') }}" id="topnav-auth"
                      role="button">
                      <span data-key="t-authentication">Levels</span>
                    </a>
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('Course-Category') }}"
                      id="topnav-auth" role="button">
                      <span data-key="t-authentication">Course Category</span>
                    </a>
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('Course-Specialization') }}"
                      id="topnav-auth" role="button">
                      <span data-key="t-authentication">Course Specialization</span>
                    </a>
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('Programs') }}"
                      id="topnav-auth" role="button">
                      <span data-key="t-authentication">Programs</span>
                    </a>
                  </div>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">

                  <span data-key="t-extra-pages">University</span>
                  <div class="arrow-down"></div>
                </a>
                <div class="dropdown-menu" aria-labelledby="topnav-more">
                  <div class="dropdown">
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('Institute-Types') }}"
                      id="topnav-auth" role="button">
                      <span data-key="t-authentication">Institute Types</span>
                    </a>
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('study-modes') }}"
                      id="topnav-auth" role="button">
                      <span data-key="t-authentication">Study Mode</span>
                    </a>
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('course-modes') }}"
                      id="topnav-auth" role="button">
                      <span data-key="t-authentication">Course Mode</span>
                    </a>
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('university') }}"
                      id="topnav-auth" role="button">
                      <span data-key="t-authentication">University</span>
                    </a>
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('university/add') }}"
                      id="topnav-auth" role="button">
                      <span data-key="t-authentication">Add University</span>
                    </a>
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('university-reviews') }}"
                      id="topnav-auth" role="button">
                      <span data-key="t-authentication">University Reviews</span>
                    </a>
                  </div>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">

                  <span data-key="t-extra-pages">Blogs</span>
                  <div class="arrow-down"></div>
                </a>
                <div class="dropdown-menu" aria-labelledby="topnav-more">
                  <div class="dropdown">
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('blog-category') }}"
                      id="topnav-auth" role="button">
                      <span data-key="t-authentication">Blog Category</span>
                    </a>
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('blogs') }}" id="topnav-auth"
                      role="button">
                      <span data-key="t-authentication">Blogs</span>
                    </a>
                  </div>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">

                  <span data-key="t-extra-pages">SEOS</span>
                  <div class="arrow-down"></div>
                </a>
                <div class="dropdown-menu" aria-labelledby="topnav-more">
                  <div class="dropdown">
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('seos') }}" id="topnav-auth"
                      role="button">
                      <span data-key="t-authentication">SEO</span>
                    </a>
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('dynamic-page-seos') }}"
                      id="topnav-auth" role="button">
                      <span data-key="t-authentication">Dynamic Page Seo</span>
                    </a>
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('default-og-image') }}"
                      id="topnav-auth" role="button">
                      <span data-key="t-authentication">Default OG Image</span>
                    </a>
                  </div>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">

                  <span data-key="t-extra-pages">Career</span>
                  <div class="arrow-down"></div>
                </a>
                <div class="dropdown-menu" aria-labelledby="topnav-more">
                  <a href="{{ aurl('career') }}" class="dropdown-item">Job Vacancy</a>
                  <a href="{{ aurl('job-application') }}" class="dropdown-item">Job Application</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">

                  <span data-key="t-extra-pages">Faqs</span>
                  <div class="arrow-down"></div>
                </a>
                <div class="dropdown-menu" aria-labelledby="topnav-more">
                  <a href="{{ aurl('faq-categories') }}" class="dropdown-item">Category</a>
                  <a href="{{ aurl('faqs') }}" class="dropdown-item">Faqs</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">

                  <span data-key="t-extra-pages">More</span>
                  <div class="arrow-down"></div>
                </a>
                <div class="dropdown-menu" aria-labelledby="topnav-more">
                  <div class="dropdown">
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('services') }}"
                      id="topnav-auth" role="button">
                      <span data-key="t-authentication">Services</span>
                    </a>
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('exams') }}" id="topnav-auth"
                      role="button">
                      <span data-key="t-authentication">Exams</span>
                    </a>
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('job-pages') }}"
                      id="topnav-auth" role="button">
                      <span data-key="t-authentication">Job Pages</span>
                    </a>
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('users') }}" id="topnav-auth"
                      role="button">
                      <span data-key="t-authentication">Authors</span>
                    </a>
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('employees') }}"
                      id="topnav-auth" role="button">
                      <span data-key="t-authentication">Employees</span>
                    </a>
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('employee-statuses') }}"
                      id="topnav-auth" role="button">
                      <span data-key="t-authentication">Employees Status</span>
                    </a>
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('testimonials') }}"
                      id="topnav-auth" role="button">
                      <span data-key="t-authentication">Testimonials</span>
                    </a>
                    <a class="dropdown-item dropdown-toggle arrow-none" href="{{ aurl('upload-files') }}"
                      id="topnav-auth" role="button">
                      <span data-key="t-authentication">Upload Files</span>
                    </a>

                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
