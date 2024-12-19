<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
  use HasFactory;
  public function blogs()
  {
    return $this->hasMany(Blog::class, 'cate_id', 'id');
  }
  public function scopeWebsite($query)
  {
    return $query->where('website', site_var);
  }
}
