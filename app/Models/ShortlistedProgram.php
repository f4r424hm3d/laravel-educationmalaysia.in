<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortlistedProgram extends Model
{
  use HasFactory;
  public function getProgram()
  {
    return $this->hasOne(UniversityProgram::class, 'id', 'program_id')->with('getUniversity');
  }
  public function getProgramWithAll()
  {
    return $this->hasOne(UniversityProgram::class, 'id', 'program_id')->with('getCategory', 'getSpecialization', 'getLevel');
  }
  public function getStudent()
  {
    return $this->hasOne(Student::class, 'id', 'student_id');
  }
}
