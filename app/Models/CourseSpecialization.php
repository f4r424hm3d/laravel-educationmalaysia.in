<?php

namespace App\Models;

use App\Models\Scopes\WebsiteScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSpecialization extends Model
{
  use HasFactory;
  protected $guarded = [];
  protected static function booted()
  {
    static::addGlobalScope(new WebsiteScope);
  }
  public function courseCategory()
  {
    return $this->belongsTo(CourseCategory::class, 'course_category_id', 'id');
  }

  public function universityPrograms()
  {
    return $this->hasMany(UniversityProgram::class, 'specialization_id', 'id');
  }
  public function universities()
  {
    return $this->hasManyThrough(
      University::class,
      UniversityProgram::class,
      'specialization_id', // Foreign key on UniversityProgram
      'id',                // Foreign key on University
      'id',                // Local key on CourseSpecialization
      'university_id'      // Local key on UniversityProgram
    );
  }

  public function getCategory()
  {
    return $this->hasOne(CourseCategory::class, 'id', 'course_category_id');
  }
  public function contents()
  {
    return $this->hasMany(SpecializationContent::class, 'specialization_id')->orderBy('position', 'asc');
  }
  public function levelContents()
  {
    return $this->hasMany(LevelSpecializationContent::class, 'specialization_id');
  }
  public function programs()
  {
    return $this->hasMany(UniversityProgram::class, 'specialization_id');
  }
  public function faqs()
  {
    return $this->hasMany(CourseSpecializationFaq::class, 'specialization_id');
  }
  public function author()
  {
    return $this->belongsTo(Author::class, 'author_id');
  }
  public function scopeWebsite($query)
  {
    return $query->where('website', site_var);
  }
}
