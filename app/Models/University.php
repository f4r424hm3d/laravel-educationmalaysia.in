<?php

namespace App\Models;

use App\Models\Scopes\WebsiteScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
  use HasFactory;
  protected $guarded = [];
  protected static function booted()
  {
    static::addGlobalScope(new WebsiteScope);
  }

  public function instituteType()
  {
    return $this->hasOne(InstituteType::class, 'id', 'institute_type');
  }

  public function scholarships()
  {
    return $this->hasMany(UniversityScholarship::class, 'u_id', 'id');
  }
  public function reviews()
  {
    return $this->hasMany(UniversityReviews::class, 'u_id', 'id');
  }
  public function programs()
  {
    return $this->hasMany(UniversityProgram::class, 'university_id', 'id');
  }
  public function photos()
  {
    return $this->hasMany(UniversityPhoto::class, 'u_id', 'id');
  }
  public function videos()
  {
    return $this->hasMany(UniversityVideo::class, 'u_id', 'id');
  }
  public function overviews()
  {
    return $this->hasMany(UniversityOverview::class, 'u_id', 'id');
  }
  public function scopeActive($query)
  {
    return $query->where('status', 1);
  }
  public function scopeHead($query)
  {
    return $query->where('parent_university_id', null);
  }
  public function headUniversity()
  {
    return $this->hasOne(University::class, 'id', 'parent_university_id');
  }

  public static function getRelatedUniversities($specializationId, $startFrom)
  {
    return self::select('universities.*')
      ->join('university_programs', 'universities.id', '=', 'university_programs.university_id')
      ->where('university_programs.website', site_var)
      ->where('universities.website', site_var)
      ->where('university_programs.status', 1)
      ->where('universities.status', 1)
      ->where('university_programs.specialization_id', $specializationId)
      ->groupBy('university_programs.university_id')
      ->orderBy('universities.name', 'ASC')
      ->skip($startFrom)
      ->take(10)
      ->get();
  }
  public static function getCatRelatedUniversities($course_category_id, $start_from)
  {
    return self::select('university_programs.university_id', 'universities.*')
      ->join('universities', 'universities.id', '=', 'university_programs.university_id')
      ->where('university_programs.website', config('app.site_var'))
      ->where('universities.website', config('app.site_var'))
      ->where('university_programs.status', 1)
      ->where('universities.status', 1)
      ->where('university_programs.course_category_id', $course_category_id)
      ->groupBy('university_programs.university_id')
      ->orderBy('universities.name', 'ASC')
      ->skip($start_from)
      ->take(5)
      ->get();
  }

  public function scopeWebsite($query)
  {
    return $query->where('website', site_var);
  }
}
