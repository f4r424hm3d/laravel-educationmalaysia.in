<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecializationContent extends Model
{
  public function courseSpecialization()
  {
    return $this->belongsTo(CourseSpecialization::class, 'specialization_id');
  }
}
