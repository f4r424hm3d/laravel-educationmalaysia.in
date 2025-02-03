<?php

namespace App\Models;

use App\Http\Controllers\front\BlogFc;
use App\Models\Scopes\WebsiteScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
  use HasFactory;
  protected $guarded = [];
  protected static function booted()
  {
    static::addGlobalScope(new WebsiteScope);
  }
  public function category()
  {
    return $this->hasOne(BlogCategory::class, 'id', 'cate_id');
  }
  public function getCategory()
  {
    return $this->hasOne(BlogCategory::class, 'id', 'cate_id');
  }
  public function contents()
  {
    return $this->hasMany(BlogContent::class, 'blog_id', 'id')->orderBy('position', 'asc');
  }
  public function faqs()
  {
    return $this->hasMany(BlogFaq::class, 'blog_id', 'id');
  }
  public function parentContents()
  {
    return $this->hasMany(BlogContent::class, 'blog_id', 'id')->orderBy('position', 'asc')->where('parent_id', null);
  }
  public function author()
  {
    return $this->hasOne(Author::class, 'id', 'author_id');
  }
  public function scopeWebsite($query)
  {
    return $query->where('website', site_var);
  }
}
