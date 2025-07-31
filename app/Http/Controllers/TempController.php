<?php

namespace App\Http\Controllers;

use App\Models\Blog;
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
  public function moveBlogImages()
  {
    $blogs = Blog::all();
    $moved = [];
    $skipped = [];
    $notFound = [];

    foreach ($blogs as $blog) {
      $imgpath = $blog->imgpath;

      if (!$imgpath) continue;

      // Case 1: Full URL
      if (strpos($imgpath, 'assets/uploadFiles/study/') !== false) {
        $fileName = basename(parse_url($imgpath, PHP_URL_PATH));
        $oldPath = 'assets/uploadFiles/study/' . $fileName;
        $newPath = 'uploads/blogs/' . $fileName;

        // Check if old file exists
        if (file_exists($oldPath)) {
          // Create target directory if not exists
          if (!file_exists('uploads/blogs')) {
            mkdir('uploads/blogs', 0777, true);
          }

          // Move file
          rename($oldPath, $newPath);

          // Update DB
          $blog->thumbnail_name = $fileName;
          $blog->thumbnail_path = $newPath;
          $blog->save();

          $moved[] = $fileName;
        } else {
          $notFound[] = $fileName;
        }
      }

      // Case 2: Already in `uploads/blogs/`
      elseif (strpos($imgpath, 'uploads/blogs/') !== false) {
        $fileName = basename($imgpath);
        $blog->thumbnail_name = $fileName;
        $blog->thumbnail_path = 'uploads/blogs/' . $fileName;
        $blog->save();

        $skipped[] = $fileName; // No move needed
      }
    }

    return response()->json([
      'moved' => $moved,
      'skipped' => $skipped,
      'not_found' => $notFound,
      'message' => 'Blog image processing completed.',
    ]);
  }
}
