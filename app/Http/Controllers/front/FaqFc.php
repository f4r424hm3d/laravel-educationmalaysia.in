<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqFc extends Controller
{

  public function index(Request $request)
  {
    $categories = FaqCategory::whereHas('faqs')->get();
    $data = compact('categories');
    return view('front.faqs')->with($data);
  }
  public function byCategory($category_slug, Request $request)
  {
    $category = FaqCategory::where('category_slug', $category_slug)->firstOrFail();
    $categories = FaqCategory::whereHas('faqs')->get();
    $data = compact('categories', 'category');
    return view('front.faq-by-category')->with($data);
  }
}
