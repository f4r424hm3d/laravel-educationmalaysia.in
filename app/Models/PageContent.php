<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
  protected $table = 'page_contents';

  public function author()
  {
    return $this->belongsTo(Author::class, 'author_id', 'id');
  }
}
