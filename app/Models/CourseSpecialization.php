<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSpecialization extends Model
{
  use HasFactory;
  protected $guarded = [];
  public function getCategory()
  {
    return $this->hasOne(CourseCategory::class, 'id', 'course_category_id');
  }
  public function contents()
  {
    return $this->hasMany(SpecializationContent::class, 'specialization_id')->orderBy('position', 'asc');
  }
  public function faqs()
  {
    return $this->hasMany(CourseSpecializationFaq::class, 'specialization_id')->orderBy('position', 'asc');
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
