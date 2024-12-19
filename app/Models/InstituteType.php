<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituteType extends Model
{
  use HasFactory;
  protected $table = 'institute_types';
  protected $guarded = [];
  public function nou()
  {
    return $this->hasMany(University::class, 'institute_type_id', 'id');
  }
}
