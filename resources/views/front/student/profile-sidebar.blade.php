<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 mb-4">
  <div class="dashboard-navbar">
    <div class="d-user-avater">
      <img data-src="{{ url('front/') }}/assets/img/user.jpg" class="img-fluid avater" alt="">
      <a href="javascript:void(0)" id="upload">
        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect x="1" y="1" width="28" height="28" rx="14" fill="#FFE9D3"></rect>
          <path
            d="M8 19.084V22h2.916l8.601-8.601-2.916-2.916L8 19.083Zm13.773-7.94a.773.773 0 0 0 0-1.097l-1.82-1.82a.774.774 0 0 0-1.097 0l-1.423 1.424 2.916 2.916 1.424-1.423Z"
            fill="#0a4191"></path>
          <rect x="1" y="1" width="28" height="28" rx="14" stroke="#fff" stroke-width="2"></rect>
        </svg>
      </a>
      <input id="upload-file" type="file" />
      <h4>{{ $student->name }}</h4>
      <span>{{ $student->email }}</span>
    </div>
    <div class="d-navigation">
      <ul id="side-menu">
        <li class="{{ Request::segment(2) == 'profile' ? 'active' : '' }}"><a href="{{ url('student/profile/') }}"><i
              class="ti-user"></i>My Profile</a></li>
        <li class="{{ Request::segment(2) == 'applied-college' ? 'active' : '' }}"><a
            href="{{ url('student/applied-college/') }}"><i class="ti-comment-alt"></i>Applied colleges</a></li>
        <li class="{{ Request::segment(2) == 'shortlist' ? 'active' : '' }}"><a
            href="{{ url('student/shortlist/') }}"><i class="ti-list"></i>Shortlist</a></li>
        <li class="{{ Request::segment(2) == 'change-password' ? 'active' : '' }}"><a
            href="{{ url('student/change-password/') }}"><i class="ti-lock"></i>Change Password</a></li>
        <li><a href="{{ url('student/logout/') }}"><i class="ti-power-off"></i>Log Out</a></li>
      </ul>
    </div>
  </div>
</div>
