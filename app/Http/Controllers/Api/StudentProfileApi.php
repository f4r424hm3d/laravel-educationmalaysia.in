<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\StudentDocument;
use App\Models\StudentSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentProfileApi extends Controller
{
  // Profile API (return JSON data)
  public function profile(Request $request)
  {
    $student = $request->user();

    return response()->json([
      'status' => true,
      'data' => [
        'student' => $student,
      ]
    ]);
  }

  // Student Schools (return JSON data)
  public function schools(Request $request)
  {
    $student = $request->user();

    $schools = StudentSchool::where('std_id', $student->id)->get();

    return response()->json([
      'status' => true,
      'data' => [
        'schools' => $schools,
        // If you need URLs, provide as strings here or generate in frontend
      ]
    ]);
  }

  // Student School Detail (return JSON data)
  public function school(Request $request, $id)
  {
    $student = $request->user();

    $school = StudentSchool::where('std_id', $student->id)->where('id', $id)->first();

    if (!$school) {
      return response()->json(['status' => false, 'message' => 'School not found'], 404);
    }

    return response()->json([
      'status' => true,
      'data' => [
        'school' => $school,
        // If you need URLs, provide as strings here or generate in frontend
      ]
    ]);
  }

  // Student Documents API (return JSON data)
  public function documents(Request $request)
  {
    $student = $request->user();

    $stdDocs = StudentDocument::where('std_id', $student->id)->get();

    return response()->json([
      'status' => true,
      'data' => [
        'student_documents' => $stdDocs,
        // If you need URLs, provide as strings here or generate in frontend
      ]
    ]);
  }

  /**
   * Submit Personal Information API
   */
  public function submitPersonalInfo(Request $request)
  {
    $student = $request->user();

    $validator = Validator::make($request->all(), [
      'name' => 'required|regex:/^[a-zA-Z ]*$/',
      'email' => 'required|email',
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
      'zipcode' => 'required',
      'home_contact_number' => 'required|numeric',
    ]);

    if ($validator->fails()) {
      return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
    }

    $field = Lead::find($student->id);
    $field->fill($request->all());
    $field->save();

    return response()->json(['status' => true, 'message' => 'Personal information updated successfully']);
  }

  /**
   * Submit Education Summary
   */
  public function submitEduSum(Request $request)
  {
    $student = $request->user();

    $validator = Validator::make($request->all(), [
      'country_of_education' => 'required',
      'highest_level_of_education' => 'required',
      'grading_scheme' => 'required',
      'grade_average' => 'required|regex:/^[a-zA-Z0-9\s\.\-]+$/',
    ]);

    if ($validator->fails()) {
      return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
    }

    $field = Lead::find($student->id);
    $field->fill($request->only(['country_of_education', 'highest_level_of_education', 'grading_scheme', 'grade_average']));
    $field->save();

    return response()->json(['status' => true, 'message' => 'Education summary updated successfully']);
  }

  /**
   * Add New School
   */
  public function addSchool(Request $request)
  {
    $student = $request->user();

    $validator = Validator::make($request->all(), [
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
    ]);

    if ($validator->fails()) {
      return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
    }

    $field = new StudentSchool();
    $field->std_id = $student->id;
    $field->fill($request->all());
    $field->save();

    return response()->json(['status' => true, 'message' => 'School added successfully']);
  }

  /**
   * Update School
   */
  public function updateSchool(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'id' => 'required|exists:student_schools,id',
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
    ]);

    if ($validator->fails()) {
      return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
    }

    $field = StudentSchool::find($request->id);
    $field->fill($request->all());
    $field->save();

    return response()->json(['status' => true, 'message' => 'School updated successfully']);
  }

  /**
   * Delete School
   */
  public function deleteSchool($id)
  {
    try {
      // Find the school record by ID
      $school = StudentSchool::find($id);

      // If no record found
      if (!$school) {
        return response()->json([
          'status' => false,
          'message' => 'School record not found'
        ], 404);
      }

      // Delete the record
      $school->delete();

      return response()->json([
        'status' => true,
        'message' => 'School record deleted successfully'
      ], 200);
    } catch (\Exception $e) {
      // Handle unexpected errors
      return response()->json([
        'status' => false,
        'message' => 'Something went wrong',
        'error' => $e->getMessage()
      ], 500);
    }
  }

  /**
   * Update Test Scores (Generic)
   */

  public function updateTestScore(Request $request)
  {
    $student = $request->user();

    // Allowed exam types
    $examTypes = [
      'I dont have this',
      'I will provide this later',
      'TOEFL',
      'IELTS',
      'Duolingo English Test',
      'PTE',
    ];

    // Validate exam type first
    $validator = Validator::make($request->all(), [
      'english_exam_type' => 'required|in:' . implode(',', $examTypes),
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => false,
        'errors' => $validator->errors()
      ], 422);
    }

    // Prepare dynamic rules
    $examType = $request->english_exam_type;
    $rules = [];

    if ($examType === 'TOEFL') {
      $rules = [
        'date_of_exam'     => 'required|date',
        'speaking_score'   => 'required|numeric|min:0|max:30',
        'listening_score'  => 'required|numeric|min:0|max:30',
        'reading_score'    => 'required|numeric|min:0|max:30',
        'writing_score'    => 'required|numeric|min:0|max:30',
      ];
    } elseif ($examType === 'IELTS') {
      $rules = [
        'date_of_exam'     => 'required|date',
        'speaking_score'   => 'required|numeric|min:0|max:9',
        'listening_score'  => 'required|numeric|min:0|max:9',
        'reading_score'    => 'required|numeric|min:0|max:9',
        'writing_score'    => 'required|numeric|min:0|max:9',
      ];
    } elseif ($examType === 'Duolingo English Test') {
      $rules = [
        'date_of_exam'   => 'required|date',
        'overall_score'  => 'required|numeric|min:0|max:160',
      ];
    } elseif ($examType === 'PTE') {
      $rules = [
        'date_of_exam'     => 'required|date',
        'speaking_score'   => 'required|numeric|min:0|max:90',
        'listening_score'  => 'required|numeric|min:0|max:90',
        'reading_score'    => 'required|numeric|min:0|max:90',
        'writing_score'    => 'required|numeric|min:0|max:90',
        'overall_score'    => 'required|numeric|min:0|max:90',
      ];
    }

    // Validate according to rules
    if (!empty($rules)) {
      $scoreValidator = Validator::make($request->all(), $rules);

      if ($scoreValidator->fails()) {
        return response()->json([
          'status' => false,
          'errors' => $scoreValidator->errors()
        ], 422);
      }
    }

    // Save data
    $lead = Lead::find($student->id);
    $lead->fill($request->all());
    $lead->save();

    return response()->json([
      'status' => true,
      'message' => 'Test Score updated successfully'
    ]);
  }



  public function updateGRE(Request $request)
  {
    return $this->updateLeadField($request, ['gre' => 'required']);
  }

  public function updateGMAT(Request $request)
  {
    return $this->updateLeadField($request, ['gmat' => 'required']);
  }

  public function updateSAT(Request $request)
  {
    return $this->updateLeadField($request, ['sat' => 'required']);
  }

  private function updateLeadField(Request $request, $rules)
  {
    $student = $request->user();
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
    }

    $field = Lead::find($student->id);
    foreach ($request->except(['_token']) as $key => $value) {
      $field->$key = $value;
    }
    $field->save();

    return response()->json(['status' => true, 'message' => 'Score updated successfully']);
  }

  /**
   * Update Background Info
   */
  public function updateBI(Request $request)
  {
    $student = $request->user();

    $validator = Validator::make($request->all(), [
      'refused_visa' => 'required',
      'valid_study_permit' => 'required',
      'visa_note' => 'required|regex:/^[a-zA-Z0-9\s\.\-]+$/',
    ]);

    if ($validator->fails()) {
      return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
    }

    $field = Lead::find($student->id);
    $field->fill($request->only(['refused_visa', 'valid_study_permit', 'visa_note']));
    $field->save();

    return response()->json(['status' => true, 'message' => 'Background info updated successfully']);
  }

  /**
   * Upload Documents
   */
  public function updateDocs(Request $request)
  {
    $student = $request->user();

    $validator = Validator::make($request->all(), [
      'document_name' => 'required|regex:/^[a-zA-Z0-9\s\.\-]+$/',
      'doc' => 'required|max:2048|mimes:png,jpg,jpeg,pdf',
    ]);

    if ($validator->fails()) {
      return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
    }

    $field = new StudentDocument();
    $field->std_id = $student->id;
    $field->doc_name = $request->document_name;

    if ($request->hasFile('doc')) {
      $file = $request->file('doc');
      $fileOriginalName = $file->getClientOriginalName();
      $fileNameWithoutExt = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $fileSlug = slugify($fileNameWithoutExt);
      $fileExt = $file->getClientOriginalExtension();
      $fileName = $fileSlug . '_' . time() . '.' . $fileExt;

      $file->move(public_path('uploads/documents'), $fileName);

      $field->imgname = $fileName;
      $field->imgpath = 'uploads/documents/' . $fileName;
      $field->upload_source = url('/');
    }

    $field->save();

    return response()->json(['status' => true, 'message' => 'Document uploaded successfully']);
  }

  // Logout API (revoke token)
  public function logout(Request $request)
  {
    $request->user()->currentAccessToken()->delete();

    return response()->json([
      'status' => true,
      'message' => 'Successfully logged out.'
    ]);
  }
}
