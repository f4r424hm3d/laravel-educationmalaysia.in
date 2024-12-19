<?php

namespace App\Helpers;

use App\Models\University;
use App\Models\UniversityProgram;
use App\Models\User;

class UniversityListFilters
{
  public static function destinations()
  {
    $destinations = University::whereHas('getPrograms', function ($query) {
      $query->whereExists(function ($subQuery) {
        $subQuery->select('id')->from('university_programs')->whereColumn('university_id', 'universities.id');
      });
    })->where('status', 1)->select('destination_id')->groupBy('destination_id')->get();
    return $destinations;
  }
  public static function level($destinationId)
  {
    $levelListForFilter = UniversityProgram::whereHas('getUniversity', function ($query) use ($destinationId) {
      $query->where('destination_id', $destinationId);
    });
    if (session()->has('FilterState')) {
      $levelListForFilter = $levelListForFilter->whereHas('getUniversity', function ($query) {
        $query->where('state_slug', session()->get('FilterState'));
      });
    }
    if (session()->has('FilterCity')) {
      $levelListForFilter = $levelListForFilter->whereHas('getUniversity', function ($query) {
        $query->where('city_slug', session()->get('FilterCity'));
      });
    }
    if (session()->has('FilterInstituteType')) {
      $levelListForFilter = $levelListForFilter->whereHas('getUniversity', function ($query) {
        $query->where('institute_type_id', session()->get('FilterInstituteType'));
      });
    }
    if (session()->has('FilterCategory')) {
      $levelListForFilter = $levelListForFilter->where(['course_category_id' => session()->get('FilterCategory')]);
    }
    if (session()->has('FilterSpecialization')) {
      $levelListForFilter = $levelListForFilter->where(['specialization_id' => session()->get('FilterSpecialization')]);
    }
    $levelListForFilter = $levelListForFilter->select('level_id')->groupBy('level_id')->get();
    return $levelListForFilter;
  }
  public static function category($destinationId)
  {
    $categoryListForFilter = UniversityProgram::whereHas('getUniversity', function ($query) use ($destinationId) {
      $query->where('destination_id', $destinationId);
    });
    if (session()->has('FilterState')) {
      $categoryListForFilter = $categoryListForFilter->whereHas('getUniversity', function ($query) {
        $query->where('state_slug', session()->get('FilterState'));
      });
    }
    if (session()->has('FilterCity')) {
      $categoryListForFilter = $categoryListForFilter->whereHas('getUniversity', function ($query) {
        $query->where('city_slug', session()->get('FilterCity'));
      });
    }
    if (session()->has('FilterInstituteType')) {
      $categoryListForFilter = $categoryListForFilter->whereHas('getUniversity', function ($query) {
        $query->where('institute_type_id', session()->get('FilterInstituteType'));
      });
    }
    if (session()->has('FilterLevel')) {
      $categoryListForFilter = $categoryListForFilter->where(['level_id' => session()->get('FilterLevel')]);
    }
    $categoryListForFilter = $categoryListForFilter->select('course_category_id')->groupBy('course_category_id')->get();
    return $categoryListForFilter;
  }
  public static function specialization($destinationId)
  {
    $spcListForFilter = UniversityProgram::whereHas('getUniversity', function ($query) use ($destinationId) {
      $query->where('destination_id', $destinationId);
    });
    if (session()->has('FilterState')) {
      $spcListForFilter = $spcListForFilter->whereHas('getUniversity', function ($query) {
        $query->where('state_slug', session()->get('FilterState'));
      });
    }
    if (session()->has('FilterCity')) {
      $spcListForFilter = $spcListForFilter->whereHas('getUniversity', function ($query) {
        $query->where('city_slug', session()->get('FilterCity'));
      });
    }
    if (session()->has('FilterInstituteType')) {
      $spcListForFilter = $spcListForFilter->whereHas('getUniversity', function ($query) {
        $query->where('institute_type_id', session()->get('FilterInstituteType'));
      });
    }
    if (session()->has('FilterLevel')) {
      $spcListForFilter = $spcListForFilter->where(['level_id' => session()->get('FilterLevel')]);
    }
    if (session()->has('FilterCategory')) {
      $spcListForFilter = $spcListForFilter->where(['course_category_id' => session()->get('FilterCategory')]);
    }
    $spcListForFilter = $spcListForFilter->select('specialization_id')->groupBy('specialization_id')->get();
    return $spcListForFilter;
  }
  public static function instituteType($destinationId)
  {
    $instTYpe = University::select('institute_type_id')->where(['destination_id' => $destinationId, 'status' => 1])->where('institute_type_id', '!=', null)->groupBy('institute_type_id');
    if (session()->has('FilterState')) {
      $instTYpe->where('state_slug', session()->get('FilterState'));
    }
    if (session()->has('FilterCity')) {
      $instTYpe->where('city_slug', session()->get('FilterCity'));
    }
    if (session()->has('FilterLevel')) {
      $instTYpe = $instTYpe->whereHas('getPrograms', function ($query) {
        $query->where('level_id', session()->get('FilterLevel'));
      });
    }
    if (session()->has('FilterCategory')) {
      $instTYpe = $instTYpe->whereHas('getPrograms', function ($query) {
        $query->where('course_category_id', session()->get('FilterCategory'));
      });
    }
    if (session()->has('FilterSpecialization')) {
      $instTYpe = $instTYpe->whereHas('getPrograms', function ($query) {
        $query->where('specialization_id', session()->get('FilterSpecialization'));
      });
    }
    $instTYpe = $instTYpe->get();
    return $instTYpe;
  }
  public static function states($destinationId)
  {
    $states = University::select('state', 'state_slug')->where(['destination_id' => $destinationId, 'status' => 1])->where('state', '!=', null)->distinct();
    if (session()->has('FilterInstituteType')) {
      $states->where('institute_type_id', session()->get('FilterInstituteType'));
    }
    if (session()->has('FilterLevel')) {
      $states = $states->whereHas('getPrograms', function ($query) {
        $query->where('level_id', session()->get('FilterLevel'));
      });
    }
    if (session()->has('FilterCategory')) {
      $states = $states->whereHas('getPrograms', function ($query) {
        $query->where('course_category_id', session()->get('FilterCategory'));
      });
    }
    if (session()->has('FilterSpecialization')) {
      $states = $states->whereHas('getPrograms', function ($query) {
        $query->where('specialization_id', session()->get('FilterSpecialization'));
      });
    }
    $states = $states->get();
    return $states;
  }
  public static function cities($destinationId)
  {
    $cities = University::select('city', 'city_slug')->where(['destination_id' => $destinationId, 'status' => 1])->where('city', '!=', null)->distinct();

    if (session()->has('FilterState')) {
      $cities = $cities->where(['state_slug' => session()->get('FilterState')]);
    }
    if (session()->has('FilterInstituteType')) {
      $cities->where('institute_type_id', session()->get('FilterInstituteType'));
    }
    if (session()->has('FilterLevel')) {
      $cities = $cities->whereHas('getPrograms', function ($query) {
        $query->where('level_id', session()->get('FilterLevel'));
      });
    }
    if (session()->has('FilterCategory')) {
      $cities = $cities->whereHas('getPrograms', function ($query) {
        $query->where('course_category_id', session()->get('FilterCategory'));
      });
    }
    if (session()->has('FilterSpecialization')) {
      $cities = $cities->whereHas('getPrograms', function ($query) {
        $query->where('specialization_id', session()->get('FilterSpecialization'));
      });
    }
    $cities = $cities->get();
    return $cities;
  }
}
