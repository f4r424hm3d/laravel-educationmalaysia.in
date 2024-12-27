<?php

namespace App\Models;

use App\Models\Scopes\WebsiteScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
  use HasFactory;
  protected static function booted()
  {
    static::addGlobalScope(new WebsiteScope);
  }
  public function scopeActive($query)
  {
    return $query->where('status', 1);
  }
}
