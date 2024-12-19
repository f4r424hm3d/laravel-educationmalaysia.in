<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPage extends Model
{
  use HasFactory;
  public function getAllTabs()
  {
    return $this->hasMany(JobPageTab::class, 'page_id', 'id')->orderBy('position');
  }
  public function getAuthor()
  {
    return $this->hasOne(User::class, 'id', 'author_id');
  }
}
