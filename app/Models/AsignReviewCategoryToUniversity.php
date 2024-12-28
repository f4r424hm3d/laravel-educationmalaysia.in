<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignReviewCategoryToUniversity extends Model
{
  public function category()
  {
    return $this->belongsTo(ReviewCategory::class, 'category_id');
  }
  public function university()
  {
    return $this->belongsTo(University::class, 'university_id');
  }
}
