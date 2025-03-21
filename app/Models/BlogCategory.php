<?php

namespace App\Models;

use App\Models\Scopes\WebsiteScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
  use HasFactory;
  protected $guarded = [];
  protected static function booted()
  {
    static::addGlobalScope(new WebsiteScope);
  }
  public function blogs()
  {
    return $this->hasMany(Blog::class, 'cate_id', 'id');
  }
  public function scopeWebsite($query)
  {
    return $query->where('website', site_var);
  }
}
