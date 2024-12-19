<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
  use HasFactory;
  public function getPosition()
  {
    return $this->hasOne(Career::class, 'id', 'position_id');
  }
}
