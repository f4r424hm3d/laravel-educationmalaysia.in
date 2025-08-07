<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\CourseCategory;
use App\Models\CourseSpecialization;
use App\Models\DynamicPageSeo;
use App\Models\StaticPageSeo;
use App\Models\University;
use App\Models\UniversityOverview;
use App\Models\UniversityPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TempController extends Controller
{
  public function photos()
  {
    $photos = UniversityPhoto::where('website', 'MYS')->get();

    $oldDir = 'assets/uploadFiles/study/';
    $newDir = 'uploads/university/photos/';
    $baseUrl = 'https://www.educationmalaysia.in/assets/uploadFiles/study/';

    // Make sure destination directory exists
    if (!file_exists($newDir)) {
      mkdir($newDir, 0777, true);
    }

    $moved = [];
    $notFound = [];

    foreach ($photos as $photo) {
      $photoPath = $photo->photo_path;

      if (!$photoPath) continue;

      // Only process if it's a URL from the old directory
      if (strpos($photoPath, $baseUrl) !== false) {
        $fileName = basename(parse_url($photoPath, PHP_URL_PATH));
        $oldPath = $oldDir . $fileName;
        $newPath = $newDir . $fileName;

        if (file_exists($oldPath)) {
          // Move file
          rename($oldPath, $newPath);

          // Update DB
          $photo->photo_name = $fileName;
          $photo->photo_path = $newDir . $fileName;
          $photo->save();

          $moved[] = $fileName;
        } else {
          // File not found — set fields to null
          $photo->photo_path = null;
          $photo->save();

          $notFound[] = $fileName;
        }
      }
    }

    return response()->json([
      'moved' => $moved,
      'not_found' => $notFound,
      'message' => 'University photo migration completed.'
    ]);
  }
}
