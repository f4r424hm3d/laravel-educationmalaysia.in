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
  public function getSlugAttribute()
  {
    return $this->attributes['uname'];
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
    return $this->hasMany(Review::class, 'university_id', 'id')->where('status', 1);
  }
  public function programs()
  {
    return $this->hasMany(UniversityProgram::class, 'university_id', 'id');
  }
  public function activePrograms()
  {
    return $this->hasMany(UniversityProgram::class, 'university_id', 'id')->where('status', 1);
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
  public function scopeHomeview($query)
  {
    return $query->where('homeview', 1);
  }
  public function scopeHead($query)
  {
    return $query->where('parent_university_id', null);
  }
  public function headUniversity()
  {
    return $this->hasOne(University::class, 'id', 'parent_university_id');
  }

  public function scopeWebsite($query)
  {
    return $query->where('website', site_var);
  }
}
