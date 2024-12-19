@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  <div class="image-cover ed_detail_head lg" style="background:url({{ asset('front/') }}/assets/img/ub.jpg);"
    data-overlay="8">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12">
          <div class="ed_detail_wrap light">
            <ul class="cources_facts_list">
              <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
              <li class="facts-1">Who we are</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->

  <!-- Content -->
  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="about-short">
            <div class="sec-heading">
              <h2>About <span class="theme-cl1">Education Malaysia</span></h2>
            </div>
            <div class="font-size-16">
              <div class="cor-p3">
                <div class="row">
                  <div class="col-sm-12 col-md-7">
                    <h2 style="margin:0px!important">About Us</h2>
                    <div class="pad10 font b" style="margin-bottom:15px!important">The Achievement of Perfection is our
                      goal but Excellence is Guarantee!</div>
                    <p>Britannica Overseas is the cutting edge of higher education’s Recruitment, Marketing and student
                      enrollment. We have been a well founded solutions specialist to our partner institutions since 2015.
                    </p>
                    <p>Britannica Overseas has been providing services for higher education marketing to over 100 partner
                      schools across the globe. We have also launched multiple websites for different overseas study
                      destinations like Malaysia, Germany, Canada, Australia and UK; hence, we receive millions of
                      visitors every month. Prospective candidates, who are looking to get admission in any university and
                      course program of their liking, can find information through our multiple portals dedicated for
                      overseas education.</p>
                    <p>With more to come in the near future, we are currently representing multiple individual education
                      brands which cover everything under one roof from Admission to Marketing and every section of an
                      education system. This evolution of ours has helped connect potential candidates from around the
                      globe to our partner Universities/Institutions/Colleges and is now recognized to an international
                      team in Malaysia and India. Britannica Overseas, has stepped into an era within the education
                      industry by introducing software and marketing solutions.</p>
                  </div>
                  <div class="col-md-5 col-sm-12"> <img
                      data-src="<?= url('assets/web/') ?>images/education-malaysia-aboutus.png" class="img-responsive">
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <h3>Vision</h3>
                    <p>Our vision is to make a transformative impact on the Study Abroad Service Sector through continual
                      innovation in student services by connecting institutions, recruiters, and students across the
                      globe.</p>
                    <h3>Mission</h3>
                    <ul>
                      <li>To simplify the Overseas Education Admission Process & provide World’s Best Education Solutions
                      </li>
                      <li>To render scrupulous services and build robust business relationships</li>
                      <li>To strive to be the world’s most reliable service brand</li>
                    </ul>
                    <h3>Core Values</h3>
                    <p>Integrity, Honesty, Commitment, Transparency, Excellence and Value Addition.</p>
                    <h3>Objectives</h3>
                    <p>To Expand the Academic Horizons.</p>
                  </div>
                </div>
              </div>
              <div class="cor-p3">
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <h2 class="b" style="margin-top:0px!important">Our Services</h2>
                    <p>Britannica Overseas believes in re-inventing the Overseas Education Services for the students who
                      want to study in Malaysia from all over the world. We have joined the forces with the Top
                      Universities globally and with like minded student recruiters. We together strive to attain the
                      academic ambitions of the aspirants while guiding them to take the right decision for their career.
                    </p>
                    <!--    <ul class="nav nav-tabs hidden-xs hidden-sm">-->
                    <!--     <li><a data-toggle="tab" href="#universities"><span>Universities</span></a></li>-->
                    <!--    <li><a data-toggle="tab" href="#for-students">-->
                    <!--     <span>Students</span></a>-->
                    <!--    </li>-->
                    <!--    <li><a data-toggle="tab" href="#partners"><span>Partners</span></a></li>-->
                    <!--</ul>-->
                    <ul class="tabs tabs-hom-reg text-center">
                      <li class="tab s6"><a href="#universities" class="b">Universities</a></li>
                      <li class="tab s6"><a href="#for-students" class="b">Students</a> </li>
                      <li class="tab s6"><a href="#partners" class="b">Partners</a></li>
                    </ul>
                    <div class="tab-content">
                      <div id="universities" class="tab-pane fade in active">
                        <h2 class="pad10"> For Universities</h2>
                        <ul>
                          <li>We are partnered with the most esteemed Universities/ Institutions globally and enlarge the
                            options for the students who look for out of the way higher education prospects around the
                            world. </li>
                          <li>To find and recruit the most number of qualified and focused students for our Partner
                            Institutions.</li>
                          <li>By organizing the University Outreach Programs for our Partner institutions by reaching out
                            to the unexposed zones for prospective student recruitment and improving the connection
                            between the students and the esteemed Universities/Institutions/Colleges.</li>
                        </ul>
                        <h3 class="pad10 b">For institutions- </h3>
                        <h4 style="margin-bottom:0px">International Students Recruitment Solutions -:</h4>
                        <p>End to end Student recruitment solutions to the universities in Malaysia. We help with
                          marketing

                          to strengthen their enrolments with students internationally. Specific target of expanding an
                          extensive network of education agents for our client Institutions / Universities and helping
                          them in organizing and managing their office in India. We use successful marketing strategies
                          like partnering with International Universities and Educational fairs which will create a strong
                          presence in the education sector.</p>
                        <h4 style="margin-bottom:0px">Establish a Network of Education Agents -:</h4>
                        <p>Our services include initiating a network of international education representatives across the
                          entire India. We also give assistance by training and grooming them to market your university in
                          these prospective regions.</p>
                        <h4 style="margin-bottom:0px">Recruiting and Supervising an In-Country Representative -:</h4>
                        <p>From Recruiting to training and supervising an In-Country agent for your esteemed institutions.
                          We

                          guide them to carry out the marketing venture by participating in education

                          fairs and partnering with local universities to recruit more candidates. We

                          will also monitor their production and help them with necessary support.</p>
                        <h4 style="margin-bottom:0px">Screening of Applications -:</h4>
                        <p>Our local team in India will make sure to pre screen the applications received from your
                          network of agents to guarantee that your admission team gets in touch with candidates with high
                          quality and verified applications. Our service will reduce the workload and enhance the
                          efficiency of your admission team. This will also save time and get you in touch with the cream
                          crowd.</p>
                      </div>
                      <div id="for-students" class="tab-pane fade in active">
                        <h2 class="pad10"> For Students</h2>
                        <ul>
                          <li>To manifest accomplished services by making the whole process simpler and smoother. </li>
                          <li>To accelerate the student’s process of analyzing the best study destination, universities
                            and courses as per their liking and need by providing the best tech search platforms. </li>
                          <li>To provide everything under one roof to the students from Counseling to Systematize Test
                            Coaching, Admission, Overseas Education Loan Assistance to Visa Processing and all other
                            associated allied services is provided by us. </li>
                        </ul>
                      </div>
                      <div id="partners" class="tab-pane fade in active">
                        <h2 class="pad10"> For Partners</h2>
                        <ul>
                          <li>Swift, Simple and rewarding are the key words we describe for our services to make
                            International student recruitment easier.</li>
                          <li>With the developments in the education sector we empower Britannica's Partners by providing
                            perfect and enterprising services and up-to-date product knowledge.</li>
                          <li>To furnish the best tech platforms and renewed processes for higher student conversation.
                          </li>
                        </ul>
                        <h3 class="pad10 b">Our Clients</h3>
                        <p>Having a vast number of clients in our list, we understand our client’s frame of reference and
                          conclude solutions more than they expect.</p>
                        <ul>
                          <li>Partner with us for Swift Services & Higher Commissions</li>
                          <li>
                            <h5 class="b">Multi-Country Advantage</h5>
                            Our prompt and proactive services with high commission and a smooth on time transparent
                            payments have lined up a list of best clientele.
                          </li>
                          <li>
                            <h5 class="b">Ethical Business Transparency</h5>
                            We are linked with 100+ Universities in 6 countries globally. Which includes, Malaysia,
                            Canada, Australia, New Zealand, UK and many more.
                          </li>
                          <li>
                            <h5 class="b">Support</h5>
                            Britannica Overseas well experienced team will support you and your students to find the best
                            and high ranked university, the application process, help them in getting through the
                            processes of admission as well as getting their Visa Processed.
                          </li>
                        </ul>
                        <br>
                        <h2 class="b text-center pad-bot-70">Our 3-Step Process</h2>
                        <div class="stepwizard">
                          <div class="stepwizard-row">
                            <div class="col-md-4 col-sm-12">
                              <div class="stepwizard-step">
                                <button type="button" class="btn b">1</button>
                                <h5 class="pad10 b">As a partner Associate</h5>
                                <p>We ensure the success of the on boarding by giving access to online platforms and
                                  complete hand holding. </p>
                              </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                              <div class="stepwizard-step">
                                <button type="button" class="btn b">2</button>
                                <h5 class="pad10 b">Branding</h5>
                                <p>Your Brand will be in front while we recruit for you. Along with our admissions team,
                                  we will assist you to screen, apply and process your candidate’s applications and visa
                                </p>
                              </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                              <div class="stepwizard-step">
                                <button type="button" class="btn b">3</button>
                                <h5 class="pad10 b">Revenue Boosting</h5>
                                <p>You earn your commissions and enhance the revenue successfully on every candidate’s
                                  enrolment</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <div class="card"> <img data-src="<?= url('assets/web/') ?>images/Establish-an-India-Office.jpg"
                      alt="Establish an India Office" style="width:100%">
                    <div class="card-body" style="padding:10px 20px;">
                      <h5 class="card-title text-center pad10" style="line-height:normal; margin-bottom:15px">Establish an
                        India Office</h5>
                      <p>If you plan to set up an

                        office in India to smoothen the process between the students and agents then we

                        will be the best choice to help you do so. Our Legal team will guide you

                        through every step from the legal aspects like RBI License required for this purpose.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="card"> <img data-src="<?= url('assets/web/') ?>images/market-research-and-analysis.jpg"
                      alt="marketing research and Analysis" style="width:100%">
                    <div class="card-body" style="padding:10px 20px;">
                      <h5 class="card-title text-center pad10" style="line-height:normal; margin-bottom:15px">Market
                        Research and Analysis</h5>
                      <p>Our service will include understanding of these markets and trace out the effective strategies
                        for marketing which will suit your needs , requirements and goals.<br />
                        &nbsp;<br />
                        &nbsp;<br />
                        &nbsp;</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="card"> <img data-src="<?= url('assets/web/') ?>images/marketing-and-branding.jpg"
                      alt="Marketing and Branding" style="width:100%">
                    <div class="card-body" style="padding:10px 20px;">
                      <h5 class="card-title text-center pad10" style="line-height:normal; margin-bottom:15px">Marketing
                        and Branding</h5>
                      <p>Our marketing and Branding strategies will help you outstretch to a vast pool of prospective
                        international candidates. We will also assist you in conducting International Education Fairs to
                        showcase the best of your programs, features and services.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class=" row mar10">
                <h2 class="text-center">Why Choose Us?</h2>
                <div class="col-md-4 col-sm-12">
                  <div class="card-body">
                    <h3 class="text-center">We Understand Business</h3>
                    <p>The Boundless experience in the education industry gives us a unique advantage of far reaching and
                      understanding the Education Industry in India.</p>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="card-body">
                    <h3 class="text-center">We are good at what we do</h3>
                    <p>We work with a highly professional with much experience and resources to provide you with cost
                      effective yet target oriented high output marketing solutions. The goal is to aid out the needs and
                      requirements of our client by helping them to perceive their international student enrollment goals.
                    </p>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="card-bod">
                    <h3 class="text-center">An Accomplished Team</h3>
                    <p>Our extensive and vast experience in the education industry gives an edge to our clients as our
                      Team of education and marketing experts work with the client and for the client by understanding and
                      explaining every step taken in the process. We understand the needs of.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Content -->
@endsection
