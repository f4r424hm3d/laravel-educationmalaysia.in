<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Models\Gender;
use App\Models\Level;
use App\Models\MaritalStatus;
use Illuminate\Http\Request;

class DropdownListApi extends Controller
{
  public function levels(Request $request)
  {
    $data = Level::select('id', 'level', 'slug', 'short_name')->groupBy('level')->orderBy('level', 'ASC')->get();

    return response()->json([
      'status' => true,
      'data' => $data
    ]);
  }
  public function courseCategories(Request $request)
  {
    $data = CourseCategory::select('id', 'name', 'slug', 'thumbnail_path')->groupBy('name')->orderBy('name', 'ASC')->get();

    return response()->json([
      'status' => true,
      'data' => $data
    ]);
  }
  public function genders(Request $request)
  {
    $data = Gender::select('id', 'gender')->orderBy('gender', 'ASC')->get();

    return response()->json([
      'status' => true,
      'data' => $data
    ]);
  }
  public function maritalStatuses(Request $request)
  {
    $data = MaritalStatus::select('id', 'marital_status')->orderBy('marital_status', 'ASC')->get();

    return response()->json([
      'status' => true,
      'data' => $data
    ]);
  }
}
