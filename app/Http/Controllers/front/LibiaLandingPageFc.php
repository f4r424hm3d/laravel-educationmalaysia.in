<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LibiaLandingPageFc extends Controller
{
  public function index(Request $request)
  {
    return view('front.education-fair-in-libia-2025');
  }
}
