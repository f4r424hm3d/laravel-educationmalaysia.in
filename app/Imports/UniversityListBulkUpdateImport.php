<?php

namespace App\Imports;

use App\Models\University;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UniversityListBulkUpdateImport implements ToCollection, WithHeadingRow, WithChunkReading, WithBatchInserts
{
  /**
   * @param Collection $collection
   */
  public function startRow(): int
  {
    return 2;
  }
  public function collection(collection $rows)
  {
    $rowsInserted = 0;
    $totalRows = 0;
    foreach ($rows as $row) {

      $field = University::find($row['id']);

      $field->name = $row['name'];
      $field->slug = slugify($row['name']);
      $field->destination_id = $row['destination_id'];
      $field->parent_university_id = $row['parent_university_id'];
      $field->address = $row['address'];
      $field->city = $row['city'];
      $field->city_slug = slugify($row['city']);
      $field->state = $row['state'];
      $field->state_slug = slugify($row['state']);
      $field->country = $row['country'];
      $field->institute_type_id = $row['institute_type_id'];
      $field->founded = $row['founded'];
      $field->university_rank = $row['university_rank'];
      $field->qs_rank = $row['qs_rank'];
      $field->us_world_rank = $row['us_world_rank'];

      $field->save();
      $rowsInserted++;
      $totalRows++;
    }
    if ($rowsInserted > 0) {
      session()->flash('smsg', $rowsInserted . ' out of ' . $totalRows . ' rows imported succesfully.');
    } else {
      session()->flash('emsg', 'Data not imported. Duplicate rows found.');
    }
  }

  public function chunkSize(): int
  {
    return 1000;
  }
  public function batchSize(): int
  {
    return 1000;
  }
}
