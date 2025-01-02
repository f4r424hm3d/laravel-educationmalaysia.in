<div class="image-cover ed_detail_head lg" style="background:url({{ asset($university->bannerpath) }});"
    data-overlay="8">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-2 col-md-2 col-6">
                <img data-src="{{ asset($university->imgpath) }}" class="w-100 circle" alt="{{ $university->name }}">
            </div>

            <div class="col-lg-10 col-md-10">
                <div class="ed_detail_wrap light">
                    <ul class="cources_facts_list">
                        <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
                        <li class="facts-1"><a href="{{ route('select.university') }}">University</a>
                        </li>
                        <li class="facts-1"><a
                                href="{{ route('university.overview', ['university_slug' => $university->uname]) }}">{{ $university->name }}</a>
                        </li>
                        @if (Request::segment(3) != '')
                        <li class="facts-1">{{ Request::segment(3) }}</li>
                        @endif
                    </ul>
                    <div class="ed_header_caption">
                        <h1 class="ed_title">
                            {{ $university->name }} Rankings, Courses, Fees, Admission {{ date('Y') }} & Scholarships
                        </h1>
                        <ul>
                            <li><i class="ti-location-pin"></i><span>Location:</span> {{ $university->city }},
                                {{ $university->state }}</li>
                            <li><i class="fa fa-graduation-cap"></i><span>Type:</span>
                                {{ $university->instituteType->type ?? 'N/A' }}
                            </li>
                            <li><i class="ti-user"></i><span>Courses:</span> {{ $university->programs->count() }}</li>
                            <li><i class="fa fa-building"></i><span>QS World University Rankings:</span>
                                {{ $university->qs_rank }}
                            </li>
                            <li><i class="fa fa-globe"></i><span>Times Higher Education World University
                                    Rankings:</span>
                                {{ $university->times_rank }}</li>
                        </ul>
                    </div>

                    <div class="head-btns">
                        <a href="#" class="btn btn-white-t-theme btn-50L" data-toggle="modal"
                            data-target="#exampleModalCenter"><i class="ti-download mr-1"></i> Download
                            Brochure</a>
                        <a href="#" class="btn btn-white-t-theme btn-50R"><i class="ti-user mr-1"></i> Download Fees
                            Structure</a>
                        <a href="{{ route('write.review') }}" class="btn btn-white-t-theme"><i
                                class="ti-pencil-alt mr-1"></i>
                            Write a review</a>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal registration-modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body p-0">
                    <div class="all-registration">
                        <div class="row flex-column-reverse flex-md-row align-items-center">
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 pr-md-0">
                                <div class="all-grays">
                                    <h2>How New-Education-Malysia helps you in </h2>
                                    <div class="d-flex set-gaps gap-3 flex-wrap align-items-center">
                                        <div class="border-alls">
                                            <img src="/assets/images/open-book.png" alt="">
                                            <h4>Brochure Details</h4>
                                        </div>
                                        <div class="border-alls">
                                            <img src="/assets/images/open-book.png" alt="">
                                            <h4>Brochure Details</h4>
                                        </div>
                                        <div class="border-alls">
                                            <img src="/assets/images/open-book.png" alt="">
                                            <h4>Brochure Details</h4>
                                        </div>
                                        <div class="border-alls">
                                            <img src="/assets/images/open-book.png" alt="">
                                            <h4>Brochure Details</h4>
                                        </div>
                                        <div class="border-alls">
                                            <img src="/assets/images/open-book.png" alt="">
                                            <h4>Brochure Details</h4>
                                        </div>
                                        <div class="border-alls">
                                            <img src="/assets/images/open-book.png" alt="">
                                            <h4>Brochure Details</h4>
                                        </div>
                                    </div>

                                    <div class="your-class">
                                        <div>
                                            <h3 class="user-says">
                                                <div class="d-flex set-gap">
                                                    <img src="/assets/images/deepak.jpg" alt="">
                                                    <div class="user-profile">
                                                        <h2>Because of educatemalaysia, all my questions regarding JEE
                                                            Mains were answered.
                                                        </h2>
                                                        <p>Sandeep </p>
                                                    </div>
                                                </div>
                                            </h3>
                                        </div>
                                        <div>
                                            <h3 class="user-says">
                                                <div class="d-flex set-gap">
                                                    <img src="/assets/images/deepak.jpg" alt="">
                                                    <div class="user-profile">
                                                        <h2>Because of educatemalaysia, all my questions regarding JEE
                                                            Mains were answered.
                                                        </h2>
                                                        <p>Sandeep </p>
                                                    </div>
                                                </div>
                                            </h3>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-8  col-lg-8 pl-md-0">
                                <div class="all-white">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                    <div class=" leadform-header">
                                        <div class="lead-hdr-img"><img src="/assets/images/open-book.png" alt=""></div>
                                        <div class="hdr-info">
                                            <h3 class="">Register Now To
                                                Download Brochure</h3>
                                            <p class="all-list">All India Institute of Medical
                                                Sciences New Delhi</p>
                                        </div>
                                    </div>
                                    <form class="form-added">
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                <input type="text" placeholder="Full Name" class="form-control">

                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                            <input type="text" placeholder="Email" class="form-control">

                                            </div>
                                            </div>
                                           

                                            <div class="col-12">
                                            <div class="form-group">
                                            <div class="d-flex align-items-center setgap3">
                                                    <select class="form-control w-25">
                                                        <option value="">Country Code</option>
                                                        <option value="0">+0</option>
                                                        <option value="1">+1</option>
                                                        <option value="7">+7</option>
                                                        <option value="20">+20</option>
                                                        <option value="27">+27</option>
                                                        <option value="30">+30</option>
                                                        <option value="31">+31</option>
                                                        <option value="32">+32</option>
                                                        <option value="33">+33</option>
                                                        <option value="34">+34</option>
                                                        <option value="36">+36</option>
                                                        <option value="39">+39</option>
                                                        <option value="40">+40</option>
                                                        <option value="41">+41</option>
                                                        <option value="43">+43</option>
                                                        <option value="44">+44</option>
                                                        <option value="45">+45</option>
                                                        <option value="46">+46</option>
                                                        <option value="47">+47</option>
                                                        <option value="48">+48</option>
                                                        <option value="49">+49</option>
                                                        <option value="51">+51</option>
                                                        <option value="52">+52</option>
                                                        <option value="53">+53</option>
                                                        <option value="54">+54</option>
                                                        <option value="55">+55</option>
                                                        <option value="56">+56</option>
                                                        <option value="57">+57</option>
                                                        <option value="58">+58</option>
                                                        <option value="60">+60</option>
                                                        <option value="61">+61</option>
                                                        <option value="62">+62</option>
                                                        <option value="63">+63</option>
                                                        <option value="64">+64</option>
                                                        <option value="65">+65</option>
                                                        <option value="66">+66</option>
                                                        <option value="70">+70</option>
                                                        <option value="81">+81</option>
                                                        <option value="82">+82</option>
                                                        <option value="84">+84</option>
                                                        <option value="86">+86</option>
                                                        <option value="90">+90</option>
                                                        <option value="91" selected="">+91</option>
                                                        <option value="92">+92</option>
                                                        <option value="93">+93</option>
                                                        <option value="94">+94</option>
                                                        <option value="95">+95</option>
                                                        <option value="98">+98</option>
                                                        <option value="211">+211</option>
                                                        <option value="212">+212</option>
                                                        <option value="213">+213</option>
                                                        <option value="216">+216</option>
                                                        <option value="218">+218</option>
                                                        <option value="220">+220</option>
                                                        <option value="221">+221</option>
                                                        <option value="222">+222</option>
                                                        <option value="223">+223</option>
                                                        <option value="224">+224</option>
                                                        <option value="225">+225</option>
                                                        <option value="226">+226</option>
                                                        <option value="227">+227</option>
                                                        <option value="228">+228</option>
                                                        <option value="229">+229</option>
                                                        <option value="230">+230</option>
                                                        <option value="231">+231</option>
                                                        <option value="232">+232</option>
                                                        <option value="233">+233</option>
                                                        <option value="234">+234</option>
                                                        <option value="235">+235</option>
                                                        <option value="236">+236</option>
                                                        <option value="237">+237</option>
                                                        <option value="238">+238</option>
                                                        <option value="239">+239</option>
                                                        <option value="240">+240</option>
                                                        <option value="241">+241</option>
                                                        <option value="242">+242</option>
                                                        <option value="244">+244</option>
                                                        <option value="245">+245</option>
                                                        <option value="246">+246</option>
                                                        <option value="248">+248</option>
                                                        <option value="249">+249</option>
                                                        <option value="250">+250</option>
                                                        <option value="251">+251</option>
                                                        <option value="252">+252</option>
                                                        <option value="253">+253</option>
                                                        <option value="254">+254</option>
                                                        <option value="255">+255</option>
                                                        <option value="256">+256</option>
                                                        <option value="257">+257</option>
                                                        <option value="258">+258</option>
                                                        <option value="260">+260</option>
                                                        <option value="261">+261</option>
                                                        <option value="262">+262</option>
                                                        <option value="263">+263</option>
                                                        <option value="264">+264</option>
                                                        <option value="265">+265</option>
                                                        <option value="266">+266</option>
                                                        <option value="267">+267</option>
                                                        <option value="268">+268</option>
                                                        <option value="269">+269</option>
                                                        <option value="290">+290</option>
                                                        <option value="291">+291</option>
                                                        <option value="297">+297</option>
                                                        <option value="298">+298</option>
                                                        <option value="299">+299</option>
                                                        <option value="350">+350</option>
                                                        <option value="351">+351</option>
                                                        <option value="352">+352</option>
                                                        <option value="353">+353</option>
                                                        <option value="354">+354</option>
                                                        <option value="355">+355</option>
                                                        <option value="356">+356</option>
                                                        <option value="357">+357</option>
                                                        <option value="358">+358</option>
                                                        <option value="359">+359</option>
                                                        <option value="370">+370</option>
                                                        <option value="371">+371</option>
                                                        <option value="372">+372</option>
                                                        <option value="373">+373</option>
                                                        <option value="374">+374</option>
                                                        <option value="375">+375</option>
                                                        <option value="376">+376</option>
                                                        <option value="377">+377</option>
                                                        <option value="378">+378</option>
                                                        <option value="380">+380</option>
                                                        <option value="381">+381</option>
                                                        <option value="385">+385</option>
                                                        <option value="386">+386</option>
                                                        <option value="387">+387</option>
                                                        <option value="389">+389</option>
                                                        <option value="420">+420</option>
                                                        <option value="421">+421</option>
                                                        <option value="423">+423</option>
                                                        <option value="500">+500</option>
                                                        <option value="501">+501</option>
                                                        <option value="502">+502</option>
                                                        <option value="503">+503</option>
                                                        <option value="504">+504</option>
                                                        <option value="505">+505</option>
                                                        <option value="506">+506</option>
                                                        <option value="507">+507</option>
                                                        <option value="508">+508</option>
                                                        <option value="509">+509</option>
                                                        <option value="590">+590</option>
                                                        <option value="591">+591</option>
                                                        <option value="592">+592</option>
                                                        <option value="593">+593</option>
                                                        <option value="594">+594</option>
                                                        <option value="595">+595</option>
                                                        <option value="596">+596</option>
                                                        <option value="597">+597</option>
                                                        <option value="598">+598</option>
                                                        <option value="599">+599</option>
                                                        <option value="670">+670</option>
                                                        <option value="672">+672</option>
                                                        <option value="673">+673</option>
                                                        <option value="674">+674</option>
                                                        <option value="675">+675</option>
                                                        <option value="676">+676</option>
                                                        <option value="677">+677</option>
                                                        <option value="678">+678</option>
                                                        <option value="679">+679</option>
                                                        <option value="680">+680</option>
                                                        <option value="681">+681</option>
                                                        <option value="682">+682</option>
                                                        <option value="683">+683</option>
                                                        <option value="684">+684</option>
                                                        <option value="686">+686</option>
                                                        <option value="687">+687</option>
                                                        <option value="688">+688</option>
                                                        <option value="689">+689</option>
                                                        <option value="690">+690</option>
                                                        <option value="691">+691</option>
                                                        <option value="692">+692</option>
                                                        <option value="850">+850</option>
                                                        <option value="852">+852</option>
                                                        <option value="853">+853</option>
                                                        <option value="855">+855</option>
                                                        <option value="856">+856</option>
                                                        <option value="880">+880</option>
                                                        <option value="886">+886</option>
                                                        <option value="960">+960</option>
                                                        <option value="961">+961</option>
                                                        <option value="962">+962</option>
                                                        <option value="963">+963</option>
                                                        <option value="964">+964</option>
                                                        <option value="965">+965</option>
                                                        <option value="966">+966</option>
                                                        <option value="967">+967</option>
                                                        <option value="968">+968</option>
                                                        <option value="970">+970</option>
                                                        <option value="971">+971</option>
                                                        <option value="972">+972</option>
                                                        <option value="973">+973</option>
                                                        <option value="974">+974</option>
                                                        <option value="975">+975</option>
                                                        <option value="976">+976</option>
                                                        <option value="977">+977</option>
                                                        <option value="992">+992</option>
                                                        <option value="994">+994</option>
                                                        <option value="995">+995</option>
                                                        <option value="996">+996</option>
                                                        <option value="998">+998</option>
                                                        <option value="1242">+1242</option>
                                                        <option value="1246">+1246</option>
                                                        <option value="1264">+1264</option>
                                                        <option value="1268">+1268</option>
                                                        <option value="1284">+1284</option>
                                                        <option value="1340">+1340</option>
                                                        <option value="1345">+1345</option>
                                                        <option value="1441">+1441</option>
                                                        <option value="1473">+1473</option>
                                                        <option value="1649">+1649</option>
                                                        <option value="1664">+1664</option>
                                                        <option value="1670">+1670</option>
                                                        <option value="1671">+1671</option>
                                                        <option value="1684">+1684</option>
                                                        <option value="1758">+1758</option>
                                                        <option value="1767">+1767</option>
                                                        <option value="1784">+1784</option>
                                                        <option value="1787">+1787</option>
                                                        <option value="1809">+1809</option>
                                                        <option value="1868">+1868</option>
                                                        <option value="1869">+1869</option>
                                                        <option value="1876">+1876</option>
                                                        <option value="7370">+7370</option>
                                                    </select>
                                                    <input type="text" placeholder="Mobile Number" class="form-control">
                                                </div>
                                            </div>
                                               
                                            </div>
                                            <div class="col-12">
                                            <div class="form-group">
                                            <select class="form-control">
                                                    <option value="">Select Country..</option>
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
                                                    <option value="BOSNIA AND HERZEGOVINA">BOSNIA AND HERZEGOVINA
                                                    </option>
                                                    <option value="BOTSWANA">BOTSWANA</option>
                                                    <option value="BOUVET ISLAND">BOUVET ISLAND</option>
                                                    <option value="BRAZIL">BRAZIL</option>
                                                    <option value="BRITISH INDIAN OCEAN TERRITORY">BRITISH INDIAN OCEAN
                                                        TERRITORY</option>
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
                                                    <option value="CENTRAL AFRICAN REPUBLIC">CENTRAL AFRICAN REPUBLIC
                                                    </option>
                                                    <option value="CHAD">CHAD</option>
                                                    <option value="CHILE">CHILE</option>
                                                    <option value="CHINA">CHINA</option>
                                                    <option value="CHRISTMAS ISLAND">CHRISTMAS ISLAND</option>
                                                    <option value="COCOS (KEELING) ISLANDS">COCOS (KEELING) ISLANDS
                                                    </option>
                                                    <option value="COLOMBIA">COLOMBIA</option>
                                                    <option value="COMOROS">COMOROS</option>
                                                    <option value="CONGO">CONGO</option>
                                                    <option value="CONGO, THE DEMOCRATIC REPUBLIC OF THE">CONGO, THE
                                                        DEMOCRATIC REPUBLIC OF THE</option>
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
                                                    <option value="FALKLAND ISLANDS (MALVINAS)">FALKLAND ISLANDS
                                                        (MALVINAS)</option>
                                                    <option value="FAROE ISLANDS">FAROE ISLANDS</option>
                                                    <option value="FIJI">FIJI</option>
                                                    <option value="FINLAND">FINLAND</option>
                                                    <option value="FRANCE">FRANCE</option>
                                                    <option value="FRENCH GUIANA">FRENCH GUIANA</option>
                                                    <option value="FRENCH POLYNESIA">FRENCH POLYNESIA</option>
                                                    <option value="FRENCH SOUTHERN TERRITORIES">FRENCH SOUTHERN
                                                        TERRITORIES</option>
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
                                                    <option value="HEARD ISLAND AND MCDONALD ISLANDS">HEARD ISLAND AND
                                                        MCDONALD ISLANDS</option>
                                                    <option value="HOLY SEE (VATICAN CITY STATE)">HOLY SEE (VATICAN CITY
                                                        STATE)</option>
                                                    <option value="HONDURAS">HONDURAS</option>
                                                    <option value="HONG KONG">HONG KONG</option>
                                                    <option value="HUNGARY">HUNGARY</option>
                                                    <option value="ICELAND">ICELAND</option>
                                                    <option value="INDIA">INDIA</option>
                                                    <option value="INDONESIA">INDONESIA</option>
                                                    <option value="IRAN, ISLAMIC REPUBLIC OF">IRAN, ISLAMIC REPUBLIC OF
                                                    </option>
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
                                                    <option value="KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF">KOREA,
                                                        DEMOCRATIC PEOPLE'S REPUBLIC OF</option>
                                                    <option value="KOREA, REPUBLIC OF">KOREA, REPUBLIC OF</option>
                                                    <option value="KUWAIT">KUWAIT</option>
                                                    <option value="KYRGYZSTAN">KYRGYZSTAN</option>
                                                    <option value="LAO PEOPLE'S DEMOCRATIC REPUBLIC">LAO PEOPLE'S
                                                        DEMOCRATIC REPUBLIC</option>
                                                    <option value="LATVIA">LATVIA</option>
                                                    <option value="LEBANON">LEBANON</option>
                                                    <option value="LESOTHO">LESOTHO</option>
                                                    <option value="LIBERIA">LIBERIA</option>
                                                    <option value="LIBYAN ARAB JAMAHIRIYA">LIBYAN ARAB JAMAHIRIYA
                                                    </option>
                                                    <option value="LIECHTENSTEIN">LIECHTENSTEIN</option>
                                                    <option value="LITHUANIA">LITHUANIA</option>
                                                    <option value="LUXEMBOURG">LUXEMBOURG</option>
                                                    <option value="MACAO">MACAO</option>
                                                    <option value="MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF">
                                                        MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF</option>
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
                                                    <option value="MICRONESIA, FEDERATED STATES OF">MICRONESIA,
                                                        FEDERATED STATES OF</option>
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
                                                    <option value="NORTHERN MARIANA ISLANDS">NORTHERN MARIANA ISLANDS
                                                    </option>
                                                    <option value="NORWAY">NORWAY</option>
                                                    <option value="OMAN">OMAN</option>
                                                    <option value="PAKISTAN">PAKISTAN</option>
                                                    <option value="PALAU">PALAU</option>
                                                    <option value="PALESTINIAN TERRITORY, OCCUPIED">PALESTINIAN
                                                        TERRITORY, OCCUPIED</option>
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
                                                    <option value="SAINT PIERRE AND MIQUELON">SAINT PIERRE AND MIQUELON
                                                    </option>
                                                    <option value="SAINT VINCENT AND THE GRENADINES">SAINT VINCENT AND
                                                        THE GRENADINES</option>
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
                                                    <option value="SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS">SOUTH
                                                        GEORGIA AND THE SOUTH SANDWICH ISLANDS</option>
                                                    <option value="SOUTH SUDAN">SOUTH SUDAN</option>
                                                    <option value="SPAIN">SPAIN</option>
                                                    <option value="SRI LANKA">SRI LANKA</option>
                                                    <option value="SUDAN">SUDAN</option>
                                                    <option value="SURINAME">SURINAME</option>
                                                    <option value="SVALBARD AND JAN MAYEN">SVALBARD AND JAN MAYEN
                                                    </option>
                                                    <option value="SWAZILAND">SWAZILAND</option>
                                                    <option value="SWEDEN">SWEDEN</option>
                                                    <option value="SWITZERLAND">SWITZERLAND</option>
                                                    <option value="SYRIAN ARAB REPUBLIC">SYRIAN ARAB REPUBLIC</option>
                                                    <option value="TAIWAN, PROVINCE OF CHINA">TAIWAN, PROVINCE OF CHINA
                                                    </option>
                                                    <option value="TAJIKISTAN">TAJIKISTAN</option>
                                                    <option value="TANZANIA, UNITED REPUBLIC OF">TANZANIA, UNITED
                                                        REPUBLIC OF</option>
                                                    <option value="THAILAND">THAILAND</option>
                                                    <option value="TIMOR-LESTE">TIMOR-LESTE</option>
                                                    <option value="TOGO">TOGO</option>
                                                    <option value="TOKELAU">TOKELAU</option>
                                                    <option value="TONGA">TONGA</option>
                                                    <option value="TRINIDAD AND TOBAGO">TRINIDAD AND TOBAGO</option>
                                                    <option value="TUNISIA">TUNISIA</option>
                                                    <option value="TURKEY">TURKEY</option>
                                                    <option value="TURKMENISTAN">TURKMENISTAN</option>
                                                    <option value="TURKS AND CAICOS ISLANDS">TURKS AND CAICOS ISLANDS
                                                    </option>
                                                    <option value="TUVALU">TUVALU</option>
                                                    <option value="UGANDA">UGANDA</option>
                                                    <option value="UKRAINE">UKRAINE</option>
                                                    <option value="UNITED ARAB EMIRATES">UNITED ARAB EMIRATES</option>
                                                    <option value="UNITED KINGDOM">UNITED KINGDOM</option>
                                                    <option value="UNITED STATES">UNITED STATES</option>
                                                    <option value="UNITED STATES MINOR OUTLYING ISLANDS">UNITED STATES
                                                        MINOR OUTLYING ISLANDS</option>
                                                    <option value="URUGUAY">URUGUAY</option>
                                                    <option value="UZBEKISTAN">UZBEKISTAN</option>
                                                    <option value="VANUATU">VANUATU</option>
                                                    <option value="VENEZUELA">VENEZUELA</option>
                                                    <option value="VIET NAM">VIET NAM</option>
                                                    <option value="VIRGIN ISLANDS, BRITISH">VIRGIN ISLANDS, BRITISH
                                                    </option>
                                                    <option value="VIRGIN ISLANDS, U.S.">VIRGIN ISLANDS, U.S.</option>
                                                    <option value="WALLIS AND FUTUNA">WALLIS AND FUTUNA</option>
                                                    <option value="WESTERN SAHARA">WESTERN SAHARA</option>
                                                    <option value="YEMEN">YEMEN</option>
                                                    <option value="ZAMBIA">ZAMBIA</option>
                                                    <option value="ZIMBABWE">ZIMBABWE</option>
                                                </select>
                                            </div>
                                                
                                            </div>
                                            <div class="col-12">
                                            <div class="form-group">
                                            <select class="form-control">
                                                    <option value="">Select Level..</option>
                                                    <option value="1">CERTIFICATE</option>
                                                    <option value="2">PRE-UNIVERSITY</option>
                                                    <option value="3">DIPLOMA</option>
                                                    <option value="4">UNDER-GRADUATE</option>
                                                    <option value="5">POST-GRADUATE</option>
                                                    <option value="6">POST-GRADUATE-DIPLOMA</option>
                                                    <option value="7">PHD</option>
                                                </select>
                                            </div>
                                               
                                            </div>
                                            <div class="col-12">
                                            <div class="form-group">
                                            <select class="form-control">
                                                    <option value="">Select Category..</option>
                                                    <option value="Agriculture and Veterinary Medicine">Agriculture and
                                                        Veterinary Medicine</option>
                                                    <option value="Applied and Pure Sciences">Applied and Pure Sciences
                                                    </option>
                                                    <option value="Business and Management">Business and Management
                                                    </option>
                                                    <option value="Computer Science and IT">Computer Science and IT
                                                    </option>
                                                    <option value="Creative Arts and Design">Creative Arts and Design
                                                    </option>
                                                    <option value="Education and Training">Education and Training
                                                    </option>
                                                    <option value="Engineering">Engineering</option>
                                                    <option value="Health and Medicine">Health and Medicine</option>
                                                    <option value="Humanities">Humanities</option>
                                                    <option value="Law">Law</option>
                                                    <option value="Personal Care and Fitness">Personal Care and Fitness
                                                    </option>
                                                    <option value="Social Studies and Media">Social Studies and Media
                                                    </option>
                                                    <option value="Travel and Hospitality">Travel and Hospitality
                                                    </option>
                                                    <option value="A-Levels">A-Levels</option>
                                                    <option value="Foundation">Foundation</option>
                                                    <option value="American Degree program ">American Degree program
                                                    </option>
                                                    <option value="Certificate">Certificate</option>
                                                    <option value="MBA">MBA</option>
                                                    <option value="Architecture and Construction">Architecture and
                                                        Construction</option>
                                                    <option value="Australian Matriculation (AUSMAT)">Australian
                                                        Matriculation (AUSMAT)</option>
                                                </select>
                                            </div>
                                               
                                            </div>
                                            <div class="col-12">
                                            <div class="form-group">
                                            <div class="d-flex all-regi align-items-center setgap3">
                                                    <input type="text" placeholder="Captcha : 8 * 5  ="
                                                        class="form-control  widthss" value="Captcha : 8 * 5  =" disbaled=""
                                                        readonly="">
                                                    <input type="text" placeholder="Enter the Captcha Value"
                                                        class="form-control" name="captcha_input" required="">
                                                </div>
                                            </div>
                                               
                                            </div>
                                           <div class="col-12 text-right ">
                                           <button type="submit" class="btn btn-primary rounded"
                                           data-dismiss="modal">Send Message</button>
                                           </div>


                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>