<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultOgImage extends Model
{
  use HasFactory;
  public function scopeDefault($query)
  {
    return $query->where('page', 'all');
  }
}
