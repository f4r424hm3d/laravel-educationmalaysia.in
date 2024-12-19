<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationArticleContents extends Model
{
  use HasFactory;
  public function getParentHeading()
  {
    return $this->hasOne(DestinationArticleContents::class, 'id', 'parent_id');
  }
  public function getAllChild()
  {
    return $this->hasMany(DestinationArticleContents::class, 'parent_id', 'id');
  }
}
