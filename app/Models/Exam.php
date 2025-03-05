<?php

namespace App\Models;

use App\Models\Scopes\WebsiteScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
  use HasFactory;
  protected static function booted()
  {
    static::addGlobalScope(new WebsiteScope);
  }
}
