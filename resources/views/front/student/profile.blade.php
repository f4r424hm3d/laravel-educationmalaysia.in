@php

@endphp
@extends('front.layouts.main')
@push('seo_meta_tag')
@include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
<!-- Content -->
<section class="gray pt-5">
  <div class="container-fluid">
    <div class="row">
      @include('front.student.profile-sidebar')
      <div class=" col-lg-9 col-md-9 col-sm-12">

        <!-- NOTIFICATION FIELD START -->
        <x-FrontResultNotification></x-FrontResultNotification>
        <!-- NOTIFICATION FIELD END -->

        <div class="proHead" id="myHeader">
          <ul class="links scrollTo hor-scrlbar" data-gssticky="1">
            <li class="active"><a href="#PerInfo">General Information <i class="fa fa-check-circle green"></i><i
                  class="fa fa-exclamation-circle red"></i></a></li>
            <li class=""><a href="#EduSummary">Education History <i class="fa fa-check-circle green"></i></a></li>
            <li class=""><a href="#TestScores">Test Scores <i class="fa fa-check-circle green"></i></a></li>
            <li class=""><a href="#BackInfo">Background Information <i class="fa fa-check-circle green"></i></a>
            </li>
            <li class=""><a href="#UplodDoc">Upload Documents <i class="fa fa-check-circle green"></i></a></li>
          </ul>
        </div>

        <div class="infoContent mt-3" id="PerInfo">
          <form action="{{ $piurl }}" method="post">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <h2>Personal Information</h2>
                <div class="slogan">(As indicated on your passport)</div>
              </div>
              <div class="col-md-3">
                <label>Full Name <span class="red">*</span></label>
                <input name="name" id="name" placeholder="Enter Full Name" value="<?php echo $student->name; ?>"
                  required>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-4">
                <label>Email <span class="red">*</span></label>
                <input type="email" class=" pif" name="email" id="email" placeholder="Enter email"
                  value="<?php echo $student->email; ?>" required>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-2">
                <label>Country Code <span class="red">*</span></label>
                <select name="c_code" id="c_code" class="pif select2">
                  <option value="" <?php echo $student->c_code == '' ? "Selected" : ''; ?>>Select</option>
                  @foreach ($phonecodes as $phone)
                  <option value="{{ $phone->phonecode }}" {{ $student->c_code == $phone->phonecode ? "Selected" : ''
                    }}>{{ $phone->phonecode }} ({{ $phone->name }}) </option>
                  @endforeach
                </select>
                @error('c_code')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3">
                <label>Mobile <span class="red">*</span></label>
                <input type="text" class=" pif" name="mobile" id="mobile" placeholder="Enter Phone Number"
                  value="<?php echo $student->mobile; ?>" required>
                @error('mobile')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3">
                <label>Father Name <span class="red">*</span></label>
                <input type="text" class=" pif" name="father" id="father" placeholder="Enter Father Name"
                  value="<?php echo $student->father; ?>">
                @error('father')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3">
                <label>Mother Name <span class="red">*</span></label>
                <input type="text" class=" pif" name="mother" id="mother" placeholder="Enter mother Name"
                  value="<?php echo $student->mother; ?>">
                @error('mother')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3">
                <label>Date of Birth <span class="red">*</span></label>
                <input type="date" class=" pif" name="dob" id="dob" placeholder="Enter date of birth"
                  value="<?php echo $student->dob; ?>">
                @error('dob')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3">
                <label>First Language <span class="red">*</span></label>
                <input type="text" class=" pif" name="first_language" id="first_language"
                  placeholder="Enter First Language" value="<?php echo $student->first_language; ?>">
                @error('first_language')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3">
                <label>Country of Citizenship <span class="red">*</span></label>
                <select name="nationality" id="nationality" class=" pif select2">
                  <option value="" <?php echo $student->nationality == '' ? "Selected" : ''; ?>>Select</option>
                  @foreach ($countries as $c)
                  <option value="{{ $c->name }}" {{ $student->nationality == $c->name ? "Selected" : '' }}>{{ $c->name
                    }}</option>
                  @endforeach
                </select>
                @error('nationality')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3">
                <label>Passport Number <i class="fa fa-info-circle"
                    title="We collect your passport information for identity verification purposes, your school or program of interest may require this information to process your application. If applicable, it may also be used for processing your visa."></i>
                  <span class="red">*</span></label>
                <input type="text" class=" pif" name="passport_number" id="passport_number"
                  placeholder="Enter Passport Number" value="<?php echo $student->passport_number; ?>">
                @error('passport_number')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3">
                <label>Passport Expiry Date</label>
                <input type="date" class=" pif" name="passport_expiry" id="passport_expiry"
                  placeholder="Enter Passport Expiry date" value="<?php echo $student->passport_expiry; ?>">
                @error('passport_expiry')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3">
                <label>Marital Status <span class="red">*</span></label>
                <select name="marital_status" id="marital_status" class=" pif select2">
                  <option value="" <?php echo $student->marital_status == '' ? "Selected" : ''; ?>>Select</option>
                  @foreach ($marital_statuses as $ms)
                  <option value="{{ $ms->marital_status }}" {{ $student->marital_status == $ms->marital_status ?
                    "Selected" : '' }}>{{ $ms->marital_status }}</option>
                  @endforeach
                </select>
                @error('marital_status')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3">
                <label>Gender <i class="fa fa-info-circle"></i> <span class="red">*</span></label>
                <select id="gender" name="gender" class=" pif select2">
                  <option value="" <?php echo $student->gender == '' ? "Selected" : ''; ?>>Select</option>
                  @foreach ($genders as $gender)
                  <option value="{{ $gender->gender }}" {{ $student->gender == $gender->gender ? "Selected" : '' }}>{{
                    $gender->gender }}</option>
                  @endforeach
                </select>
                @error('gender')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col-md-12" style="margin-top:40px">
                <h2>
                  Address Detail
                  <span>
                    <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M11 17h2v-6h-2v6zm1-15C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zM11 9h2V7h-2v2z">
                      </path>
                    </svg>
                    Please make sure to enter the student's residential address. Organization address will not be
                    accepted.
                  </span>
                </h2>
              </div>

              <div class="col-md-6">
                <label>Address <span class="red">*</span></label>
                <input type="text" class=" pif" name="home_address" id="home_address" placeholder="Enter address"
                  value="<?php echo $student->home_address; ?>">
                @error('home_address')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3">
                <label>City/Town <span class="red">*</span></label>
                <input type="text" class=" pif" name="city" id="city" placeholder="Enter city"
                  value="<?php echo $student->city; ?>">
                @error('city')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3">
                <label>Province/State <span class="red">*</span></label>
                <input type="text" class=" pif" name="state" id="state" placeholder="Enter state"
                  value="<?php echo $student->state; ?>">
                @error('state')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-4">
                <label>Country <span class="red">*</span></label>
                <select name="country" class=" pif select2">
                  <option value="" <?php echo $student->country == '' ? "Selected" : ''; ?>>Select</option>
                  @foreach ($countries as $c)
                  <option value="{{ $c->name }}" {{ $student->country == $c->name ? "Selected" : '' }}>{{ $c->name
                    }}</option>
                  @endforeach
                </select>
                @error('country')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-4">
                <label>Postal/Zip Code</label>
                <input type="text" class=" pif" name="zip_code" id="zip_code" placeholder="Enter Postal/Zipcode"
                  value="<?php echo $student->zip_code == 0 ? '' : $student->zip_code; ?>">
                @error('zip_code')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-4">
                <label>Home Contact Number <span class="red">*</span></label>
                <input type="text" class=" pif" name="home_contact_number" id="home_contact_number"
                  placeholder="Enter home contact number" value="<?php echo $student->home_contact_number; ?>">
                @error('home_contact_number')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-12">
                <button class="saveBtn" type="submit">Save</button>
                <button class="cancelBtn" type="button">Cancel</button>
              </div>
            </div>
          </form>
        </div>

        <div class="infoContent" id="EduSummary">
          <form action="{{ $eduurl }}" method="post">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <h2>Education Summary</h2>
              </div>
              <div class="col-md-3">
                <label>Country of Education <span class="red">*</span></label>
                <select name="country_of_education" id="country_of_education" class="pif select2">
                  <option value="" <?php echo $student->country_of_education == '' ? "Selected" : ''; ?>>Select</option>
                  @foreach ($countries as $row)
                  <option value="{{ $row->name }}" {{ $student->country_of_education == $row->name ? "Selected" : ''
                    }}>{{ $row->name }}</option>
                  @endforeach
                </select>
                @error('country_of_education')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3">
                <label>Highest Level of Education <span class="red">*</span></label>
                <select name="highest_level_of_education" id="highest_level_of_education" class=" pif select2">
                  <option value="" <?php echo $student->highest_level_of_education == '' ? "Selected" : ''; ?>>Select
                  </option>
                  @foreach ($levels as $row)
                  <option value="{{ $row->level }}" {{ $student->country_of_education == $row->level ? "Selected" : ''
                    }}>{{ $row->level }}</option>
                  @endforeach
                </select>
                @error('highest_level_of_education')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3">
                <label>Grading Scheme <span class="red">*</span></label>
                <select name="grading_scheme" id="grading_scheme" class=" pif select2">
                  <option value="" <?php echo $student->grading_scheme == '' ? "Selected" : ''; ?>>Select</option>
                  <option value="Percentage scale (0-100)" <?php echo $student->grading_scheme == 'Percentage scale
                    (0-100)' ? "Selected" : ''; ?>>Percentage
                    scale (0-100)</option>
                  <option value="Grade Points (10 scale)" <?php echo $student->grading_scheme == 'Grade Points (10
                    scale)' ? "Selected" : ''; ?>>Grade Points
                    (10 scale)</option>
                  <option value="Grade (A to E)" <?php echo $student->grading_scheme == 'Grade (A to E)' ? "Selected" :
                    ''; ?>>Grade (A to E)</option>
                </select>
                @error('grading_scheme')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3">
                <label>Grade Average <span class="red">*</span></label>
                <input type="text" class=" pif" name="grade_average" id="grade_average"
                  placeholder="Enter Grade Average" value="<?php echo $student->grade_average; ?>">
                @error('grade_average')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-12">
                <button class="saveBtn" type="submit">Save</button>
                <button class="cancelBtn" type="button">Cancel</button>
              </div>
            </div>
          </form>
        </div>

        <div class="infoContent" id="SchAtd">
          <div class="row">
            <div class="col-md-12">
              <h2>
                Schools Attended
                <button style="float:right" class="schAtdBtn" onclick="toggleSchoolAttendedForm()">Add Attended School<i
                    class="fa fa-plus css-1a2afmv"></i></button>
              </h2>
            </div>
          </div>
          <hr>
          <form action="{{ $schoolurl }}" method="post" class="school-attended-form hide-this">
            @csrf
            <div class="row">
              <div class="col-md-3">
                <label>Country of Institution <span class="red">*</span></label>
                <select name="country_of_institution" class=" pif select2">
                  <option value="">Select</option>
                  @foreach ($countries as $c)
                  <option value="{{ $c->name }}">{{ $c->name
                    }}</option>
                  @endforeach
                </select>
                @error('country_of_institution')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3">
                <label>Name of Institution <span class="red">*</span></label>
                <input type="text" class="" name="name_of_institution" id="name_of_institution"
                  placeholder="Enter Name of Institution" required>
              </div>
              <div class="col-md-3">
                <label>Level of Education <span class="red">*</span></label>
                <select name="level_of_education" id="level_of_education" class=" pif select2">
                  <option value="">Select
                  </option>
                  @foreach ($levels as $row)
                  <option value="{{ $row->level }}">{{ $row->level }}</option>
                  @endforeach
                </select>
                @error('level_of_education')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3">
                <label>Primary Language of Instruction <span class="red">*</span></label>
                <input type="text" class="" name="primary_language_of_instruction" id="primary_language_of_instruction"
                  placeholder="Enter Primary Language of Instruction" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <label>Attended Institution From <span class="red">*</span></label>
                <input type="date" class="" name="attended_institution_from" id="attended_institution_from"
                  placeholder="Enter Attended Institution From" required>
              </div>
              <div class="col-md-4">
                <label>Attended Institution To <span class="red">*</span></label>
                <input type="date" class="" name="attended_institution_to" id="attended_institution_to"
                  placeholder="Enter Attended Institution to" required>
              </div>
              <div class="col-md-4">
                <label>Degree Name <span class="red">*</span></label>
                <input type="text" class="" name="degree_name" id="degree_name" placeholder="Enter Degree Name">
              </div>
              <div class="clearfix"></div>
              <div class="col-md-4">
                <label style="font-size:18px!important; font-weight:400!important; color:#606a84!important;">I have
                  graduated from this institution <span class="red">*</span></label>
                <label class="checkCircle" style="margin-top:10px!important">
                  Yes
                  <input class="form-check-input" type="radio" name="graduated_from_this" value="1" checked>
                  <span class="checkmark"></span>
                </label>
                <label class="checkCircle" style="margin-top:10px!important">
                  No
                  <input class="form-check-input" type="radio" name="graduated_from_this" value="0">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="clearfix"></div>
              <div class="col-md-4 grdf">
                <label>Graduation Date </label>
                <input type="date" class="" name="graduation_date" id="graduation_date"
                  placeholder="Enter Graduation Date" required>
              </div>
              <div class="clearfix"></div>
              <div class="col-md-4 grdf">
                <label style="margin-top:0px!important"></label>
                <label class="checkRyt" style="margin-top:0px!important">
                  I have the physical certificate for this degree
                  <input class="form-check-input" type="checkbox" name="have_physical_certificate"
                    id="have_physical_certificate" value="1">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="clearfix"></div>
              <div class="col-md-12" style="margin-top:40px">
                <h3>School Address Detail</h3>
              </div>
              <div class="col-md-4">
                <label>Address <span class="red">*</span></label>
                <input type="text" class="" name="address" id="address" placeholder="Enter address" required>
              </div>
              <div class="col-md-3">
                <label>City/Town <span class="red">*</span></label>
                <input type="text" class="" name="city" id="scity" placeholder="Enter city" required>
              </div>
              <div class="col-md-3">
                <label>Province</label>
                <input type="text" class="" name="state" id="sstate" placeholder="Enter State/Province..." required>
              </div>
              <div class="col-md-2">
                <label>Postal/Zip Code</label>
                <input type="number" class="" name="zipcode" id="szipcode" placeholder="Enter Postal/Zipcode">
              </div>

              <div class="col-md-12">
                <button class="saveBtn" type="submit">Save</button>
                <button class="cancelBtn" type="button">Cancel</button>
              </div>
            </div>
          </form>
          @foreach ($schools as $row)
          <div class="row SchAtdResult" id="schitem{{ $row->id }}">
            <div class="col-md-4 black">
              <h3>
                <?php echo $row->name_of_institution; ?>
              </h3>
              <h4>
                <?php echo $row->degree_name; ?>
              </h4>
            </div>
            <div class="col-md-8 light">
              <?php if ($row->graduated_from_this == 1) { ?>
              <h3>
                <svg role="img" width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                  style="fill:#58BE91; margin-right:5px">
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M19.707 6.293a1 1 0 010 1.414L9 18.414l-4.707-4.707a1 1 0 111.414-1.414L9 15.586l9.293-9.293a1 1 0 011.414 0z">
                  </path>
                </svg>
                <b>Graduated from Institution</b>
                <?php echo getFormattedDate($row->graduation_date, 'd M , Y'); ?>
              </h3>
              <?php if ($row->have_physical_certificate == 1) { ?>
              <h3>
                <svg role="img" width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                  style="fill:#58BE91; margin-right:5px">
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M19.707 6.293a1 1 0 010 1.414L9 18.414l-4.707-4.707a1 1 0 111.414-1.414L9 15.586l9.293-9.293a1 1 0 011.414 0z">
                  </path>
                </svg>
                <b>Level:</b> 3-Year Bachelors Degree
              </h3>
              <?php } ?>
              <?php } ?>
              <h3>
                <b>Level:</b>
                <?php echo $row->level_of_education; ?>
              </h3>
              <h3>
                Attended from</b>
                <?php echo getFormattedDate($row->attended_institution_from, 'd M , Y'); ?> <b>to</b>
                <?php echo getFormattedDate($row->attended_institution_to, 'd M , Y'); ?>
              </h3>
              <h3>
                <b>Language of instruction:</b>
                <?php echo $row->primary_language_of_instruction; ?>
              </h3>
              <h3>
                <b>Address:</b>
                <?php echo $row->address; ?>,
                <?php echo $row->city; ?>,
                <?php echo $row->state; ?>
                <?php echo $row->zipcode; ?><br>
                <?php echo $row->country_of_institution; ?>
              </h3>
            </div>
            <div class="col-md-12">
              <button onclick="schItemTgl('<?php echo $row->id; ?>')" class="saveBtn">Expand</button>
              <button onclick="dltsch('<?php echo $row->id; ?>')" class="deleteBtn">Delete</button>
            </div>
            <div class="col-md-12 bdr"></div>
          </div>
          <div class="hide-this" id="schitemeditform{{ $row->id }}">
            <form action="{{ $editschoolurl }}" method="post" class="school-attended-form-edit">
              @csrf
              <input type="hidden" name="id" value="{{ $row->id }}">
              <div class="row">
                <div class="col-md-3">
                  <label>Country of Institution <span class="red">*</span></label>
                  <select name="country_of_institution" class=" pif select2">
                    <option value="">Select</option>
                    @foreach ($countries as $c)
                    <option value="{{ $c->name }}" {{ $c->name==$row->country_of_institution?'selected':'' }}>{{
                      $c->name }}</option>
                    @endforeach
                  </select>
                  @error('country_of_institution')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-md-3">
                  <label>Name of Institution <span class="red">*</span></label>
                  <input type="text" class="" name="name_of_institution" id="name_of_institution"
                    placeholder="Enter Name of Institution" value="{{ $row->name_of_institution }}" required>
                </div>
                <div class="col-md-3">
                  <label>Level of Education <span class="red">*</span></label>
                  <select name="level_of_education" id="level_of_education" class=" pif select2">
                    <option value="">Select
                    </option>
                    @foreach ($levels as $l)
                    <option value="{{ $l->level }}" {{ $l->level==$row->level_of_education?'selected':'' }}>{{ $l->level
                      }}</option>
                    @endforeach
                  </select>
                  @error('level_of_education')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-md-3">
                  <label>Primary Language of Instruction <span class="red">*</span></label>
                  <input type="text" class="" name="primary_language_of_instruction"
                    id="primary_language_of_instruction" placeholder="Enter Primary Language of Instruction"
                    value="{{ $row->primary_language_of_instruction }}" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <label>Attended Institution From <span class="red">*</span></label>
                  <input type="date" class="" name="attended_institution_from" id="attended_institution_from"
                    placeholder="Enter Attended Institution From" value="{{ $row->attended_institution_from }}"
                    required>
                </div>
                <div class="col-md-4">
                  <label>Attended Institution To <span class="red">*</span></label>
                  <input type="date" class="" name="attended_institution_to" id="attended_institution_to"
                    placeholder="Enter Attended Institution to" value="{{ $row->attended_institution_to }}" required>
                </div>
                <div class="col-md-4">
                  <label>Degree Name <span class="red">*</span></label>
                  <input type="text" class="" name="degree_name" id="degree_name" placeholder="Enter Degree Name"
                    value="{{ $row->degree_name }}">
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4">
                  <label style="font-size:18px!important; font-weight:400!important; color:#606a84!important;">I have
                    graduated from this institution <span class="red">*</span></label>
                  <label class="checkCircle" style="margin-top:10px!important">
                    Yes
                    <input class="form-check-input" type="radio" name="graduated_from_this" value="1" <?php echo
                      $row->graduated_from_this == '1' ? 'checked' : ''; ?>>
                    <span class="checkmark"></span>
                  </label>
                  <label class="checkCircle" style="margin-top:10px!important">
                    No
                    <input class="form-check-input" type="radio" name="graduated_from_this" value="0" <?php echo
                      $row->graduated_from_this == '0' ? 'checked' : ''; ?>>
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4 grdf">
                  <label>Graduation Date </label>
                  <input type="date" class="" name="graduation_date" id="graduation_date"
                    placeholder="Enter Graduation Date" value="<?php echo $row->graduation_date; ?>" required>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4 grdf">
                  <label style="margin-top:0px!important"></label>
                  <label class="checkRyt" style="margin-top:0px!important">
                    I have the physical certificate for this degree
                    <input class="form-check-input" type="checkbox" name="have_physical_certificate"
                      id="have_physical_certificate" value="1" <?php echo $row->have_physical_certificate == '1' ?
                    'checked' : ''; ?>>
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12" style="margin-top:40px">
                  <h3>School Address Detail</h3>
                </div>
                <div class="col-md-4">
                  <label>Address <span class="red">*</span></label>
                  <input type="text" class="" name="address" id="address" placeholder="Enter address"
                    value="<?php echo $row->address; ?>" required>
                </div>
                <div class="col-md-3">
                  <label>City/Town <span class="red">*</span></label>
                  <input type="text" class="" name="city" id="scity" placeholder="Enter city"
                    value="<?php echo $row->city; ?>" required>
                </div>
                <div class="col-md-3">
                  <label>Province</label>
                  <input type="text" class="" name="state" id="sstate" placeholder="Enter State/Province..."
                    value="<?php echo $row->state; ?>" required>
                </div>
                <div class="col-md-2">
                  <label>Postal/Zip Code</label>
                  <input type="number" class="" name="zipcode" id="szipcode" value="<?php echo $row->zipcode; ?>"
                    placeholder="Enter Postal/Zipcode">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button class="saveBtn" type="submit">Save</button>
                  <button class="cancelBtn" type="button" onclick="schItemTgl('{{ $row->id }}')">Cancel</button>
                </div>
              </div>
            </form>
          </div>
          @endforeach
        </div>

        <div class="infoContent" id="TestScores">
          <form action="{{ url('student/update-test-score/') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <h2>Test Scores</h2>
              </div>
              <div class="col-md-2">
                <label>English Exam Type</label>
                <select name="english_exam_type" id="english_exam_type" class=" pif select2"
                  onchange="testScoreMagic()">
                  <option value="" <?php echo $student->english_exam_type == '' ? "Selected" : ''; ?>>Select</option>
                  <?php
                  $exmtype = ["I dont have this", "I will provide this later", "TOEFL", "IELTS", "Duolingo English Test", "PTE"];
                  foreach ($exmtype as $exmtyp) {
                  ?>
                  <option value="<?php echo $exmtyp; ?>" <?php echo $student->english_exam_type == $exmtyp ? "Selected"
                    : ''; ?>>
                    <?php echo $exmtyp; ?>
                  </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-2 allfh" id="date_of_exam_div">
                <label>Date of Exam</label>
                <input type="date" class=" pif" name="date_of_exam" id="date_of_exam" placeholder="Enter Grade Average"
                  value="<?php echo $student->date_of_exam; ?>">
              </div>
              <div class="col-md-2 allfh testpartsdiv" id="listening_score_div">
                <label>Listening</label>
                <input type="number" class=" pif" name="listening_score" id="listening_score"
                  placeholder="Enter Exact Score Listening" value="<?php echo $student->listening_score; ?>" step="any"
                  min="0">
              </div>
              <div class="col-md-2 allfh testpartsdiv" id="reading_score_div">
                <label class="hideM">Reading</label>
                <input type="number" class=" pif" name="reading_score" id="reading_score"
                  placeholder="Enter Exact Score Reading" value="<?php echo $student->reading_score; ?>" step="any"
                  min="0">
              </div>
              <div class="col-md-2 allfh testpartsdiv" id="writing_score_div">
                <label class="hideM">Writing</label>
                <input type="number" class=" pif" name="writing_score" id="writing_score"
                  placeholder="Enter Exact Score Writing" value="<?php echo $student->writing_score; ?>" step="any"
                  min="0">
              </div>
              <div class="col-md-2 allfh testpartsdiv" id="speaking_score_div">
                <label class="hideM">Speaking</label>
                <input type="number" class=" pif" name="speaking_score" id="speaking_score"
                  placeholder="Enter Exact Score Speaking" value="<?php echo $student->speaking_score; ?>" step="any"
                  min="0">
              </div>
              <div class="col-md-2 allfh" id="overall_score_div">
                <label class="hideM">Overall Score</label>
                <input type="number" class=" pif" name="overall_score" id="overall_score"
                  placeholder="Enter Exact overall score" value="<?php echo $student->overall_score; ?>" step="any"
                  min="0">
              </div>
              <div class="col-md-12">
                <button class="saveBtn" type="submit">Save</button>
                <button class="cancelBtn" type="button">Cancel</button>
              </div>
            </div>
          </form>
        </div>

        <div class="infoContent" id="AddQuali">
          <div class="row">
            <div class="col-md-12">
              <h2>Additional Qualifications</h2>
            </div>
          </div>
          <form action="<?php echo url('student/update-gre-score'); ?>" method="post">
            @csrf
            <input type="hidden" name="id" value="<?php echo $student->id; ?>">
            <div class="row">
              <div class="col-md-12">
                <label>I have GRE exam scores</label>
                <div class="OnOff">
                  <input onclick="toggleGRE()" type="checkbox" name="gre" id="gre" <?php echo $student->gre == '1' ?
                  'checked' : ''; ?> value="1">
                  <label for="gre"></label>
                </div>
              </div>
            </div>
            <div class="<?php echo $student->gre == '0' || $student->gre == null ? 'hide-this' : ''; ?>" id="greDiv">
              <div class="row">
                <div class="col-md-3">
                  <label>Date of Exam</label>
                  <input type="date" class="" name="gre_exam_date" placeholder="Exam Date"
                    value="<?php echo $student->gre_exam_date; ?>" required>
                </div>
                <div class="col-md-2">
                  <label>Verbal</label>
                  <input type="number" class="" name="gre_v_score" placeholder="Score"
                    value="<?php echo $student->gre_v_score; ?>" max="170" step="any" min="0" required>
                  <input type="number" class="" name="gre_v_rank" placeholder="Rank"
                    value="<?php echo $student->gre_v_rank; ?>" step="any" max="100" min="0" required>
                </div>
                <div class="col-md-2">
                  <label>Quantitative</label>
                  <input type="number" class="" name="gre_q_score" placeholder="Score"
                    value="<?php echo $student->gre_q_score; ?>" max="170" step="any" min="0" required>
                  <input type="number" class="" name="gre_q_rank" placeholder="Rank"
                    value="<?php echo $student->gre_q_rank; ?>" step="any" max="100" min="0" required>
                </div>
                <div class="col-md-2">
                  <label>Writing</label>
                  <input type="number" class="" name="gre_w_score" placeholder="Score"
                    value="<?php echo $student->gre_w_score; ?>" max="6" step="any" min="0" required>
                  <input type="number" class="" name="gre_w_rank" placeholder="Rank"
                    value="<?php echo $student->gre_w_rank; ?>" step="any" max="100" min="0" required>
                </div>
                <div class="col-md-12">
                  <button class="saveBtn" type="submit">Save</button>
                  <button class="cancelBtn" type="reset">Cancel</button>
                </div>
              </div>
            </div>
          </form>

          <form action="<?php echo url('student/update-gmat-score'); ?>" method="post">
            @csrf
            <input type="hidden" name="id" value="<?php echo $student->id; ?>">
            <div class="row">
              <div class="col-md-12" style="margin-top:20px">
                <label>I have GMAT exam scores</label>
                <div class="OnOff">
                  <input onclick="toggleGMAT()" type="checkbox" name="gmat" id="gmat" <?php echo $student->gmat == '1' ?
                  'checked' : ''; ?> value="1">
                  <label for="gmat"></label>
                </div>
              </div>
            </div>
            <div class="<?php echo $student->gmat == '0' || $student->gmat == null ? 'hide-this' : ''; ?>" id="gmatDiv">
              <div class="row">
                <div class="col-md-2">
                  <label>Date of Exam</label>
                  <input type="date" class="" name="gmat_exam_date" placeholder="Exam Date"
                    value="<?php echo $student->gmat_exam_date; ?>" required>
                </div>
                <div class="col-md-2">
                  <label>Verbal</label>
                  <input type="number" class="" name="gmat_v_score" placeholder="Score"
                    value="<?php echo $student->gmat_v_score; ?>" max="51" min="0" step="any" required>
                  <input type="number" class="" name="gmat_v_rank" placeholder="Rank"
                    value="<?php echo $student->gmat_v_rank; ?>" step="any" max="100" min="0" required>
                </div>
                <div class="col-md-2">
                  <label>Quantitative</label>
                  <input type="number" class="" name="gmat_q_score" placeholder="Score"
                    value="<?php echo $student->gmat_q_score; ?>" max="51" min="0" step="any" required>
                  <input type="number" class="" name="gmat_q_rank" placeholder="Rank"
                    value="<?php echo $student->gmat_q_rank; ?>" step="any" max="100" min="0" required>
                </div>
                <div class="col-md-2">
                  <label>Writing</label>
                  <input type="number" class="" name="gmat_w_score" placeholder="Score"
                    value="<?php echo $student->gmat_w_score; ?>" max="6" min="0" step="any" required>
                  <input type="number" class="" name="gmat_w_rank" placeholder="Rank"
                    value="<?php echo $student->gmat_w_rank; ?>" step="any" max="100" min="0" required>
                </div>
                <div class="col-md-2">
                  <label>Integrated reasoning</label>
                  <input type="number" class="" name="gmat_ir_score" placeholder="Score"
                    value="<?php echo $student->gmat_ir_score; ?>" max="8" min="0" step="any">
                  <input type="number" class="" name="gmat_ir_rank" placeholder="Rank"
                    value="<?php echo $student->gmat_ir_rank; ?>" step="any" max="100" min="0">
                </div>
                <div class="col-md-2">
                  <label>Total</label>
                  <input type="number" class="" name="gmat_total_score" placeholder="Score"
                    value="<?php echo $student->gmat_total_score; ?>" min="200" max="800" step="any" required>
                  <input type="number" class="" name="gmat_total_rank" placeholder="Rank"
                    value="<?php echo $student->gmat_total_rank; ?>" step="any" max="100" min="0" required>
                </div>
                <div class="col-md-12">
                  <button class="saveBtn" type="submit">Save</button>
                  <button class="cancelBtn" type="reset">Cancel</button>
                </div>
              </div>
            </div>
          </form>

          <form action="<?php echo url('student/update-sat-score'); ?>" method="post">
            @csrf
            <input type="hidden" name="id" value="<?php echo $student->id; ?>">
            <div class="row">
              <div class="col-md-12" style="margin-top:20px">
                <label>I have SAT exam scores</label>
                <div class="OnOff">
                  <input onclick="toggleSAT()" type="checkbox" name="sat" id="sat" <?php echo $student->sat == '1' ?
                  'checked' : ''; ?> value="1">
                  <label for="sat"></label>
                </div>
              </div>
            </div>
            <div class="<?php echo $student->sat == '0' || $student->sat == null ? 'hide-this' : ''; ?>" id="satDiv">
              <div class="row">
                <div class="col-md-3">
                  <label>Date of Exam</label>
                  <input type="date" class="" name="sat_exam_date" placeholder="Exam Date"
                    value="<?php echo $student->sat_exam_date; ?>" required>
                </div>
                <div class="col-md-2">
                  <label>Reasoing Test Points</label>
                  <input type="number" class="" name="sat_reasoning_point" placeholder="SAT Reasoning Point"
                    value="<?php echo $student->sat_reasoning_point; ?>" step="any" min="0" max="1600" required>
                </div>
                <div class="col-md-2">
                  <label>SAT Subject Test Point</label>
                  <input type="number" class="" name="sat_subject_point" placeholder="SAT Subject Points"
                    value="<?php echo $student->sat_subject_point; ?>" step="any" min="0" max="800" required>
                </div>
                <div class="col-md-12">
                  <button class="saveBtn" type="submit">Save</button>
                  <button class="cancelBtn" type="reset">Cancel</button>
                </div>
              </div>
            </div>
          </form>
        </div>

        <div class="infoContent" id="BackInfo">
          <form action="{{ url('student/update-background-info') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="<?php echo $student->id; ?>">
            <div class="row">
              <div class="col-md-12">
                <h2>Background Information</h2>
              </div>
              <div class="col-md-6">
                <label>Have you been refused a visa from Canada, USA, UK, Australia more...? <i
                    class="fa fa-info-circle"
                    title="The schools listed share biometric information. Hence, visa refusal from these countries might result in a low visa chance approval rate."></i>
                  <span class="red">*</span></label>
                <select class=" select2" name="refused_visa">
                  <option value="" <?php echo $student->refused_visa == '' ? 'Selected' : ''; ?>>Select</option>
                  <option value="Yes" <?php echo $student->refused_visa == 'Yes' ? 'Selected' : ''; ?>>Yes</option>
                  <option value="No" <?php echo $student->refused_visa == 'No' ? 'Selected' : ''; ?>>No</option>
                </select>
                @error('refused_visa')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label>Do you have a valid Study Permit / Visa? <i class="fa fa-info-circle"></i></label>
                <select class=" select2" name="valid_study_permit">
                  <option value="" <?php echo $student->valid_study_permit == '' ? 'Selected' : ''; ?>>Select</option>
                  <option value="Yes" <?php echo $student->valid_study_permit == 'Yes' ? 'Selected' : ''; ?>>Yes
                  </option>
                  <option value="No" <?php echo $student->valid_study_permit == 'No' ? 'Selected' : ''; ?>>No</option>
                </select>
                @error('valid_study_permit')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-12">
                <label>If you answered "Yes" to any of the questions above, please provide more details below: <span
                    class="red">*</span></label>
                <textarea class="" name="visa_note"><?php echo $student->visa_note; ?></textarea>
                @error('visa_note')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-12">
                <button class="saveBtn" type="submit">Save</button>
                <button class="cancelBtn" type="button">Cancel</button>
              </div>
            </div>
          </form>
        </div>
        <div class="infoContent" id="UplodDoc">
          <form action="{{ url('student/upload-documents') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <h2>Upload Documents</h2>
                <div class="slogan" style="margin-top:10px">The acceptable formats of the photocopy are .PDF, .JPEG or
                  .PNG</div>
              </div>
              <div class="col-md-6">
                <label>Document Name</label>
                <input type="text" name="document_name" placeholder="Enter Document Name..."
                  value="{{ old('document_name') }}">
                @error('document_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label>Upload Document</label>
                <div class="input-group b-0 image-preview">
                  <input type="text" class="image-preview-filename">
                  <span class="input-group-btn">
                    <div class="saveBtn image-preview-input">
                      <span class="fa fa-folder-open"></span>
                      <span class="image-preview-input-title">Browse</span>
                      <input type="file" accept="image/png, image/jpeg, image/gif" name="doc" />
                    </div>
                  </span>
                  @error('doc')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-12">
                <button class="saveBtn" type="submit">Save</button>
                <button class="cancelBtn" type="button">Cancel</button>
              </div>
            </div>
          </form>
        </div>
        @if ($stdDocs->count()>0)
        <div class="infoContent" id="docTbl">
          <div class="row">
            <div class="col-md-12">
              <h2>Uploaded Documents</h2>
            </div>
          </div>
          <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
              <tr>
                <th>S.N.</th>
                <th>Doc Name</th>
                <th>File</th>
                {{-- <th>Action</th> --}}
              </tr>
            </thead>
            <tbody>
              @php
              $i = 1;
              @endphp
              @foreach ($stdDocs as $row)
              <tr>
                <td scope="row">{{ $i }}</td>
                <td>{{ $row->document_name }}</td>
                <td>
                  <a target="blank" href="{{ asset($row->file_path) }}" class="btn btn-sm btn-info">View</a> | <a
                    target="blank" href="{{ asset($row->file_path) }}" class="btn btn-sm btn-secondary"
                    download>Download</a>
                </td>
              </tr>
              @php
              $i++;
              @endphp
              @endforeach
            </tbody>
          </table>
        </div>
        @endif
      </div>
    </div>
  </div>
</section>
<!-- Content -->
<script>
  function toggleGRE() {
    var radioValue = $("input[name='gre']:checked").val();
    //alert(radioValue);
    if (radioValue == undefined) {
      $("#greDiv").hide();
    } else if (radioValue == '1') {
      $("#greDiv").show();
    }
  }

  function toggleGMAT() {
    var radioValue = $("input[name='gmat']:checked").val();
    //alert(radioValue);
    if (radioValue == undefined) {
      $("#gmatDiv").hide();
    } else if (radioValue == '1') {
      $("#gmatDiv").show();
    }
  }

  function toggleSAT() {
    var radioValue = $("input[name='sat']:checked").val();
    //alert(radioValue);
    if (radioValue == undefined) {
      $("#satDiv").hide();
    } else if (radioValue == '1') {
      $("#satDiv").show();
    }
  }

  $(document).ready(function () {
    testScoreMagic();
    $("#english_exam_type").on("change", function (event) {
      testScoreMagic();
    });
    gradeSystem();
    $("#grading_scheme").on("change", function (event) {
      gradeSystem();
    });
  });

  function schItemTgl(id) {
    //alert(id);
    $("#schitem" + id).toggle();
    $("#schitemeditform" + id).toggle();
  }


  function dltsch(id) {
    //alert(id);
    var deleteConfirm = confirm("Are you sure?");
    if (deleteConfirm == true) {
      if (id != '') {
        $.ajax({
          url: "{{ url('/student/delete-school/') }}/" + id,
          method: "GET",
          success: function (data) {
            $("#schitem" + id).remove();
            var msg = 'Record has been deleted successfully.';
            var ty = 'success';
            showToast(msg, ty);
          }
        });
      }
    }
  }

  function editSchool(id) {
    alert(id);
    var deleteConfirm = confirm("Are you sure?");
    if (deleteConfirm == true) {
      if (id != '') {
        $.ajax({
          url: "{{ url('/student/delete-school/') }}/" + id,
          method: "GET",
          success: function (data) {
            $("#schitem" + id).remove();
            var msg = 'Record has been deleted successfully.';
            var ty = 'success';
            showToast(msg, ty);
          }
        });
      }
    }
  }

  function toggleSchoolAttendedForm() {
    $(".school-attended-form").toggle();
  }

  $(document).ready(function () {
    $("input[name='graduated_from_this']").on("click", function (event) {
      var radioValue = $("input[name='graduated_from_this']:checked").val();
      if (radioValue == '0') {
        $(".grdf").hide();
        $("#graduation_date").attr("required", false);
      } else if (radioValue == '1') {
        $(".grdf").show();
        $("#graduation_date").attr("required", true);
      }
    });
  });

  function testScoreMagic() {
    var eet = $("#english_exam_type").val();
    if (eet == 'I dont have this' || eet == 'I will provide this later') {
      $("#date_of_exam_div,#listening_score_div,#reading_score_div,#writing_score_div,#speaking_score_div,#overall_score_div")
        .hide();
    }
    if (eet == 'TOEFL') {
      $("#listening_score_div,#reading_score_div,#writing_score_div,#speaking_score_div").show();
      $("#overall_score_div").hide();
      $("#listening_score,#reading_score,#writing_score,#speaking_score").attr("max", "30");
    }
    if (eet == 'IELTS') {
      $("#date_of_exam_div,#listening_score_div,#reading_score_div,#writing_score_div,#speaking_score_div").show();
      $("#overall_score_div").hide();
      $("#listening_score,#reading_score,#writing_score,#speaking_score").attr("max", "9");
    }
    if (eet == 'Duolingo English Test') {
      $("#listening_score_div,#reading_score_div,#writing_score_div,#speaking_score_div").hide();
      $("#date_of_exam_div,#overall_score_div").show();
      $("#overall_score").attr("max", "160");
    }
    if (eet == 'PTE') {
      $("#listening_score_div,#reading_score_div,#writing_score_div,#speaking_score_div,#date_of_exam_div,#overall_score_div")
        .show();
      $("#listening_score,#reading_score,#writing_score,#speaking_score,#overall_score").attr("max", "90");
    }
  }

  function gradeSystem() {
    var eet = $("#grading_scheme").val();
    if (eet == 'Percentage scale (0-100)') {
      $("#grade_average").attr("max", "100");
    }
    if (eet == 'Grade Points (10 scale)') {
      $("#grade_average").attr("max", "10");
    }
  }

  $(document).ready(function () {
    $('#testscoreform').on('submit', function (event) {
      event.preventDefault();
      $.ajax({
        url: "<?php echo url('Common/updateStudentDetail'); ?>",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (result) {
          location.reload(true);
        }
      })
    });
  });

  jQuery(document).ready(function ($) {
    $(function () {
      $(".scrollTo a").click(function (e) {
        var destination = $(this).attr('href');
        $(".scrollTo li").removeClass('active');
        $(this).parent().addClass('active');

        $('html, body').animate({
          scrollTop: $(destination).offset().top - 90
        }, 500);
      });
    });
    var totalHeight = $('#myHeader').height() + $('.proHead').height();
    $(window).scroll(function () {
      if ($(this).scrollTop() > totalHeight) {
        $('.proHead').addClass('sticky');
      } else {
        $('.proHead').removeClass('sticky');
      }
    })
  });
</script>
<script>
  $(document).on('click', '#close-preview', function () {
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

  $(function () {
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
    $('.image-preview-clear').click(function () {
      $('.image-preview').attr("data-content", "").popover('hide');
      $('.image-preview-filename').val("");
      $('.image-preview-clear').hide();
      $('.image-preview-input input:file').val("");
      $(".image-preview-input-title").text("Browse");
    });
    // Create the preview image
    $(".image-preview-input input:file").change(function () {
      var img = $('<img/>', {
        id: 'dynamic',
        width: 250,
        height: 200
      });
      var file = this.files[0];
      var reader = new FileReader();
      // Set preview image into the popover data-content
      reader.onload = function (e) {
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
  $("#upload").click(function () {
    $("#upload-file").trigger('click');
  });
</script>
@endsection