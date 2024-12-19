@extends('front.layouts.main')
@push('seo_meta_tag')
@include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
<!-- Content -->
<section class="bg-light pt-4 pb-4">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">

<div class="topMenu">
<ul class="hor-scrlbar">
<li class="active"><a href="#">Profile</a></li>
<li><a href="#">Search and Apply</a></li>
<li><a href="#">Applications <span>2</span></a></li>
<li><a href="#">Payments</a></li>
</ul>
</div>

<div class="proHead" id="myHeader">
<ul class="links scrollTo hor-scrlbar" data-gssticky="1">
<li class="active"><a href="#PerInfo">General Information <i class="fa fa-check-circle green"></i><i class="fa fa-exclamation-circle red"></i></a></li>
<li class=""><a href="#EduSummary">Education History <i class="fa fa-check-circle green"></i></a></li>
<li class=""><a href="#TestScores">Test Scores <i class="fa fa-check-circle green"></i></a></li>
<li class=""><a href="#BackInfo">Background Information <i class="fa fa-check-circle green"></i></a></li>
<li class=""><a href="#UplodDoc">Upload Documents <i class="fa fa-check-circle green"></i></a></li>
</ul>
</div>

<div class="proContent noti"><i class="fa fa-bell"></i> Please enter your information accurately and correctly. All fields will be sent to the selected school upon submission of your application on ApplyBoard. <span class="fa fa-close close"></span></div>

<div class="proContent noti"><h2>Profile Complete!</h2></div>

<div class="notiBlank"><h3>Registration Date: January 2nd, 2022</h3></div>

<div class="infoContent" id="PerInfo">
<div class="row">
<div class="col-md-12">
<h2>Personal Information</h2>
<div class="slogan">(As indicated on your passport)</div>
</div>
<div class="col-md-4">
<label>First Name <span class="red">*</span></label>
<input placeholder="Enter First Name..." value="" required="">
</div>
<div class="col-md-4">
<label>Middle Name</label>
<input placeholder="Middle Name..." value="" required="">
</div>
<div class="col-md-4">
<label>Last Name <span class="red">*</span></label>
<input placeholder="Last Name..." value="" required="">
</div>
<div class="col-md-4">
<label>Date of Birth <span class="red">*</span></label>
<input type="date" placeholder="Date of Birth..." value="" required="">
</div>
<div class="col-md-4">
<label>First Language <span class="red">*</span></label>
<input placeholder="First Language..." value="" required="">
</div>
<div class="col-md-4">
<label>Country of Citizenship <span class="red">*</span></label>
<select name="">
<option value="">Select Country</option>
<option value="">Select Country</option>
<option value="">Select Country</option>
<option value="">Select Country</option>
<option value="">Select Country</option>
</select>
</div>
<div class="col-md-4">
<label>Passport Number <i class="fa fa-info-circle" title="We collect your passport information for identity verification purposes, your school or program of interest may require this information to process your application. If applicable, it may also be used for processing your visa."></i> <span class="red">*</span></label>
<input placeholder="Passport Number..." value="" required="">
</div>
<div class="col-md-4">
<label>Passport Expiry Date</label>
<input type="date" placeholder="Passport Expiry Date..." value="" required="">
</div>
<div class="col-md-2">
<label>Marital Status <i class="fa fa-info-circle" title="We collect your passport information for identity verification purposes, your school or program of interest may require this information to process your application. If applicable, it may also be used for processing your visa."></i> <span class="red">*</span></label>
<select name="">
<option value="">Select</option>
<option value="">Single</option>
<option value="">Merriad</option>
</select>
</div>
<div class="col-md-2">
<label>Gender <i class="fa fa-info-circle"></i> <span class="red">*</span></label>
<select name="">
<option value="">Select</option>
<option value="">Male</option>
<option value="">Female</option>
</select>
</div>

<div class="col-md-12" style="margin-top:40px">
<h2>Address Detail <span><svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M11 17h2v-6h-2v6zm1-15C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zM11 9h2V7h-2v2z"></path></svg> Please make sure to enter the student's residential address. Organization address will not be accepted.</span></h2>
</div>
<div class="col-md-8">
<label>Address <span class="red">*</span></label>
<input placeholder="Enter Address Here..." value="" required="">
</div>
<div class="col-md-4">
<label>City/Town <span class="red">*</span></label>
<input placeholder="Enter City/Town..." value="" required="">
</div>
<div class="col-md-4">
<label>Country <span class="red">*</span></label>
<select name="">
<option value="">Select Country</option>
<option value="">Select Country</option>
<option value="">Select Country</option>
<option value="">Select Country</option>
<option value="">Select Country</option>
</select>
</div>
<div class="col-md-4">
<label>Province/State <span class="red">*</span></label>
<select name="">
<option value="">Select Province/State</option>
<option value="">Select Province/State</option>
<option value="">Select Province/State</option>
<option value="">Select Province/State</option>
<option value="">Select Province/State</option>
</select>
</div>
<div class="col-md-4">
<label>Postal/Zip Code</label>
<input placeholder="Enter Postal/Zip Code..." value="" required="">
</div>
<div class="col-md-4">
<label>Email</label>
<input placeholder="Enter Email..." value="" required="">
</div>
<div class="col-md-4">
<label>Phone Number <span class="red">*</span></label>
<input placeholder="Enter Phone Number..." value="" required="">
</div>
<div class="col-md-12"><button class="saveBtn">Save</button><button class="cancelBtn">Cancel</button></div>
</div>
</div>

<div class="infoContent" id="EduSummary">
<div class="row">
<div class="col-md-12">
<h2>Education Summary</h2>
</div>
<div class="col-md-4">
<label>Country of Education <span class="red">*</span></label>
<select name="">
<option value="">Select Country</option>
<option value="">Select Country</option>
<option value="">Select Country</option>
<option value="">Select Country</option>
<option value="">Select Country</option>
</select>
</div>
<div class="col-md-4">
<label>Highest Level of Education <span class="red">*</span></label>
<select name="">
<option value="">Highest Level of Education</option>
<option value="">Highest Level of Education</option>
<option value="">Highest Level of Education</option>
<option value="">Highest Level of Education</option>
<option value="">Highest Level of Education</option>
</select>
</div>
<div class="col-md-4">
<label>Grading Scheme <span class="red">*</span></label>
<select name="">
<option value="">Grading Scheme</option>
<option value="">Grading Scheme</option>
<option value="">Grading Scheme</option>
<option value="">Grading Scheme</option>
<option value="">Grading Scheme</option>
</select>
</div>
<div class="col-md-4">
<label>Grade Average <span class="red">*</span></label>
<input placeholder="Enter Grade Average..." value="" required="">
</div>
<div class="col-md-4">
<label class="hideM">&nbsp;</label>
<label class="checkRyt" style="margin-top:10px!important">Graduated from most recent school <input type="checkbox" value="3"><span class="checkmark"></span></label>
</div>
<div class="col-md-12"><button class="saveBtn">Save</button><button class="cancelBtn">Cancel</button></div>
</div>
</div>

<div class="infoContent" id="SchAtd">
<div class="row">
<div class="col-md-12">
<h2>Schools Attended</h2>
</div>
<div class="col-md-4">
<label>Country of Institution <span class="red">*</span></label>
<select name="">
<option value="">Select Country</option>
<option value="">Select Country</option>
<option value="">Select Country</option>
<option value="">Select Country</option>
<option value="">Select Country</option>
</select>
</div>
<div class="col-md-4">
<label>Name of Institution <span class="red">*</span></label>
<input placeholder="Enter Name of Institution..." value="" required="">
</div>
<div class="col-md-4">
<label>Level of Education <span class="red">*</span></label>
<select name="">
<option value="">Level of Education</option>
<option value="">Level of Education</option>
<option value="">Level of Education</option>
<option value="">Level of Education</option>
<option value="">Level of Education</option>
</select>
</div>
<div class="col-md-4">
<label>Primary Language of Instruction <span class="red">*</span></label>
<input placeholder="Enter Primary Language of Instruction..." value="" required="">
</div>
<div class="col-md-4">
<label>Attended Institution From <span class="red">*</span></label>
<input type="date" placeholder="Select Date..." value="" required="">
</div>
<div class="col-md-4">
<label>Attended Institution To <span class="red">*</span></label>
<input type="date" placeholder="Select Date..." value="" required="">
</div>
<div class="col-md-4">
<label>Degree Name <span class="red">*</span></label>
<input placeholder="Enter Degree Name..." value="" required="">
</div>
<div class="clearfix"></div>
<div class="col-md-4">
<label>I have graduated from this institution <span class="red">*</span></label>
<div class="d-flex">
<label class="checkCircle" style="margin-top:10px!important">Yes<input type="radio" checked="checked" name="radio"><span class="checkmark"></span></label>
<label class="checkCircle ml-3" style="margin-top:10px!important">No<input type="radio" name="radio"><span class="checkmark"></span></label>
</div>
</div>
<div class="clearfix"></div>
<div class="col-md-4">
<label>Graduation Date <span class="red">*</span> <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill:#323847; position: absolute; margin-left:4px;"><path fill-rule="evenodd" clip-rule="evenodd" d="M11 17h2v-6h-2v6zm1-15C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zM11 9h2V7h-2v2z"></path></svg></label>
<input type="date" placeholder="Select Date..." value="" required="">
</div>
<div class="clearfix"></div>
<div class="col-md-4">
<label style="margin-top:0px!important"></label>
<label class="checkRyt" style="margin-top:0px!important">I have the physical certificate for this degree <input type="checkbox" value="3"><span class="checkmark"></span></label>
</div>
<div class="clearfix"></div>
<div class="col-md-12" style="margin-top:40px">
<h3>Address Detail</h3>
</div>
<div class="col-md-4">
<label>Address <span class="red">*</span></label>
<input placeholder="Enter Address Here..." value="" required="">
</div>
<div class="col-md-4">
<label>City/Town <span class="red">*</span></label>
<input placeholder="Enter City/Town..." value="" required="">
</div>
<div class="col-md-4">
<label>Province</label>
<input placeholder="Enter Province..." value="" required="">
</div>
<div class="col-md-4">
<label>Postal/Zip Code</label>
<input placeholder="Enter Postal/Zip Code..." value="" required="">
</div>
<div class="col-md-12"><button class="saveBtn">Save</button><button class="cancelBtn">Cancel</button></div>
</div>

<div class="row SchAtdResult">
<div class="col-md-4 black">
<h3>Bengaluru city University</h3>
<h4>Bachelor of Computer Applications</h4>
</div>
<div class="col-md-8 light">
<h3><svg role="img" width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" style="fill:#58BE91; margin-right:5px"><path fill-rule="evenodd" clip-rule="evenodd" d="M19.707 6.293a1 1 0 010 1.414L9 18.414l-4.707-4.707a1 1 0 111.414-1.414L9 15.586l9.293-9.293a1 1 0 011.414 0z"></path></svg><b>Graduated from Institution</b> January 2, 2021</h3>
<h3><svg role="img" width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" style="fill:#58BE91; margin-right:5px"><path fill-rule="evenodd" clip-rule="evenodd" d="M19.707 6.293a1 1 0 010 1.414L9 18.414l-4.707-4.707a1 1 0 111.414-1.414L9 15.586l9.293-9.293a1 1 0 011.414 0z"></path></svg><b>Level:</b> 3-Year Bachelors Degree</h3>
<h3><b>Attended from</b> January 2, 2018 to January 2, 2021</h3>
<h3><b>Language of instruction:</b> English</h3>
<h3><b>Address:</b><br>
Central College Campus, Dr. B.R, Ambedkar Veedi<br>
Bengaluru, Karnataka 560001<br>
India</h3>
</div>
<div class="col-md-12"><button class="saveBtn">Expand</button><button class="deleteBtn">Delete</button></div>
<div class="col-md-12 bdr"></div>
</div>

<div class="row SchAtdResult">
<div class="col-md-4 black">
<h3>Bengaluru city University</h3>
<h4>Bachelor of Computer Applications</h4>
</div>
<div class="col-md-8 light">
<h3><svg role="img" width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" style="fill:#58BE91; margin-right:5px"><path fill-rule="evenodd" clip-rule="evenodd" d="M19.707 6.293a1 1 0 010 1.414L9 18.414l-4.707-4.707a1 1 0 111.414-1.414L9 15.586l9.293-9.293a1 1 0 011.414 0z"></path></svg><b>Graduated from Institution</b> January 2, 2021</h3>
<h3><svg role="img" width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" style="fill:#58BE91; margin-right:5px"><path fill-rule="evenodd" clip-rule="evenodd" d="M19.707 6.293a1 1 0 010 1.414L9 18.414l-4.707-4.707a1 1 0 111.414-1.414L9 15.586l9.293-9.293a1 1 0 011.414 0z"></path></svg><b>Level:</b> 3-Year Bachelors Degree</h3>
<h3><b>Attended from</b> January 2, 2018 to January 2, 2021</h3>
<h3><b>Language of instruction:</b> English</h3>
<h3><b>Address:</b><br>
Central College Campus, Dr. B.R, Ambedkar Veedi<br>
Bengaluru, Karnataka 560001<br>
India</h3>
</div>
<div class="col-md-12"><button class="saveBtn">Expand</button><button class="deleteBtn">Delete</button></div>
<div class="col-md-12 bdr"></div>
</div>

<div class="row SchAtdResult">
<div class="col-md-4 black">
<h3>Bengaluru city University</h3>
<h4>Bachelor of Computer Applications</h4>
</div>
<div class="col-md-8 light">
<h3><svg role="img" width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" style="fill:#58BE91; margin-right:5px"><path fill-rule="evenodd" clip-rule="evenodd" d="M19.707 6.293a1 1 0 010 1.414L9 18.414l-4.707-4.707a1 1 0 111.414-1.414L9 15.586l9.293-9.293a1 1 0 011.414 0z"></path></svg><b>Graduated from Institution</b> January 2, 2021</h3>
<h3><svg role="img" width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" style="fill:#58BE91; margin-right:5px"><path fill-rule="evenodd" clip-rule="evenodd" d="M19.707 6.293a1 1 0 010 1.414L9 18.414l-4.707-4.707a1 1 0 111.414-1.414L9 15.586l9.293-9.293a1 1 0 011.414 0z"></path></svg><b>Level:</b> 3-Year Bachelors Degree</h3>
<h3><b>Attended from</b> January 2, 2018 to January 2, 2021</h3>
<h3><b>Language of instruction:</b> English</h3>
<h3><b>Address:</b><br>
Central College Campus, Dr. B.R, Ambedkar Veedi<br>
Bengaluru, Karnataka 560001<br>
India</h3>
</div>
<div class="col-md-12"><button class="saveBtn">Expand</button><button class="deleteBtn">Delete</button></div>
<div class="col-md-12 bdr"></div>
</div>

<div class="row SchAtdResult">
<div class="col-md-4 black">
<h3>Bengaluru city University</h3>
<h4>Bachelor of Computer Applications</h4>
</div>
<div class="col-md-8 light">
<h3><svg role="img" width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" style="fill:#58BE91; margin-right:5px"><path fill-rule="evenodd" clip-rule="evenodd" d="M19.707 6.293a1 1 0 010 1.414L9 18.414l-4.707-4.707a1 1 0 111.414-1.414L9 15.586l9.293-9.293a1 1 0 011.414 0z"></path></svg><b>Graduated from Institution</b> January 2, 2021</h3>
<h3><svg role="img" width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" style="fill:#58BE91; margin-right:5px"><path fill-rule="evenodd" clip-rule="evenodd" d="M19.707 6.293a1 1 0 010 1.414L9 18.414l-4.707-4.707a1 1 0 111.414-1.414L9 15.586l9.293-9.293a1 1 0 011.414 0z"></path></svg><b>Level:</b> 3-Year Bachelors Degree</h3>
<h3><b>Attended from</b> January 2, 2018 to January 2, 2021</h3>
<h3><b>Language of instruction:</b> English</h3>
<h3><b>Address:</b><br>
Central College Campus, Dr. B.R, Ambedkar Veedi<br>
Bengaluru, Karnataka 560001<br>
India</h3>
</div>
<div class="col-md-12"><button class="saveBtn">Expand</button><button class="deleteBtn">Delete</button></div>

<div class="col-md-12"><button class="schAtdBtn">Add Attended School<i class="fa fa-plus css-1a2afmv"></i></button></div>

</div>

</div>

<div class="infoContent" id="TestScores">
<div class="row">
<div class="col-md-12">
<h2>Test Scores</h2>
</div>
<div class="col-md-2">
<label>English Exam Type</label>
<select name="">
<option value="">I don't have this</option>
<option value="">I will provide this leter</option>
<option value="">TOEFL</option>
<option value="">IELTS</option>
<option value="">Duolingo English Test</option>
<option value="">PTE</option>
</select>
</div>
<div class="col-md-2">
<label>Date of Exam</label>
<input type="date" placeholder="Select Date..." value="" required="">
</div>
<div class="col-md-2">
<label>Enter Exact Scores</label>
<input type="number" placeholder="Reading" value="" required="">
</div>
<div class="col-md-2">
<label class="hideM">&nbsp;</label>
<input type="number" placeholder="Listening" value="" required="">
</div>
<div class="col-md-2">
<label class="hideM">&nbsp;</label>
<input type="number" placeholder="Speaking" value="" required="">
</div>
<div class="col-md-2">
<label class="hideM">&nbsp;</label>
<input type="number" placeholder="Writing" value="" required="">
</div>

<div class="col-md-12">
<p style="font-size:16px; margin-top:15px">Note: You will be able to apply for conditional admission by enrolling in an ESL program if the academic program does not accept delayed submission of English Language Proficiency scores.</p></div>
<div class="col-md-12"><button class="saveBtn">Save</button><button class="cancelBtn">Cancel</button></div>
</div>
</div>

<div class="infoContent" id="AddQuali">
<div class="row">
<div class="col-md-12">
<h2>Additional Qualifications</h2>
</div>
<div class="col-md-12">
<label>I have GRE exam scores</label>
<div class="OnOff"><input type="checkbox" id="checkbox1" /><label for="checkbox1"></label></div>
</div>
<div class="col-md-3">
<label>Date of Exam</label>
<input type="date" placeholder="Select Date..." value="" required="">
</div>
<div class="col-md-2">
<label>Verbal</label>
<input type="number" placeholder="Score" value="" required="">
<input type="number" placeholder="Rank %" value="" required="" style="margin-top:-1px">
</div>
<div class="col-md-2">
<label>Quantitative</label>
<input type="number" placeholder="Score" value="" required="">
<input type="number" placeholder="Rank %" value="" required="" style="margin-top:-1px">
</div>
<div class="col-md-2">
<label>Writing</label>
<input type="number" placeholder="Score" value="" required="">
<input type="number" placeholder="Rank %" value="" required="" style="margin-top:-1px">
</div>

<div class="col-md-12" style="margin-top:20px">
<label>I have GMAT exam scores</label>
<div class="OnOff"><input type="checkbox" id="checkbox2" /><label for="checkbox2"></label></div>
</div>
<div class="col-md-3">
<label>Date of Exam</label>
<input type="date" placeholder="Select Date..." value="" required="">
</div>
<div class="col-md-2">
<label>Verbal</label>
<input type="number" placeholder="Score" value="" required="">
<input type="number" placeholder="Rank %" value="" required="" style="margin-top:-1px">
</div>
<div class="col-md-2">
<label>Quantitative</label>
<input type="number" placeholder="Score" value="" required="">
<input type="number" placeholder="Rank %" value="" required="" style="margin-top:-1px">
</div>
<div class="col-md-2">
<label>Writing</label>
<input type="number" placeholder="Score" value="" required="">
<input type="number" placeholder="Rank %" value="" required="" style="margin-top:-1px">
</div>
<div class="col-md-2">
<label>Total</label>
<input type="number" placeholder="Score" value="" required="">
<input type="number" placeholder="Rank %" value="" required="" style="margin-top:-1px">
</div>
<div class="col-md-12"><button class="saveBtn">Save</button><button class="cancelBtn">Cancel</button></div>
</div>
</div>

<div class="infoContent" id="BackInfo">
<div class="row">
<div class="col-md-12">
<h2>Background Information</h2>
</div>
<div class="col-md-6">
<label>Have you been refused a visa from Canada, the USA, the United Kingdom, New Zealand or Australia? <i class="fa fa-info-circle" title="The schools listed share biometric information. Hence, visa refusal from these countries might result in a low visa chance approval rate."></i> <span class="red">*</span></label>
<select name="">
<option value="">Select</option>
<option value="">Yes</option>
<option value="">No</option>
</select>
</div>
<div class="col-md-6">
<label>Do you have a valid Study Permit / Visa? <i class="fa fa-info-circle"></i></label>
<select name="">
<option value="">Select</option>
<option value="">Yes</option>
<option value="">No</option>
</select>
</div>
<div class="col-md-12">
<label>If you answered "Yes" to any of the questions above, please provide more details below: <span class="red">*</span></label>
<textarea placeholder="Provide details..." required="" rows="3"></textarea>
</div>
<div class="col-md-12"><button class="saveBtn">Save</button><button class="cancelBtn">Cancel</button></div>
</div>
</div>

<div class="infoContent" id="UplodDoc">
<div class="row">
<div class="col-md-12">
<h2>Upload Documents</h2>
<div class="slogan" style="margin-top:10px">The acceptable formats of the photocopy are .PDF, .JPEG or .PNG</div>
</div>
<div class="col-md-6">
<label>Document Name</label>
<input type="text" placeholder="Enter Document Name..." value="" required="">
</div>
<div class="col-md-6">
<label>Upload Document</label>
<div class="input-group b-0 image-preview">
<input type="text" class="image-preview-filename">
<span class="input-group-btn">
<div class="saveBtn image-preview-input">
<span class="fa fa-folder-open"></span>
<span class="image-preview-input-title">Browse</span>
<input type="file" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/>
</div>
</span>
</div>
</div>
<div class="col-md-12"><button class="saveBtn">Save</button><button class="cancelBtn">Cancel</button></div>
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
scrollTop: $(destination).offset().top - 120
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
$(document).on('click', '#close-preview', function(){
$('.image-preview').popover('hide');
// Hover befor close the preview
$('.image-preview').hover(
function () {
   $('.image-preview').popover('show');
},
 function () {
   $('.image-preview').popover('hide');
}
);
});

$(function() {
// Create the close button
var closebtn = $('<button/>', {
type:"button",
text: 'x',
id: 'close-preview',
style: 'font-size: initial;',
});
closebtn.attr("class","close pull-right");
// Set the popover default content
$('.image-preview').popover({
trigger:'manual',
html:true,
title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
content: "There's no image",
placement:'bottom'
});
// Clear event
$('.image-preview-clear').click(function(){
$('.image-preview').attr("data-content","").popover('hide');
$('.image-preview-filename').val("");
$('.image-preview-clear').hide();
$('.image-preview-input input:file').val("");
$(".image-preview-input-title").text("Browse");
});
// Create the preview image
$(".image-preview-input input:file").change(function (){
var img = $('<img/>', {
id: 'dynamic',
width:250,
height:200
});
var file = this.files[0];
var reader = new FileReader();
// Set preview image into the popover data-content
reader.onload = function (e) {
$(".image-preview-input-title").text("Change");
$(".image-preview-clear").show();
$(".image-preview-filename").val(file.name);
img.attr('src', e.target.result);
$(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
}
reader.readAsDataURL(file);
});
});
</script>
@endsection
