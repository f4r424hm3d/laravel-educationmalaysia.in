<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
  public function scopeWebsite($query)
  {
    return $query->where('website', site_var);
  }
  public function contents()
  {
    return $this->hasMany(ScholarshipContent::class, 'scholarship_id')->orderBy('position', 'asc');
  }
  public function faqs()
  {
    return $this->hasMany(ScholarshipFaq::class, 'scholarship_id');
  }
}
