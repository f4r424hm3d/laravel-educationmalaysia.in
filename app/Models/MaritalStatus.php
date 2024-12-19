<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class MaritalStatus extends Model
{
  use HasFactory;
  protected function maritalStatus(): Attribute
  {
    return Attribute::make(
      get: fn (string $value) => ucfirst($value),
    );
  }
}
