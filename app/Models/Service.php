<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
  use HasFactory;
  protected $guarded = [];
  protected $table = 'site_pages';

  public function contents()
  {
    return $this->hasMany(ServiceContent::class, 'page_id');
  }

  public function scopeWebsite($query)
  {
    return $query->where('website', site_var);
  }
}