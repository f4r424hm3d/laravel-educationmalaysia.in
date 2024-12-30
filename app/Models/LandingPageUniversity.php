<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPageUniversity extends Model
{

  public function university()
  {
    return $this->hasOne(University::class, 'id', 'university_id');
  }
  public function landingPage()
  {
    return $this->hasOne(LandingPage::class, 'id', 'landing_page_id');
  }
}
