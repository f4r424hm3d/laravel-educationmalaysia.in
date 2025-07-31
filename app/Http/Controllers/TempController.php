<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TempController extends Controller
{
  public function blogCategory()
  {
    $categories = BlogCategory::all();
    $deleted = [];
    $notFound = [];

    foreach ($categories as $category) {
      if ($category->imgpath) {
        // Extract the file name from the URL
        $fileName = basename(parse_url($category->imgpath, PHP_URL_PATH));

        // Build the full file path
        $filePath = "assets/uploadFiles/study/{$fileName}";

        // Delete the file if it exists
        if (File::exists($filePath)) {
          File::delete($filePath);
          $deleted[] = $fileName;
        } else {
          $notFound[] = $fileName;
        }
      }
    }

    return response()->json([
      'deleted_images' => $deleted,
      'not_found_images' => $notFound,
      'message' => 'Image deletion process completed.',
    ]);
  }
}
