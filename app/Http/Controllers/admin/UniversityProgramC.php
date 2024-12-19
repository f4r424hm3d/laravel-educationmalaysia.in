<?php

namespace App\Http\Controllers\admin;

use App\Exports\UniversityProgramsExport;
use App\Http\Controllers\Controller;
use App\Imports\UniversityProgramBulkUpdateImport;
use App\Imports\UniversityProgramImport;
use App\Models\CourseCategory;
use App\Models\CourseMode;
use App\Models\CourseSpecialization;
use App\Models\Exam;
use App\Models\Level;
use App\Models\Month;
use App\Models\Program;
use App\Models\StudyMode;
use App\Models\University;
use App\Models\UniversityProgram;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UniversityProgramC extends Controller
{
  public function index($university_id, $id = null)
  {
    $exams = Exam::all();
    $categories = CourseCategory::all();
    $specializations = CourseSpecialization::all();
    $programs = Program::all();
    $studymodes = StudyMode::all();
    $coursemodes = CourseMode::all();
    $months = Month::orderBy('month_number')->get();
    $university = University::find($university_id);
    //$levels = Level::where('destination_id', $university->destination_id)->get();
    $levels = Level::all();
    $rows = UniversityProgram::where('university_id', $university_id)->paginate(10);
    $cp = $rows->currentPage();
    $pp = $rows->perPage();
    $i = ($cp - 1) * $pp + 1;
    if ($id != null) {
      $sd = UniversityProgram::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/university-programs/' . $university_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/university-programs');
      }
    } else {
      $ft = 'add';
      $url = url('admin/university-programs/' . $university_id . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "University Programs";
    $page_route = "university-programs";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'university', 'categories', 'specializations', 'programs', 'levels', 'studymodes', 'i', 'coursemodes', 'exams', 'months');
    return view('admin.university-programs')->with($data);
  }
  public function store($university_id, Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'course_category_id' => 'required',
        'specialization_id' => 'required',
        'program_name' => 'required',
        'level_id' => 'required',
        'duration' => 'required',
        'study_mode' => 'required|array',
      ]
    );
    if ($request['program_name'] == 'addnew') {
      $pf = new Program();
      $pf->course_category_id = $request['course_category_id'];
      $pf->specialization_id = $request['specialization_id'];
      $pf->program_name = $request['new_program'];
      $pf->program_slug = slugify($request['new_program']);
      $pf->save();
      $program_name = $request['new_program'];
    } else {
      $program_name = $request['program_name'];
    }
    $field = new UniversityProgram;
    $field->university_id = $request['university_id'];
    $field->course_category_id = $request['course_category_id'];
    $field->specialization_id = $request['specialization_id'];
    $field->program_name = $program_name;
    $field->program_slug = slugify($program_name);
    $field->level_id = $request['level_id'];
    $field->duration = $request['duration'];
    $field->tution_fees = $request['tution_fees'];
    $field->study_mode = json_encode($request['study_mode']);
    $field->course_mode = json_encode($request['course_mode']);
    $field->exam_accepted = json_encode($request['exam_accepted']);
    $field->intake = json_encode($request['intake']);
    $field->overview = $request['overview'];
    $field->entry_requirement = $request['entry_requirement'];
    $field->ielts = $request['ielts'];
    $field->toefl = $request['toefl'];
    $field->duolingo = $request['duolingo'];
    $field->pte = $request['pte'];
    $field->gre = $request['gre'];
    $field->gmat = $request['gmat'];
    $field->sat = $request['sat'];
    $field->meta_title = $request['meta_title'];
    $field->meta_keyword = $request['meta_keyword'];
    $field->meta_description = $request['meta_description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/university-programs/' . $university_id);
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = UniversityProgram::find($id)->delete();
  }
  public function update($university_id, $id, Request $request)
  {
    $request->validate(
      [
        'course_category_id' => 'required',
        'specialization_id' => 'required',
        'program_name' => 'required',
        'level_id' => 'required',
        'duration' => 'required',
        'study_mode' => 'required|array',
      ]
    );
    if ($request['program_name'] == 'addnew') {
      $pf = new Program();
      $pf->course_category_id = $request['course_category_id'];
      $pf->specialization_id = $request['specialization_id'];
      $pf->program_name = $request['new_program'];
      $pf->program_slug = slugify($request['new_program']);
      $pf->save();
      $program_name = $request['new_program'];
    } else {
      $program_name = $request['program_name'];
    }
    $field = UniversityProgram::find($id);
    $field->university_id = $request['university_id'];
    $field->course_category_id = $request['course_category_id'];
    $field->specialization_id = $request['specialization_id'];
    $field->program_name = $program_name;
    $field->program_slug = slugify($program_name);
    $field->level_id = $request['level_id'];
    $field->duration = $request['duration'];
    $field->study_mode = json_encode($request['study_mode']);
    $field->course_mode = json_encode($request['course_mode']);
    $field->exam_accepted = json_encode($request['exam_accepted']);
    $field->intake = json_encode($request['intake']);
    $field->overview = $request['overview'];
    $field->entry_requirement = $request['entry_requirement'];
    $field->ielts = $request['ielts'];
    $field->toefl = $request['toefl'];
    $field->duolingo = $request['duolingo'];
    $field->pte = $request['pte'];
    $field->gre = $request['gre'];
    $field->gmat = $request['gmat'];
    $field->sat = $request['sat'];
    $field->tution_fees = $request['tution_fees'];
    $field->meta_title = $request['meta_title'];
    $field->meta_keyword = $request['meta_keyword'];
    $field->meta_description = $request['meta_description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/university-programs/' . $university_id);
  }
  public function Import($university_id, Request $request)
  {
    // printArray($data->all());
    // die;
    $request->validate([
      'file' => 'required|mimes:xlsx,csv,xls'
    ]);
    $file = $request->file;
    $data['university_id'] = $university_id;
    if ($file) {
      try {
        $result = Excel::import(new UniversityProgramImport($data), $file);
        // session()->flash('smsg', 'Data has been imported succesfully.');
        return redirect('admin/university-programs/' . $university_id);
      } catch (\Exception $ex) {
        dd($ex);
      }
    }
  }
  public function export($university_id)
  {
    $data['university_id'] = $university_id;
    return Excel::download(new UniversityProgramsExport($data), 'university-programs-list.xlsx');
  }
  public function bulkUpdateImport($university_id, Request $request)
  {
    // printArray($data->all());
    // die;
    $request->validate([
      'file' => 'required|mimes:xlsx,csv,xls'
    ]);
    $file = $request->file;
    $data['university_id'] = $university_id;
    if ($file) {
      try {
        $result = Excel::import(new UniversityProgramBulkUpdateImport($data), $file);
        // session()->flash('smsg', 'Data has been imported succesfully.');
        return redirect('admin/university-programs/' . $university_id);
      } catch (\Exception $ex) {
        dd($ex);
      }
    }
  }
}
