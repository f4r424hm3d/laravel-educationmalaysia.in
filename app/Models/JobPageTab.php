<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPageTab extends Model
{
  use HasFactory;
  public function getAllContent()
  {
    return $this->hasMany(JobPageTabContent::class, 'tab_id', 'id');
  }
  public function getPage()
  {
    return $this->hasOne(JobPage::class, 'id', 'page_id');
  }
}
