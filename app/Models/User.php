<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * Automatically hash the password when it is set.
   *
   * @param  string  $value
   * @return void
   */
  public function setPasswordAttribute($value)
  {
    $this->attributes['password'] = Hash::make($value);
  }

  public function scopeEmployees($query)
  {
    $query->where('role', 'employee');
  }
  public function scopeAuthor($query)
  {
    $query->where('role', 'author');
  }
  public function empByDepartment()
  {
    return $this->hasMany(User::class, 'department', 'department')->orderBy('priority');
  }
  public function ws()
  {
    return $this->hasOne(EmployeeStatus::class, 'id', 'working_status');
  }
}
