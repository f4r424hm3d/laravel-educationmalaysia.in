<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Gender;
use App\Models\Level;
use App\Models\MaritalStatus;
use App\Models\StudentSchool;
use App\Models\ShortlistedProgram;
use App\Models\Lead;
use App\Models\StudentApplication;
use App\Models\StudentDocument;
use Illuminate\Http\Request;

class StudentFc extends Controller
{
  public function profile()
  {
    $id = session()->get('student_id');
    $student = Lead::find($id);

    $phonecodes = Country::orderBy('phonecode')->groupBy('phonecode')->where('phonecode', '!=', '0')->get();
    $countries = Country::orderBy('name')->get();
    $genders = Gender::all();
    $marital_statuses = MaritalStatus::all();
    $levels = Level::all();
    $schools = StudentSchool::where('std_id', $id)->get();
    $stdDocs = StudentDocument::where('std_id', $id)->get();

    $piurl = url('student/personal-information');
    $eduurl = url('student/education-summary');
    $schoolurl = url('student/add-school');
    $editschoolurl = url('student/update-school');

    $data = compact('student', 'countries', 'marital_statuses', 'genders', 'phonecodes', 'piurl', 'levels', 'eduurl', 'schoolurl', 'schools', 'editschoolurl', 'stdDocs');
    return view('front.student.profile')->with($data);
  }
  public function editProfile()
  {
    $id = session()->get('student_id');
    $student = Lead::find($id);
    $data = compact('student');
    return view('front.student.edit-profile')->with($data);
  }
  public function updateProfile(Request $request)
  {
    $request->validate(
      [
        'name' => 'required|regex:/^[a-zA-Z ]*$/',
        'gender' => 'required|in:Male,Female,Other',
        'c_code' => 'required|numeric',
        'mobile' => 'required|numeric',
        'dob' => 'required|date',
        'nationality' => 'required',
        'city' => 'regex:/^[a-zA-Z ]*$/',
        'state' => 'regex:/^[a-zA-Z ]*$/',
        'country' => 'regex:/^[a-zA-Z ]*$/',
      ]
    );
    $field = Lead::find($request['id']);
    $field->name = $request['name'];
    $field->gender = $request['gender'];
    $field->dob = $request['dob'];
    $field->nationality = $request['nationality'];
    $field->c_code = $request['c_code'];
    $field->mobile = $request['mobile'];
    $field->city = $request['city'];
    $field->state = $request['state'];
    $field->country = $request['country'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('profile');
  }
  public function viewChangePassword()
  {
    $id = session()->get('student_id');
    $student = Lead::find($id);
    $data = compact('student');
    return view('front.student.change-password')->with($data);
  }
  public function changePassword(Request $request)
  {
    $id = session()->get('student_id');
    $student = Lead::find($id);

    $request->validate(
      [
        'old_password' => 'required|in:' . $student->password,
        'new_password' => 'required|min:8',
        'confirm_new_password' => 'required|min:8|same:new_password',
      ]
    );
    $field = Lead::find($request['id']);
    $field->password = $request['new_password'];
    $field->save();
    session()->flash('smsg', 'Password has been changed.');
    return redirect('student/change-password');
  }
  public function appliedCollege()
  {
    $id = session()->get('student_id');
    $student = Lead::find($id);
    $appliedprograms = StudentApplication::active()->where('stdid', $id)->get();
    $data = compact('student', 'appliedprograms');
    //die;
    return view('front.student.applied-colleges')->with($data);
  }
  public function shortlist()
  {
    $id = session()->get('student_id');
    $student = Lead::find($id);
    $rows = StudentApplication::inActive()->where('stdid', $id)->get();
    $data = compact('student', 'rows');
    return view('front.student.shortlist')->with($data);
  }
  public function settings()
  {
    $id = session()->get('student_id');
    $student = Lead::find($id);
    $data = compact('student');
    return view('front.student.account-settings')->with($data);
  }
  public function submitPersonalInfo(Request $request)
  {
    $id = session()->get('student_id');
    $request->validate(
      [
        'name' => 'required|regex:/^[a-zA-Z ]*$/',
        'email' => 'required',
        'c_code' => 'required|numeric',
        'mobile' => 'required|numeric',
        'father' => 'required',
        'mother' => 'required',
        'dob' => 'required|date',
        'first_language' => 'required',
        'nationality' => 'required',
        'passport_number' => 'required',
        'passport_expiry' => 'required|date',
        'marital_status' => 'required',
        'gender' => 'required',
        'home_address' => 'required',
        'city' => 'regex:/^[a-zA-Z ]*$/',
        'state' => 'regex:/^[a-zA-Z ]*$/',
        'country' => 'regex:/^[a-zA-Z ]*$/',
        'zip_code' => 'required',
        'home_contact_number' => 'required|numeric',
      ]
    );
    $field = Lead::find($id);
    $field->name = $request['name'];
    $field->email = $request['email'];
    $field->c_code = $request['c_code'];
    $field->mobile = $request['mobile'];
    $field->father = $request['father'];
    $field->mother = $request['mother'];
    $field->dob = $request['dob'];
    $field->first_language = $request['first_language'];
    $field->nationality = $request['nationality'];
    $field->passport_number = $request['passport_number'];
    $field->passport_expiry = $request['passport_expiry'];
    $field->marital_status = $request['marital_status'];
    $field->gender = $request['gender'];
    $field->home_address = $request['home_address'];
    $field->city = $request['city'];
    $field->state = $request['state'];
    $field->country = $request['country'];
    $field->zip_code = $request['zip_code'];
    $field->home_contact_number = $request['home_contact_number'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('student/profile');
  }
  public function submitEduSum(Request $request)
  {
    $id = session()->get('student_id');
    $request->validate(
      [
        'country_of_education' => 'required',
        'highest_level_of_education' => 'required',
        'grading_scheme' => 'required',
        'grade_average' => 'required',
      ]
    );
    $field = Lead::find($id);
    $field->country_of_education = $request['country_of_education'];
    $field->highest_level_of_education = $request['highest_level_of_education'];
    $field->grading_scheme = $request['grading_scheme'];
    $field->grade_average = $request['grade_average'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('student/profile');
  }
  public function addSchool(Request $request)
  {
    $id = session()->get('student_id');
    // printArray($request->toArray());
    // die;
    $request->validate(
      [
        'country_of_institution' => 'required',
        'name_of_institution' => 'required',
        'level_of_education' => 'required',
        'primary_language_of_instruction' => 'required',
        'attended_institution_from' => 'required',
        'attended_institution_to' => 'required',
        'degree_name' => 'required',
        'graduated_from_this' => 'required',
        'address' => 'required',
        'city' => 'required',
        'state' => 'required',
        'zipcode' => 'required',
      ]
    );
    $field = new StudentSchool;
    $field->std_id = $id;
    $field->country_of_institution = $request['country_of_institution'];
    $field->name_of_institution = $request['name_of_institution'];
    $field->level_of_education = $request['level_of_education'];
    $field->primary_language_of_instruction = $request['primary_language_of_instruction'];
    $field->attended_institution_from = $request['attended_institution_from'];
    $field->attended_institution_to = $request['attended_institution_to'];
    $field->degree_name = $request['degree_name'];
    $field->graduated_from_this = $request['graduated_from_this'];
    $field->graduation_date = $request['graduation_date'];
    $field->have_physical_certificate = $request['have_physical_certificate'];
    $field->address = $request['address'];
    $field->city = $request['city'];
    $field->state = $request['state'];
    $field->zipcode = $request['zipcode'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('student/profile');
  }
  public function updateSchool(Request $request)
  {
    // printArray($request->toArray());
    // die;
    $request->validate(
      [
        'country_of_institution' => 'required',
        'name_of_institution' => 'required',
        'level_of_education' => 'required',
        'primary_language_of_instruction' => 'required',
        'attended_institution_from' => 'required',
        'attended_institution_to' => 'required',
        'degree_name' => 'required',
        'graduated_from_this' => 'required',
        'address' => 'required',
        'city' => 'required',
        'state' => 'required',
        'zipcode' => 'required',
      ]
    );
    $field = StudentSchool::find($request['id']);
    $field->country_of_institution = $request['country_of_institution'];
    $field->name_of_institution = $request['name_of_institution'];
    $field->level_of_education = $request['level_of_education'];
    $field->primary_language_of_instruction = $request['primary_language_of_instruction'];
    $field->attended_institution_from = $request['attended_institution_from'];
    $field->attended_institution_to = $request['attended_institution_to'];
    $field->degree_name = $request['degree_name'];
    $field->graduated_from_this = $request['graduated_from_this'];
    $field->graduation_date = $request['graduation_date'];
    $field->have_physical_certificate = $request['have_physical_certificate'];
    $field->address = $request['address'];
    $field->city = $request['city'];
    $field->state = $request['state'];
    $field->zipcode = $request['zipcode'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('student/profile');
  }
  public function updateTestScore(Request $request)
  {
    $data = $request->toArray();
    unset($data['_token']);
    $id = session()->get('student_id');
    // printArray($request->toArray());
    // die;
    $request->validate(
      [
        'english_exam_type' => 'required',
      ]
    );
    $field = Lead::find($id);
    foreach ($data as $key => $value) {
      $field->$key = $value;
    }

    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('student/profile');
  }
  public function updateGRE(Request $request)
  {
    $data = $request->toArray();
    unset($data['_token']);
    $id = session()->get('student_id');
    // printArray($request->toArray());
    // die;
    $request->validate(
      [
        'gre' => 'required',
      ]
    );
    $field = Lead::find($id);
    foreach ($data as $key => $value) {
      $field->$key = $value;
    }

    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('student/profile');
  }
  public function updateGMAT(Request $request)
  {
    $data = $request->toArray();
    unset($data['_token']);
    $id = session()->get('student_id');
    // printArray($request->toArray());
    // die;
    $request->validate(
      [
        'gmat' => 'required',
      ]
    );
    $field = Lead::find($id);
    foreach ($data as $key => $value) {
      $field->$key = $value;
    }

    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('student/profile');
  }
  public function updateSAT(Request $request)
  {
    $data = $request->toArray();
    unset($data['_token']);
    $id = session()->get('student_id');
    // printArray($request->toArray());
    // die;
    $request->validate(
      [
        'sat' => 'required',
      ]
    );
    $field = Lead::find($id);
    foreach ($data as $key => $value) {
      $field->$key = $value;
    }

    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('student/profile');
  }
  public function updateBI(Request $request)
  {
    $id = session()->get('student_id');
    // printArray($request->toArray());
    // die;
    $request->validate(
      [
        'refused_visa' => 'required',
        'valid_study_permit' => 'required',
        'visa_note' => 'required',
      ]
    );
    $field = Lead::find($id);
    $field->refused_visa = $request->refused_visa;
    $field->valid_study_permit = $request->valid_study_permit;
    $field->visa_note = $request->visa_note;
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('student/profile');
  }
  public function updateDocs(Request $request)
  {
    $id = session()->get('student_id');
    // printArray($request->toArray());
    // die;
    $request->validate(
      [
        'document_name' => 'required',
        'doc' => 'required|max:2024|mimes:png,jpg,jpeg,pdf',
      ]
    );
    $field = new StudentDocument();
    $field->std_id = $id;
    $field->doc_name = $request->document_name;
    if ($request->hasFile('doc')) {
      $fileOriginalName = $request->file('doc')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('doc')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('doc')->move('uploads/documents/', $file_name);
      if ($move) {
        $field->imgname = $file_name;
        $field->imgpath = 'uploads/documents/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('student/profile');
  }
  public function deleteSchool($id)
  {
    //echo $id;
    echo $result = StudentSchool::find($id)->delete();
  }
  public function deleteProgram($id)
  {
    //echo $id;
    echo $result = StudentApplication::find($id)->delete();
  }
}
