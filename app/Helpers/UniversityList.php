<?php

namespace App\Helpers;

use App\Models\CourseCategory;
use App\Models\CourseSpecialization;
use App\Models\InstituteType;
use App\Models\Level;
use App\Models\University;
use App\Models\UniversityProgram;
use App\Models\User;
use Illuminate\Http\Request;

class UniversityList
{
  public static function universityPrograms(Request $request)
  {
    $query = UniversityProgram::query();

    //$query->groupBy('university_id');
    $query->where('status', 1);

    $query->whereHas('university', function ($subQuery) use ($request) {
      $subQuery->where('status', 1);
      if ($request->has('search') && $request->search != '') {
        $subQuery->where('name', 'like', '%' . $request->search . '%');
      }
    });

    if (session()->has('CFilterLevel')) {
      $query->where('level', session()->get('CFilterLevel'));
      $curLevel = Level::where('slug', session()->get('CFilterLevel'))->first();
    }
    if (session()->has('CFilterCategory')) {
      $query->where('course_category_id', session()->get('CFilterCategory'));
      $curCat = CourseCategory::find(session()->get('CFilterCategory'));
    }
    if (session()->has('CFilterSpecialization')) {
      $query->where('specialization_id', session()->get('CFilterSpecialization'));
      $curSpc = CourseSpecialization::find(session()->get('CFilterSpecialization'));
    }
    if ($request->has('study_mode')) {
      $query->whereRaw("FIND_IN_SET(?, study_mode)", [$request->study_mode]);
    }
    if ($request->has('intake')) {
      $query->whereRaw("FIND_IN_SET(?, intake)", [$request->intake]);
    }

    $rows = $query->paginate(10);
    return $rows;
  }
  public static function universityCount(Request $request)
  {
    $query = UniversityProgram::query();

    $query->groupBy('university_id');
    $query->where('status', 1);

    $query->whereHas('university', function ($subQuery) use ($request) {
      $subQuery->where('status', 1);
      if ($request->has('search') && $request->search != '') {
        $subQuery->where('name', 'like', '%' . $request->search . '%');
      }
    });

    if (session()->has('CFilterLevel')) {
      $query->where('level', session()->get('CFilterLevel'));
      $curLevel = Level::where('slug', session()->get('CFilterLevel'))->first();
    }
    if (session()->has('CFilterCategory')) {
      $query->where('course_category_id', session()->get('CFilterCategory'));
      $curCat = CourseCategory::find(session()->get('CFilterCategory'));
    }
    if (session()->has('CFilterSpecialization')) {
      $query->where('specialization_id', session()->get('CFilterSpecialization'));
      $curSpc = CourseSpecialization::find(session()->get('CFilterSpecialization'));
    }
    if ($request->has('study_mode')) {
      $query->whereRaw("FIND_IN_SET(?, study_mode)", [$request->study_mode]);
    }
    if ($request->has('intake')) {
      $query->whereRaw("FIND_IN_SET(?, intake)", [$request->intake]);
    }

    $rows = $query->get()->count();
    return $rows;
  }
}
