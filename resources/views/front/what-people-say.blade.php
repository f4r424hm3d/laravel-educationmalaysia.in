@extends('front.layouts.main')
@push('seo_meta_tag')
@include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
<section class="people-testi">
    <div class="container">
        <div class="reviewss">
            <h2>What People Are Saying About Us</h2>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">

                <div id="carouselExampleControls" class="carousel slide users-collapse pb-5 " data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="say-h2"> What our users say ?</div>
                            <div class="overflows mx-5">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="u-stall">
                                        <div class="img-box"><img
                                                src=" {{ asset('assets/web/images/testimonialimage.png') }}"
                                                class="img-fluid" alt=""></div>
                                        <p class="testimonial">As a student Iam really thankful that I got contacted
                                            with
                                            them. Their co operation with students is really impressive and my
                                            overall
                                            experience is excellent with them.</p>
                                        <p class="overview"><b>HASEEB , </b>, PAKISTAN</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="u-stall">
                                        <div class="img-box"><img
                                                src=" {{ asset('assets/web/images/testimonialimage.png') }}"
                                                class="img-fluid" alt=""></div>
                                        <p class="testimonial">I am studying accountancy in Malaysia and got a very
                                            good
                                            help from their Gurgaon office regarding choosing the right course..</p>
                                        <p class="overview"><b>Neha </b>, INDIA</p>
                                    </div>
                                </div>
                            </div>
                            </div>
                           
                        </div>
                        <div class="carousel-item">
                            <div class="say-h2"> What Universities say ?</div>
                            <div class="overflows mx-5"> 
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="u-stall">
                                        <div class="img-box"><img
                                                src=" {{ asset('assets/web/images/testimonialimage.png') }}"
                                                class="img-fluid" alt=""></div>
                                        <p class="testimonial">As a student Iam really thankful that I got contacted
                                            with
                                            them. Their co operation with students is really impressive and my
                                            overall
                                            experience is excellent with them.</p>
                                        <p class="overview"><b>HASEEB , </b>, PAKISTAN</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="u-stall">
                                        <div class="img-box"><img
                                                src=" {{ asset('assets/web/images/testimonialimage.png') }}"
                                                class="img-fluid" alt=""></div>
                                        <p class="testimonial">I am studying accountancy in Malaysia and got a very
                                            good
                                            help from their Gurgaon office regarding choosing the right course..</p>
                                        <p class="overview"><b>Neha </b>, INDIA</p>
                                    </div>
                                </div>
                            </div>
                            </div>
                            
                        </div>
                        <div class="carousel-item">
                            <div class="say-h2"> What our guardian say ?</div>
                            <div class="overflows mx-5">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="u-stall">
                                        <div class="img-box"><img
                                                src=" {{ asset('assets/web/images/testimonialimage.png') }}"
                                                class="img-fluid" alt=""></div>
                                        <p class="testimonial">Excellent Consultant
                                            Great.......</p>
                                        <p class="overview"><b>MOHAMMAD AMJAD ALI </b>, UNITED ARAB EMIRATES</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="u-stall">
                                        <div class="img-box"><img
                                                src=" {{ asset('assets/web/images/testimonialimage.png') }}"
                                                class="img-fluid" alt=""></div>
                                        <p class="testimonial">Deserve to be thank your coordination for the
                                            admission
                                            process it is really appreciated.
                                            The quality of communication is great, anytime without any hesitation.

                                            Thanks again and wish you the best</p>
                                        <p class="overview"><b>Elango M S </b>, INDIA</p>
                                    </div>
                                </div>
                            </div>        
                        </div>
                            
                        </div>
                    </div>
                   

                    <a class="carousel-control left carousel-control-prev" href="#carouselExampleControls" role="button"  data-slide="prev">
					<i class="fa fa-angle-left"></i>
				</a>
				<a class="carousel-control right carousel-control-next" href="#carouselExampleControls" data-slide="next">
					<i class="fa fa-angle-right"></i>
				</a>
                </div>
            </div>
  
        </div>
<div class="row">
 <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="reviewss allusrs">
                    <h2 class="review-write">Write Reviews </h2>
                    <form>
                        <div class="row">

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Name">

                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Email ID">

                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <select class="form-control" id="inputGroupSelect01">
                                        <option selected>What you are ?</option>
                                        <option value="1">Student</option>
                                        <option value="2">Guardian</option>
                                        <option value="3">University</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <select class="form-control" id="country" name="country" required="">
                                        <!-- <option value="">Country..</option> -->
                                        <option value="AFGHANISTAN">AFGHANISTAN</option>
                                        <option value="ALBANIA">ALBANIA</option>
                                        <option value="ALGERIA">ALGERIA</option>
                                        <option value="AMERICAN SAMOA">AMERICAN SAMOA</option>
                                        <option value="ANDORRA">ANDORRA</option>
                                        <option value="ANGOLA">ANGOLA</option>
                                        <option value="ANGUILLA">ANGUILLA</option>
                                        <option value="ANTARCTICA">ANTARCTICA</option>
                                        <option value="ANTIGUA AND BARBUDA">ANTIGUA AND BARBUDA</option>
                                        <option value="ARGENTINA">ARGENTINA</option>
                                        <option value="ARMENIA">ARMENIA</option>
                                        <option value="ARUBA">ARUBA</option>
                                        <option value="AUSTRALIA">AUSTRALIA</option>
                                        <option value="AUSTRIA">AUSTRIA</option>
                                        <option value="AZERBAIJAN">AZERBAIJAN</option>
                                        <option value="BAHAMAS">BAHAMAS</option>
                                        <option value="BAHRAIN">BAHRAIN</option>
                                        <option value="BANGLADESH">BANGLADESH</option>
                                        <option value="BARBADOS">BARBADOS</option>
                                        <option value="BELARUS">BELARUS</option>
                                        <option value="BELGIUM">BELGIUM</option>
                                        <option value="BELIZE">BELIZE</option>
                                        <option value="BENIN">BENIN</option>
                                        <option value="BERMUDA">BERMUDA</option>
                                        <option value="BHUTAN">BHUTAN</option>
                                        <option value="BOLIVIA">BOLIVIA</option>
                                        <option value="BOSNIA AND HERZEGOVINA">BOSNIA AND HERZEGOVINA</option>
                                        <option value="BOTSWANA">BOTSWANA</option>
                                        <option value="BOUVET ISLAND">BOUVET ISLAND</option>
                                        <option value="BRAZIL">BRAZIL</option>
                                        <option value="BRITISH INDIAN OCEAN TERRITORY">BRITISH INDIAN OCEAN TERRITORY
                                        </option>
                                        <option value="BRUNEI DARUSSALAM">BRUNEI DARUSSALAM</option>
                                        <option value="BULGARIA">BULGARIA</option>
                                        <option value="BURKINA FASO">BURKINA FASO</option>
                                        <option value="BURUNDI">BURUNDI</option>
                                        <option value="CAMBODIA">CAMBODIA</option>
                                        <option value="CAMEROON">CAMEROON</option>
                                        <option value="CANADA">CANADA</option>
                                        <option value="CAPE VERDE">CAPE VERDE</option>
                                        <option value="Caribbean Island">Caribbean Island</option>
                                        <option value="CAYMAN ISLANDS">CAYMAN ISLANDS</option>
                                        <option value="CENTRAL AFRICAN REPUBLIC">CENTRAL AFRICAN REPUBLIC</option>
                                        <option value="CHAD">CHAD</option>
                                        <option value="CHILE">CHILE</option>
                                        <option value="CHINA">CHINA</option>
                                        <option value="CHRISTMAS ISLAND">CHRISTMAS ISLAND</option>
                                        <option value="COCOS (KEELING) ISLANDS">COCOS (KEELING) ISLANDS</option>
                                        <option value="COLOMBIA">COLOMBIA</option>
                                        <option value="COMOROS">COMOROS</option>
                                        <option value="CONGO">CONGO</option>
                                        <option value="CONGO, THE DEMOCRATIC REPUBLIC OF THE">CONGO, THE DEMOCRATIC
                                            REPUBLIC OF
                                            THE</option>
                                        <option value="COOK ISLANDS">COOK ISLANDS</option>
                                        <option value="COSTA RICA">COSTA RICA</option>
                                        <option value="COTE D'IVOIRE">COTE D'IVOIRE</option>
                                        <option value="CROATIA">CROATIA</option>
                                        <option value="CUBA">CUBA</option>
                                        <option value="CYPRUS">CYPRUS</option>
                                        <option value="CZECH REPUBLIC">CZECH REPUBLIC</option>
                                        <option value="DENMARK">DENMARK</option>
                                        <option value="DJIBOUTI">DJIBOUTI</option>
                                        <option value="DOMINICA">DOMINICA</option>
                                        <option value="DOMINICAN REPUBLIC">DOMINICAN REPUBLIC</option>
                                        <option value="ECUADOR">ECUADOR</option>
                                        <option value="EGYPT">EGYPT</option>
                                        <option value="EL SALVADOR">EL SALVADOR</option>
                                        <option value="EQUATORIAL GUINEA">EQUATORIAL GUINEA</option>
                                        <option value="ERITREA">ERITREA</option>
                                        <option value="ESTONIA">ESTONIA</option>
                                        <option value="ETHIOPIA">ETHIOPIA</option>
                                        <option value="FALKLAND ISLANDS (MALVINAS)">FALKLAND ISLANDS (MALVINAS)</option>
                                        <option value="FAROE ISLANDS">FAROE ISLANDS</option>
                                        <option value="FIJI">FIJI</option>
                                        <option value="FINLAND">FINLAND</option>
                                        <option value="FRANCE">FRANCE</option>
                                        <option value="FRENCH GUIANA">FRENCH GUIANA</option>
                                        <option value="FRENCH POLYNESIA">FRENCH POLYNESIA</option>
                                        <option value="FRENCH SOUTHERN TERRITORIES">FRENCH SOUTHERN TERRITORIES</option>
                                        <option value="GABON">GABON</option>
                                        <option value="GAMBIA">GAMBIA</option>
                                        <option value="GEORGIA">GEORGIA</option>
                                        <option value="GERMANY">GERMANY</option>
                                        <option value="GHANA">GHANA</option>
                                        <option value="GIBRALTAR">GIBRALTAR</option>
                                        <option value="GREECE">GREECE</option>
                                        <option value="GREENLAND">GREENLAND</option>
                                        <option value="GRENADA">GRENADA</option>
                                        <option value="GUADELOUPE">GUADELOUPE</option>
                                        <option value="GUAM">GUAM</option>
                                        <option value="GUATEMALA">GUATEMALA</option>
                                        <option value="GUINEA">GUINEA</option>
                                        <option value="GUINEA-BISSAU">GUINEA-BISSAU</option>
                                        <option value="GUYANA">GUYANA</option>
                                        <option value="HAITI">HAITI</option>
                                        <option value="HEARD ISLAND AND MCDONALD ISLANDS">HEARD ISLAND AND MCDONALD
                                            ISLANDS
                                        </option>
                                        <option value="HOLY SEE (VATICAN CITY STATE)">HOLY SEE (VATICAN CITY STATE)
                                        </option>
                                        <option value="HONDURAS">HONDURAS</option>
                                        <option value="HONG KONG">HONG KONG</option>
                                        <option value="HUNGARY">HUNGARY</option>
                                        <option value="ICELAND">ICELAND</option>
                                        <option value="INDIA">INDIA</option>
                                        <option value="INDONESIA">INDONESIA</option>
                                        <option value="IRAN, ISLAMIC REPUBLIC OF">IRAN, ISLAMIC REPUBLIC OF</option>
                                        <option value="IRAQ">IRAQ</option>
                                        <option value="IRELAND">IRELAND</option>
                                        <option value="ISRAEL">ISRAEL</option>
                                        <option value="ITALY">ITALY</option>
                                        <option value="JAMAICA">JAMAICA</option>
                                        <option value="JAPAN">JAPAN</option>
                                        <option value="JORDAN">JORDAN</option>
                                        <option value="KAZAKHSTAN">KAZAKHSTAN</option>
                                        <option value="KENYA">KENYA</option>
                                        <option value="KIRIBATI">KIRIBATI</option>
                                        <option value="KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF">KOREA, DEMOCRATIC
                                            PEOPLE'S
                                            REPUBLIC OF</option>
                                        <option value="KOREA, REPUBLIC OF">KOREA, REPUBLIC OF</option>
                                        <option value="KUWAIT">KUWAIT</option>
                                        <option value="KYRGYZSTAN">KYRGYZSTAN</option>
                                        <option value="LAO PEOPLE'S DEMOCRATIC REPUBLIC">LAO PEOPLE'S DEMOCRATIC
                                            REPUBLIC
                                        </option>
                                        <option value="LATVIA">LATVIA</option>
                                        <option value="LEBANON">LEBANON</option>
                                        <option value="LESOTHO">LESOTHO</option>
                                        <option value="LIBERIA">LIBERIA</option>
                                        <option value="LIBYAN ARAB JAMAHIRIYA">LIBYAN ARAB JAMAHIRIYA</option>
                                        <option value="LIECHTENSTEIN">LIECHTENSTEIN</option>
                                        <option value="LITHUANIA">LITHUANIA</option>
                                        <option value="LUXEMBOURG">LUXEMBOURG</option>
                                        <option value="MACAO">MACAO</option>
                                        <option value="MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF">MACEDONIA, THE FORMER
                                            YUGOSLAV REPUBLIC OF</option>
                                        <option value="MADAGASCAR">MADAGASCAR</option>
                                        <option value="MALAWI">MALAWI</option>
                                        <option value="MALAYSIA">MALAYSIA</option>
                                        <option value="MALDIVES">MALDIVES</option>
                                        <option value="MALI">MALI</option>
                                        <option value="MALTA">MALTA</option>
                                        <option value="MARSHALL ISLANDS">MARSHALL ISLANDS</option>
                                        <option value="MARTINIQUE">MARTINIQUE</option>
                                        <option value="MAURITANIA">MAURITANIA</option>
                                        <option value="MAURITIUS">MAURITIUS</option>
                                        <option value="MAYOTTE">MAYOTTE</option>
                                        <option value="MEXICO">MEXICO</option>
                                        <option value="MICRONESIA, FEDERATED STATES OF">MICRONESIA, FEDERATED STATES OF
                                        </option>
                                        <option value="MOLDOVA, REPUBLIC OF">MOLDOVA, REPUBLIC OF</option>
                                        <option value="MONACO">MONACO</option>
                                        <option value="MONGOLIA">MONGOLIA</option>
                                        <option value="MONTSERRAT">MONTSERRAT</option>
                                        <option value="MOROCCO">MOROCCO</option>
                                        <option value="MOZAMBIQUE">MOZAMBIQUE</option>
                                        <option value="MYANMAR">MYANMAR</option>
                                        <option value="NAMIBIA">NAMIBIA</option>
                                        <option value="NAURU">NAURU</option>
                                        <option value="NEPAL">NEPAL</option>
                                        <option value="NETHERLANDS">NETHERLANDS</option>
                                        <option value="NETHERLANDS ANTILLES">NETHERLANDS ANTILLES</option>
                                        <option value="NEW CALEDONIA">NEW CALEDONIA</option>
                                        <option value="NEW ZEALAND">NEW ZEALAND</option>
                                        <option value="NICARAGUA">NICARAGUA</option>
                                        <option value="NIGER">NIGER</option>
                                        <option value="NIGERIA">NIGERIA</option>
                                        <option value="NIUE">NIUE</option>
                                        <option value="NORFOLK ISLAND">NORFOLK ISLAND</option>
                                        <option value="NORTHERN MARIANA ISLANDS">NORTHERN MARIANA ISLANDS</option>
                                        <option value="NORWAY">NORWAY</option>
                                        <option value="OMAN">OMAN</option>
                                        <option value="PAKISTAN">PAKISTAN</option>
                                        <option value="PALAU">PALAU</option>
                                        <option value="PALESTINIAN TERRITORY, OCCUPIED">PALESTINIAN TERRITORY, OCCUPIED
                                        </option>
                                        <option value="PANAMA">PANAMA</option>
                                        <option value="PAPUA NEW GUINEA">PAPUA NEW GUINEA</option>
                                        <option value="PARAGUAY">PARAGUAY</option>
                                        <option value="PERU">PERU</option>
                                        <option value="PHILIPPINES">PHILIPPINES</option>
                                        <option value="PITCAIRN">PITCAIRN</option>
                                        <option value="POLAND">POLAND</option>
                                        <option value="PORTUGAL">PORTUGAL</option>
                                        <option value="PUERTO RICO">PUERTO RICO</option>
                                        <option value="QATAR">QATAR</option>
                                        <option value="REUNION">REUNION</option>
                                        <option value="ROMANIA">ROMANIA</option>
                                        <option value="RUSSIAN FEDERATION">RUSSIAN FEDERATION</option>
                                        <option value="RWANDA">RWANDA</option>
                                        <option value="SAINT HELENA">SAINT HELENA</option>
                                        <option value="SAINT KITTS AND NEVIS">SAINT KITTS AND NEVIS</option>
                                        <option value="SAINT LUCIA">SAINT LUCIA</option>
                                        <option value="SAINT PIERRE AND MIQUELON">SAINT PIERRE AND MIQUELON</option>
                                        <option value="SAINT VINCENT AND THE GRENADINES">SAINT VINCENT AND THE
                                            GRENADINES
                                        </option>
                                        <option value="SAMOA">SAMOA</option>
                                        <option value="SAN MARINO">SAN MARINO</option>
                                        <option value="SAO TOME AND PRINCIPE">SAO TOME AND PRINCIPE</option>
                                        <option value="SAUDI ARABIA">SAUDI ARABIA</option>
                                        <option value="SENEGAL">SENEGAL</option>
                                        <option value="SERBIA AND MONTENEGRO">SERBIA AND MONTENEGRO</option>
                                        <option value="SEYCHELLES">SEYCHELLES</option>
                                        <option value="SIERRA LEONE">SIERRA LEONE</option>
                                        <option value="SINGAPORE">SINGAPORE</option>
                                        <option value="SLOVAKIA">SLOVAKIA</option>
                                        <option value="SLOVENIA">SLOVENIA</option>
                                        <option value="SOLOMON ISLANDS">SOLOMON ISLANDS</option>
                                        <option value="SOMALIA">SOMALIA</option>
                                        <option value="SOUTH AFRICA">SOUTH AFRICA</option>
                                        <option value="SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS">SOUTH GEORGIA AND
                                            THE SOUTH
                                            SANDWICH ISLANDS</option>
                                        <option value="SOUTH SUDAN">SOUTH SUDAN</option>
                                        <option value="SPAIN">SPAIN</option>
                                        <option value="SRI LANKA">SRI LANKA</option>
                                        <option value="SUDAN">SUDAN</option>
                                        <option value="SURINAME">SURINAME</option>
                                        <option value="SVALBARD AND JAN MAYEN">SVALBARD AND JAN MAYEN</option>
                                        <option value="SWAZILAND">SWAZILAND</option>
                                        <option value="SWEDEN">SWEDEN</option>
                                        <option value="SWITZERLAND">SWITZERLAND</option>
                                        <option value="SYRIAN ARAB REPUBLIC">SYRIAN ARAB REPUBLIC</option>
                                        <option value="TAIWAN, PROVINCE OF CHINA">TAIWAN, PROVINCE OF CHINA</option>
                                        <option value="TAJIKISTAN">TAJIKISTAN</option>
                                        <option value="TANZANIA, UNITED REPUBLIC OF">TANZANIA, UNITED REPUBLIC OF
                                        </option>
                                        <option value="THAILAND">THAILAND</option>
                                        <option value="TIMOR-LESTE">TIMOR-LESTE</option>
                                        <option value="TOGO">TOGO</option>
                                        <option value="TOKELAU">TOKELAU</option>
                                        <option value="TONGA">TONGA</option>
                                        <option value="TRINIDAD AND TOBAGO">TRINIDAD AND TOBAGO</option>
                                        <option value="TUNISIA">TUNISIA</option>
                                        <option value="TURKEY">TURKEY</option>
                                        <option value="TURKMENISTAN">TURKMENISTAN</option>
                                        <option value="TURKS AND CAICOS ISLANDS">TURKS AND CAICOS ISLANDS</option>
                                        <option value="TUVALU">TUVALU</option>
                                        <option value="UGANDA">UGANDA</option>
                                        <option value="UKRAINE">UKRAINE</option>
                                        <option value="UNITED ARAB EMIRATES">UNITED ARAB EMIRATES</option>
                                        <option value="UNITED KINGDOM">UNITED KINGDOM</option>
                                        <option value="UNITED STATES">UNITED STATES</option>
                                        <option value="UNITED STATES MINOR OUTLYING ISLANDS">UNITED STATES MINOR
                                            OUTLYING
                                            ISLANDS</option>
                                        <option value="URUGUAY">URUGUAY</option>
                                        <option value="UZBEKISTAN">UZBEKISTAN</option>
                                        <option value="VANUATU">VANUATU</option>
                                        <option value="VENEZUELA">VENEZUELA</option>
                                        <option value="VIET NAM">VIET NAM</option>
                                        <option value="VIRGIN ISLANDS, BRITISH">VIRGIN ISLANDS, BRITISH</option>
                                        <option value="VIRGIN ISLANDS, U.S.">VIRGIN ISLANDS, U.S.</option>
                                        <option value="WALLIS AND FUTUNA">WALLIS AND FUTUNA</option>
                                        <option value="WESTERN SAHARA">WESTERN SAHARA</option>
                                        <option value="YEMEN">YEMEN</option>
                                        <option value="ZAMBIA">ZAMBIA</option>
                                        <option value="ZIMBABWE">ZIMBABWE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" id="exampleFormControlTextarea1"
                                        placeholder="Enter Your Review" rows="3"></textarea>
                                </div>
                            </div>
                        </div> <button type="submit" class="btn btn-primary w-100 ">Submit</button>
                    </form>
                </div>
            </div>
</div>



    </div>
    </div>
</section>
@endsection