@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <section class="banner-section">
    <div class="container">
      <div class="row">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item ">
              <img src="https://www.educationmalaysia.in/uploads/banners/IMG_20241210_163547.png" class="img-fluid"
                alt="Banner">
            </div>
            <div class="carousel-item active">
              <img src="https://www.educationmalaysia.in/uploads/banners/IMG_20241210_163554.png" class="img-fluid"
                alt="banner">
            </div>
            <div class="carousel-item ">
              <img src="https://www.educationmalaysia.in/uploads/banners/IMG_20241210_163604.png" class="img-fluid"
                alt="banner">
            </div>
            <div class="carousel-item ">
              <img src="https://www.educationmalaysia.in/uploads/banners/IMG_20241210_163614.png" class="img-fluid"
                alt="banner">
            </div>
            <div class="carousel-item ">
              <img src="https://www.educationmalaysia.in/uploads/banners/IMG_20241210_163626.png" class="img-fluid"
                alt="banner">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>

  </section>

  <section class="Sureworks">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mb-4 ">
          <div class="flex flex-col all-flexx gap-3 items-center text-center h-100">
            <img src="https://www.educationmalaysia.in//assets/web/images/png1.png" alt="">
            <h2 class="text-xl font-bold">Courses</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
              labore et dolore magna aliqua.</p>
          </div>
        </div>
        <div class="col-lg-4 mb-4 ">
          <div class="flex flex-col all-flexx gap-3 h-100 items-center text-center">
            <img src="https://www.educationmalaysia.in//assets/web/images/png2.png" alt="">
            <h2 class="text-xl font-bold">Institutions</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
              labore et dolore magna aliqua.

            </p>
          </div>
        </div>

        <div class="col-lg-4 mb-4 ">
          <div class="flex flex-col all-flexx gap-3 h-100 items-center text-center">
            <img src="https://www.educationmalaysia.in//assets/web/images/png3.png" alt="">
            <h2 class="text-xl font-bold">Scholarships</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
              labore et dolore magna aliqua.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="registrationss">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <h2 class="fairs">
            International Education Fair

          </h2>
          <p class="all-fair">New Delhi, 23 March 2025, 13.00–17.00 The Lalit, Fire Brigade Lane, Barakhamba</p>

          <a href="#register" class="new-registor">Register now to get your free invitation!</a>

        </div>
        <div class="col-lg-6">
          <img src="https://www.educationmalaysia.in/uploads/banners/IMG_20241209_114208.jpg" class="img-fluid"
            alt="education fair in libia 2025">
          <!-- <img src="https://www.educationmalaysia.in//assets/web/images/study-abroad.jpg" class="img-fluid"
                        alt=""> -->
        </div>
      </div>
    </div>
  </section>

  <section class="studaies-abroad">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="abroad-imags">
            <img src="https://www.educationmalaysia.in//assets/web/images/studies.jpg" class="studysimage" alt="">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="abroad-students">
            <h2>Want to study abroad?</h2>
            <p class="mb-3">Nam libero tempore, cum soluta nobis est eligendi</p>
            <p class="mb-3">Nam libero tempore, cum soluta nobis est eligendi</p>
            <p class="mb-3">Nam libero tempore, cum soluta nobis est eligendi</p>
            <p class="mb-3">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo
              minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor
              repellendus.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="registrations-fomrs" id="register">
    <div class="container">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">

              <div class="all-forms main-modals">
                <h2 class="new-regist">Register ow</h2>
                <form class="s12 f" action="https://www.educationmalaysia.in/libia/register" method="post">
                  <input class="mt-0" type="hidden" name="return_path"
                    value="https://www.educationmalaysia.in/education-fair-in-libia-2025">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input name="name" class="form-control" type="text" placeholder="Enter Full Name"
                          pattern="[a-zA-Z'-'\s]*" value="" required>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <input name="email" class="form-control" type="email" placeholder="Enter Email Address"
                          value="" required>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <div class="form-group">
                        <select name="c_code" id="countryCode" class="form-control" required>
                          <option value="">Select</option>
                          <option value="0">
                            +0</option>
                          <option value="1">
                            +1</option>
                          <option value="7">
                            +7</option>
                          <option value="20">
                            +20</option>
                          <option value="27">
                            +27</option>
                          <option value="30">
                            +30</option>
                          <option value="31">
                            +31</option>
                          <option value="32">
                            +32</option>
                          <option value="33">
                            +33</option>
                          <option value="34">
                            +34</option>
                          <option value="36">
                            +36</option>
                          <option value="39">
                            +39</option>
                          <option value="40">
                            +40</option>
                          <option value="41">
                            +41</option>
                          <option value="43">
                            +43</option>
                          <option value="44">
                            +44</option>
                          <option value="45">
                            +45</option>
                          <option value="46">
                            +46</option>
                          <option value="47">
                            +47</option>
                          <option value="48">
                            +48</option>
                          <option value="49">
                            +49</option>
                          <option value="51">
                            +51</option>
                          <option value="52">
                            +52</option>
                          <option value="53">
                            +53</option>
                          <option value="54">
                            +54</option>
                          <option value="55">
                            +55</option>
                          <option value="56">
                            +56</option>
                          <option value="57">
                            +57</option>
                          <option value="58">
                            +58</option>
                          <option value="60">
                            +60</option>
                          <option value="61">
                            +61</option>
                          <option value="62">
                            +62</option>
                          <option value="63">
                            +63</option>
                          <option value="64">
                            +64</option>
                          <option value="65">
                            +65</option>
                          <option value="66">
                            +66</option>
                          <option value="70">
                            +70</option>
                          <option value="81">
                            +81</option>
                          <option value="82">
                            +82</option>
                          <option value="84">
                            +84</option>
                          <option value="86">
                            +86</option>
                          <option value="90">
                            +90</option>
                          <option value="91">
                            +91</option>
                          <option value="92">
                            +92</option>
                          <option value="93">
                            +93</option>
                          <option value="94">
                            +94</option>
                          <option value="95">
                            +95</option>
                          <option value="98">
                            +98</option>
                          <option value="211">
                            +211</option>
                          <option value="212">
                            +212</option>
                          <option value="213">
                            +213</option>
                          <option value="216">
                            +216</option>
                          <option value="218">
                            +218</option>
                          <option value="220">
                            +220</option>
                          <option value="221">
                            +221</option>
                          <option value="222">
                            +222</option>
                          <option value="223">
                            +223</option>
                          <option value="224">
                            +224</option>
                          <option value="225">
                            +225</option>
                          <option value="226">
                            +226</option>
                          <option value="227">
                            +227</option>
                          <option value="228">
                            +228</option>
                          <option value="229">
                            +229</option>
                          <option value="230">
                            +230</option>
                          <option value="231">
                            +231</option>
                          <option value="232">
                            +232</option>
                          <option value="233">
                            +233</option>
                          <option value="234">
                            +234</option>
                          <option value="235">
                            +235</option>
                          <option value="236">
                            +236</option>
                          <option value="237">
                            +237</option>
                          <option value="238">
                            +238</option>
                          <option value="239">
                            +239</option>
                          <option value="240">
                            +240</option>
                          <option value="241">
                            +241</option>
                          <option value="242">
                            +242</option>
                          <option value="244">
                            +244</option>
                          <option value="245">
                            +245</option>
                          <option value="246">
                            +246</option>
                          <option value="248">
                            +248</option>
                          <option value="249">
                            +249</option>
                          <option value="250">
                            +250</option>
                          <option value="251">
                            +251</option>
                          <option value="252">
                            +252</option>
                          <option value="253">
                            +253</option>
                          <option value="254">
                            +254</option>
                          <option value="255">
                            +255</option>
                          <option value="256">
                            +256</option>
                          <option value="257">
                            +257</option>
                          <option value="258">
                            +258</option>
                          <option value="260">
                            +260</option>
                          <option value="261">
                            +261</option>
                          <option value="262">
                            +262</option>
                          <option value="263">
                            +263</option>
                          <option value="264">
                            +264</option>
                          <option value="265">
                            +265</option>
                          <option value="266">
                            +266</option>
                          <option value="267">
                            +267</option>
                          <option value="268">
                            +268</option>
                          <option value="269">
                            +269</option>
                          <option value="290">
                            +290</option>
                          <option value="291">
                            +291</option>
                          <option value="297">
                            +297</option>
                          <option value="298">
                            +298</option>
                          <option value="299">
                            +299</option>
                          <option value="350">
                            +350</option>
                          <option value="351">
                            +351</option>
                          <option value="352">
                            +352</option>
                          <option value="353">
                            +353</option>
                          <option value="354">
                            +354</option>
                          <option value="355">
                            +355</option>
                          <option value="356">
                            +356</option>
                          <option value="357">
                            +357</option>
                          <option value="358">
                            +358</option>
                          <option value="359">
                            +359</option>
                          <option value="370">
                            +370</option>
                          <option value="371">
                            +371</option>
                          <option value="372">
                            +372</option>
                          <option value="373">
                            +373</option>
                          <option value="374">
                            +374</option>
                          <option value="375">
                            +375</option>
                          <option value="376">
                            +376</option>
                          <option value="377">
                            +377</option>
                          <option value="378">
                            +378</option>
                          <option value="380">
                            +380</option>
                          <option value="381">
                            +381</option>
                          <option value="385">
                            +385</option>
                          <option value="386">
                            +386</option>
                          <option value="387">
                            +387</option>
                          <option value="389">
                            +389</option>
                          <option value="420">
                            +420</option>
                          <option value="421">
                            +421</option>
                          <option value="423">
                            +423</option>
                          <option value="500">
                            +500</option>
                          <option value="501">
                            +501</option>
                          <option value="502">
                            +502</option>
                          <option value="503">
                            +503</option>
                          <option value="504">
                            +504</option>
                          <option value="505">
                            +505</option>
                          <option value="506">
                            +506</option>
                          <option value="507">
                            +507</option>
                          <option value="508">
                            +508</option>
                          <option value="509">
                            +509</option>
                          <option value="590">
                            +590</option>
                          <option value="591">
                            +591</option>
                          <option value="592">
                            +592</option>
                          <option value="593">
                            +593</option>
                          <option value="594">
                            +594</option>
                          <option value="595">
                            +595</option>
                          <option value="596">
                            +596</option>
                          <option value="597">
                            +597</option>
                          <option value="598">
                            +598</option>
                          <option value="599">
                            +599</option>
                          <option value="670">
                            +670</option>
                          <option value="672">
                            +672</option>
                          <option value="673">
                            +673</option>
                          <option value="674">
                            +674</option>
                          <option value="675">
                            +675</option>
                          <option value="676">
                            +676</option>
                          <option value="677">
                            +677</option>
                          <option value="678">
                            +678</option>
                          <option value="679">
                            +679</option>
                          <option value="680">
                            +680</option>
                          <option value="681">
                            +681</option>
                          <option value="682">
                            +682</option>
                          <option value="683">
                            +683</option>
                          <option value="684">
                            +684</option>
                          <option value="686">
                            +686</option>
                          <option value="687">
                            +687</option>
                          <option value="688">
                            +688</option>
                          <option value="689">
                            +689</option>
                          <option value="690">
                            +690</option>
                          <option value="691">
                            +691</option>
                          <option value="692">
                            +692</option>
                          <option value="850">
                            +850</option>
                          <option value="852">
                            +852</option>
                          <option value="853">
                            +853</option>
                          <option value="855">
                            +855</option>
                          <option value="856">
                            +856</option>
                          <option value="880">
                            +880</option>
                          <option value="886">
                            +886</option>
                          <option value="960">
                            +960</option>
                          <option value="961">
                            +961</option>
                          <option value="962">
                            +962</option>
                          <option value="963">
                            +963</option>
                          <option value="964">
                            +964</option>
                          <option value="965">
                            +965</option>
                          <option value="966">
                            +966</option>
                          <option value="967">
                            +967</option>
                          <option value="968">
                            +968</option>
                          <option value="970">
                            +970</option>
                          <option value="971">
                            +971</option>
                          <option value="972">
                            +972</option>
                          <option value="973">
                            +973</option>
                          <option value="974">
                            +974</option>
                          <option value="975">
                            +975</option>
                          <option value="976">
                            +976</option>
                          <option value="977">
                            +977</option>
                          <option value="992">
                            +992</option>
                          <option value="994">
                            +994</option>
                          <option value="995">
                            +995</option>
                          <option value="996">
                            +996</option>
                          <option value="998">
                            +998</option>
                          <option value="1242">
                            +1242</option>
                          <option value="1246">
                            +1246</option>
                          <option value="1264">
                            +1264</option>
                          <option value="1268">
                            +1268</option>
                          <option value="1284">
                            +1284</option>
                          <option value="1340">
                            +1340</option>
                          <option value="1345">
                            +1345</option>
                          <option value="1441">
                            +1441</option>
                          <option value="1473">
                            +1473</option>
                          <option value="1649">
                            +1649</option>
                          <option value="1664">
                            +1664</option>
                          <option value="1670">
                            +1670</option>
                          <option value="1671">
                            +1671</option>
                          <option value="1684">
                            +1684</option>
                          <option value="1758">
                            +1758</option>
                          <option value="1767">
                            +1767</option>
                          <option value="1784">
                            +1784</option>
                          <option value="1787">
                            +1787</option>
                          <option value="1809">
                            +1809</option>
                          <option value="1868">
                            +1868</option>
                          <option value="1869">
                            +1869</option>
                          <option value="1876">
                            +1876</option>
                          <option value="7370">
                            +7370</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                      <div class="form-group">
                        <input name="mobile" class="form-control mt-0" required type="text" pattern="[0-9]+"
                          placeholder="Phone number" value="">
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                        <select name="highest_qualification" class="form-control" required
                          placeholder="Your Highest Qualification">
                          <option value="">Select Highest Qualification</option>
                          <option value="CERTIFICATE">
                            CERTIFICATE</option>
                          <option value="PRE-UNIVERSITY">
                            PRE-UNIVERSITY</option>
                          <option value="DIPLOMA">
                            DIPLOMA</option>
                          <option value="UNDER-GRADUATE">
                            UNDER-GRADUATE</option>
                          <option value="POST-GRADUATE">
                            POST-GRADUATE</option>
                          <option value="POST-GRADUATE-DIPLOMA">
                            POST-GRADUATE-DIPLOMA</option>
                          <option value="PHD">
                            PHD</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                        <select name="nationality" class="form-control" required>
                          <option value="">Select Nationality</option>
                          <option value="Libian">Libian</option>
                          <option value="Non-Libian">Non-Libian</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                        <select name="university" class="form-control" id="ef_university" required>
                          <option value="">Select University</option>
                          <option value="5">
                            University of Malaya (UM)</option>
                          <option value="6">
                            Universiti Kebangsaan Malaysia</option>
                          <option value="7">
                            Universiti Putra Malaysia</option>
                          <option value="9">
                            International Islamic University of Malaysia</option>
                          <option value="39">
                            Meritus University</option>
                          <option value="58">
                            SEGi UNIVERSITY</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                        <select name="program" class="form-control" id="ef_program" required>
                          <option value="">Select Program</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <div class="form-group">
                        <input type="text" placeholder="Captcha : 1 * 5  =" class="form-control"
                          value="Captcha : 1 * 5  =" disbaled readonly>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                      <div class="form-group">
                        <input type="text" id="captcha" placeholder="Enter the Captcha Value"
                          class="form-control" name="captcha_input" required>
                      </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <p>
                        <label for="test5">By clicking on register I agree to the
                          <a href="https://www.educationmalaysia.in/terms-and-conditions" target="_blank">terms &
                            conditions</a>
                        </label>
                      </p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="input-field s4 d-flex justify-content-center align-items-center">
                        <button type="submit" class="blue-register mar5 w-50">Register</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>

            </div>
            <div class="col-md-6">
              <div class="p-5">
                <img src="https://www.educationmalaysia.in//assets/web/images/registrations.png" alt=""
                  class="img-fluid">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="particaptes-universties">
    <div class="container">
      <div class="particaptes">
        <h3 class="universties   px-2 py-3 align-items-center gap-3 my-0 justify-content-between d-flex ">
          Participates University</h3>

        <div class="tab-content" id="one-tabContent">
          <div class="tab-pane active" id="one" role="tabpanel" aria-labelledby="one-tab">

            <div class="row">
              <div class="col-12 col-sm-8"></div>
              <div class="col-12 col-sm-4"></div>
            </div>
            <div class="flex flex-col divide-y">
              <div
                class=" px-2 py-3 align-items-center gap-3 my-0 justify-content-between d-flex border-top border-bottom ">
                <span class="grow"><label>EXHIBITOR</label></span>
                <div class="d-flex justify-content-between spacebx">
                  <span class="shrink"><label>BOOTH</label></span>

                  <span class="shrink"><label>Send Application
                    </label></span>
                </div>
              </div>
            </div>
            <div
              class=" px-2 py-3 align-items-center gap-3 my-0 justify-content-between d-flex border-top border-bottom">

              <div class="grow">
                <a href="https://www.educationmalaysia.in/university/university-of-malaya-um" target="_blank">
                  <span class="">University of Malaya (UM)</span>
                </a>
              </div>
              <div class="d-flex justify-content-between spacebx">
                <div class="numbers">
                  1.
                </div>
                <div class="shrink">
                  <button class="all-apply" data-id="5">Apply Now</button>
                </div>
              </div>
            </div>

            <div
              class=" px-2 py-3 align-items-center gap-3 my-0 justify-content-between d-flex border-top border-bottom">

              <div class="grow">
                <a href="https://www.educationmalaysia.in/university/national-university-of-malaysia-ukm"
                  target="_blank">
                  <span class="">Universiti Kebangsaan Malaysia</span>
                </a>
              </div>
              <div class="d-flex justify-content-between spacebx">
                <div class="numbers">
                  1.
                </div>
                <div class="shrink">
                  <button class="all-apply" data-id="6">Apply Now</button>
                </div>
              </div>
            </div>

            <div
              class=" px-2 py-3 align-items-center gap-3 my-0 justify-content-between d-flex border-top border-bottom">

              <div class="grow">
                <a href="https://www.educationmalaysia.in/university/universiti-putra-malaysia-upm" target="_blank">
                  <span class="">Universiti Putra Malaysia</span>
                </a>
              </div>
              <div class="d-flex justify-content-between spacebx">
                <div class="numbers">
                  1.
                </div>
                <div class="shrink">
                  <button class="all-apply" data-id="7">Apply Now</button>
                </div>
              </div>
            </div>

            <div
              class=" px-2 py-3 align-items-center gap-3 my-0 justify-content-between d-flex border-top border-bottom">

              <div class="grow">
                <a href="https://www.educationmalaysia.in/university/international-islamic-university-of-malaysia"
                  target="_blank">
                  <span class="">International Islamic University of Malaysia</span>
                </a>
              </div>
              <div class="d-flex justify-content-between spacebx">
                <div class="numbers">
                  1.
                </div>
                <div class="shrink">
                  <button class="all-apply" data-id="9">Apply Now</button>
                </div>
              </div>
            </div>

            <div
              class=" px-2 py-3 align-items-center gap-3 my-0 justify-content-between d-flex border-top border-bottom">

              <div class="grow">
                <a href="https://www.educationmalaysia.in/university/meritus-university" target="_blank">
                  <span class="">Meritus University</span>
                </a>
              </div>
              <div class="d-flex justify-content-between spacebx">
                <div class="numbers">
                  1.
                </div>
                <div class="shrink">
                  <button class="all-apply" data-id="39">Apply Now</button>
                </div>
              </div>
            </div>

            <div
              class=" px-2 py-3 align-items-center gap-3 my-0 justify-content-between d-flex border-top border-bottom">

              <div class="grow">
                <a href="https://www.educationmalaysia.in/university/segi-university" target="_blank">
                  <span class="">SEGi UNIVERSITY</span>
                </a>
              </div>
              <div class="d-flex justify-content-between spacebx">
                <div class="numbers">
                  1.
                </div>
                <div class="shrink">
                  <button class="all-apply" data-id="58">Apply Now</button>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

    </div>
  </section>

  <section class="fair-about">

    <div class="container">
      <h2>Join the fair to learn about:</h2>
      <div class="row align-items-center ">
        <div class="col-lg-7">
          <ul class="ol-joins">
            <li class="li-joins">
              <span>1</span>
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magni non esse veritatis.</p>
            </li>
            <li class="li-joins">
              <span>2</span>
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magni non esse veritatis.</p>
            </li>
            <li class="li-joins">
              <span>3</span>
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magni non esse veritatis.</p>
            </li>
            <li class="li-joins">
              <span>4</span>
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magni non esse veritatis.</p>
            </li>
            <li class="li-joins">
              <span>5</span>
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magni non esse veritatis.</p>
            </li>
            <li class="li-joins">
              <span>6</span>
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magni non esse veritatis.</p>
            </li>

          </ul>
        </div>
        <div class="col-lg-5">
          <img src="https://www.educationmalaysia.in//assets/web/images/joins.jpg" class="img-fluid" alt="">
        </div>
      </div>
    </div>
  </section>
  <section class="applyisss">
    <div class="applyingsstart">
      <h2 class="applyings">Applying for Scholarships in Malaysia? Here’s a Quick Guide
    </div>
    </h2>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="position-relative">
            <img src="https://www.educationmalaysia.in//assets/web/images/apply.png" class="passings" alt="">
            <div class="divmalaysiass">
              <h2 class="malaysiass">How to apply for scholarships in Malaysia?
              </h2>
              <p class="applyis">
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto
                beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut
                odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
              </p>
            </div>
          </div>
        </div>
        <div class="col-12">

          <ol class="olrearsarch">
            <li>
              <h2>Research available scholarships</h2>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
                cupiditate non provident</p>
            </li>
            <li>
              <h2>Check eligibility criteria</h2>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
                cupiditate non provident</p>
            </li>
            <li>

              <h2>Gather required documents</h2>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
                cupiditate non provident</p>
            </li>
            <li>
              <h2>Apply online or offline</h2>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
                cupiditate non provident</p>
            </li>
            <li>
              <h2>Submit the application</h2>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
                cupiditate non provident</p>
            </li>
            <li>
              <h2>Wait for results</h2>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
                cupiditate non provident</p>
            </li>
            <li>
              <h2>Fulfil scholarship requirements</h2>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
                cupiditate non provident</p>
            </li>
            <li>
              <h2>Submit the application</h2>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
                cupiditate non provident</p>
            </li>

          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="malaysia-govt">
    <div class="contanier">
      <div class="row">
        <div class="col-md-12">
          <div class="minsiter">

            <h2 class="titles-malaysia">The Ministry of Education (MOE)
              Malaysia</h2>

            <div class="allsponser">
              <div class="slider">
                <div class="slide-track">
                  <div class="slide">
                    <img src="https://www.educationmalaysia.in//assets/web/images/govermentlibya.png" alt="">
                  </div>
                  <div class="slide">
                    <img src="https://www.educationmalaysia.in//assets/web/images/Libia-education-board-Logo.png"
                      alt="">
                  </div>

                  <div class="slide">
                    <img src="https://www.educationmalaysia.in//assets/web/images/govt-logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="https://www.educationmalaysia.in//assets/web/images/britannica-logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="https://www.educationmalaysia.in//assets/web/images/Flag-of-Libya.png" alt="">
                  </div>
                  <!-- 1  -->

                  <div class="slide">
                    <img src="https://www.educationmalaysia.in//assets/web/images/govermentlibya.png" alt="">
                  </div>
                  <div class="slide">
                    <img src="https://www.educationmalaysia.in//assets/web/images/Libia-education-board-Logo.png"
                      alt="">
                  </div>

                  <div class="slide">
                    <img src="https://www.educationmalaysia.in//assets/web/images/govt-logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="https://www.educationmalaysia.in//assets/web/images/britannica-logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="https://www.educationmalaysia.in//assets/web/images/Flag-of-Libya.png" alt="">
                  </div>
                  <!-- 2  -->

                  <div class="slide">
                    <img src="https://www.educationmalaysia.in//assets/web/images/govermentlibya.png" alt="">
                  </div>
                  <div class="slide">
                    <img src="https://www.educationmalaysia.in//assets/web/images/Libia-education-board-Logo.png"
                      alt="">
                  </div>

                  <div class="slide">
                    <img src="https://www.educationmalaysia.in//assets/web/images/govt-logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="https://www.educationmalaysia.in//assets/web/images/britannica-logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="https://www.educationmalaysia.in//assets/web/images/Flag-of-Libya.png" alt="">
                  </div>

                </div>
              </div>
            </div>

          </div>

        </div>

      </div>
    </div>
  </section>

  <section class="faq-sections">
    <div class="faq"></div>
    <div class=" faq-details">
      Frequently Ask Question
    </div>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="accordion mainacc" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne3">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Do I need to apply for visa to travel overseas? </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                  deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                  provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.
                  Et harum quidem rerum facilis est et expedita distinctio. </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    $(document).ready(function() {
      // Check if a university is already selected on page load
      // const selectedUniversityId = $('#ef_university').val();
      // if (selectedUniversityId) {
      // 	fetchPrograms(selectedUniversityId); // Call the function to fetch programs
      // }

      // Fetch programs when university dropdown changes
      $('#ef_university').change(function() {
        const universityId = $(this).val();
        if (universityId) {
          fetchPrograms(universityId); // Call the function to fetch programs
        }
      });

      // Function to fetch programs
      function fetchPrograms(universityId) {
        $.ajax({
          url: 'https://www.educationmalaysia.in/LibiaLandingPage/getProgramsByUniversity',
          type: 'POST',
          data: {
            university_id: universityId
          },
          success: function(response) {
            $('#ef_program').html(response);
          },
          error: function() {
            alert('An error occurred while fetching programs.');
          },
        });
      }
    });

    $(document).ready(function() {
      // Handle the click event on the "Apply Now" button
      $('.all-apply').on('click', function() {
        // Get the university ID from the data-id attribute of the clicked button
        const universityId = $(this).data('id');

        // Scroll smoothly to the register section
        $('html, body').animate({
          scrollTop: $('#register').offset().top
        }, 500);

        // Set the value of the university dropdown to the selected university ID
        $('#ef_university').val(universityId);

        // Trigger change event to ensure any dependent functionality updates
        $('#ef_university').trigger('change');
      });
    });
  </script>
@endsection
