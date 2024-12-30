<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
  public function banners()
  {
    return $this->hasMany(LandingPageBanner::class, 'landing_page_id', 'id');
  }
  public function faqs()
  {
    return $this->hasMany(LandingPageFaq::class, 'landing_page_id', 'id');
  }
  public function universities()
  {
    return $this->hasMany(LandingPageUniversity::class, 'landing_page_id', 'id');
  }
}
