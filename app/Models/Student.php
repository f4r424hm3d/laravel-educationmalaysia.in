<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Student extends Model
{
  use HasFactory;
  protected $guarded = [];

  public function setPasswordAttribute($value)
  {
    $this->attributes['password'] = Hash::make($value);
  }

  public function getLevel()
  {
    return $this->hasOne(Level::class, 'id', 'current_qualification_level');
  }
  public function getCourse()
  {
    return $this->hasOne(CourseCategory::class, 'id', 'intrested_course_category');
  }
}
