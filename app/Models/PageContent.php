<?php

namespace App\Models;

use App\Models\Scopes\WebsiteScope;
use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
  protected $table = 'page_contents';
  protected static function booted()
  {
    static::addGlobalScope(new WebsiteScope);
  }
  public function author()
  {
    return $this->belongsTo(Author::class, 'author_id', 'id');
  }
}
