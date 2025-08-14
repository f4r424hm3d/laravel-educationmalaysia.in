<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
  use HasFactory;
  protected $guarded = [];
  public function allUniversityPrograms()
  {
    return $this->hasMany(UniversityProgram::class, 'level', 'level')->where('status', 1)->where('website', site_var);
  }
}
