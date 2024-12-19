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
                <li class="active"><a href="applied-CAF.html"><i class="ti-check-box"></i>Applied CAF</a></li>
                <li><a href="pending-application.html"><i class="ti-timer"></i>Pending Application</a></li>
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
                <h2>Applied Colleges</h2>
              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-md-5 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 668.119 462.395">
                  <g id="Group_835" data-name="Group 835" transform="translate(-965 -492.136)">
                    <g id="Group_552" data-name="Group 552" transform="translate(1063.184 492.136)">
                      <rect id="Rectangle_94" data-name="Rectangle 94" width="256.095" height="230.296"
                        transform="translate(8.83 18.153)" fill="#bbab84" />
                      <rect id="Rectangle_95" data-name="Rectangle 95" width="273.755" height="13.799"
                        transform="translate(0 197.462)" fill="#bbab84" />
                      <rect id="Rectangle_96" data-name="Rectangle 96" width="218.739" height="179.309"
                        transform="translate(27.508 18.153)" fill="#edf0f2" />
                      <rect id="Rectangle_97" data-name="Rectangle 97" width="256.095" height="7.123"
                        transform="translate(8.83 211.262)" fill="#212121" opacity="0.2"
                        style="mix-blend-mode: multiply;isolation: isolate" />
                      <g id="Group_551" data-name="Group 551" transform="translate(27.508)">
                        <rect id="Rectangle_98" data-name="Rectangle 98" width="218.739" height="75.477" fill="#96a0c5" />
                        <rect id="Rectangle_99" data-name="Rectangle 99" width="218.739" height="4.482"
                          transform="translate(0 70.996)" fill="#6f74b0" />
                        <g id="Group_550" data-name="Group 550" transform="translate(101.777 75.477)">
                          <rect id="Rectangle_100" data-name="Rectangle 100" width="2.243" height="18.36"
                            transform="translate(6.471)" fill="#6f74b0" />
                          <path id="Path_615" data-name="Path 615"
                            d="M227.29,143.107a7.592,7.592,0,1,1,7.592-7.592A7.6,7.6,0,0,1,227.29,143.107Zm0-12.942a5.35,5.35,0,1,0,5.35,5.35A5.354,5.354,0,0,0,227.29,130.165Z"
                            transform="translate(-219.698 -110.683)" fill="#6f74b0" />
                        </g>
                      </g>
                    </g>
                    <g id="Group_557" data-name="Group 557" transform="translate(1162.557 614.023)">
                      <g id="Group_556" data-name="Group 556">
                        <path id="Path_616" data-name="Path 616"
                          d="M363.717,321.625H256.973v-7.873h22v-39.3h62.739v39.3h22Z"
                          transform="translate(-168.89 -74.95)" fill="#6e8190" />
                        <path id="Path_617" data-name="Path 617"
                          d="M200.531,313.621V152.874a6.26,6.26,0,0,1,6.26-6.26H477.182a6.26,6.26,0,0,1,6.26,6.26V313.621Z"
                          transform="translate(-200.531 -146.614)" fill="#1c2832" />
                        <path id="Path_618" data-name="Path 618"
                          d="M477.182,286.124H206.791a6.26,6.26,0,0,1-6.26-6.261V253.629h282.91v26.234A6.26,6.26,0,0,1,477.182,286.124Z"
                          transform="translate(-200.531 -86.622)" fill="#6e8190" />
                        <path id="Path_619" data-name="Path 619" d="M207.6,153.9H468.447V298.127H207.6Z"
                          transform="translate(-196.568 -142.53)" fill="#d5dae8" />
                        <g id="Group_553" data-name="Group 553" transform="translate(25.129 27.471)">
                          <path id="Path_620" data-name="Path 620"
                            d="M249.772,170.506H219.778a3.146,3.146,0,0,1-3.145-3.145h0a3.145,3.145,0,0,1,3.145-3.145h29.995a3.144,3.144,0,0,1,3.145,3.145h0A3.145,3.145,0,0,1,249.772,170.506Z"
                            transform="translate(-216.633 -164.217)" fill="#96a0c5" />
                        </g>
                        <g id="Group_554" data-name="Group 554" transform="translate(25.129 40.271)">
                          <path id="Path_621" data-name="Path 621"
                            d="M265.976,178.708h-46.2a3.145,3.145,0,0,1-3.145-3.145h0a3.146,3.146,0,0,1,3.145-3.145h46.2a3.145,3.145,0,0,1,3.145,3.145h0A3.144,3.144,0,0,1,265.976,178.708Z"
                            transform="translate(-216.633 -172.419)" fill="#96a0c5" />
                        </g>
                        <g id="Group_555" data-name="Group 555" transform="translate(25.129 53.45)">
                          <path id="Path_622" data-name="Path 622"
                            d="M249.772,187.153H219.778a3.145,3.145,0,0,1-3.145-3.145h0a3.145,3.145,0,0,1,3.145-3.145h29.995a3.144,3.144,0,0,1,3.145,3.145h0A3.144,3.144,0,0,1,249.772,187.153Z"
                            transform="translate(-216.633 -180.864)" fill="#96a0c5" />
                        </g>
                      </g>
                    </g>
                    <g id="Group_558" data-name="Group 558" transform="translate(1094.302 830.439)">
                      <ellipse id="Ellipse_14" data-name="Ellipse 14" cx="32.783" cy="4.085" rx="32.783"
                        ry="4.085" transform="translate(0 50.568)" fill="#212121" opacity="0.2"
                        style="mix-blend-mode: multiply;isolation: isolate" />
                      <path id="Path_623" data-name="Path 623"
                        d="M207.592,292.633h-6.818V285.29H158.239l0,46.89a6.531,6.531,0,0,0,6.531,6.531h0l29.472,0a6.536,6.536,0,0,0,6.534-6.536v-8.4h6.818a7.348,7.348,0,0,0,7.339-7.339V299.972A7.348,7.348,0,0,0,207.592,292.633Zm2.548,23.8a2.551,2.551,0,0,1-2.548,2.548h-6.818V297.424h6.818a2.552,2.552,0,0,1,2.548,2.548Z"
                        transform="translate(-155.986 -285.29)" fill="#edf0f2" />
                    </g>
                    <g id="Group_564" data-name="Group 564" transform="translate(1174.271 590.224)">
                      <g id="Group_563" data-name="Group 563">
                        <g id="Group_562" data-name="Group 562" transform="translate(76.136)">
                          <g id="Group_559" data-name="Group 559" transform="translate(26.398 115.098)">
                            <path id="Path_624" data-name="Path 624"
                              d="M301.437,288.144h0a27.7,27.7,0,0,0,27.7-27.7V205.117H273.74v55.331A27.7,27.7,0,0,0,301.437,288.144Z"
                              transform="translate(-273.74 -205.117)" fill="#8e5d53" />
                          </g>
                          <g id="Group_560" data-name="Group 560" transform="translate(5.564 17.17)">
                            <path id="Path_625" data-name="Path 625"
                              d="M357.4,183.6v0c0-26.772-21.7-41.231-48.475-41.231h0c-26.772,0-48.475,14.459-48.475,41.231v0c0,21.324-.056,40.906-.056,40.906h97.063S357.4,204.922,357.4,183.6Z"
                              transform="translate(-260.39 -142.366)" fill="#1c2832" />
                          </g>
                          <g id="Group_561" data-name="Group 561" transform="translate(0 75.427)">
                            <ellipse id="Ellipse_15" data-name="Ellipse 15" cx="11.788" cy="15.41"
                              rx="11.788" ry="15.41" fill="#8e5d53" />
                            <ellipse id="Ellipse_16" data-name="Ellipse 16" cx="11.788" cy="15.41"
                              rx="11.788" ry="15.41" transform="translate(84.615)" fill="#8e5d53" />
                          </g>
                          <path id="Path_626" data-name="Path 626"
                            d="M340.773,164.249a17.12,17.12,0,0,0-19.017-23.655,17.128,17.128,0,0,0-30.293-.2,17.116,17.116,0,0,0-17.735,23.851c-6.456,6.049-10.356,14.484-10.356,25.269v45.468a43.878,43.878,0,0,0,43.878,43.878h0a43.878,43.878,0,0,0,43.878-43.878V189.518C351.127,178.733,347.229,170.3,340.773,164.249Z"
                            transform="translate(-253.155 -131.364)" fill="#1c2832" />
                        </g>
                        <path id="Path_627" data-name="Path 627"
                          d="M467.518,437.73l-.535-65.642c-.654-58.477-15.375-90.4-34.6-108.656-20.03-21.438-54.9-28.71-94.6-28.71s-74.576,7.272-94.6,28.71c-19.225,18.256-33.946,50.179-34.6,108.656l-.535,65.642Z"
                          transform="translate(-208.038 -73.422)" fill="#1c2832" />
                        <rect id="Rectangle_101" data-name="Rectangle 101" width="196.128" height="102.782"
                          rx="13.196" transform="translate(32.306 214.916)" fill="#445c70" />
                        <path id="Path_628" data-name="Path 628"
                          d="M310.113,388.042V302.489a13.935,13.935,0,1,0-27.869,0v85.553Z"
                          transform="translate(-166.439 -43.245)" fill="#6e8190" />
                      </g>
                    </g>
                    <path id="Path_629" data-name="Path 629"
                      d="M499.494,125.16c247.3-63.7,319.737,251.251,150.833,290.755C473.269,457.327,348.709,585.6,189.1,478.064,37.124,375.666,35.389,131.7,184.965,87.4,351.043,38.2,341.986,165.732,499.494,125.16Z"
                      transform="translate(891.06 427.783)" fill="none" />
                    <g id="Group_570" data-name="Group 570" transform="translate(1467.986 542.674)">
                      <g id="Group_569" data-name="Group 569">
                        <g id="Group_567" data-name="Group 567">
                          <path id="Path_630" data-name="Path 630"
                            d="M457.952,224.3a61.705,61.705,0,1,1,61.707-61.7A61.775,61.775,0,0,1,457.952,224.3Z"
                            transform="translate(-396.245 -100.895)" fill="#8c8063" />
                        </g>
                        <path id="Path_631" data-name="Path 631"
                          d="M509.361,159.88a54.13,54.13,0,1,0-54.131,54.126A54.133,54.133,0,0,0,509.361,159.88Z"
                          transform="translate(-393.523 -98.173)" fill="#edf0f2" />
                        <path id="Path_632" data-name="Path 632"
                          d="M447.652,154.761h-29.67a1.966,1.966,0,0,1-1.966-1.966h0a1.966,1.966,0,0,1,1.966-1.966h28.1l33.667-31.9a1.966,1.966,0,0,1,2.779.075h0a1.967,1.967,0,0,1-.075,2.779Z"
                          transform="translate(-385.162 -91.089)" fill="#596e80" />
                        <path id="Path_633" data-name="Path 633"
                          d="M452.918,197.92a3.669,3.669,0,1,0,3.669,3.669A3.669,3.669,0,0,0,452.918,197.92Zm0-88.045a3.669,3.669,0,1,0,3.669,3.669A3.669,3.669,0,0,0,452.918,109.875ZM408.894,153.9a3.669,3.669,0,1,0,3.669,3.669A3.669,3.669,0,0,0,408.894,153.9Zm88.052,0a3.669,3.669,0,1,0,3.669,3.669A3.669,3.669,0,0,0,496.946,153.9Z"
                          transform="translate(-391.211 -95.861)" fill="#96a0c5" />
                        <path id="Path_634" data-name="Path 634"
                          d="M412.888,131.216a1.781,1.781,0,0,0-1.782,3.084,1.829,1.829,0,0,0,2.433-.652,1.78,1.78,0,0,0-.651-2.431ZM429,191.354a1.78,1.78,0,1,0-1.782,3.082,1.822,1.822,0,0,0,2.433-.652A1.781,1.781,0,0,0,429,191.354Zm42.24-73.168a1.823,1.823,0,0,0,2.431-.651,1.78,1.78,0,1,0-2.431.651Zm17.9,57.057a1.78,1.78,0,0,0-1.778,3.084,1.823,1.823,0,0,0,2.43-.654A1.778,1.778,0,0,0,489.141,175.242Zm-76.684-.183a1.78,1.78,0,0,0-2,2.609,1.822,1.822,0,0,0,2.433.651,1.78,1.78,0,0,0-.431-3.26ZM429,118.182a1.78,1.78,0,1,0-2.433-.652A1.826,1.826,0,0,0,429,118.182ZM489.135,134.3a1.78,1.78,0,1,0-2.43-.652A1.822,1.822,0,0,0,489.135,134.3Zm-16.541,56.882a1.778,1.778,0,0,0-2,2.609,1.822,1.822,0,0,0,2.43.649,1.779,1.779,0,0,0-.431-3.258Z"
                          transform="translate(-388.413 -93.066)" fill="#bec3c8" />
                        <rect id="Rectangle_102" data-name="Rectangle 102" width="2.243" height="59.116"
                          transform="matrix(0.714, -0.7, 0.7, 0.714, 52.739, 54.139)" fill="#596e80" />
                        <g id="Group_568" data-name="Group 568" transform="translate(55.702 55.679)">
                          <path id="Path_635" data-name="Path 635"
                            d="M442.446,142.186a4.895,4.895,0,1,0-4.894,4.9A4.894,4.894,0,0,0,442.446,142.186Z"
                            transform="translate(-431.535 -136.17)" fill="#edf0f2" />
                          <path id="Path_636" data-name="Path 636"
                            d="M437.954,148.605a6.016,6.016,0,1,1,6.016-6.016A6.022,6.022,0,0,1,437.954,148.605Zm0-9.788a3.773,3.773,0,1,0,3.772,3.772A3.777,3.777,0,0,0,437.954,138.817Z"
                            transform="translate(-431.938 -136.573)" fill="#596e80" />
                        </g>
                      </g>
                    </g>
                    <g id="Group_572" data-name="Group 572" transform="translate(1478.452 756.6)">
                      <ellipse id="Ellipse_17" data-name="Ellipse 17" cx="51.603" cy="6.266" rx="51.603"
                        ry="6.266" transform="translate(2.777 115.797)" fill="#212121" opacity="0.2"
                        style="mix-blend-mode: multiply;isolation: isolate" />
                      <g id="Group_571" data-name="Group 571" transform="translate(0 0)">
                        <path id="Rectangle_103" data-name="Rectangle 103"
                          d="M4.856,0H78.723a4.856,4.856,0,0,1,4.856,4.856V37.844A13.562,13.562,0,0,1,70.017,51.405H13.562A13.562,13.562,0,0,1,0,37.844V4.856A4.856,4.856,0,0,1,4.856,0Z"
                          transform="translate(0 70.884)" fill="#445c70" />
                        <path id="Path_637" data-name="Path 637"
                          d="M420.639,252.043h0a10.218,10.218,0,0,0-10.219,10.219v45.521A4.217,4.217,0,0,0,414.637,312h16.219V262.262A10.218,10.218,0,0,0,420.639,252.043Z"
                          transform="translate(-398.765 -230.089)" fill="#80d8d2" />
                        <path id="Path_638" data-name="Path 638"
                          d="M446.5,265.922h0a10.218,10.218,0,0,0-10.219,10.219v28.078H452.5A4.217,4.217,0,0,0,456.714,300V276.141A10.218,10.218,0,0,0,446.5,265.922Z"
                          transform="translate(-384.27 -222.308)" fill="#80d8d2" />
                        <path id="Path_639" data-name="Path 639"
                          d="M434.253,237.975h0a12.59,12.59,0,0,0-12.591,12.589v69.321h25.18V250.564A12.59,12.59,0,0,0,434.253,237.975Z"
                          transform="translate(-392.463 -237.975)" fill="#00b2a5" />
                      </g>
                      <rect id="Rectangle_104" data-name="Rectangle 104" width="12.547" height="1.967"
                        transform="translate(48.28 16.726) rotate(-31.955)" fill="#008e93" />
                      <rect id="Rectangle_105" data-name="Rectangle 105" width="12.547" height="1.967"
                        transform="translate(48.28 29.969) rotate(-31.955)" fill="#008e93" />
                      <rect id="Rectangle_106" data-name="Rectangle 106" width="1.967" height="13.499"
                        transform="matrix(0.615, -0.789, 0.789, 0.615, 23.271, 15.422)" fill="#00b2a5" />
                      <rect id="Rectangle_107" data-name="Rectangle 107" width="12.547" height="1.967"
                        transform="translate(48.28 43.213) rotate(-31.955)" fill="#008e93" />
                      <rect id="Rectangle_108" data-name="Rectangle 108" width="1.968" height="13.5"
                        transform="translate(23.271 41.908) rotate(-52.054)" fill="#00b2a5" />
                      <rect id="Rectangle_109" data-name="Rectangle 109" width="12.547" height="1.967"
                        transform="translate(48.28 56.456) rotate(-31.955)" fill="#008e93" />
                      <rect id="Rectangle_110" data-name="Rectangle 110" width="1.967" height="13.499"
                        transform="matrix(0.615, -0.789, 0.789, 0.615, 23.271, 55.152)" fill="#00b2a5" />
                      <rect id="Rectangle_111" data-name="Rectangle 111" width="1.967" height="13.499"
                        transform="matrix(0.615, -0.789, 0.789, 0.615, 23.271, 28.665)" fill="#00b2a5" />
                      <rect id="Rectangle_112" data-name="Rectangle 112" width="1.967" height="13.5"
                        transform="translate(5.727 41.908) rotate(-52.054)" fill="#00b2a5" />
                      <rect id="Rectangle_113" data-name="Rectangle 113" width="1.967" height="13.499"
                        transform="matrix(0.615, -0.789, 0.789, 0.615, 5.727, 55.152)" fill="#00b2a5" />
                      <rect id="Rectangle_114" data-name="Rectangle 114" width="12.547" height="1.967"
                        transform="translate(48.28 69.7) rotate(-31.957)" fill="#008e93" />
                      <rect id="Rectangle_115" data-name="Rectangle 115" width="12.547" height="1.967"
                        transform="matrix(0.849, -0.529, 0.529, 0.849, 67.988, 56.456)" fill="#00b2a5" />
                      <rect id="Rectangle_116" data-name="Rectangle 116" width="12.547" height="1.967"
                        transform="matrix(0.848, -0.529, 0.529, 0.848, 67.988, 69.699)" fill="#00b2a5" />
                      <rect id="Rectangle_117" data-name="Rectangle 117" width="1.968" height="13.499"
                        transform="matrix(0.615, -0.789, 0.789, 0.615, 23.271, 68.396)" fill="#00b2a5" />
                    </g>
                  </g>
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
