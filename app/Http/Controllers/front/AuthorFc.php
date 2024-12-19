<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;

class AuthorFc extends Controller
{
  public function index($author_slug, Request $request)
  {
    $authArr = explode('-', $author_slug);
    $id = $authArr[0];
    $author = User::findOrFail($id);

    $blogs = Blog::limit(9)->orderBy('id', 'desc')->get();

    $data = compact('author', 'blogs');
    return view('front.author')->with($data);
  }
}
