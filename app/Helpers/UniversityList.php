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
  public static function universities(Request $request, $destination)
  {
    $query = UniversityProgram::query();

    $query->groupBy('university_id');

    $query->whereHas('getUniversity', function ($subQuery) use ($destination) {
      $subQuery->where('destination_id', $destination->id);
    });
    $query->whereHas('getUniversity', function ($subQuery) use ($destination) {
      $subQuery->where('status', 1);
    });

    if (session()->has('FilterState')) {
      $query->whereHas('getUniversity', function ($subQuery) {
        $subQuery->where('state_slug', session()->get('FilterState'));
      });
      $headTail = unslugify(session()->get('FilterState'));
    }
    if (session()->has('FilterCity')) {
      $query->whereHas('getUniversity', function ($subQuery) {
        $subQuery->where('city_slug', session()->get('FilterCity'));
      });
      $headTail = unslugify(session()->get('FilterCity'));
    }
    if (session()->has('FilterInstituteType')) {
      $query->whereHas('getUniversity', function ($subQuery) {
        $subQuery->where('institute_type_id', session()->get('FilterInstituteType'));
      });
      $curInstType = InstituteType::find(session()->get('FilterInstituteType'));
    }

    if (session()->has('FilterLevel')) {
      $query->where('level_id', session()->get('FilterLevel'));
      $curLevel = Level::find(session()->get('FilterLevel'));
    }
    if (session()->has('FilterCategory')) {
      $query->where('course_category_id', session()->get('FilterCategory'));
      $curCat = CourseCategory::find(session()->get('FilterCategory'));
    }
    if (session()->has('FilterSpecialization')) {
      $query->where('specialization_id', session()->get('FilterSpecialization'));
      $curSpc = CourseSpecialization::find(session()->get('FilterSpecialization'));
    }
    if ($request->has('study_mode')) {
      $query->whereJsonContains('study_mode', $request->study_mode);
    }
    if ($request->has('intake')) {
      $query->whereJsonContains('intake', $request->intake);
    }

    $rows = $query->paginate(10);
    return $rows;
  }
}
