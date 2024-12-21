<?php

namespace App\Models;

use App\Models\Scopes\WebsiteScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicPageSeo extends Model
{
  use HasFactory;
  protected static function booted()
  {
    static::addGlobalScope(new WebsiteScope);
  }
  public function scopeWebsite($query)
  {
    return $query->where('website', site_var);
  }
}
