@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <div class="image-cover half_banner"
    style="background:#0b2248 url(https://www.educationmalaysia.in/front/assets/img/partner-banner.jpg) no-repeat;">
    <div class="container">
      <!-- Type -->
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="banner-search-2 pt-heading">
            <h1 class="cl_2 mb-0">Services for <b class="theme-cl1"> Partners</b> </h1>
            <p>“Our mission is to empower you to thrive in the education sector and enjoy lucrative commissions”</p>
            <p>We're here to empower our business partners to succeed, leveraging technology, hard work, and a
              well-established network to help you reap generous commissions in the education industry.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid pt-2 pb-1" data-overlay="9">
    <div class="row align-items-center">
      <div class="col-lg-12 col-md-12">
        <div class="ed_detail_wrap light">
          <ul class="cources_facts_list">
            <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
            <li class="facts-1">Services For Partners</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Content -->
  <section class=" pb-0 service-section">
    <div class="container">
      <div class="cat-10 pl-4 pr-4">
        <div class="row align-items-center">
          <div class="col-lg-7">
            <div id="carouselExampleControls" class="carousel slide service-slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="about-short">
                    <h3>Substantial <b class="theme-cl1">Earnings</b></h3>
                    <hr>
                    <p class="mb-4">Maximize your commissions with our efficient, transparent payment system. We've
                      streamlined the process for swift, substantial earnings and a user-friendly experience.</p>
                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Maximum Profits</h4>
                        <p>Maximize your earnings with our speedy and transparent commission system, ensuring swift
                          payouts.</p>
                      </span>
                    </span>

                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Speedy Commissions</h4>
                        <p>Experience the swiftest commission processing as we transfer your earnings promptly upon
                          receipt from universities.</p>
                      </span>
                    </span>

                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Profitable Promotions</h4>
                        <p>Benefit from bonus payments, application fee waivers, generous commissions, and more through
                          our lucrative promotions</p>
                      </span>
                    </span>
                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Dedicated Commission Assistance</h4>
                        <p>Our responsive team is here to address your commission inquiries promptly, ensuring your
                          payments are well-supported.</p>
                      </span>
                    </span>
                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Diverse Income Streams</h4>
                        <p>Seek our prospects to expand your revenue streams by introducing a variety of services,
                          training programs, or complementary products to augment your consultancy offerings.</p>
                      </span>
                    </span>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="about-short ">
                    <h3>Tailored Technology <b class="theme-cl1"> Solutions</b></h3>
                    <hr>
                    <p class="mb-4">Our commitment to innovation is geared towards bolstering the success of your
                      consultancy enterprise. We provide an array of personalized technology solutions meticulously
                      crafted to optimize your operations, improve efficiency, and keep your business at the forefront of
                      industry advancements.</p>
                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Custom-Built Applications Software</h4>
                        <p>Our tailor-made software and applications that are intricately crafted to align with your exact
                          business needs and are purpose-built to streamline a range of operational tasks, including the
                          management of student data and tracking of applications. </p>
                      </span>
                    </span>

                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Tailored CRM Solutions</h4>
                        <p>Our customized CRM solutions streamline student interaction management, lead tracking, and
                          communication, ensuring a more organized and efficient consultancy process</p>
                      </span>
                    </span>

                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Statistical investigation</h4>
                        <p>We provide tailored tools for tracking your consultancy's performance, assessing diverse
                          strategies, and identifying areas for improvement, leveraging data-driven insights to guide your
                          consultancy toward growth and enhanced service delivery</p>
                      </span>
                    </span>
                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Web Design and Development</h4>
                        <p>We create a professional, user-friendly website for your consultancy, complete with student
                          portals, appointment scheduling, and application tracking features, to make a positive first
                          impression and attract and retain students.</p>
                      </span>
                    </span>
                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Tech Training </h4>
                        <p>Embracing new technology can present challenges, but we provide comprehensive training and
                          support to ensure your team is proficient in harnessing technology to its full potential, with
                          our programs encompassing software management, CRM solution utilization, and data analysis</p>
                      </span>
                    </span>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="about-short">
                    <h3>Igniting <b class="theme-cl1">Empowerment</b></h3>
                    <hr>
                    <p class="mb-4">We empower our partners to reach new heights by authorizing their potential,
                      enabling their progress, and equipping them with the tools for success, because together, we amplify
                      possibilities.</p>
                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Webinars for Ongoing Learning </h4>
                        <p>Stay updated and ahead of industry trends through our weekly e-learning webinars. Presented by
                          university delegates and experts from Britannica, these interactive sessions provide invaluable
                          insights, ensuring counselors and advisors are well-versed in international education.</p>
                      </span>
                    </span>

                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Comprehensive Learning Resources</h4>
                        <p>Knowledge is power, and Empowering You equips your counselors with a comprehensive library of
                          rich and up-to-date learning materials. Our resources include detailed country guides,
                          informative presentation decks, outreach materials, and much more. These resources are
                          indispensable for assisting your students in making informed decisions about their education
                          abroad</p>
                      </span>
                    </span>

                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Conversion Sessions for Personalized Guidance</h4>
                        <p>We value the significance of fostering direct interactions between students and universities.
                          Our Conversion Sessions, skillfully conducted by the Britannica team, offer a distinct platform
                          for your students to engage with university representatives. These sessions play a vital role in
                          guiding students toward the most suitable institutions, ensuring a seamless transition into
                          their international education expedition</p>
                      </span>
                    </span>
                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>International Network and Partnerships</h4>
                        <p>Leverage our extensive network of international university partners and strategic
                          collaborations. We can connect you with the right institutions, ensuring your students have
                          access to diverse study options, scholarships, and admission opportunities.</p>
                      </span>
                    </span>
                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Progress Tracking and Reporting</h4>
                        <p>We provide tools and reporting mechanisms to help you track the progress of your students
                          throughout the application and admission process. This data-driven approach empowers you to make
                          informed decisions and continually improve your services.</p>
                      </span>
                    </span>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="about-short">
                    <h3>Your Needs Take <b class="theme-cl1"> Priority</b></h3>
                    <hr>
                    <p class="mb-4">At our consultancy, we prioritize our partners' needs, fostering a mutually
                      beneficial relationship built on unwavering support.</p>
                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Tailored Partner Support</h4>
                        <p>We take a personalized approach to comprehend your unique requirements. Your success is our
                          success, and we're committed to customizing our services to align with your goals and
                          objectives.</p>
                      </span>
                    </span>

                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4> Dedicated Expertise</h4>
                        <p>Our team of seasoned professionals is well-versed in the intricacies of the education
                          landscape. We don't just offer assistance; we bring expertise to the table, ensuring you're
                          always equipped with the knowledge and resources needed to excel.</p>
                      </span>
                    </span>

                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Proactive Problem Solving</h4>
                        <p>From resolving challenges to seizing opportunities, we're here to navigate the journey
                          alongside you. Our commitment to your success means that we don't just react to issues – we
                          proactively address them, turning potential obstacles into stepping stones.</p>
                      </span>
                    </span>
                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Multiple Communication Channels</h4>
                        <p>We know the importance of flexibility in communication. Reach out to us through your preferred
                          channel—be it emails, WhatsApp chats, calls, or comments in our Course Finder. We are always
                          ready to listen and respond promptly to ensure your needs are met with the utmost convenience.
                        </p>
                      </span>
                    </span>
                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Innovative Solutions</h4>
                        <p>The educational landscape is ever-evolving, and so are our solutions. We are dedicated to
                          staying at the forefront of industry trends and technology, providing you with innovative tools
                          and resources to help you thrive in the dynamic world of education consultancy.</p>
                      </span>
                    </span>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="about-short">
                    <h3>Legal and Regulatory <b class="theme-cl1">Compliance</b></h3>
                    <hr>
                    <p class="mb-4">In today's complex business landscape, staying compliant with ever-evolving legal
                      and regulatory requirements is a paramount concern for organizations. As business partners, it
                      becomes imperative to navigate this intricate web of laws, standards, and guidelines effectively.
                    </p>
                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Tailored Guidance</h4>
                        <p>Recognizing that each partner may have unique compliance needs, we offer tailored guidance that
                          takes into account the specific requirements and nuances of your business. Our experts work
                          closely with you to create a compliance strategy that is aligned with your objectives.</p>
                      </span>
                    </span>

                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Education and Training</h4>
                        <p>To foster a culture of compliance, we provide educational resources and training programs.
                          These are designed to empower your team with the knowledge and skills necessary to uphold the
                          established legal and regulatory standards.</p>
                      </span>
                    </span>

                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Continuous Monitoring</h4>
                        <p>Compliance is not a one-time effort; it requires continuous vigilance. We implement monitoring
                          systems to keep partners informed about changes in laws and regulations, ensuring timely
                          adjustments to your operations.</p>
                      </span>
                    </span>
                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Risk Mitigation</h4>
                        <p>We help partners identify potential compliance risks and provide strategies for risk
                          mitigation. Proactive risk management is a crucial component of maintaining legal and regulatory
                          compliance.</p>
                      </span>
                    </span>
                    <span class="list_facts icon-top">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Crisis Management</h4>
                        <p>In the event of compliance-related issues or crises, our team is readily available to provide
                          guidance and support. Swift response and resolution are essential to minimize potential damage.
                        </p>
                      </span>
                    </span>
                  </div>
                </div>
              </div>
              <a class="carousel-control-prev slick-next slick-icon slick-arrow" href="#carouselExampleControls"
                role="button" data-slide="prev">
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next slick-next slick-icon slick-arrow" href="#carouselExampleControls"
                role="button" data-slide="next">
                <span class="sr-only">Next</span>
              </a>

            </div>
          </div>
          <div class="col-lg-5">
            <div class="list_facts_wrap_img ser image-services"><img
                data-src="https://www.educationmalaysia.in/front/assets/img/partners-service.png" class="img-fluid"
                alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="strengths core-section  "
    style="background:url(https://www.educationmalaysia.in/front/assets/img/testimonial.png)">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-sm-12 text-center">
          <h2>Our Core Strengths</h2>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-lg-4 text-center">
          <h3 class="orange">700+</h3>
          <h4>Global University Tie Ups</h4>
          <p class="text-center">Our students aren’t just pursuing their higher education, but their dreams and ambitions
            in eminent universities across the globe</p>
        </div>

        <div class="col-lg-4 text-center">
          <h3 class="green">65+</h3>
          <h4>Offices across the Globe</h4>
          <p class="text-center">We’re growing, we’re expanding and we’re doing that fast! Join the fastest growing
            EdTech brand in South and South-East Asia.</p>
        </div>

        <div class="col-lg-4 text-center">
          <h3 class="blue">25+</h3>
          <h4>Years of Industry Presence</h4>
          <p class="text-center">With over two decades of industry expertise, we know what’s best for you and that makes
            us really good at what we do!</p>
        </div>
      </div>

    </div>
  </section>

  <section class="bg-light-1 offerings-section">
    <div class="container">

      <div class="row mb-2">
        <div class="col-lg-12 col-sm-12 text-center service-heading-pb">
          <h2>Britannica <span class="theme-cl1">Services & </span> Offerings</h2>
        </div>
      </div>

      <div class="edu_cat_2 cat-10 pl-4 pr-4">
        <div class="row align-items-center">
          <div class="col-lg-7">
            <div class="about-short">
              <h3> Services For <b class="theme-cl1">Students</b></h3>
              <p class="mb-4">Our services are designed to be comprehensive, empowering you to navigate every step of
                the
                study abroad journey with confidence and success.</p>

              <h5 class="mb-3">Offerings</h5>
              <span class="list_facts">
                <span class="list_facts_icons"><i class="ti-star"></i></span>
                <span class="list_facts_caption">
                  <h4>Virtual Coaching & Expert-Led Premium Admission Consultation</h4>
                </span>
              </span>

              <span class="list_facts">
                <span class="list_facts_icons"><i class="ti-star"></i></span>
                <span class="list_facts_caption">
                  <h4>Facilitating High-Value Scholarships and Study Loans</h4>
                </span>
              </span>

              <span class="list_facts">
                <span class="list_facts_icons"><i class="ti-star"></i></span>
                <span class="list_facts_caption">
                  <h4>Assistance with Applications, Admissions, and Visas</h4>
                </span>
              </span>

              <a href="student-services" class="btn btn-modern float-left mt-3">Know More<span><i
                    class="fa fa-angle-right"></i></span></a>
            </div>
          </div>

          <div class="col-lg-5">
            <div class="list_facts_wrap_img"><img
                data-src="https://www.educationmalaysia.in/front/assets/img/student2.png" class="img-fluid"
                alt="">
            </div>
          </div>
        </div>
      </div>

      <div class="edu_cat_2 cat-4 pl-4 pr-4">
        <div class="row align-items-center">
          <div class="col-lg-5">
            <div class="list_facts_wrap_img"><img
                data-src="https://www.educationmalaysia.in/front/assets/img/franchise.png" class="img-fluid"
                alt="">
            </div>
          </div>

          <div class="col-lg-7">
            <div class="about-short">
              <h3>Services For <b class="theme-cl1">Franchisees</b></h3>
              <p class="mb-4">At Education Malaysia Education, we understand the unique needs and challenges faced by
                our franchisees. We are dedicated to providing comprehensive support and resources to ensure your success
                as a franchise partner.</p>

              <h5 class="mb-3">Offerings</h5>
              <span class="list_facts">
                <span class="list_facts_icons"><i class="ti-star"></i></span>
                <span class="list_facts_caption">
                  <h4>Business solutions tailor made for your market</h4>
                </span>
              </span>

              <span class="list_facts">
                <span class="list_facts_icons"><i class="ti-star"></i></span>
                <span class="list_facts_caption">
                  <h4>Support for Operations, Events and Marketing</h4>
                </span>
              </span>

              <span class="list_facts">
                <span class="list_facts_icons"><i class="ti-star"></i></span>
                <span class="list_facts_caption">
                  <h4>Access to Britannica's rich Knowledge Repository</h4>
                </span>
              </span>

              <a href="franchise-services" class="btn btn-modern float-left mt-3">Know More<span><i
                    class="fa fa-angle-right"></i></span></a>
            </div>
          </div>

        </div>
      </div>

      <div class="edu_cat_2 cat-6 mb-0 pl-4 pr-4">
        <div class="row align-items-center">

          <div class="col-lg-7">
            <div class="about-short">
              <h3>Services For <b class="theme-cl1">Universities</b></h3>
              <p class="mb-4">At Education Malaysia Education, we take pride in being a bridge between universities
                and international students. Our dedication to facilitating academic pursuits has made us a reliable
                partner for universities worldwide.</p>

              <h5 class="mb-3">Assistances</h5>
              <span class="list_facts">
                <span class="list_facts_icons"><i class="ti-star"></i></span>
                <span class="list_facts_caption">
                  <h4>Enroll students from various nationalities</h4>
                </span>
              </span>

              <span class="list_facts">
                <span class="list_facts_icons"><i class="ti-star"></i></span>
                <span class="list_facts_caption">
                  <h4>Leverage Britannica's vast recruitment network</h4>
                </span>
              </span>

              <span class="list_facts">
                <span class="list_facts_icons"><i class="ti-star"></i></span>
                <span class="list_facts_caption">
                  <h4>Amplify brand visibility and recognition</h4>
                </span>
              </span>

              <a href="universities-services" class="btn btn-modern float-left mt-3">Know More<span><i
                    class="fa fa-angle-right"></i></span></a>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="list_facts_wrap_img"><img
                data-src="https://www.educationmalaysia.in/front/assets/img/university2.png" class="img-fluid"
                alt="">
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <section class="bg-light lets-helps">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="sec-heading center">
            <h2>Let’s <span class="theme-cl1"> help you live</span> your dream</h2>
          </div>
        </div>
      </div>
      @if ($destinations->count() > 0)
        <div class="row mt-3 arrow_slide five_slide arrow_middle _wrk_prc_wrap active bg-white">
          @foreach ($destinations as $row)
            <div class="singles_items">
              <div class="card shadow-0 mb-0">
                <img data-src="{{ asset($row->thumbnail_path) }}" class="img-fluid" alt="{{ $row->destination_name }}">
                <div class="card-header bg-light border-0 pl-4 pr-4">
                  <h4 class="text-center" style="font-size:15px; font-weight:600;">Study in {{ $row->destination_name }}
                  </h4>
                  <a href="{{ url($row->destination_slug) }}" class="btn btn_apply w-100" style="height:40px">View
                    Details</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif

      <div class="row justify-content-center mt-4">
        <a href="{{ url('cities') }}" class="btn btn-modern float-none">View all Destinations<span><i
              class="fa fa-angle-right"></i></span></a>
      </div>
    </div>
  </section>
  <section class="new-testi student-saying hide-this">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-sm-12 text-center">
          <h2>What our <span class="theme-cl1">students</span> are saying</h2>
        </div>
      </div>

      <div class="row mt-3 edu_cat_2 cat-3">
        <div class="col-lg-3 rating-box">
          <div class="rating _wrk_prc_wrap active">
            <p>42,150+ reviews</p>
            <div class="testi-rate">
              <i class="fa fa-star filled"></i>
              <i class="fa fa-star filled"></i>
              <i class="fa fa-star filled"></i>
              <i class="fa fa-star filled"></i>
              <i class="fa fa-star filled"></i>
            </div>
            <h3>4.9/5</h3>
            <div class="row justify-content-center"><a href="#" class="btn btn-modern float-none">Get free
                counselling <span><i class="fa fa-angle-right"></i></span></a></div>
          </div>
        </div>

        <div class="col-lg-9 text-center">
          <div class="reviews_third" id="reviews-slide">

            <div class="testimonial-wraps">
              <div class="testimonial-icon">
                <div class="testimonial-icon-thumb"><span class="quotes"><i class="fas fa-quote-left"></i></span></div>
                <h4>Student Name</h4>
              </div>
              <div class="facts-detail">
                <p>Faucibus tristique felis potenti ultrices ornare rhoncus semper hac facilisi Rutrum tellus lorem sem
                  velit nisi.</p>
                <h5>Student from Delhi</h5>
              </div>
            </div>

            <div class="testimonial-wraps">
              <div class="testimonial-icon">
                <div class="testimonial-icon-thumb"><span class="quotes"><i class="fas fa-quote-left"></i></span></div>
                <h4>Student Name</h4>
              </div>
              <div class="facts-detail">
                <p>Faucibus tristique felis potenti ultrices ornare rhoncus semper hac facilisi Rutrum tellus lorem sem
                  velit nisi.</p>
                <h5>Student from Delhi</h5>
              </div>
            </div>

            <div class="testimonial-wraps">
              <div class="testimonial-icon">
                <div class="testimonial-icon-thumb"><span class="quotes"><i class="fas fa-quote-left"></i></span></div>
                <h4>Student Name</h4>
              </div>
              <div class="facts-detail">
                <p>Faucibus tristique felis potenti ultrices ornare rhoncus semper hac facilisi Rutrum tellus lorem sem
                  velit nisi.</p>
                <h5>Student from Delhi</h5>
              </div>
            </div>

            <div class="testimonial-wraps">
              <div class="testimonial-icon">
                <div class="testimonial-icon-thumb"><span class="quotes"><i class="fas fa-quote-left"></i></span></div>
                <h4>Student Name</h4>
              </div>
              <div class="facts-detail">
                <p>Faucibus tristique felis potenti ultrices ornare rhoncus semper hac facilisi Rutrum tellus lorem sem
                  velit nisi.</p>
                <h5>Student from Delhi</h5>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </section>

  @if ($blogs->count() > 0)
    <section class="min-sec bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 col-md-12">
            <div class="sec-heading">
              <h2>Recent Articles</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 p-0">
            <div class="container">
              <div class="custom-tab customize-tab tabs_creative mb-0">

                <div class="tab-content" id="myTabContent" style="margin:0px -10px">
                  <div class="tab-pane fade active show pb-0" id="artical1" role="tabpanel"
                    aria-labelledby="artical1-tab" aria-expanded="true">
                    <div class="arrow_slide three_slide arrow_middle">
                      @foreach ($blogs as $row)
                        <!-- Single Slide -->
                        <div class="singles_items">
                          <div class="education_block_grid style_2">
                            <div class="education_block_thumb n-shadow">
                              <a href="{{ url($row->slug) }}"><img data-src="{{ asset($row->thumbnail_path) }}"
                                  class="article-img" alt="{{ $row->title }}"></a>
                              <div class="cources_price">{{ $row->getCategory->category_name }}</div>
                            </div>
                            <div class="education_block_body">
                              <h4 class="bl-title"><a href="{{ url($row->slug) }}">{{ $row->title }}</a></h4>
                            </div>
                            <div class="cources_info_style3">
                              <ul>
                                <li><i class="ti-calendar mr-2"></i>{{ getFormattedDate($row->created_at, 'd M, Y') }}
                                </li>
                                {{-- <li><i class="ti-eye mr-2"></i>55 Views</li>
                          <li><i class="ti-star text-warning mr-2"></i>4.7 Rating</li> --}}
                              </ul>
                            </div>
                          </div>
                        </div>
                      @endforeach

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <a href="{{ url('/articles') }}" class="btn btn-modern float-none">View all Articals<span><i
                class="fa fa-angle-right"></i></span></a>
        </div>
      </div>
    </section>
  @endif

  <!-- Content -->
@endsection
