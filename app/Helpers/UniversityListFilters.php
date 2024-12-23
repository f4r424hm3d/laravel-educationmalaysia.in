<?php

namespace App\Helpers;

use App\Models\CourseCategory;
use App\Models\CourseSpecialization;
use App\Models\University;
use App\Models\UniversityProgram;
use App\Models\User;

class UniversityListFilters
{
  public static function level()
  {
    $levelListForFilter = UniversityProgram::query();
    // if (session()->has('CFilterCategory')) {
    //   $levelListForFilter = $levelListForFilter->where(['course_category_id' => session()->get('CFilterCategory')]);
    // }
    // if (session()->has('CFilterSpecialization')) {
    //   $levelListForFilter = $levelListForFilter->where(['specialization_id' => session()->get('CFilterSpecialization')]);
    // }
    $levelListForFilter = $levelListForFilter->select('level')->groupBy('level')->where('status', 1)->get();
    return $levelListForFilter;
  }
  public static function category()
  {
    $categoryListForFilter = CourseCategory::query()->whereHas('programs');
    if (session()->has('CFilterLevel')) {
      $categoryListForFilter = $categoryListForFilter->whereHas('programs', function ($query) {
        $query->where('level', session()->get('CFilterLevel'));
      });
    }
    $categoryListForFilter = $categoryListForFilter->select('id', 'name', 'slug')->orderBy('name')->get();

    return $categoryListForFilter;
  }
  public static function specialization()
  {
    $spcListForFilter = CourseSpecialization::orderBy('name')
      ->whereHas('programs', function ($query) {
        $query->where('status', 1) // Filter programs with status = 1
          ->whereHas('university', function ($universityQuery) {
            $universityQuery->where('status', 1); // Filter universities with status = 1
          });
      });

    if (session()->has('CFilterLevel')) {
      $spcListForFilter = $spcListForFilter->whereHas('programs', function ($query) {
        $query->where('level', session()->get('CFilterLevel'));
      });
    }

    if (session()->has('CFilterCategory')) {
      $spcListForFilter = $spcListForFilter->whereHas('programs', function ($query) {
        $query->where('course_category_id', session()->get('CFilterCategory'));
      });
    }

    $spcListForFilter = $spcListForFilter->select('id', 'name', 'slug', 'website')->groupBy('name')->get();

    return $spcListForFilter;
  }
}
