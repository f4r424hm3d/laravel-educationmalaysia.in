<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamTabContent extends Model
{
  use HasFactory;
  public function getParentHeading()
  {
    return $this->hasOne(ExamTabContent::class, 'id', 'parent_id');
  }
  public function getAllChild()
  {
    return $this->hasMany(ExamTabContent::class, 'parent_id', 'id');
  }
}
