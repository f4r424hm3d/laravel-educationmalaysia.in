<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class FileUploadHelper
{

  public static function uploadFile($request, $fieldName, $folder)
  {
    if ($request->hasFile($fieldName)) {
      $fileOriginalName = $request->file($fieldName)->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file($fieldName)->getClientOriginalExtension();
      $fileName = $file_name_slug . '_' . time() . '.' . $fileExtention;

      $file = $request->file($fieldName);

      // Upload file to SFTP
      Storage::disk('ftp')->put("uploads/{$folder}/{$fileName}", fopen($file, 'r+'));

      // Return the file path to be stored in the database
      $filePath = '/uploads/' . $folder . '/' . $fileName;
      return ['fileName' => $fileName, 'filePath' => $filePath];
    }

    return null;
  }
  public static function uploadFile2($file, $folder)
  {
    if ($file) {
      $fileOriginalName = $file->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = self::slugify($fileNameWithoutExtention);
      $fileName = $file_name_slug . '-' . time() . '.' . $file->getClientOriginalExtension();

      // Upload file to FTP
      Storage::disk('ftp')->put("uploads/{$folder}/{$fileName}", fopen($file, 'r+'));

      // Return the file path to be stored in the database
      return '/uploads/' . $folder . '/' . $fileName;
    }

    return null;
  }
  public static function uploadMultipleFiles($files, $folder)
  {
    $uploadedFiles = [];

    if (!empty($files)) {
      foreach ($files as $file) {
        $filePath = self::uploadFile2($file, $folder);
        if ($filePath) {
          $uploadedFiles[] = $filePath;
        }
      }
    }

    return $uploadedFiles;
  }

  // Slugify function for consistency
  private static function slugify($text)
  {
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $text), '-'));
  }
}
