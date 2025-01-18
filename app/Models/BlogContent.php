<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogContent extends Model
{
  public function childContents()
  {
    return $this->hasMany(BlogContent::class, 'parent_id', 'id')->orderBy('position', 'asc')->where('parent_id', '!=', null);
  }
}
