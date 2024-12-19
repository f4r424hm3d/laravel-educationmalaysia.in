<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
  use HasFactory;
  public function category()
  {
    return $this->hasOne(BlogCategory::class, 'id', 'cate_id');
  }
  public function contents()
  {
    return $this->hasMany(BlogContent::class, 'id', 'blog_id')->orderBy('position', 'asc');
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