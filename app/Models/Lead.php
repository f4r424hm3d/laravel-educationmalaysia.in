<?php

namespace App\Models;

use App\Models\Scopes\WebsiteScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Lead extends Model
{
  protected $guarded = [];
  protected static function booted()
  {
    static::addGlobalScope(new WebsiteScope);
  }
  public function setPasswordAttribute($value)
  {
    $this->attributes['password'] = Hash::make($value);
  }

  public function studentApplications()
  {
    return $this->hasMany(StudentApplication::class, 'stdid', 'id');
  }
}
