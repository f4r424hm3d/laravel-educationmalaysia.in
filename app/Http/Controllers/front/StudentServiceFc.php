<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Destination;
use Illuminate\Http\Request;

class StudentServiceFc extends Controller
{
  public function index(Request $request)
  {
    $blogs = Blog::limit(10)->get();
    $destinations = Destination::where(['status' => 1])->limit(10)->get();
    $data = compact('destinations', 'blogs');
    return view('front.student-services')->with($data);
  }
  public function franchise(Request $request)
  {
    $blogs = Blog::limit(10)->get();
    $destinations = Destination::where(['status' => 1])->limit(10)->get();
    $data = compact('destinations', 'blogs');
    return view('front.franchise-services')->with($data);
  }
  public function partner(Request $request)
  {
    $blogs = Blog::limit(10)->get();
    $destinations = Destination::where(['status' => 1])->limit(10)->get();
    $data = compact('destinations', 'blogs');
    return view('front.partner-services')->with($data);
  }
  public function university(Request $request)
  {
    $blogs = Blog::limit(10)->get();
    $destinations = Destination::where(['status' => 1])->limit(10)->get();
    $data = compact('destinations', 'blogs');
    return view('front.university-services')->with($data);
  }
}
