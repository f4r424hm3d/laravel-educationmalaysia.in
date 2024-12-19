@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <!-- Content -->
  <section class="gray pt-5">
    <div class="container-fluid">

      <div class="row">

        <div class="col-lg-3 col-md-3">
          <div class="dashboard-navbar">
            <div class="d-user-avater"><img data-src="{{ url('front/') }}/assets/img/user-3.jpg" class="img-fluid avater"
                alt="">
              <a href="javascript:void(0)" id="upload"><svg width="30" height="30" viewBox="0 0 30 30"
                  fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="1" y="1" width="28" height="28" rx="14" fill="#FFE9D3"></rect>
                  <path
                    d="M8 19.084V22h2.916l8.601-8.601-2.916-2.916L8 19.083Zm13.773-7.94a.773.773 0 0 0 0-1.097l-1.82-1.82a.774.774 0 0 0-1.097 0l-1.423 1.424 2.916 2.916 1.424-1.423Z"
                    fill="#da0b4e"></path>
                  <rect x="1" y="1" width="28" height="28" rx="14" stroke="#fff" stroke-width="2"></rect>
                </svg></a>
              <input id="upload-file" type="file" />
              <h4>abdul rafay</h4>
              <span>mohdabdulrafay@gmail.com</span>
            </div>

            <div class="d-navigation">
              <ul id="side-menu">
                <li><a href="student-profile.html"><i class="ti-user"></i>My Profile</a></li>
                <li><a href="applied-colleges.html"><i class="ti-comment-alt"></i>Applied colleges</a></li>
                <li><a href="applied-CAF.html"><i class="ti-check-box"></i>Applied CAF</a></li>
                <li class="active"><a href="pending-application.html"><i class="ti-timer"></i>Pending Application</a></li>
                <li><a href="account-settings.html"><i class="ti-settings"></i>Account settings</a></li>
                <li><a href="sign-in.html"><i class="ti-power-off"></i>Log Out</a></li>
              </ul>
            </div>

          </div>
        </div>

        <div class=" col-lg-9 col-md-9 col-sm-12">

          <div class="infoContent mt-0">
            <div class="row">
              <div class="col-md-12">
                <h2>Common Application Form</h2>
              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-md-5 text-center mt-3">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                  viewBox="0 0 1116.21 857.08">
                  <defs>
                    <linearGradient id="a" x1="654.32" y1="613.24" x2="654.32" y2="117"
                      gradientUnits="userSpaceOnUse">
                      <stop offset="0" stop-color="gray" stop-opacity="0.25"></stop>
                      <stop offset="0.54" stop-color="gray" stop-opacity="0.12"></stop>
                      <stop offset="1" stop-color="gray" stop-opacity="0.1"></stop>
                    </linearGradient>
                    <linearGradient id="b" x1="475.65" y1="861.71" x2="475.65" y2="223.28"
                      xlink:href="#a"></linearGradient>
                  </defs>
                  <path
                    d="M1089.16 582.74c-1 .73-1.92 1.44-2.9 2.13a97.79 97.79 0 0 1-11.33 6.91c-20.58 10.85-45.95 16.15-70.66 19.75-55.42 8.08-112 9.65-168.34 11.19-152.23 4.18-304.83 8.35-456.69-1.28-60-3.8-121.32-10.16-175.69-29.66q-11.69-4.18-22.92-9.22c-15.15-6.81-29.7-15.1-41.8-25-11.37-9.28-20.59-19.94-26.1-32.06-11.49-25.24-5.41-53.59 7.71-78.33a243.42 243.42 0 0 1 18.39-28.77c10.13-13.93 21.3-27.46 31.49-41.38 36.26-49.48 59.92-112.08 26.45-162.83-9.62-14.58-23.52-27.38-31.36-42.6-10-19.47-9.23-41.09-6.05-62.09q.62-4 1.31-7.92c5.43-31.14 15.65-64.69 47.16-84.13 32.73-20.2 79.21-19.18 119.83-12 63.17 11.28 121.44 34.76 180.33 55.96s120.5 40.57 185.22 42.65c57.15 1.84 123.81-11.93 161.74-47.72 36.84-34.76 106.09-37.41 156-16.41 34.26 14.41 59.82 40.37 70.6 69.57a90.81 90.81 0 0 1 4.69 18.12 83.56 83.56 0 0 1 .84 17.09 92.64 92.64 0 0 1-.84 8.37c-8.34 57.62-68.37 103.07-104.86 154.54-17.83 25.14-30.42 55.34-18.16 82.45 18.7 41.31 83.73 56 123 86.74a92.4 92.4 0 0 1 19.3 19.8c19.05 27.36 12.02 64.31-16.36 86.13Z"
                    fill="#da0b4e" opacity="0.1"></path>
                  <g data-name="flowers">
                    <path
                      d="M257.99 324.86s-46-81.52-115.32-105c-29.09-9.86-54.48-28.4-71.84-53.74A238 238 0 0 1 49.63 128"
                      fill="none" stroke="#535461" stroke-miterlimit="10" stroke-width="2"></path>
                    <path
                      d="M6.04 112.91c7.9 7.63 44.68 15.63 44.68 15.63s-9-36.52-16.92-44.19a19.93 19.93 0 0 0-27.76 28.6ZM26.85 179c10.79 2.14 46-11.19 46-11.19s-27.45-25.76-38.25-27.9A19.93 19.93 0 0 0 26.85 179ZM102.6 250.54c10.4-3.6 34-32.87 34-32.87s-36.68-8.39-47.07-4.79a19.93 19.93 0 1 0 13 37.66ZM172.1 291.73c10.86-1.8 39.1-26.65 39.1-26.65s-34.73-14.47-45.59-12.68a19.93 19.93 0 0 0 6.49 39.33ZM103.49 139.27c0 11-19.9 42.93-19.9 42.93s-19.94-31.91-19.95-42.91a19.93 19.93 0 1 1 39.85 0ZM184.17 188.54c-3.29 10.5-31.84 35-31.84 35s-9.48-36.45-6.23-47a19.93 19.93 0 0 1 38 11.91ZM256.01 247.09c-1.46 10.91-25.46 39.88-25.46 39.88s-15.5-34.28-14-45.19a19.93 19.93 0 0 1 39.5 5.31Z"
                      fill="#da0b4e"></path>
                    <path
                      d="M6.04 112.91c7.9 7.63 44.68 15.63 44.68 15.63s-9-36.52-16.92-44.19a19.93 19.93 0 0 0-27.76 28.6ZM26.85 179c10.79 2.14 46-11.19 46-11.19s-27.45-25.76-38.25-27.9A19.93 19.93 0 0 0 26.85 179ZM102.6 250.54c10.4-3.6 34-32.87 34-32.87s-36.68-8.39-47.07-4.79a19.93 19.93 0 1 0 13 37.66ZM172.1 291.73c10.86-1.8 39.1-26.65 39.1-26.65s-34.73-14.47-45.59-12.68a19.93 19.93 0 0 0 6.49 39.33ZM103.49 139.27c0 11-19.9 42.93-19.9 42.93s-19.94-31.91-19.95-42.91a19.93 19.93 0 1 1 39.85 0ZM184.17 188.54c-3.29 10.5-31.84 35-31.84 35s-9.48-36.45-6.23-47a19.93 19.93 0 0 1 38 11.91ZM256.01 247.09c-1.46 10.91-25.46 39.88-25.46 39.88s-15.5-34.28-14-45.19a19.93 19.93 0 0 1 39.5 5.31Z"
                      opacity="0.25"></path>
                    <path
                      d="M255.34 323.24s-9-93.18-62.88-142.74c-22.59-20.8-38.29-48-43.9-78.24a238.15 238.15 0 0 1-3.92-43.45"
                      fill="none" stroke="#535461" stroke-miterlimit="10" stroke-width="2"></path>
                    <path
                      d="M110.89 27.38c4.12 10.21 34.53 32.36 34.53 32.36s6.55-37.05 2.44-47.26a19.944 19.944 0 0 0-37 14.9ZM103.1 96.23c9 6.33 46.57 8.4 46.57 8.4S135.1 69.97 126.1 63.64a19.944 19.944 0 1 0-23 32.59ZM143.41 192.31c11 .93 44.44-16.26 44.44-16.26s-30.13-22.53-41.1-23.45a19.93 19.93 0 1 0-3.34 39.71ZM190.25 258.15c10.66 2.76 46.55-8.52 46.55-8.52s-25.89-27.3-36.54-30.06a19.93 19.93 0 0 0-10 38.58ZM189.3 90.97c-4.45 10.06-35.59 31.17-35.59 31.17s-5.3-37.24-.85-47.31a19.93 19.93 0 1 1 36.44 16.14ZM243.1 168.65c-7.26 8.27-43.29 19.1-43.29 19.1s6.08-37.12 13.35-45.39a19.922 19.922 0 1 1 29.94 26.29ZM285.1 251.34c-5.76 9.38-39.44 26.14-39.44 26.14s-.28-37.62 5.48-47a19.945 19.945 0 0 1 34 20.86Z"
                      fill="#da0b4e"></path>
                  </g>
                  <ellipse cx="408.16" cy="837.18" rx="111.53" ry="14.52" fill="#da0b4e" opacity="0.1">
                  </ellipse>
                  <g data-name="floor flowers">
                    <ellipse cx="182.88" cy="836.06" rx="33.88" ry="5.8" fill="#da0b4e" opacity="0.1">
                    </ellipse>
                    <path
                      d="M190.24 771.48s5.49 7.19-2.54 18-14.65 20-12 26.77c0 0 12.11-20.15 22-20.43s3.4-12.22-7.46-24.34Z"
                      fill="#da0b4e"></path>
                    <path
                      d="M190.24 771.48a8.83 8.83 0 0 1 1.12 2.26c9.62 11.3 14.75 21.85 5.5 22.11-8.61.25-18.95 15.65-21.42 19.54a9.24 9.24 0 0 0 .29.89s12.11-20.15 22-20.43 3.37-12.25-7.49-24.37Z"
                      opacity="0.1"></path>
                    <path d="M200.45 780.64c0 2.53-.28 4.58-.63 4.58s-.64-2-.64-4.58.36-1.34.71-1.34.56-1.19.56 1.34Z"
                      fill="#ffd037"></path>
                    <path
                      d="M203.96 783.66c-2.22 1.21-4.16 1.94-4.33 1.63s1.5-1.54 3.72-2.75 1.34-.33 1.51 0 1.32-.09-.9 1.12Z"
                      fill="#ffd037"></path>
                    <path
                      d="M161.22 771.48s-5.49 7.19 2.54 18 14.65 20 12 26.77c0 0-12.11-20.15-22-20.43s-3.38-12.22 7.46-24.34Z"
                      fill="#da0b4e"></path>
                    <path
                      d="M161.22 771.48a8.83 8.83 0 0 0-1.12 2.26c-9.62 11.3-14.75 21.85-5.5 22.11 8.62.25 18.95 15.65 21.42 19.54a7.11 7.11 0 0 1-.29.89s-12.11-20.15-22-20.43-3.35-12.25 7.49-24.37Z"
                      opacity="0.1"></path>
                    <path d="M151.01 780.64c0 2.53.28 4.58.63 4.58s.64-2 .64-4.58-.36-1.34-.71-1.34-.56-1.19-.56 1.34Z"
                      fill="#ffd037"></path>
                    <path
                      d="M147.51 783.66c2.22 1.21 4.15 1.94 4.32 1.63s-1.5-1.54-3.72-2.75-1.34-.33-1.51 0-1.31-.09.91 1.12Z"
                      fill="#ffd037"></path>
                    <path
                      d="M152.76 815.34s15.36-.48 20-3.77 23.62-7.24 24.77-1.95 23.08 26.29 5.74 26.43-40.29-2.7-44.91-5.51-5.6-15.2-5.6-15.2Z"
                      fill="#a8a8a8"></path>
                    <path
                      d="M203.57 834.21c-17.34.14-40.29-2.7-44.91-5.51-3.52-2.15-4.92-9.84-5.39-13.38h-.51s1 12.38 5.59 15.2 27.57 5.65 44.91 5.51c5 0 6.74-1.82 6.64-4.46-.69 1.62-2.6 2.61-6.33 2.64Z"
                      opacity="0.2"></path>
                    <path
                      d="M665.7 814.75s-42.28-2.55-37.29 27.08c0 0-1 5.23 3.75 7.61 0 0 .08-2.19 4.34-1.45a19.36 19.36 0 0 0 4.59.22 9.5 9.5 0 0 0 5.62-2.32s11.88-4.9 16.5-24.33c0 0 3.42-4.24 3.29-5.33l-7.14 3s2.44 5.15.52 9.43c0 0-.23-9.24-1.6-9-.28 0-3.71 1.78-3.71 1.78s4.2 9 1 15.48c0 0 1.2-11-2.34-14.83l-5 2.93s4.9 9.26 1.58 16.82c0 0 .85-11.59-2.63-16.11l-4.55 3.55s4.6 9.13 1.79 15.4c0 0-.36-13.49-2.78-14.51 0 0-4 3.51-4.59 5 0 0 3.15 6.62 1.2 10.12 0 0-1.2-9-2.19-9 0 0-4 6-4.38 10 0 0 .18-6.07 3.42-10.61a11.94 11.94 0 0 0-6.07 3.15s.62-4.21 7-4.58c0 0 3.28-4.52 4.16-4.79 0 0-6.4-.54-10.28 1.18 0 0 3.41-4 11.45-2.17l4.49-3.66s-8.42-1.16-12 .12c0 0 4.12-3.52 13.21-1l4.9-2.92s-7.19-1.55-11.47-1c0 0 4.52-2.44 12.9.2l3.5-1.57s-5.27-1-6.81-1.19-1.62-.59-1.62-.59a18.26 18.26 0 0 1 9.89 1.1s7.48-2.74 7.35-3.21Z"
                      fill="#da0b4e"></path>
                    <ellipse cx="636.58" cy="852.02" rx="29.92" ry="5.06" fill="#da0b4e"
                      opacity="0.1"></ellipse>
                    <path
                      d="M591.63 816.33s-23.84-1.44-21 15.27a4.08 4.08 0 0 0 2.12 4.29s0-1.24 2.45-.82a11.67 11.67 0 0 0 2.58.13 5.47 5.47 0 0 0 3.17-1.31s6.7-2.77 9.31-13.72c0 0 1.92-2.39 1.85-3l-4 1.71s1.37 2.91.29 5.32c0 0-.13-5.21-.9-5.09-.16 0-2.09 1-2.09 1s2.36 5 .58 8.73c0 0 .67-6.23-1.32-8.37l-2.83 1.66s2.76 5.22.89 9.48c0 0 .48-6.54-1.49-9.08l-2.56 2s2.59 5.15 1 8.68c0 0-.21-7.61-1.57-8.18a15.64 15.64 0 0 0-2.59 2.79s1.78 3.74.68 5.71c0 0-.68-5.07-1.23-5.09 0 0-2.24 3.36-2.47 5.66a12.15 12.15 0 0 1 1.92-6 6.72 6.72 0 0 0-3.42 1.77s.35-2.38 4-2.58c0 0 1.84-2.55 2.34-2.7 0 0-3.61-.31-5.8.66 0 0 1.93-2.24 6.46-1.22l2.53-2.07s-4.75-.65-6.76.07c0 0 2.32-2 7.45-.54l2.75-1.64a24.71 24.71 0 0 0-6.46-.56s2.55-1.37 7.27.11l2-.88s-3-.59-3.83-.68-.92-.33-.92-.33a10.32 10.32 0 0 1 5.58.62s4.09-1.53 4.02-1.8Z"
                      fill="#da0b4e"></path>
                    <ellipse cx="575.21" cy="837.35" rx="16.87" ry="2.85" fill="#da0b4e"
                      opacity="0.1"></ellipse>
                    <path
                      d="M637 780.92s-28.77-1.74-25.38 18.43a4.92 4.92 0 0 0 2.56 5.18s0-1.49 2.95-1a14.19 14.19 0 0 0 3.12.15 6.59 6.59 0 0 0 3.83-1.58s8.09-3.34 11.23-16.57c0 0 2.33-2.88 2.24-3.62l-4.86 2.07s1.66 3.51.36 6.42c0 0-.16-6.29-1.1-6.14-.18 0-2.52 1.21-2.52 1.21s2.86 6.11.7 10.54c0 0 .82-7.52-1.59-10.1l-3.42 2s3.34 6.3 1.08 11.45c0 0 .58-7.89-1.8-11l-3.1 2.41s3.14 6.21 1.23 10.48c0 0-.25-9.18-1.9-9.88 0 0-2.71 2.39-3.12 3.37 0 0 2.15 4.51.81 6.89 0 0-.81-6.11-1.48-6.14 0 0-2.7 4-3 6.83a14.71 14.71 0 0 1 2.32-7.22 8.13 8.13 0 0 0-4.13 2.14s.42-2.87 4.8-3.12c0 0 2.23-3.07 2.83-3.26 0 0-4.36-.36-7 .81 0 0 2.32-2.71 7.8-1.48l3.06-2.49s-5.74-.79-8.17.08c0 0 2.8-2.39 9-.65l3.33-2s-4.89-1-7.8-.67c0 0 3.07-1.66 8.78.13l2.38-1.06s-3.59-.71-4.64-.82-1.1-.4-1.1-.4a12.43 12.43 0 0 1 6.73.75s5.07-1.82 4.97-2.14Z"
                      fill="#da0b4e"></path>
                    <ellipse cx="617.19" cy="806.29" rx="20.37" ry="3.44" fill="#da0b4e"
                      opacity="0.1"></ellipse>
                  </g>
                  <g data-name="browser">
                    <path d="M1130 606.13V117H178.65v461.07c12.15 10.14 26.76 18.67 42 25.68q11.26 5.19 23 9.49h875Z"
                      transform="translate(-41.9 -21.46)" fill="url(#a)"></path>
                    <path d="M1086.26 584.87V109.54H138.83v448.1c12.1 9.86 26.65 18.15 41.8 25q11.22 5 22.92 9.22h871.38Z"
                      fill="#fff"></path>
                    <path fill="#5a5773" d="M138.84 96.93h947.42v25.14H138.84z"></path>
                  </g>
                  <g data-name="buttons" fill="#fff">
                    <circle cx="157.76" cy="109.5" r="6.5"></circle>
                    <circle cx="175.26" cy="109.5" r="6.5"></circle>
                    <circle cx="192.76" cy="109.5" r="6.5"></circle>
                  </g>
                  <g data-name="boxes">
                    <path fill="#da0b4e" d="M380.95 177.32h156.5v98.34h-156.5z"></path>
                    <path fill="#5a5773" opacity="0.2"
                      d="M164.26 177.32h156.5v98.34h-156.5zM597.64 177.32h156.5v98.34h-156.5zM164.26 317.91h156.5v98.34h-156.5zM380.95 317.91h156.5v98.34h-156.5zM597.64 317.91h156.5v98.34h-156.5zM164.26 458.49h156.5v98.34h-156.5zM380.95 458.49h156.5v98.34h-156.5zM597.64 458.49h156.5v98.34h-156.5z">
                    </path>
                  </g>
                  <g data-name="woman">
                    <path
                      d="M551.37 445.2s-28.11-51.38-23.37-59.74 8.23-20.46 8.23-20.46 10.38-7.1 10.38-10 8.22-9.61 12.55-12.53 2.16-16.71 0-18.38-5.59-7.52-5.59-7.52 3-8.35 0-10.86.44-5 0-7.52 0-11.69 0-11.69c-3.51-4.88-7.4-7.16-11.06-8l-.32-1.32-1.85-7.79s9-17.25-5.6-26.28a24.4 24.4 0 0 0-3.23-1.7s0-.42-.08-1.13c-.2-2.58-.81-9-2.12-13.21-.76-2.42-1.75-4.05-3-3.68a2 2 0 0 0-.82.47 9.12 9.12 0 0 0-1.55 1.83.41.41 0 0 1-.07.11 31.36 31.36 0 0 0-3.44 9.55 55.16 55.16 0 0 0-1 6 33 33 0 0 0-1.67 3.71c-1.77 4.59-3.84 12.54-.07 18.42 3.2 5 7.51 11.87 10.64 16.87l.1.16.19.31-.33.21v.77l.29 4.21 2.42 36.38a15.45 15.45 0 0 0-2.22-.47 20.17 20.17 0 0 0-3.23-.21c-2.11-8.29-7.9-16-9-24.66a22.87 22.87 0 0 1-.17-2.61c.09-5.45 1.45-10.92 1.34-16.36 0-1 0-2-.1-3 0-.27-.05-.55-.08-.83a24.59 24.59 0 0 0-13.37-18.63c-2.51-1.25-5.23-2.08-7.67-3.45-5.64-3.16-9.25-8.86-14.37-12.77-3.81-2.91-9.5-4.47-13.75-3a63.49 63.49 0 0 0-6.69 1.38 60.35 60.35 0 0 0-15.31 6.36c-.65.39-1.3.79-1.92 1.25a8.46 8.46 0 0 0-3.09 3.61 9.46 9.46 0 0 0-.48 3.89c0 .95 0 1.92.06 2.87-.28 16-17.52 28.38-18.94 44 0 .37-.06.74-.08 1.11v2.96c.25 6.85 3.81 13.23 4.46 20.05.06.61.09 1.21.1 1.82a30.24 30.24 0 0 1-1.77 9.18 26.87 26.87 0 0 0-6.21 2.52c-5.24 3.37-14.7 9.19-18.15 20.32a29.76 29.76 0 0 0-1.31 8.92 186.26 186.26 0 0 1-2.92 31.85 59.53 59.53 0 0 1-1.84 7.83 1.84 1.84 0 0 0-.06.77l-2.08 27-.37 4.75-.52 6.76s.15.41.37 1.1a31.8 31.8 0 0 1 .82 3.12 16.78 16.78 0 0 1 .27 7 4.82 4.82 0 0 1-1.46 2.57 1.08 1.08 0 0 0-.17.19c-.59.83-1.12 3.3-1.58 6.88-.18 1.4-.35 3-.52 4.66-1 10.65-1.62 26.59-2 39.77-.36 13-.49 23.27-.49 23.27a26.54 26.54 0 0 0 5.37 2.66c-.14.35-.29.71-.43 1.09a52.53 52.53 0 0 0-3.26 13.74c-.84 9.83 1.91 20.75 15.62 26.37a22.06 22.06 0 0 0 2.69.92c3 .8 5.21.58 6.84-.42 0 .59.07 1.16.1 1.73.14 2.44.26 4.67.32 6.54.43 11.7 3.33 32.16 3.33 32.16s1 8.36.13 10.86 0 12.53 0 12.53 3 5 0 7.52-3.89 15-3 16.71a.56.56 0 0 1 .05.19c.66 4.15-3.07 65.81-3.07 65.81s-3.53 9.44-6.34 19.24c-2.74 9.54-4.8 19.42-2.26 21.27 1.26.92 4.19 1.61 7.91 2.14 0 .41-.06.82-.1 1.24-.36 4.41-.93 9.16-1.75 10.36-1.19 1.7-2.44 14.88-3.05 22l-.06.79a73.7 73.7 0 0 0-3.22 9.34s-9.57 24-6.33 30.23a5.11 5.11 0 0 0 1.19 1.47 2.7 2.7 0 0 0 .31.28c4.61 3.69 16.16 4.46 20.35 4.63l-.16 5.94v.22h5.45v-.15c0-.75.12-4.19.3-8.79 0-.82.06-1.68.1-2.56 0-.69.07-1.39.1-2.11a37 37 0 0 0 2.37-13.35 58.58 58.58 0 0 1 2.1-15.48 43 43 0 0 1 2.77-7.55s1.7-9-.67-15.37a11.1 11.1 0 0 0-2-3.46v-2a57.69 57.69 0 0 1 1.28-12.82 1.42 1.42 0 0 1 0-.2c.08-.35.17-.68.26-1l.06-.22 1.77.06c5.43.15 9.42.15 9.42.15s4.33-22.14 3.9-31.74v-1.3c-.15-9.54 2.62-22.51 2.62-22.51l3.49-33.85s-1.73-5.86 0-10c1.07-2.58 3.28-7.37 4.82-10.67.72-1.53 1.29-2.73 1.53-3.25l.14-.28a6.47 6.47 0 0 1-1.54-.77c-1.41-.94-2.67-2.78 1.55-5.49 6.49-4.18 4.33-14.62 4.33-14.62s-1.91-3.76.34-7.1 0-15.87 0-15.87a52.47 52.47 0 0 0 4.44-10.45c1.61-5 5.68-29.45 7.6-41.24.63-3.87 1-6.37 1-6.37l.06.61.06.66.54 5.57.07.74 1 10.53s2 27.68.75 38.53v.2a12.82 12.82 0 0 1-.73 3.29c-2.3 5.2-1.88 25.86-1.76 30.43v.92c0 .25-1.63 4.08-1.22 7.06a4.53 4.53 0 0 0 .79 2.1 5.32 5.32 0 0 1 .77 3.25v.1a11.81 11.81 0 0 1-.12 1.44 27.46 27.46 0 0 1-1.52 5.66s-2.32 6.1-1.44 9.29a2.94 2.94 0 0 0 .57 1.13 2.67 2.67 0 0 1 .33 1.2.43.43 0 0 0 0 .11c.81 6.73-1.28 36.44-2.52 52.7-.5 6.42-.86 10.74-.86 10.74l-3.43 35.5.34.24c.39.28 1.12.76 2.1 1.34v.08l-.15 1.07c-.49 3.42-1.15 7.4-1.87 10.44-.06.23-.11.45-.17.66a9.57 9.57 0 0 0-3.67 1.47c-7.28 12.93-4.06 23.18 0 26.16 1.15.84 1.93 3.19 2.45 6.11l1 12.89v1.48a3.84 3.84 0 0 0 .19 1.18l.31 3.91.42 5.44h3.32V849h.18c5.24.18 13.69.4 17.37.11h.1c.39 0 .72-.07 1-.11a2.51 2.51 0 0 0 .58-.16c1.95-.94 6.81-14.72 2.43-17.85s-5.35-12-5.35-12c-.38-1.16-.76-2.26-1.15-3.31V815c-.12-4.29-.07-8.94.52-11.46.66-2.77 1-8.59 1.14-13.69v-1.27a17.07 17.07 0 0 0 2.23-.73l.16-.07a15.71 15.71 0 0 0 3.73-2.21L506 731.33l1.29-6.31 7.35-35.89s-2.59-12.53 0-14.61c.95-.76 1.21-4 1.15-7.75-.1-6.56-1.15-14.81-1.15-14.81s3.46-5.43 5.2-8.77 0-12.11 0-12.11l3.41-20.08s3.9-23.81 13.41-43.86c7-14.75 2.54-54.58-2-75.78-.12-.55-.24-1.09-.36-1.61v-.08c2.14-1.06 4.76-2.34 7.56-3.68l1.06-.5c3.55-1.67 7.31-3.39 10.68-4.82l.22-.09a74.58 74.58 0 0 1 7.43-2.78 12.47 12.47 0 0 1 2.28-.47c6.01-.39-12.16-32.13-12.16-32.13Zm-135.31 67.95h1.8c-.21.39-.41.79-.61 1.19-.12.24-.24.47-.35.71-.66 1.37-1.27 2.77-1.77 4.14.2-1.48.45-3.09.73-4.81.07-.38.14-.83.2-1.23Zm-4.86 26.07a.74.74 0 0 0 0-.14l-.15-.47c-.11-.32-.21-.64-.31-1q.93-.28 1.89-.63h.13v.33c-.05.47-.11.94-.17 1.4a1 1 0 0 1 0 .18c0 .38-.09.74-.13 1.1-.09.72-.18 1.42-.26 2.09-.19-.63-.38-1.25-.58-1.86-.2-.33-.31-.67-.42-1Z"
                      transform="translate(-41.9 -21.46)" fill="url(#b)"></path>
                    <path
                      d="m499.1 263.46-10.8 3.82-3.92-6.5c-3-5-7.16-11.84-10.23-16.81-5.42-8.74 1.67-22.06 1.67-22.06s1.28-13.37 5.84-17.49 5.83 17.49 5.83 17.49c18.31 8.32 8.5 27.89 8.5 27.89l1.78 7.76Z"
                      fill="#efb7b9"></path>
                    <path d="m499.1 263.46-10.8 3.82-3.92-6.5v-.57s6.19-4.25 13.41-2.65Z" opacity="0.1"></path>
                    <path
                      d="m481.66 307.26 5.41-4.58-2.71-41.22s14-9.58 24.36 5.41c0 0-.42 9.16 0 11.66s-2.91 5 0 7.49 0 10.83 0 10.83 3.29 5.83 5.37 7.49 4.17 15.41 0 18.32-11.99 9.58-11.99 12.49-10 10-10 10l-8.78-11.61Z"
                      fill="#ff6484"></path>
                    <path
                      d="M364.66 557.48c-20.18-8.56-15.7-29.47-11.9-40a54.46 54.46 0 0 1 2.67-6.24l11.32-6.87s2.31 5.89 4.78 13.79c5.73 18.38 12.32 47.47-6.87 39.32ZM392.4 748.27a34 34 0 0 0-3 8.42 60.81 60.81 0 0 0-1.3 14.33c.08 3.33.36 5.51.36 5.51l-22.48 15.46s.13-1.81.35-4.47c.58-7.08 1.79-20.22 2.93-21.92.79-1.18 1.34-5.92 1.69-10.32s.49-8.26.49-8.26 27.05-10.14 20.96 1.25ZM445.49 759.36s0 4.3-.16 9.3-.46 10.9-1.09 13.65c-.58 2.52-.62 7.15-.51 11.42.15 5 .51 9.5.51 9.5s-22.95-21.7-20.61-23.42c.63-.46 1.25-2.31 1.82-4.77.7-3 1.33-7 1.8-10.4.56-4.05.91-7.31.91-7.31Z"
                      fill="#efb7b9"></path>
                    <path
                      d="M392.4 748.27a34 34 0 0 0-3 8.42 183.72 183.72 0 0 1-18.4-1.41c.34-4.3.49-8.26.49-8.26s27-10.14 20.91 1.25ZM445.49 759.36s0 4.3-.16 9.3c-7.16 1.83-14.52-1.83-18.08-4 .56-4.05.91-7.31.91-7.31Z"
                      opacity="0.1"></path>
                    <path
                      d="M492.48 546.66c-9.16 20-12.91 43.72-12.91 43.72l-3.33 20s1.67 8.74 0 12.07-5 8.75-5 8.75 2.5 20.4 0 22.48 0 14.57 0 14.57l-8.33 42-11.66 54.12c-11.24 9.17-26.2-2.49-26.2-2.49l3.3-35.39s5-62 2.92-64.54.83-10.41.83-10.41 2.92-7.5.84-10.41.41-9.16.41-9.16-.83-25.4 1.67-31.23 0-41.89 0-41.89l-1-11.23-.58-6.22-.05-.61s-.38 2.49-1 6.35c-1.84 11.75-5.76 36.1-7.31 41.11a53.53 53.53 0 0 1-4.27 10.41s2.16 12.49 0 15.82-.33 7.08-.33 7.08 2.08 10.41-4.17 14.57 0 6.25 0 6.25-4.58 10-6.24 14.15 0 10 0 10l-3.33 33.72s-2.92 14.15-2.5 23.73-3.75 31.64-3.75 31.64-32.06 0-37-3.75 8.25-40.33 8.25-40.33 3.75-64.12 2.91-65.78 0-14.16 2.92-16.65 0-7.5 0-7.5-.83-10 0-12.49-.13-10.83-.13-10.83-2.79-20.4-3.2-32.06-2.5-37.88-2.5-37.88 2.18-16.22 2.51-23.94c.12-2.84 1.39-6.39 3-9.73a86.81 86.81 0 0 1 6.2-10.88s98.65-29.16 102.79-26.26c1.1.77 2.7 6 4.28 13.57 4.4 21.15 8.7 60.85 1.96 75.55Z"
                      fill="#444053"></path>
                    <circle cx="431.7" cy="263.46" r="28.73" fill="#a1616a"></circle>
                    <path
                      d="M490.52 471.13c-3.31 1.7-5.53 2.87-5.53 2.87s-46.63 22.07-59.89 20.82c-10.26-1-36.45-.43-47.86-.15a86.81 86.81 0 0 1 6.2-10.88s98.66-29.15 102.8-26.25c1.1.79 2.7 6 4.28 13.59Z"
                      opacity="0.1"></path>
                    <path
                      d="M411.71 309.34s-26.61 4.2-32.89 8.32-18.72 12.08-18.72 29.15-2.91 34.56-4.58 39.55 26.23 45.38 26.23 45.38l-10 61.21s40-1.25 53.32 0S485 472.13 485 472.13s27.48-14.57 33.31-15-11.66-32.06-11.66-32.06-27.07-51.2-22.49-59.53 7.94-20.4 7.94-20.4l-5-42.46s-7.49-2.5-13.74 2.08-27.48 2.08-27.48 2.08Z"
                      fill="#ff6484"></path>
                    <path
                      d="m366.54 383.45-10.44 2.91-2.89 39.18s3.75 10.41 0 13.74-4.58 74.53-4.58 74.53 12.08 8.74 26.23 2.08c0 0-2.08-7.91 4.17-36.64s6.24-43.3 6.24-43.3 0-35.81 2.92-41.64 0-20.4 0-20.4-5.83-7.91-5.42-10.82-16.23 20.36-16.23 20.36Z"
                      opacity="0.1"></path>
                    <path
                      d="M371.53 518.19a26.59 26.59 0 0 1-18.77-.68 54.46 54.46 0 0 1 2.67-6.24l11.32-6.87s2.35 5.89 4.78 13.79Z"
                      opacity="0.1"></path>
                    <path
                      d="m365.91 383.45-10.41 2.91-2.91 39.18s3.75 10.41 0 13.74-4.58 74.53-4.58 74.53 12.09 8.73 26.23 2.04c0 0-2.08-7.91 4.16-36.64s6.25-43.3 6.25-43.3 0-35.81 2.91-41.64 0-20.4 0-20.4-5.83-7.91-5.41-10.82-16.24 20.4-16.24 20.4Z"
                      fill="#ff6484"></path>
                    <path
                      d="M472.5 389.69s-5.41 46.63-21.24 55.38c0 0 35.39-9.99 21.24-55.38ZM392.98 393.86s19.56 9.57 15 16.23-15-16.23-15-16.23ZM392.98 413.01s12.49 12.91 10 17.49-10-17.49-10-17.49ZM493.73 306.01s4.9 8.32 5.37 13.74-5.37-13.74-5.37-13.74ZM493.73 294.77s2.46-2.09 8.74 0-8.74 0-8.74 0ZM469.69 538.12a57.9 57.9 0 0 1-30.45-3.9l-5.25 13.44-.58-6.22c.86-5.22 2.53-10.81 5.83-12.22 0 0 11.56 9.21 30.45 8.9ZM384.28 555.61s25.61 5.31 32.79 4.37ZM386.94 562.32s10.93-.47 16.39 1.72ZM388.19 566.85a98 98 0 0 0 15.14 2ZM387.56 624.15c.47-.31 21.86-5.31 24.52-1.72ZM387.56 630.71s18.58-2.19 19.05 0-19.05 0-19.05 0ZM387.56 636.64s19.83-4.1 22.17-3.1-22.17 3.1-22.17 3.1ZM388.5 776.54 366.02 792s.13-1.81.35-4.47c5-12.3 11.51-18.79 11.51-18.79 5.07-1.32 8.27-.1 10.26 2.29.08 3.32.36 5.51.36 5.51Z"
                      opacity="0.1"></path>
                    <path
                      d="M390.69 790.43a55.79 55.79 0 0 0-4.69 23 35.67 35.67 0 0 1-4.76 18.51 18.24 18.24 0 0 1-1.58 2.26s-15.62-.13-21.09-4.66a5.41 5.41 0 0 1-1.47-1.8c-3.13-6.24 6.09-30.13 6.09-30.13 4.84-18.42 14.67-28.26 14.67-28.26 17.51-4.53 12.83 21.08 12.83 21.08Z"
                      fill="#444053"></path>
                    <path
                      d="M381.24 831.89a18.24 18.24 0 0 1-1.58 2.26s-15.62-.13-21.09-4.66c2.69-8.9 11.27-35.83 15.29-31.25 3.78 4.3 6.41 24.99 7.38 33.65Z"
                      opacity="0.1"></path>
                    <path d="m379.1 799.91-1.09 40.34h5.24s.85-35.39 3.19-40.34-7.34 0-7.34 0Z" fill="#444053"></path>
                    <path
                      d="M444.24 803.23s-22.95-21.7-20.61-23.42c.63-.46 1.25-2.31 1.82-4.77 4.41-.77 12 1.07 18.28 18.69.15 5 .51 9.5.51 9.5Z"
                      opacity="0.1"></path>
                    <path
                      d="M447.67 827.43a2.33 2.33 0 0 1-.55.16c-2.7.47-12.65.2-18.22 0a3.94 3.94 0 0 1-3.81-3.93c0-1.5 0-3.33-.12-5.28-.26-6.16-1-13.49-3.21-15.14-3.91-3-7-13.18 0-26.07 0 0 13.42-10.25 23.1 20.56 0 0 .94 8.79 5.15 11.91s-.46 16.9-2.34 17.79Z"
                      fill="#444053"></path>
                    <path
                      d="M447.1 827.59c-2.7.47-12.65.2-18.22 0a3.94 3.94 0 0 1-3.81-3.93c0-1.5 0-3.33-.12-5.28 1.69-7.46 4.12-15.14 7.25-16.89.02-.01 9.49-1.08 14.9 26.1Z"
                      opacity="0.1"></path>
                    <path fill="#444053" d="m423.46 800.58 2.52 33.57h3.2v-36.43l-5.72 2.86z"></path>
                    <path
                      d="M431.28 217.68a57.42 57.42 0 0 0-25.62 8.23c-2 1.21-4 2.68-4.83 4.85-.72 1.88-.42 4-.39 6 .27 17.22-18.93 30.25-18.33 47.46.24 6.83 3.67 13.19 4.3 20 1.05 11.36-5.67 21.81-12.11 31.22a25.86 25.86 0 0 0 18.25-6.05 138.39 138.39 0 0 1 2.55 69.75h9.21a7 7 0 0 1 2.69.33 6.76 6.76 0 0 1 2.13 1.59c8.61 8.57 14.38 21.24 11.09 32.94l19.6-7.35c4.69-1.76 9.45-3.55 13.53-6.45s7.5-7.11 8.36-12.05c.53-3 .36-6.58 2.83-8.32a15.4 15.4 0 0 1 3.86-1.43c5.38-1.9 7.76-8.12 8.86-13.72a79 79 0 0 0 1.25-20.87c-.87-11.7-4.33-23.58-1.48-35 1.61-6.41 5.19-12.38 5.48-19 .47-10.91-8.06-20.31-9.33-31.16-.89-7.56 1.84-15.21.95-22.77a24.46 24.46 0 0 0-12.87-18.57c-2.41-1.24-5-2.07-7.38-3.44-5.43-3.15-8.9-8.82-13.83-12.72s-13.14-5.37-16.85-.3Z"
                      opacity="0.1"></path>
                    <path
                      d="M431.28 216.43a57.42 57.42 0 0 0-25.62 8.23c-2 1.21-4 2.68-4.83 4.85-.72 1.88-.42 4-.39 6 .27 17.22-18.93 30.25-18.33 47.47.24 6.82 3.67 13.18 4.3 20 1.05 11.36-5.67 21.81-12.11 31.23a26 26 0 0 0 18.25-6.05 138.34 138.34 0 0 1 2.55 69.73h9.21a7 7 0 0 1 2.69.34 6.58 6.58 0 0 1 2.13 1.58c8.61 8.58 14.38 21.24 11.09 32.94l19.6-7.35c4.69-1.76 9.45-3.55 13.53-6.45s7.5-7.11 8.36-12.05c.53-3 .36-6.58 2.83-8.32a15.4 15.4 0 0 1 3.86-1.43c5.38-1.9 7.76-8.12 8.86-13.72a79 79 0 0 0 1.28-20.89c-.87-11.7-4.33-23.58-1.48-35 1.61-6.41 5.19-12.38 5.48-19 .47-10.91-8.06-20.31-9.33-31.16-.89-7.56 1.84-15.2.95-22.77a24.48 24.48 0 0 0-12.87-18.57c-2.41-1.24-5-2.07-7.38-3.43-5.43-3.16-8.9-8.83-13.83-12.73s-13.14-5.37-16.85-.3Z"
                      fill="#925978"></path>
                    <g opacity="0.1">
                      <path
                        d="M400.42 231.35a11.12 11.12 0 0 0-.06 1.16c.03-.38.05-.77.06-1.16ZM473.1 271.38c.36-5.3 1.54-10.62 1.1-15.9-.33 5.3-1.51 10.62-1.1 15.9ZM386.41 297.73c-.58-6.2-3.47-12-4.15-18.19a22.8 22.8 0 0 0-.15 3.42c.24 6.75 3.59 13.06 4.27 19.78a27 27 0 0 0 .03-5.01ZM477.1 322.36a42.88 42.88 0 0 0-1 12.42 37.65 37.65 0 0 1 1-7.21c1.61-6.41 5.19-12.38 5.48-19a20.61 20.61 0 0 0-.16-3.52c-.78 5.95-3.89 11.49-5.32 17.31ZM392.55 322.9a26 26 0 0 1-14.76 6c-1.14 1.78-2.32 3.52-3.49 5.24a26 26 0 0 0 18.25-6.05 138 138 0 0 1 5.82 37.45 138.31 138.31 0 0 0-5.82-42.64ZM477.29 378.19c-1.1 5.6-3.48 11.82-8.86 13.71a15 15 0 0 0-3.86 1.44c-2.47 1.74-2.3 5.34-2.83 8.32-.86 4.94-4.27 9.14-8.36 12s-8.84 4.7-13.53 6.46l-18.7 7a25.81 25.81 0 0 1-.9 5.55l19.6-7.35c4.69-1.76 9.45-3.55 13.53-6.45s7.5-7.11 8.36-12.05c.53-3 .36-6.58 2.83-8.32a15.4 15.4 0 0 1 3.86-1.43c5.38-1.9 7.76-8.12 8.86-13.72a78.42 78.42 0 0 0 1.41-17.7 78.3 78.3 0 0 1-1.41 12.54ZM409.16 394.54a6.61 6.61 0 0 0-2.13-1.59 7.15 7.15 0 0 0-2.69-.34h-8.17c-.32 1.74-.66 3.48-1 5.21h9.21a7 7 0 0 1 2.69.34 6.58 6.58 0 0 1 2.13 1.58c6.3 6.28 11.07 14.74 11.89 23.42 1.01-10.38-4.37-21.06-11.93-28.62Z">
                      </path>
                    </g>
                    <path d="M363.47 428.62s7.44-3.12 9.1 0-9.1 0-9.1 0ZM366.1 433.97s7.44-3.12 9.11 0-9.11 0-9.11 0Z"
                      opacity="0.1"></path>
                  </g>
                  <g data-name="leaves" fill="#da0b4e">
                    <path
                      d="M827.21 30.22s-38.05-2.29-33.56 24.37c0 0-.89 4.71 3.38 6.85 0 0 .07-2 3.9-1.31a17.51 17.51 0 0 0 4.13.2 8.57 8.57 0 0 0 5.04-2.09s10.69-4.41 14.85-21.89c0 0 3.08-3.82 3-4.8l-6.42 2.75s2.19 4.63.46 8.48c0 0-.2-8.32-1.44-8.12-.25 0-3.33 1.6-3.33 1.6s3.77 8.07.92 13.94c0 0 1.08-9.94-2.1-13.35l-4.54 2.69s4.41 8.33 1.42 15.13c0 0 .77-10.43-2.37-14.49l-4.1 3.19s4.15 8.17 1.65 13.81c0 0-.33-12.15-2.51-13.06 0 0-3.58 3.16-4.12 4.46 0 0 2.83 6 1.07 9.1 0 0-1.08-8.08-2-8.12 0 0-3.57 5.36-3.94 9a19.51 19.51 0 0 1 3.07-9.55 10.67 10.67 0 0 0-5.46 2.84s.55-3.79 6.34-4.13c0 0 2.95-4.06 3.74-4.31 0 0-5.76-.48-9.25 1.07 0 0 3.07-3.58 10.31-2l4-3.3s-7.58-1-10.8.11c0 0 3.7-3.16 11.89-.86l4.4-2.63s-6.46-1.4-10.31-.89c0 0 4.06-2.19 11.6.18l3.15-1.41s-4.74-.93-6.12-1.08-1.46-.53-1.46-.53a16.36 16.36 0 0 1 8.89 1s6.73-2.43 6.62-2.85ZM772.98 8.6s-32 20.71-12.59 39.52c0 0 2.07 4.32 6.78 3.52 0 0-1.12-1.64 2.37-3.37a17.36 17.36 0 0 0 3.45-2.29 8.61 8.61 0 0 0 2.83-4.67s6-9.9-1-26.44c0 0 .22-4.9-.46-5.62l-3.54 6s4.51 2.43 5.4 6.55c0 0-5.09-6.57-6-5.68-.18.18-1.74 3.27-1.74 3.27s7.83 4.26 9 10.67c0 0-5-8.65-9.61-9.5l-2.08 4.8s8.5 4.1 10.12 11.35c0 0-5.57-8.86-10.5-10.27l-1.4 5s8.2 4.16 9.51 10.2c0 0-7.46-9.58-9.76-9 0 0-1 4.66-.68 6 0 0 5.82 3.12 6.26 6.7 0 0-5.66-5.87-6.39-5.38 0 0 .3 6.43 2.17 9.61a19.53 19.53 0 0 1-3.18-9.51 10.7 10.7 0 0 0-2.72 5.52s-1.8-3.38 2.67-7.08c0 0 0-5 .45-5.69 0 0-4.92 3-6.82 6.34 0 0 .36-4.7 7.15-7.68l1.3-5.05s-6.72 3.66-8.63 6.49c0 0 1.11-4.74 9.06-7.74l2-4.73s-6 2.71-8.84 5.4c0 0 2-4.18 9.46-6.73l1.7-3s-4.37 2.06-5.57 2.76-1.49.44-1.49.44a16.39 16.39 0 0 1 7.75-4.47s3.91-5.96 3.57-6.24ZM724.28 32.73s-19.13 33 6.7 40.93c0 0 3.81 2.91 7.64 0 0 0-1.73-.94.59-4.07a17.51 17.51 0 0 0 2-3.6 8.64 8.64 0 0 0 .41-5.45s.85-11.54-12.9-23.11c0 0-2-4.46-3-4.79l-.43 7s5.12.12 7.79 3.39c0 0-7.52-3.55-7.9-2.36-.08.24-.07 3.7-.07 3.7s8.99.27 12.99 5.45c0 0-8.4-5.43-12.87-4.11l.32 5.22s9.43-.2 14.16 5.53c0 0-9-5.37-14-4.39l1 5.09s9.2 0 13.1 4.78c0 0-11-5.16-12.79-3.63 0 0 1.21 4.62 2.13 5.69 0 0 6.6.14 8.62 3.13 0 0-7.71-2.67-8.14-1.89 0 0 3.19 5.59 6.3 7.57a19.53 19.53 0 0 1-7.15-7 10.71 10.71 0 0 0 .08 6.15s-3.14-2.19-.84-7.52c0 0-2.3-4.46-2.17-5.27 0 0-3 4.93-3.2 8.74 0 0-1.82-4.35 2.88-10.08l-1.13-5.1s-4.33 6.31-4.75 9.7c0 0-1.16-4.73 4.57-11l-.38-5.11s-4.14 5.15-5.42 8.82c0 0-.14-4.62 5.37-10.29l.15-3.45s-3 3.81-3.71 5-1.13 1.02-1.13 1.02a16.46 16.46 0 0 1 4.88-7.51s.72-7.09.3-7.18Z"
                      opacity="0.1"></path>
                  </g>
                  <path
                    d="M888.53 408.91a14.31 14.31 0 1 0 14.31 14.31 14.35 14.35 0 0 0-14.31-14.31Zm-41.84-112.29v14.31H861l25.76 52.18-10.77 17.53a13.76 13.76 0 0 0-1.79 6.8c0 9.58 6.55 14.31 15.43 14.31h83.67v-13.76h-81.92a1.69 1.69 0 0 1-1.79-1.79 9 9 0 0 1 .76-1.78l7.15-11.29h53.31a14 14 0 0 0 12.52-7.51l25.77-44.31a8.31 8.31 0 0 0 .72-3.58 6.88 6.88 0 0 0-7.16-6.8H876.75l-6.8-14.31Zm112.29 112.29a14.31 14.31 0 1 0 14.32 14.31 14.35 14.35 0 0 0-14.32-14.31Z"
                    fill="#da0b4e"></path>
                  <path fill="#fff" d="M940.67 336.21h-12v-12h-9v12h-12v9h12v12h9v-12h12v-9z"></path>
                </svg>

                <p class="mt-3">Nothing to show yet. You haven't applied to any colleges.</p>

              </div>
            </div>

            <div class="row justify-content-center mt-3">
              <a href="#" class="btn btn-modern float-none">Browse Colleges<span><i
                    class="ti-arrow-right"></i></span></a>
            </div>

          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- Content -->
  <script>
    jQuery(document).ready(function($) {
      $(function() {
        $(".scrollTo a").click(function(e) {
          var destination = $(this).attr('href');
          $(".scrollTo li").removeClass('active');
          $(this).parent().addClass('active');

          $('html, body').animate({
            scrollTop: $(destination).offset().top - 90
          }, 500);
        });
      });
      var totalHeight = $('#myHeader').height() + $('.proHead').height();
      $(window).scroll(function() {
        if ($(this).scrollTop() > totalHeight) {
          $('.proHead').addClass('sticky');
        } else {
          $('.proHead').removeClass('sticky');
        }
      })
    });
  </script>
  <script>
    $(document).on('click', '#close-preview', function() {
      $('.image-preview').popover('hide');
      // Hover befor close the preview
      $('.image-preview').hover(
        function() {
          $('.image-preview').popover('show');
        },
        function() {
          $('.image-preview').popover('hide');
        }
      );
    });

    $(function() {
      // Create the close button
      var closebtn = $('<button/>', {
        type: "button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
      });
      closebtn.attr("class", "close pull-right");
      // Set the popover default content
      $('.image-preview').popover({
        trigger: 'manual',
        html: true,
        title: "<strong>Preview</strong>" + $(closebtn)[0].outerHTML,
        content: "There's no image",
        placement: 'bottom'
      });
      // Clear event
      $('.image-preview-clear').click(function() {
        $('.image-preview').attr("data-content", "").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse");
      });
      // Create the preview image
      $(".image-preview-input input:file").change(function() {
        var img = $('<img/>', {
          id: 'dynamic',
          width: 250,
          height: 200
        });
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function(e) {
          $(".image-preview-input-title").text("Change");
          $(".image-preview-clear").show();
          $(".image-preview-filename").val(file.name);
          img.attr('src', e.target.result);
          $(".image-preview").attr("data-content", $(img)[0].outerHTML).popover("show");
        }
        reader.readAsDataURL(file);
      });
    });
  </script>
  <script>
    $("#upload").click(function() {
      $("#upload-file").trigger('click');
    });
  </script>
@endsection
