<?php

namespace App\Models;

use App\Models\Scopes\WebsiteScope;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
  protected static function booted()
  {
    static::addGlobalScope(new WebsiteScope);
  }
}
