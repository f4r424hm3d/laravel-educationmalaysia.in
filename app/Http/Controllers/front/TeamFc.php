<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TeamFc extends Controller
{

  public function team(Request $request)
  {
    $rows = User::employees()->select('department', 'id')->groupBy('department')->get();
    $all = User::orderBy('priority')->employees()->get();
    $data = compact('rows', 'all');
    return view('front.team')->with($data);
  }
  public function userDetail($slug, Request $request)
  {
    $array = explode('-', $slug);
    $user_id = array_pop($array);
    $user = User::findOrFail($user_id);
    $data = compact('user');
    return view('front.team-member-detail')->with($data);
  }
}
