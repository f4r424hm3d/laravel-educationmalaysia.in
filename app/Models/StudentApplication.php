<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentApplication extends Model
{
  public function universityProgram()
  {
    return $this->belongsTo(UniversityProgram::class, 'prog_id', 'id');
  }

  // Relationship to get lead
  public function lead()
  {
    return $this->belongsTo(lead::class, 'stdid', 'id');
  }
}
