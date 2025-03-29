<?php

namespace App\Models;

use App\Models\Scopes\WebsiteScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
  use HasFactory;
  // Allow mass assignment for these fields
  protected $fillable = ['name', 'email', 'user_type', 'country', 'review'];
  protected static function booted()
  {
    static::addGlobalScope(new WebsiteScope);
  }
  public function scopeActive($query)
  {
    return $query->where('status', 1);
  }
}
