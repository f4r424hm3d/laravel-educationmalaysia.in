<?php

namespace App\Models;

use App\Models\Scopes\WebsiteScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
  use HasFactory;
  protected $guarded = [];
  protected static function booted()
  {
    static::addGlobalScope(new WebsiteScope);
  }
  public function programs()
  {
    return $this->hasMany(UniversityProgram::class, 'course_category_id');
  }
  public function contents()
  {
    return $this->hasMany(CourseCategoryContent::class, 'course_category_id')->orderBy('position', 'asc');
  }
  public function specializations()
  {
    return $this->hasMany(CourseSpecialization::class, 'course_category_id');
  }
  public function faqs()
  {
    return $this->hasMany(CourseCategoryFaq::class, 'course_category_id');
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
