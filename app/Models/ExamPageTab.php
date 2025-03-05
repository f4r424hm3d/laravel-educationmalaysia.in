<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamPageTab extends Model
{
  public function getParentTab()
  {
    return $this->hasOne(ExamPageTab::class, 'id', 'parent_id');
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
    return $this->hasMany(ExamPageTab::class, 'parent_id', 'id');
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
