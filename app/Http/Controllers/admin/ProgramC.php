<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Imports\ProgramsImport;
use App\Models\CourseCategory;
use App\Models\CourseSpecialization;
use App\Models\Program;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProgramC extends Controller
{
  public function index($id = null)
  {
    $category = CourseCategory::all();
    $specialization = CourseSpecialization::all();
    $rows = Program::paginate(10);
    $cp = $rows->currentPage();
    $pp = $rows->perPage();
    $i = ($cp - 1) * $pp + 1;
    if ($id != null) {
      $sd = Program::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/programs/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/programs');
      }
    } else {
      $ft = 'add';
      $url = url('admin/programs/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Programs";
    $page_route = "programs";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route','category','specialization','i');
    return view('admin.courses')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'course_category_id' => 'required',
        'specialization_id' => 'required',
        'program_name' => 'required',
      ]
    );
    $field = new Program;
    $field->course_category_id = $request['course_category_id'];
    $field->specialization_id = $request['specialization_id'];
    $field->program_name = $request['program_name'];
    $field->program_slug = slugify($request['program_name']);

    $chk = Program::where(['course_category_id' => $request['course_category_id'],'specialization_id' => $request['specialization_id'],'program_name' => $request['program_name']])->count();
    if($chk==0){
      $field->save();
      session()->flash('smsg', 'New record has been added successfully.');
    }else{
      session()->flash('emsg', 'Record already exist.');
    }

    return redirect('admin/programs');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = Program::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'course_category_id' => 'required',
        'specialization_id' => 'required',
        'program_name' => 'required',
      ]
    );
    $field = Program::find($id);
    $field->course_category_id = $request['course_category_id'];
    $field->specialization_id = $request['specialization_id'];
    $field->program_name = $request['program_name'];
    $field->program_slug = slugify($request['program_name']);
    $chk = Program::where(['course_category_id' => $request['course_category_id'],'specialization_id' => $request['specialization_id'],'program_name' => $request['program_name']])->where('id','!=',$id)->count();
    if($chk==0){
      $field->save();
      session()->flash('smsg', 'Record has been updated successfully.');
    }else{
      session()->flash('emsg', 'Record already exist.');
    }

    return redirect('admin/programs');
  }
  public function Import(Request $request)
  {
    // printArray($data->all());
    // die;
    $request->validate([
      'file' => 'required|mimes:xlsx,csv,xls'
    ]);
    $file = $request->file;
    if ($file) {
      try {
        $result = Excel::import(new ProgramsImport, $file);
        // session()->flash('smsg', 'Data has been imported succesfully.');
        return redirect('admin/programs');
      } catch (\Exception $ex) {
        dd($ex);
      }
    }
  }
  public function getBySpcCat(Request $request)
  {
    // printArray($data->all());
    // die;
    $rows = Program::where(['course_category_id'=>$request->course_category_id,'specialization_id'=>$request->specialization_id])->get();
    $output = '<option value="">Select</option>';
    foreach ($rows as $row) {
      $output .= '<option value="' . $row->program_name . '">' . $row->program_name . '</option>';
    }
    if($request->add_new){
      $output .= '<option value="addnew">Add New</option>';
    }
    echo $output;
  }
}
