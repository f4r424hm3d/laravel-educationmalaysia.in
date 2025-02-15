<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Punching extends Model
{
  protected $guarded = [];
  public function user()
  {
    return $this->hasOne(User::class, 'id', 'user_id');
  }
}
