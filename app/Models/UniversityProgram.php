<?php

namespace App\Models;

use App\Models\Scopes\WebsiteScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityProgram extends Model
{
  use HasFactory;
  protected $guarded = [];
  protected static function booted()
  {
    static::addGlobalScope(new WebsiteScope);
  }
  public function category()
  {
    return $this->hasOne(CourseCategory::class, 'id', 'course_category_id');
  }
  public function getSpecialization()
  {
    return $this->hasOne(CourseSpecialization::class, 'id', 'specialization_id');
  }
  public function level()
  {
    return $this->hasOne(Level::class, 'level', 'level');
  }
  public function getLevel()
  {
    return $this->hasOne(Level::class, 'level', 'level');
  }

  public function university()
  {
    return $this->belongsTo(University::class, 'university_id', 'id');
  }

  public function courseCategory()
  {
    return $this->belongsTo(CourseCategory::class, 'course_category_id', 'id');
  }

  public function courseSpecialization()
  {
    return $this->belongsTo(CourseSpecialization::class, 'specialization_id', 'id');
  }
  public function studentApplications()
  {
    return $this->hasMany(StudentApplication::class, 'prog_id', 'id');
  }
  public function contents()
  {
    return $this->hasMany(UniversityProgramContent::class, 'c_id', 'id');
  }

  public function scopeWebsite($query)
  {
    return $query->where('website', site_var);
  }
}
