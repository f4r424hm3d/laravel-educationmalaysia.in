<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityReviews extends Model
{
  use HasFactory;
  public function getUniversity()
  {
    return $this->hasOne(University::class, 'id', 'university_id');
  }
  public function getProgram()
  {
    return $this->hasOne(University::class, 'id', 'university_id');
  }
}
