<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Lead extends Model
{
  public function setPasswordAttribute($value)
  {
    $this->attributes['password'] = Hash::make($value);
  }

  public function studentApplications()
  {
    return $this->hasMany(StudentApplication::class, 'stdid', 'id');
  }
}
