<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityScholarship extends Model
{
  use HasFactory;
  public function getLevel()
  {
    return $this->hasOne(Level::class, 'id', 'level_id');
  }
  public function getUniversity()
  {
    return $this->hasOne(University::class, 'id', 'university_id');
  }
}
