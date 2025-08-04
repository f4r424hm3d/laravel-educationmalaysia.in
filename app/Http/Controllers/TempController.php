<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\CourseCategory;
use App\Models\CourseSpecialization;
use App\Models\DynamicPageSeo;
use App\Models\StaticPageSeo;
use App\Models\University;
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
  public function moveCourseCategoryImages()
  {
    $categories = CourseCategory::all();
    $fields = ['thumbnail_path', 'banner_path', 'og_image_path'];
    $moved = [];
    $notFound = [];

    foreach ($categories as $category) {
      $updated = false;

      foreach ($fields as $field) {
        $imgUrl = $category->{$field};

        if (!$imgUrl) continue;

        // Only process if it's from the old study folder
        if (strpos($imgUrl, 'assets/uploadFiles/study/') !== false) {
          $fileName = basename(parse_url($imgUrl, PHP_URL_PATH));
          $oldPath = 'assets/uploadFiles/study/' . $fileName;
          $newPath = 'uploads/categories/' . $fileName;

          if (file_exists($oldPath)) {
            // Create the new directory if it doesn't exist
            if (!file_exists('uploads/categories')) {
              mkdir('uploads/categories', 0777, true);
            }

            // Move the image
            rename($oldPath, $newPath);

            // Update the field with the new path
            $category->{$field} = $newPath;
            $updated = true;

            $moved[] = "$field => $fileName";
          } else {
            $notFound[] = "$field => $fileName";
          }
        }
      }

      if ($updated) {
        $category->save();
      }
    }

    return response()->json([
      'moved_images' => $moved,
      'not_found_images' => $notFound,
      'message' => 'Course category image migration complete.'
    ]);
  }
  public function moveCourseSpecializationImages()
  {
    $specializations = CourseSpecialization::all();
    $fields = ['thumbnail_path', 'banner_path', 'og_image_path'];
    $moved = [];
    $notFound = [];

    foreach ($specializations as $item) {
      $updated = false;

      foreach ($fields as $field) {
        $imgUrl = $item->{$field};

        if (!$imgUrl) continue;

        $fileName = basename(parse_url($imgUrl, PHP_URL_PATH));

        // Detect old folder (study or og)
        if (strpos($imgUrl, 'assets/uploadFiles/study/') !== false) {
          $oldPath = 'assets/uploadFiles/study/' . $fileName;
        } elseif (strpos($imgUrl, 'assets/uploadFiles/og/') !== false) {
          $oldPath = 'assets/uploadFiles/og/' . $fileName;
        } else {
          continue; // Not from a known source, skip
        }

        $newPath = 'uploads/specializations/' . $fileName;

        if (file_exists($oldPath)) {
          if (!file_exists('uploads/specializations')) {
            mkdir('uploads/specializations', 0777, true);
          }

          rename($oldPath, $newPath);

          $item->{$field} = $newPath;
          $updated = true;

          $moved[] = "$field => $fileName";
        } else {
          // File not found — set to null
          $item->{$field} = null;
          $updated = true;

          $notFound[] = "$field => $fileName (set to null)";
        }
      }

      if ($updated) {
        $item->save();
      }
    }

    return response()->json([
      'moved_images' => $moved,
      'not_found_images' => $notFound,
      'message' => 'Course specialization image migration complete.'
    ]);
  }
  public function moveSeoImages()
  {
    $seos = DynamicPageSeo::all();
    $moved = [];
    $notFound = [];

    foreach ($seos as $seo) {
      $imgUrl = $seo->og_image_path;

      if (!$imgUrl) continue;

      // Only process if it's from the old /og/ folder
      if (strpos($imgUrl, 'assets/uploadFiles/study/') !== false) {
        $fileName = basename(parse_url($imgUrl, PHP_URL_PATH));
        $oldPath = 'assets/uploadFiles/study/' . $fileName;
        $newPath = 'uploads/seos/' . $fileName;

        if (file_exists($oldPath)) {
          // Ensure target folder exists
          if (!file_exists('uploads/seos')) {
            mkdir('uploads/seos', 0777, true);
          }

          // Move the file
          rename($oldPath, $newPath);

          // Update both fields
          $seo->og_image_path = $newPath;
          $seo->og_image_name = $fileName;
          $seo->save();

          $moved[] = $fileName;
        } else {
          // File missing — set both fields to null
          $seo->og_image_path = null;
          $seo->og_image_name = null;
          $seo->save();

          $notFound[] = "$fileName (set to null)";
        }
      }
    }

    return response()->json([
      'moved_images' => $moved,
      'not_found_images' => $notFound,
      'message' => 'SEO OG image migration complete.'
    ]);
  }
  public function moveStaticSeoImages()
  {
    $records = StaticPageSeo::all();
    $moved = [];
    $notFound = [];

    foreach ($records as $seo) {
      $imgUrl = $seo->og_image_path;

      if (!$imgUrl) continue;

      // Only handle images from /study/ folder
      if (strpos($imgUrl, 'assets/uploadFiles/study/') !== false) {
        $fileName = basename(parse_url($imgUrl, PHP_URL_PATH));
        $oldPath = 'assets/uploadFiles/study/' . $fileName;
        $newPath = 'uploads/seos/' . $fileName;

        if (file_exists($oldPath)) {
          if (!file_exists('uploads/seos')) {
            mkdir('uploads/seos', 0777, true);
          }

          // Move file
          rename($oldPath, $newPath);

          // Update fields
          $seo->og_image_path = $newPath;
          $seo->og_image_name = $fileName;
          $seo->save();

          $moved[] = $fileName;
        } else {
          // Set null if not found
          $seo->og_image_path = null;
          $seo->og_image_name = null;
          $seo->save();

          $notFound[] = "$fileName (set to null)";
        }
      }
    }

    return response()->json([
      'moved_images' => $moved,
      'not_found_images' => $notFound,
      'message' => 'Static SEO OG image migration complete.'
    ]);
  }
  public function moveUniversityLogos()
  {
    $universities = University::all();
    $moved = [];
    $notFound = [];

    foreach ($universities as $university) {
      $logoPath = $university->logo_path;

      if (!$logoPath) continue;

      // Extract filename from URL or relative path
      $fileName = basename(parse_url($logoPath, PHP_URL_PATH));

      // Determine source folder based on path
      if (strpos($logoPath, 'assets/uploadFiles/study/') !== false) {
        $oldPath = 'assets/uploadFiles/study/' . $fileName;
      } elseif (strpos($logoPath, 'university/') !== false) {
        $oldPath = 'university/' . $fileName;
      } else {
        $oldPath = $logoPath; // fallback — use as-is
      }

      $newPath = 'uploads/university/' . $fileName;

      if (file_exists($oldPath)) {
        // Ensure target directory exists
        if (!file_exists('uploads/university')) {
          mkdir('uploads/university', 0777, true);
        }

        // Move the file
        rename($oldPath, $newPath);

        // Update the DB
        $university->logo_path = $newPath;
        $university->save();

        $moved[] = $fileName;
      } else {
        // Set to null if file missing
        $university->logo_path = null;
        $university->save();

        $notFound[] = "$fileName (set to null)";
      }
    }

    return response()->json([
      'moved_logos' => $moved,
      'not_found_logos' => $notFound,
      'message' => 'University logo migration complete.'
    ]);
  }
  public function moveUniversityBanners()
  {
    $universities = University::all();
    $moved = [];
    $notFound = [];

    foreach ($universities as $university) {
      $logoPath = $university->logo_path;

      if (!$logoPath) continue;

      // Extract filename from URL or relative path
      $fileName = basename(parse_url($logoPath, PHP_URL_PATH));

      // Determine source folder based on path
      if (strpos($logoPath, 'assets/uploadFiles/study/') !== false) {
        $oldPath = 'assets/uploadFiles/study/' . $fileName;
      } elseif (strpos($logoPath, 'university/') !== false) {
        $oldPath = 'university/' . $fileName;
      } else {
        $oldPath = $logoPath; // fallback — use as-is
      }

      $newPath = 'uploads/university/' . $fileName;

      if (file_exists($oldPath)) {
        // Ensure target directory exists
        if (!file_exists('uploads/university')) {
          mkdir('uploads/university', 0777, true);
        }

        // Move the file
        rename($oldPath, $newPath);

        // Update the DB
        $university->logo_path = $newPath;
        $university->save();

        $moved[] = $fileName;
      } else {
        // Set to null if file missing
        $university->logo_path = null;
        $university->save();

        $notFound[] = "$fileName (set to null)";
      }
    }

    return response()->json([
      'moved_logos' => $moved,
      'not_found_logos' => $notFound,
      'message' => 'University logo migration complete.'
    ]);
  }
}
