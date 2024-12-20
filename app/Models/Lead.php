<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
  public function studentApplications()
  {
    return $this->hasMany(StudentApplication::class, 'stdid', 'id');
  }
}
