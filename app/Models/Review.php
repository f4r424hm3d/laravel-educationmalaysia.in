<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
  public function categoryReviews()
  {
    return $this->hasMany(UniversityCategoryReview::class, 'review_id');
  }
}
