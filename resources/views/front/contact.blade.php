@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  <div class="image-cover ed_detail_head lg" style="background:url({{ url('/front/') }}/assets/img/ub.jpg);"
    data-overlay="8">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12">
          <div class="ed_detail_wrap light">
            <ul class="cources_facts_list">
              <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
              <li class="facts-1"><a href="#">Contact</a></li>
            </ul>
            <div class="ed_header_caption mb-0">
              <h1 class="ed_title mb-0">Education Malaysia</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->
  <!-- Content -->
  <section class="bg-light contactusz ">
    <div class="container">

      <div class="row">
        <div class="col-lg-4 col-md-5 col-sm-12 mb-4 ">
          <div class="prc_wrap">
            <div class="prc_wrap_header">
              <h4 class="property_block_title">Contacts info & Details</h4>
            </div>
            <div class="prc_wrap-body">
              <div class="contact-info">
                <p>We at Britannica Education have not only been taking care of students but also understand their needs.
                  We consult the students as well as their family to take the right decision for a bright and happy
                  future.</p>

                <div class="cn-info-detail">
                  <div class="cn-info-content">
                    <h4 class="cn-info-title"><i class="ti-home mr-1 theme-cl"></i> Location:</h4>
                    B-16 Ground Floor, Mayfield Garden, Sector 50, Gurugram, Haryana, India 122002
                  </div>
                </div>

                <div class="cn-info-detail">
                  <div class="cn-info-content">
                    <h4 class="cn-info-title"><i class="ti-email mr-1 theme-cl"></i> Drop A Mail</h4>
                     <a href="mailto:info@educationmalaysia.in">info@educationmalaysia.in</a>
                     <a href="mailto:sales@educationmalaysia.in">sales@educationmalaysia.in</a>
                  </div>
                </div>

                <div class="cn-info-detail mb-2">
                  <div class="cn-info-content">
                    <h4 class="cn-info-title"><i class="ti-mobile mr-1 theme-cl"></i> Call Us</h4>
                    <a href="tel:+919818560331">+91 9818560331</a>
                    <a href="tel:+918130798532">+91 8130798532</a>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-8 col-md-7 col-sm-12 mb-4">
          <div class="prc_wrap">
            <div class="prc_wrap_header">
              <h4 class="property_block_title">Get in Touch</h4>
            </div>
            @if (session()->has('smsg'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span id="smsg">{{ session()->get('smsg') }}</span>
              </div>
            @endif
            @if (session()->has('emsg'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span id="emsg">{{ session()->get('emsg') }}</span>
              </div>
            @endif
            @error('g-recaptcha-response')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="prc_wrap-body">
              <form action="{{ url('contact') }}" method="post">
                @csrf
                <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                <input type="hidden" name="source" value="contact-us">
                <input type="hidden" name="source_path" value="{{ URL::full() }}">
                <div class="row">
                  <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" placeholder="Write your name" name="name" id="name"
                        value="{{ old('name') }}" class="form-control simple">
                      @error('name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" placeholder="example@gmail.com" name="email" id="email"
                        value="{{ old('email') }}" class="form-control simple">
                      @error('email')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Mobile Number</label>
                  <div class="row">
                      <div class="col-12 col-sm-4 ">
                        <select name="c_code" id="c_code" class="form-control simple border-0">
                          <option value="">Select</option>
                                                      <option value="1">
                              +1 (UNITED STATES MINOR OUTLYING ISLANDS)
                            </option>
                                                      <option value="1">
                              +1 (UNITED STATES)
                            </option>
                                                      <option value="1">
                              +1 (CANADA)
                            </option>
                                                      <option value="7">
                              +7 (KAZAKHSTAN)
                            </option>
                                                      <option value="20">
                              +20 (EGYPT)
                            </option>
                                                      <option value="27">
                              +27 (SOUTH AFRICA)
                            </option>
                                                      <option value="30">
                              +30 (GREECE)
                            </option>
                                                      <option value="31">
                              +31 (NETHERLANDS)
                            </option>
                                                      <option value="32">
                              +32 (BELGIUM)
                            </option>
                                                      <option value="33">
                              +33 (FRANCE)
                            </option>
                                                      <option value="34">
                              +34 (SPAIN)
                            </option>
                                                      <option value="36">
                              +36 (HUNGARY)
                            </option>
                                                      <option value="39">
                              +39 (ITALY)
                            </option>
                                                      <option value="39">
                              +39 (HOLY SEE (VATICAN CITY STATE))
                            </option>
                                                      <option value="40">
                              +40 (ROMANIA)
                            </option>
                                                      <option value="41">
                              +41 (SWITZERLAND)
                            </option>
                                                      <option value="43">
                              +43 (AUSTRIA)
                            </option>
                                                      <option value="44">
                              +44 (UNITED KINGDOM)
                            </option>
                                                      <option value="45">
                              +45 (DENMARK)
                            </option>
                                                      <option value="46">
                              +46 (SWEDEN)
                            </option>
                                                      <option value="47">
                              +47 (SVALBARD AND JAN MAYEN)
                            </option>
                                                      <option value="47">
                              +47 (NORWAY)
                            </option>
                                                      <option value="48">
                              +48 (POLAND)
                            </option>
                                                      <option value="49">
                              +49 (GERMANY)
                            </option>
                                                      <option value="51">
                              +51 (PERU)
                            </option>
                                                      <option value="52">
                              +52 (MEXICO)
                            </option>
                                                      <option value="53">
                              +53 (CUBA)
                            </option>
                                                      <option value="54">
                              +54 (ARGENTINA)
                            </option>
                                                      <option value="55">
                              +55 (BRAZIL)
                            </option>
                                                      <option value="56">
                              +56 (CHILE)
                            </option>
                                                      <option value="57">
                              +57 (COLOMBIA)
                            </option>
                                                      <option value="58">
                              +58 (VENEZUELA)
                            </option>
                                                      <option value="60">
                              +60 (MALAYSIA)
                            </option>
                                                      <option value="61">
                              +61 (AUSTRALIA)
                            </option>
                                                      <option value="61">
                              +61 (CHRISTMAS ISLAND)
                            </option>
                                                      <option value="62">
                              +62 (INDONESIA)
                            </option>
                                                      <option value="63">
                              +63 (PHILIPPINES)
                            </option>
                                                      <option value="64">
                              +64 (NEW ZEALAND)
                            </option>
                                                      <option value="65">
                              +65 (SINGAPORE)
                            </option>
                                                      <option value="66">
                              +66 (THAILAND)
                            </option>
                                                      <option value="70">
                              +70 (RUSSIAN FEDERATION)
                            </option>
                                                      <option value="81">
                              +81 (JAPAN)
                            </option>
                                                      <option value="82">
                              +82 (KOREA, REPUBLIC OF)
                            </option>
                                                      <option value="84">
                              +84 (VIET NAM)
                            </option>
                                                      <option value="86">
                              +86 (CHINA)
                            </option>
                                                      <option value="90">
                              +90 (TURKEY)
                            </option>
                                                      <option value="91" selected="">
                              +91 (INDIA)
                            </option>
                                                      <option value="92">
                              +92 (PAKISTAN)
                            </option>
                                                      <option value="93">
                              +93 (AFGHANISTAN)
                            </option>
                                                      <option value="94">
                              +94 (SRI LANKA)
                            </option>
                                                      <option value="95">
                              +95 (MYANMAR)
                            </option>
                                                      <option value="98">
                              +98 (IRAN, ISLAMIC REPUBLIC OF)
                            </option>
                                                      <option value="211">
                              +211 (SOUTH SUDAN)
                            </option>
                                                      <option value="212">
                              +212 (MOROCCO)
                            </option>
                                                      <option value="212">
                              +212 (WESTERN SAHARA)
                            </option>
                                                      <option value="213">
                              +213 (ALGERIA)
                            </option>
                                                      <option value="216">
                              +216 (TUNISIA)
                            </option>
                                                      <option value="218">
                              +218 (LIBYAN ARAB JAMAHIRIYA)
                            </option>
                                                      <option value="220">
                              +220 (GAMBIA)
                            </option>
                                                      <option value="221">
                              +221 (SENEGAL)
                            </option>
                                                      <option value="222">
                              +222 (MAURITANIA)
                            </option>
                                                      <option value="223">
                              +223 (MALI)
                            </option>
                                                      <option value="224">
                              +224 (GUINEA)
                            </option>
                                                      <option value="225">
                              +225 (COTE D'IVOIRE)
                            </option>
                                                      <option value="226">
                              +226 (BURKINA FASO)
                            </option>
                                                      <option value="227">
                              +227 (NIGER)
                            </option>
                                                      <option value="228">
                              +228 (TOGO)
                            </option>
                                                      <option value="229">
                              +229 (BENIN)
                            </option>
                                                      <option value="230">
                              +230 (MAURITIUS)
                            </option>
                                                      <option value="231">
                              +231 (LIBERIA)
                            </option>
                                                      <option value="232">
                              +232 (SIERRA LEONE)
                            </option>
                                                      <option value="233">
                              +233 (GHANA)
                            </option>
                                                      <option value="234">
                              +234 (NIGERIA)
                            </option>
                                                      <option value="235">
                              +235 (CHAD)
                            </option>
                                                      <option value="236">
                              +236 (CENTRAL AFRICAN REPUBLIC)
                            </option>
                                                      <option value="237">
                              +237 (CAMEROON)
                            </option>
                                                      <option value="238">
                              +238 (CAPE VERDE)
                            </option>
                                                      <option value="239">
                              +239 (SAO TOME AND PRINCIPE)
                            </option>
                                                      <option value="240">
                              +240 (EQUATORIAL GUINEA)
                            </option>
                                                      <option value="241">
                              +241 (GABON)
                            </option>
                                                      <option value="242">
                              +242 (CONGO, THE DEMOCRATIC REPUBLIC OF THE)
                            </option>
                                                      <option value="242">
                              +242 (CONGO)
                            </option>
                                                      <option value="244">
                              +244 (ANGOLA)
                            </option>
                                                      <option value="245">
                              +245 (GUINEA-BISSAU)
                            </option>
                                                      <option value="246">
                              +246 (BRITISH INDIAN OCEAN TERRITORY)
                            </option>
                                                      <option value="248">
                              +248 (SEYCHELLES)
                            </option>
                                                      <option value="249">
                              +249 (SUDAN)
                            </option>
                                                      <option value="250">
                              +250 (RWANDA)
                            </option>
                                                      <option value="251">
                              +251 (ETHIOPIA)
                            </option>
                                                      <option value="252">
                              +252 (SOMALIA)
                            </option>
                                                      <option value="253">
                              +253 (DJIBOUTI)
                            </option>
                                                      <option value="254">
                              +254 (KENYA)
                            </option>
                                                      <option value="255">
                              +255 (TANZANIA, UNITED REPUBLIC OF)
                            </option>
                                                      <option value="256">
                              +256 (UGANDA)
                            </option>
                                                      <option value="257">
                              +257 (BURUNDI)
                            </option>
                                                      <option value="258">
                              +258 (MOZAMBIQUE)
                            </option>
                                                      <option value="260">
                              +260 (ZAMBIA)
                            </option>
                                                      <option value="261">
                              +261 (MADAGASCAR)
                            </option>
                                                      <option value="262">
                              +262 (REUNION)
                            </option>
                                                      <option value="263">
                              +263 (ZIMBABWE)
                            </option>
                                                      <option value="264">
                              +264 (NAMIBIA)
                            </option>
                                                      <option value="265">
                              +265 (MALAWI)
                            </option>
                                                      <option value="266">
                              +266 (LESOTHO)
                            </option>
                                                      <option value="267">
                              +267 (BOTSWANA)
                            </option>
                                                      <option value="268">
                              +268 (SWAZILAND)
                            </option>
                                                      <option value="269">
                              +269 (COMOROS)
                            </option>
                                                      <option value="269">
                              +269 (MAYOTTE)
                            </option>
                                                      <option value="290">
                              +290 (SAINT HELENA)
                            </option>
                                                      <option value="291">
                              +291 (ERITREA)
                            </option>
                                                      <option value="297">
                              +297 (ARUBA)
                            </option>
                                                      <option value="298">
                              +298 (FAROE ISLANDS)
                            </option>
                                                      <option value="299">
                              +299 (GREENLAND)
                            </option>
                                                      <option value="350">
                              +350 (GIBRALTAR)
                            </option>
                                                      <option value="351">
                              +351 (PORTUGAL)
                            </option>
                                                      <option value="352">
                              +352 (LUXEMBOURG)
                            </option>
                                                      <option value="353">
                              +353 (IRELAND)
                            </option>
                                                      <option value="354">
                              +354 (ICELAND)
                            </option>
                                                      <option value="355">
                              +355 (ALBANIA)
                            </option>
                                                      <option value="356">
                              +356 (MALTA)
                            </option>
                                                      <option value="357">
                              +357 (CYPRUS)
                            </option>
                                                      <option value="358">
                              +358 (FINLAND)
                            </option>
                                                      <option value="359">
                              +359 (BULGARIA)
                            </option>
                                                      <option value="370">
                              +370 (LITHUANIA)
                            </option>
                                                      <option value="371">
                              +371 (LATVIA)
                            </option>
                                                      <option value="372">
                              +372 (ESTONIA)
                            </option>
                                                      <option value="373">
                              +373 (MOLDOVA, REPUBLIC OF)
                            </option>
                                                      <option value="374">
                              +374 (ARMENIA)
                            </option>
                                                      <option value="375">
                              +375 (BELARUS)
                            </option>
                                                      <option value="376">
                              +376 (ANDORRA)
                            </option>
                                                      <option value="377">
                              +377 (MONACO)
                            </option>
                                                      <option value="378">
                              +378 (SAN MARINO)
                            </option>
                                                      <option value="380">
                              +380 (UKRAINE)
                            </option>
                                                      <option value="381">
                              +381 (SERBIA AND MONTENEGRO)
                            </option>
                                                      <option value="385">
                              +385 (CROATIA)
                            </option>
                                                      <option value="386">
                              +386 (SLOVENIA)
                            </option>
                                                      <option value="387">
                              +387 (BOSNIA AND HERZEGOVINA)
                            </option>
                                                      <option value="389">
                              +389 (MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF)
                            </option>
                                                      <option value="420">
                              +420 (CZECH REPUBLIC)
                            </option>
                                                      <option value="421">
                              +421 (SLOVAKIA)
                            </option>
                                                      <option value="423">
                              +423 (LIECHTENSTEIN)
                            </option>
                                                      <option value="500">
                              +500 (FALKLAND ISLANDS (MALVINAS))
                            </option>
                                                      <option value="501">
                              +501 (BELIZE)
                            </option>
                                                      <option value="502">
                              +502 (GUATEMALA)
                            </option>
                                                      <option value="503">
                              +503 (EL SALVADOR)
                            </option>
                                                      <option value="504">
                              +504 (HONDURAS)
                            </option>
                                                      <option value="505">
                              +505 (NICARAGUA)
                            </option>
                                                      <option value="506">
                              +506 (COSTA RICA)
                            </option>
                                                      <option value="507">
                              +507 (PANAMA)
                            </option>
                                                      <option value="508">
                              +508 (SAINT PIERRE AND MIQUELON)
                            </option>
                                                      <option value="509">
                              +509 (HAITI)
                            </option>
                                                      <option value="590">
                              +590 (GUADELOUPE)
                            </option>
                                                      <option value="591">
                              +591 (BOLIVIA)
                            </option>
                                                      <option value="592">
                              +592 (GUYANA)
                            </option>
                                                      <option value="593">
                              +593 (ECUADOR)
                            </option>
                                                      <option value="594">
                              +594 (FRENCH GUIANA)
                            </option>
                                                      <option value="595">
                              +595 (PARAGUAY)
                            </option>
                                                      <option value="596">
                              +596 (MARTINIQUE)
                            </option>
                                                      <option value="597">
                              +597 (SURINAME)
                            </option>
                                                      <option value="598">
                              +598 (URUGUAY)
                            </option>
                                                      <option value="599">
                              +599 (NETHERLANDS ANTILLES)
                            </option>
                                                      <option value="670">
                              +670 (TIMOR-LESTE)
                            </option>
                                                      <option value="672">
                              +672 (NORFOLK ISLAND)
                            </option>
                                                      <option value="672">
                              +672 (COCOS (KEELING) ISLANDS)
                            </option>
                                                      <option value="673">
                              +673 (BRUNEI DARUSSALAM)
                            </option>
                                                      <option value="674">
                              +674 (NAURU)
                            </option>
                                                      <option value="675">
                              +675 (PAPUA NEW GUINEA)
                            </option>
                                                      <option value="676">
                              +676 (TONGA)
                            </option>
                                                      <option value="677">
                              +677 (SOLOMON ISLANDS)
                            </option>
                                                      <option value="678">
                              +678 (VANUATU)
                            </option>
                                                      <option value="679">
                              +679 (FIJI)
                            </option>
                                                      <option value="680">
                              +680 (PALAU)
                            </option>
                                                      <option value="681">
                              +681 (WALLIS AND FUTUNA)
                            </option>
                                                      <option value="682">
                              +682 (COOK ISLANDS)
                            </option>
                                                      <option value="683">
                              +683 (NIUE)
                            </option>
                                                      <option value="684">
                              +684 (SAMOA)
                            </option>
                                                      <option value="686">
                              +686 (KIRIBATI)
                            </option>
                                                      <option value="687">
                              +687 (NEW CALEDONIA)
                            </option>
                                                      <option value="688">
                              +688 (TUVALU)
                            </option>
                                                      <option value="689">
                              +689 (FRENCH POLYNESIA)
                            </option>
                                                      <option value="690">
                              +690 (TOKELAU)
                            </option>
                                                      <option value="691">
                              +691 (MICRONESIA, FEDERATED STATES OF)
                            </option>
                                                      <option value="692">
                              +692 (MARSHALL ISLANDS)
                            </option>
                                                      <option value="850">
                              +850 (KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF)
                            </option>
                                                      <option value="852">
                              +852 (HONG KONG)
                            </option>
                                                      <option value="853">
                              +853 (MACAO)
                            </option>
                                                      <option value="855">
                              +855 (CAMBODIA)
                            </option>
                                                      <option value="856">
                              +856 (LAO PEOPLE'S DEMOCRATIC REPUBLIC)
                            </option>
                                                      <option value="880">
                              +880 (BANGLADESH)
                            </option>
                                                      <option value="886">
                              +886 (TAIWAN, PROVINCE OF CHINA)
                            </option>
                                                      <option value="960">
                              +960 (MALDIVES)
                            </option>
                                                      <option value="961">
                              +961 (LEBANON)
                            </option>
                                                      <option value="962">
                              +962 (JORDAN)
                            </option>
                                                      <option value="963">
                              +963 (SYRIAN ARAB REPUBLIC)
                            </option>
                                                      <option value="964">
                              +964 (IRAQ)
                            </option>
                                                      <option value="965">
                              +965 (KUWAIT)
                            </option>
                                                      <option value="966">
                              +966 (SAUDI ARABIA)
                            </option>
                                                      <option value="967">
                              +967 (YEMEN)
                            </option>
                                                      <option value="968">
                              +968 (OMAN)
                            </option>
                                                      <option value="970">
                              +970 (PALESTINIAN TERRITORY, OCCUPIED)
                            </option>
                                                      <option value="971">
                              +971 (UNITED ARAB EMIRATES)
                            </option>
                                                      <option value="972">
                              +972 (ISRAEL)
                            </option>
                                                      <option value="973">
                              +973 (BAHRAIN)
                            </option>
                                                      <option value="974">
                              +974 (QATAR)
                            </option>
                                                      <option value="975">
                              +975 (BHUTAN)
                            </option>
                                                      <option value="976">
                              +976 (MONGOLIA)
                            </option>
                                                      <option value="977">
                              +977 (NEPAL)
                            </option>
                                                      <option value="992">
                              +992 (TAJIKISTAN)
                            </option>
                                                      <option value="994">
                              +994 (AZERBAIJAN)
                            </option>
                                                      <option value="995">
                              +995 (GEORGIA)
                            </option>
                                                      <option value="996">
                              +996 (KYRGYZSTAN)
                            </option>
                                                      <option value="998">
                              +998 (UZBEKISTAN)
                            </option>
                                                      <option value="1242">
                              +1242 (BAHAMAS)
                            </option>
                                                      <option value="1246">
                              +1246 (BARBADOS)
                            </option>
                                                      <option value="1264">
                              +1264 (ANGUILLA)
                            </option>
                                                      <option value="1268">
                              +1268 (ANTIGUA AND BARBUDA)
                            </option>
                                                      <option value="1284">
                              +1284 (VIRGIN ISLANDS, BRITISH)
                            </option>
                                                      <option value="1340">
                              +1340 (VIRGIN ISLANDS, U.S.)
                            </option>
                                                      <option value="1345">
                              +1345 (CAYMAN ISLANDS)
                            </option>
                                                      <option value="1441">
                              +1441 (BERMUDA)
                            </option>
                                                      <option value="1473">
                              +1473 (GRENADA)
                            </option>
                                                      <option value="1649">
                              +1649 (TURKS AND CAICOS ISLANDS)
                            </option>
                                                      <option value="1664">
                              +1664 (MONTSERRAT)
                            </option>
                                                      <option value="1670">
                              +1670 (NORTHERN MARIANA ISLANDS)
                            </option>
                                                      <option value="1671">
                              +1671 (GUAM)
                            </option>
                                                      <option value="1684">
                              +1684 (AMERICAN SAMOA)
                            </option>
                                                      <option value="1758">
                              +1758 (SAINT LUCIA)
                            </option>
                                                      <option value="1767">
                              +1767 (DOMINICA)
                            </option>
                                                      <option value="1784">
                              +1784 (SAINT VINCENT AND THE GRENADINES)
                            </option>
                                                      <option value="1787">
                              +1787 (PUERTO RICO)
                            </option>
                                                      <option value="1809">
                              +1809 (DOMINICAN REPUBLIC)
                            </option>
                                                      <option value="1868">
                              +1868 (TRINIDAD AND TOBAGO)
                            </option>
                                                      <option value="1869">
                              +1869 (SAINT KITTS AND NEVIS)
                            </option>
                                                      <option value="1876">
                              +1876 (JAMAICA)
                            </option>
                                                      <option value="7370">
                              +7370 (TURKMENISTAN)
                            </option>
                                                  </select>
                        <span class="text-danger">
                                                  </span>
                      </div>
                      <div class="col-12 col-sm-8  ">
                        <div class="form-group">
                          <div class="input-group border-0">
                            <input name="mobile" type="number" class="form-control simple border-0" placeholder="Ex. 9634575238" value="" required="">
                          </div>
                          <span class="text-danger">
                                                      </span>
                        </div>
                      </div>
                    </div>
                </div>
                
                <div class="form-group">
                  <label>Message</label>
                  <textarea id="message" name="message" placeholder="Write Your Message" id="message" class="form-control simple">{{ old('message') }}</textarea>
                  @error('message')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group main-groups">

                  <div class="input-group ">
                    <div class="input-icon"><span class="ti-captcha_answer">
                        <label for="captcha_question">{{ $captcha['text'] }}</label>
                      </span></div>
                    <input type="number" name="captcha_answer" class="form-control simple " placeholder="Enter Captcha Value"
                      required="">
                  </div>
                  @error('captcha_answer')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group mb-0"><button class="btn btn-theme" type="submit">Submit Request</button></div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <section class="min-sec">
    <div class="container">

      <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12">
          <div class="sec-heading">
            <h2>Our <span class="theme-cl1">Locations</span></h2>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 p-0">

          <div class="container">

            <div class="custom-tab customize-tab tabs_creative">
              <ul class="nav nav-tabs pb-2 b-0 vertically-scrollbar" id="myTab" role="tablist">
                @php $i = 1; @endphp
                @foreach ($allCountries as $country)
                  <li class="nav-item">
                    <a class="nav-link {{ $i == 1 ? 'active' : '' }}" id="{{ $country->country }}-tab"
                      data-toggle="tab" href="#{{ $country->country }}" role="tab" aria-selected="true"
                      aria-expanded="true">
                      {{ ucwords($country->country) }}
                    </a>
                  </li>
                  @php $i++; @endphp
                @endforeach
              </ul>

              <div class="tab-content" id="myTabContent">
                @php $j = 1; @endphp
                @foreach ($addressesByCountry as $country => $addresses)
                  <div class="tab-pane fade {{ $j == 1 ? 'active' : '' }} show bg-light pt-4 pr-2 pb-4 pl-2"
                    id="{{ $country }}" role="tabpanel" aria-labelledby="{{ $country }}-tab"
                    aria-expanded="true">
                    <div class="container">
                      <div class="row">
                        @foreach ($addresses as $address)
                          <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-4">
                            <div class="card mb-0 h-100">
                              <div class="card-body">
                                <h5>{{ $address->city }}</h5>
                                <h4 class="cn-info-title"><i class="ti-home mr-1 theme-cl"></i> Location:</h4>
                                <p class="card-text">{{ $address->address }}</p>
                                <p class="cn-info-title theme-cl"><i class="ti-mobile mr-1 theme-cl"></i> Contact: <a
                                    href="tel:{{ $address->mobile }}">{{ $address->mobile }}</a></p>
                                <p class="cn-info-title theme-cl"><i class="ti-email mr-1 theme-cl"></i> Email: <a
                                    href="mailto:{{ $address->email }}">{{ $address->email }}</a></p>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                  @php $j++; @endphp
                @endforeach
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12">
          <div class="sec-heading">
            <h2>View in <span class="theme-cl">Google map</span></h2>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 p-0">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14035.267462665315!2d77.0567231!3d28.4247823!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xdff990e03def313c!2sBritannica%20Overseas%20Education!5e0!3m2!1sen!2sin!4v1673527931145!5m2!1sen!2sin"
              width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Content -->
  <script>
    grecaptcha.ready(function() {
      grecaptcha.execute('{{ gr_site_key() }}', {
          action: 'contact_us'
        })
        .then(function(token) {
          // Set the reCAPTCHA token in the hidden input field
          document.getElementById('g-recaptcha-response').value = token;
        });
    });
  </script>
@endsection
