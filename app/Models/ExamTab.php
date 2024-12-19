<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamTab extends Model
{
  use HasFactory;
  public function getParentTab()
  {
    return $this->hasOne(ExamTab::class, 'id', 'parent_id');
  }
  public function getAllMasterContent()
  {
    return $this->hasMany(ExamTabContent::class, 'tab_id', 'id')->where('parent_id', null);
  }
  public function getAllContent()
  {
    return $this->hasMany(ExamTabContent::class, 'tab_id', 'id');
  }
  public function getAllChild()
  {
    return $this->hasMany(ExamTab::class, 'parent_id', 'id');
  }
  public function getUser()
  {
    return $this->hasOne(User::class, 'id', 'author_id');
  }
  public function getExam()
  {
    return $this->hasOne(Exam::class, 'id', 'exam_id');
  }
}
