<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticPageSeo extends Model
{
  use HasFactory;
  public function scopeWebsite($query)
  {
    return $query->where('website', site_var);
  }
}
