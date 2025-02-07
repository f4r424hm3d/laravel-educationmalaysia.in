<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AsignedLead extends Model
{
  use HasFactory;

  protected $fillable = ['std_id', 'clr_id', 'status'];

  public static function autoAssign($lastId)
  {
    $autoAsignUsers = User::where('automatic_asign_lead', 1)->get();

    if ($autoAsignUsers->isNotEmpty()) {
      foreach ($autoAsignUsers as $user) {
        self::create([
          'std_id' => $lastId,
          'clr_id' => $user->id,
          'status' => '1',
        ]);
      }
    }
  }
}
