<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\University;
use App\Models\UniversityProgram;
use Illuminate\Http\Request;

class ReviewFc extends Controller
{
  public function index(Request $request)
  {
    $universities = University::active()->get();
    $data = compact('universities');
    return view('front.write-a-review')->with($data);
  }
  public function getProgramsByUniversity(Request $request)
  {
    $universityId = $request->input('university_id');
    $programs = UniversityProgram::where('university_id', $universityId)->pluck('course_name', 'id');
    return response()->json($programs);
  }
  public function addReview(Request $request)
  {
    // printArray($request->toArray());
    // die;
    $request->validate(
      [
        'name' => ['required', 'regex:/^([a-zA-Z ])+$/i'],
        'email' => ['required', 'email'],
        'mobile' => ['required', 'numeric'],
        'university' => ['required', 'numeric'],
        'program' => ['required'],
        'passing_year' => ['required', 'numeric'],
        'review_title' => ['required', 'string', 'min:20', 'max:100'],
        'description' => ['required', 'string', 'min:150'],
        'rating' => ['required', 'numeric'],
      ]
    );

    $whr = [
      'email' => $request->input('email'),
      'university_id' => $request->input('university'),
      'program' => $request->input('program')
    ];
    $checkReview = Review::where($whr)->count();
    if ($checkReview == 0) {
      $field = new Review();
      $field->website = site_var;
      $field->name = $request->input('name');
      $field->email = $request->input('email');
      $field->mobile = $request->input('mobile');
      $field->university_id = $request->input('university');
      $field->program = $request->input('program');
      $field->passing_year = $request->input('passing_year');
      $field->review_title = $request->input('review_title');
      $field->description = $request->input('description');
      $field->rating = $request->input('rating');
      $field->save();
      session()->flash('smsg', 'Review has been submitted successfully.');
    } else {
      session()->flash('smsg', 'You have already submitted your review.');
    }
    return redirect('write-a-review');
  }
}
