<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\AsignedLead;

class AutoAssignLead
{
  public static function autoAssignLeads($lastId)
  {
    $autoAsignUsers = User::where('automatic_asign_lead', 1)->get(); // Fixing query

    if ($autoAsignUsers->isNotEmpty()) { // Check if users exist
      foreach ($autoAsignUsers as $user) {
        AsignedLead::create([
          'std_id' => $lastId,
          'clr_id' => $user->id,
          'status' => '1',
        ]);
      }
    }
  }
}
