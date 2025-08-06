<script>
  $(document).ready(function() {
    $("table").each(function() {
      if (!$(this).parent().hasClass("table-responsive")) {
        $(this).wrap("<div class='table-responsive'></div>");
      }
    });
  });
</script>
<!-- Footer -->
<footer class="dark-footer skin-dark-footer">
  <div>
    <div class="container">
      <div class="row">

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
          <div class="footer-widget">
            <span class="widget-title">Top Courses</span>
            <ul class="footer-menu">
              <li><a href="{{ url('accounting-finance-courses') }}"><i class="ti-arrow-right"></i> Accounting &
                  Finance</a></li>
              <li><a href="{{ url('civil-engineering-courses') }}"><i class="ti-arrow-right"></i> Civil Engineering</a>
              </li>
              <li><a href="{{ url('arts-fine-arts-courses') }}"><i class="ti-arrow-right"></i> Arts/Fine Arts</a></li>
              <li><a href="{{ url('hospitality-courses') }}"><i class="ti-arrow-right"></i> Hospitality</a></li>
              <li><a href="{{ url('/business-management-courses') }}"><i class="ti-arrow-right"></i> Business
                  Management</a></li>
              <li><a href="{{ url('computer-engineering-courses') }}"><i class="ti-arrow-right"></i> Computer
                  Engineering</a></li>
              <li><a href="{{ url('physiology-courses') }}"><i class="ti-arrow-right"></i> Physiology</a></li>
              <li><a href="{{ url('medicine-courses') }}"><i class="ti-arrow-right"></i> Medicine</a></li>
              <li><a href="{{ url('business-information-system-courses') }}"><i class="ti-arrow-right"></i> Business
                  Information
                  Systems</a></li>
            </ul>

          </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
          <div class="footer-widget">
            <span class="widget-title">Qualified Level</span>
            <ul class="footer-menu">
              <li><a href="{{ url('courses/pre-university') }}"><i class="fa fa-angle-right"></i>
                  CERTIFICATE</a></li>
              <li><a href="{{ url('courses/pre-university') }}"><i class="fa fa-angle-right"></i>PRE
                  UNIVERSITY</a></li>
              <li><a href="{{ url('courses/diploma') }}"><i class="fa fa-angle-right"></i> DIPLOMA</a>
              </li>
              <li><a href="{{ url('courses/under-graduate') }}"><i class="fa fa-angle-right"></i>UNDER
                  GRADUATE</a></li>
              <li><a href="{{ url('courses/post-graduate') }}"><i class="fa fa-angle-right"></i>POST
                  GRADUATE</a></li>
              <li><a href="{{ url('courses/phd') }}"><i class="fa fa-angle-right"></i>PhD COURSES</a>
              </li>

            </ul>
          </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
          <div class="footer-widget">
            <span class="widget-title">HELP & SUPPORT</span>
            <ul class="footer-menu">
              <li><a href="{{ url('faqs') }}"><i class="fa fa-angle-right"></i> FAQs</a></li>
              <li><a href="{{ url('what-people-say') }}"><i class="fa fa-angle-right"></i> What People Say</a></li>
              <li><a href="{{ url('contact-us') }}"><i class="fa fa-angle-right"></i> Contact us</a></li>
              <li><a href="{{ url('terms-and-conditions') }}"><i class="fa fa-angle-right"></i> Terms & Conditions</a>
              </li>
              <li><a href="{{ route('blog') }}"><i class="fa fa-angle-right"></i> Blog</a></li>
              <li><a href="{{ url('privacy-policy') }}"><i class="fa fa-angle-right"></i> Privacy Policy</a></li>
            </ul>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6  mt-4">
          <div class="indin-office">
            <span class="Head-indian">India Head Office</span>
            <p>B-16 Ground Floor, Mayfield Garden, Sector 50, Gurugram, Haryana, India 122002</p>
            <p>Phone: <a href="tel:+919818560331">+91-98185-60331</a></p>
            <p>Email: <a href="mailto:info@educationmalaysia.in">info@educationmalaysia.in</a></p>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6  mt-4">
          <div class="indin-office">
            <span class="Head-indian"> Malaysia Office</span>
            <p>8, Jalan Tun Sambanthan, Wilayah Persekutuan Kuala Lumpur Malaysia 50470</p>
            <p>Phone: <a href="tel:+60176472057">+60 176472057</a></p>

          </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6  mt-4">
          <div class="indin-office">
            <span class="Head-indian">Malaysia Office</span>
            <p>SRIM SOLUTIONS SDN BHD
              Unit 108 & 109 3rd Floor, Wisma RKT No. 2 Jalan Raja Abdullah50300 Kuala Lumpur</p>
            <!-- <p>Phone: <a href="tel:+60 012-2245649">+60 012-2245649</a></p> -->
            <p>Phone: <a href="tel:+60 012-2631251">+60 012-2631251</a></p>

          </div>

        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6  mt-4">
          <div class="indin-office">
            <span class="b">Zambia Office</span>
            <p>
              2nd Floor
              Provident House, Next to Bank of Zambia </p>
            <p>Phone: <a href="tel:+260971868086">+260-971868086</a></p>
            <ul class="linksfooters">
              <li><a href="https://www.facebook.com/educationmalaysia.in" target="_blank" class="fb"
                  aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
              </li>
              <li><a href="https://twitter.com/educatemalaysia/" target="_blank" class="tw" aria-label="Twitter"><i
                    class="fab fa-twitter"></i></a>
              </li>
              <li><a href="https://www.linkedin.com/company/educationmalaysia/" target="_blank" class="ln"
                  aria-label="Linkedin"><i class="fab fa-linkedin" aria-hidden="true"></i></a>
              </li>
              <li><a href="https://www.pinterest.com/educationmalaysiain/" target="_blank" rel="" class="pn"
                  aria-label="Pinterest"><i class="fab fa-pinterest" aria-hidden="true"></i></a> </li>
              <li><a href="https://www.instagram.com/educationmalaysia.in/" target="_blank" rel=""
                  class="pn" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
              </li>
              <li><a href="https://www.youtube.com/@educationmalaysia6986" target="_blank" class="yt"
                  aria-label="YouTube"><i class="fab fa-youtube" aria-hidden="true"></i></a>
              </li>
            </ul>
          </div>
        </div>

      </div>
      <!-- <div class="row">

            </div> -->

      <!-- Footer End -->

      <span id="back2Top" class="top-scroll" title="Back to top"><i class="ti-arrow-up"></i></span>
    </div>
    <!-- All Js -->
    <script src="{{ cdn('front/assets/js/popper.min.js') }}"></script>
    <script src="{{ cdn('front/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ cdn('front/assets/js/select2.min.js') }}"></script>
    <script src="{{ cdn('front/assets/js/slick.js') }}"></script>
    <script src="{{ cdn('front/assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ cdn('front/assets/js/counterup.min.js') }}"></script>
    <script src="{{ cdn('front/assets/js/custom.js') }}"></script>
    <script>
      $('#side-menu').metisMenu();
    </script>
    <script src="{{ cdn('front/assets/js/metisMenu.min.js') }}"></script>

    <!-- Zoom -->
    <link rel="preload" href="{{ cdn('front/assets/fancybox/jquery.fancybox.min.css') }}" as="style"
      onload="this.onload=null;this.rel='stylesheet'">
    <script src="{{ cdn('front/assets/fancybox/jquery.fancybox.min.js') }}" defer></script>
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
    <script>
      $(".show-more").click(function() {
        if ($(".text").hasClass("show-more-height")) {
          $(this).text("(Show Less)");
        } else {
          $(this).text("(Show More)");
        }
        $(".text").toggleClass("show-more-height");
      });
    </script>

    <div class="whats-float">
      <a href="https://api.whatsapp.com/send?phone=60176472057&text=Hello there!! I want to get counseling from experts. Want to know more information about Study Abroad Consultants in India - Education Malaysia Education" class="ed_whatsapp" onClick="openForm()">
        
        <span>Need any help<br><small>Chat with us</small></span>
        <img data-src="/assets/images/wa.png" width="30" alt="whatsapp"></a>
    </div>

    <!-- <div class="chat-popup" id="myForm">
      <div class="wa-container">
        <button type="button" class="cancel" onClick="closeForm()"><i class="ti-close"></i></button>
        <div class="whtsapp-header">
          <div class="row">
            <div class="col-2 pr0"><img data-src="https://www.educationmalaysia.in/front/assets/img/wa.png"
                alt="whatsapp" class="img-fluid"></div>
            <div class="col-10">
              <div class="title">Start a Conversation</div>
              <div class="text">Hi! Click one of our member below to chat on <strong>WhatsApp</strong>
              </div>
            </div>
          </div>
        </div>

        <div class="content">
          <span class="d-block font-size-13 mb-2">The team typically replies in a few minutes.</span>

          <a class="country-box" target="_blank"
            href="https://api.whatsapp.com/send?phone=60176472057&text=Hello there!! I want to get counseling from experts. Want to know more information about Study Abroad Consultants in India - Education Malaysia Education">
            <div class="row align-items-center">
              <div class="col-2 pr-0"><img
                  data-src="https://www.educationmalaysia.in/front/assets/img/flag-malaysia.png" alt="indian flag"
                  class="img-fluid"></div>
              <div class="col-8 pr0">
                <strong>Location: Malaysia</strong><br>
                Start Chat with a Counsellor
              </div>
              <div class="col-1 pr-0 text-right"><img
                  data-src="https://www.educationmalaysia.in/front/assets/img/wad.png" alt="counsellor"
                  width="20">
              </div>
            </div>
          </a>

        </div>

      </div>
    </div> -->

    <!-- Include jQuery and Slick Carousel libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <!-- Initialize Slick Carousel -->
    <script>
      $(document).ready(function() {
        $(".multiple-items").slick({
          dots: true,
          infinite: true,
          speed: 500,
          slidesToShow: 4,
          slidesToScroll: 4,
          responsive: [{
              breakpoint: 1200, // For devices with a width <= 1024px
              settings: {
                slidesToShow: 3,
                slidesToScroll: 2,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 1024, // For devices with a width <= 1024px
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 768, // For devices with a width <= 600px
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 600, // For devices with a width <= 600px
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: false
              }
            }
          ]
        });

        // $(".secondheader").slick({
        //   dots: true,
        //   infinite: true,
        //   speed: 500,
        //   slidesToShow: 1,
        //   slidesToScroll: 1,
        //   responsive: [{
        //       breakpoint: 1024,
        //       settings: {
        //         slidesToShow: 1,
        //         slidesToScroll: 2,
        //         infinite: true,
        //         dots: true
        //       }
        //     },
        //     {
        //       breakpoint: 600,
        //       settings: {
        //         slidesToShow: 1,
        //         slidesToScroll: 1
        //       }
        //     }
        //   ]
        // });

        $(".serviceitedms").slick({
          dots: true,
          infinite: true,
          speed: 500,
          arrows: true, // Enable arrows
          slidesToShow: 3,
          slidesToScroll: 2,
          responsive: [{
              breakpoint: 1200, // For devices with a width <= 1024px
              settings: {
                slidesToShow: 3,
                slidesToScroll: 2,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 1024, // For devices with a width <= 1024px
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 768, // For devices with a width <= 600px
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 600, // For devices with a width <= 600px
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
        });

      });
    </script>

    <!-- top slider mainheader  -->

    <script>
      document.addEventListener("DOMContentLoaded", function() {
        var lazyImages = document.querySelectorAll('[data-src]');
        var observer = new IntersectionObserver(function(entries, observer) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              var lazyImage = entry.target;
              lazyImage.src = lazyImage.dataset.src;
              observer.unobserve(lazyImage);
            }
          });
        });
        lazyImages.forEach(function(lazyImage) {
          observer.observe(lazyImage);
        });
      });
    </script>

    <script>
      function openForm() {
        document.getElementById("myForm").style.display = "block";
      }

      function closeForm() {
        document.getElementById("myForm").style.display = "none";
      }
    </script>
    <!-- Whatsapp Box and Button -->
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
      var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
      (function() {
        var s1 = document.createElement("script"),
          s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/66d70cdeea492f34bc0d310c/1i6s0ki47';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
      })();
    </script>
    <!--End of Tawk.to Script-->

    <!-- owl-carousel start  -->
    <script>
      $(document).ready(function() {
        $(".owl-carousel").owlCarousel({
          responsiveBaseElement: $('body'),
          loop: true,
          margin: 10,
          responsiveClass: true,
          // autoHeight: true,
          autoplayTimeout: 4000,
          autoplay: true,
          smartSpeed: 800,
          nav: true,
          // dots: false,
          items: 2,
          responsive: {
            0: {
              items: 1
            },

            600: {
              items: 1
            },

            1000: {
              items: 2
            },

            1200: {
              items: 3
            }
          }


        });
      });
    </script>

    <!-- jQuery -->

    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- owl-carousel end  -->

    </body>

    </html>
