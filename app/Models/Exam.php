<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
  use HasFactory;
  public function getAllTabs()
  {
    return $this->hasMany(ExamTab::class, 'exam_id', 'id');
  }
  public function getAllMasterTabs()
  {
    return $this->hasMany(ExamTab::class, 'exam_id', 'id')->where('parent_id', null)->where('header_view', '1');
  }
  public function getAllTabsForSide()
  {
    return $this->hasMany(ExamTab::class, 'exam_id', 'id')->where('header_view', '0');
  }
  public function scopeWebsite($query)
  {
    return $query->where('website', site_var);
  }
}
