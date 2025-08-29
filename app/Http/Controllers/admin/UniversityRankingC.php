<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\UniversityRanking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

class UniversityRankingC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'university-ranking';
  }
  public function index($university_id, $id = null)
  {
    $university = University::find($university_id);
    $rows = UniversityRanking::where('university_id', $university_id)->get();
    if ($id != null) {
      $sd = UniversityRanking::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/' . $this->page_route . '/' . $university_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/university-ranking');
      }
    } else {
      $ft = 'add';
      $url = url('admin/' . $this->page_route . '/' . $university_id . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "University Rankings";
    $page_route = $this->page_route;
    $lastPosition = $rows->count() + 1;
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'university', 'lastPosition', 'university_id');
    return view('admin.university-rankings')->with($data);
  }
  public function store($university_id, Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'title' => 'required',
        'description' => 'required',
      ]
    );
    $field = new UniversityRanking;
    $field->university_id = $request['university_id'];
    $field->title = $request['title'];
    $field->description = $request['description'];
    $field->position = $request['position'];
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/' . $this->page_route . '/' . $university_id);
  }
  public function delete($id)
  {
    if ($id) {
      $row = UniversityRanking::findOrFail($id);
      $row->delete();
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }
  public function update($university_id, $id, Request $request)
  {
    $request->validate(
      [
        'title' => 'required',
        'description' => 'required',
        'position' => 'required',
      ]
    );
    $field = UniversityRanking::find($id);
    $field->title = $request['title'];
    $field->description = $request['description'];
    $field->position = $request['position'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route . '/' . $university_id);
  }
  public function getPosition(Request $request)
  {
    $rows = UniversityRanking::where('university_id', $request->university_id)->count();
    $lastPosition = $rows + 1;
    return $lastPosition;
  }
}
