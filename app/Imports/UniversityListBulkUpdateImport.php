<?php

namespace App\Imports;

use App\Models\InstituteType;
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

      $instituteType = InstituteType::find($row['institute_type']);

      $field->name = $row['name'];
      $field->uname = slugify($row['name']);
      $field->views = $row['views'];
      $field->city = $row['city'];
      $field->state = $row['state'];
      $field->inst_type = $instituteType->type ?? null;
      $field->institute_type = $row['institute_type'];
      $field->rating = $row['rating'];
      $field->rank = $row['rank'];
      $field->qs_rank = $row['qs_rank'];
      $field->times_rank = $row['times_rank'];
      $field->shortnote = $row['shortnote'];
      $field->featured = $row['featured'];
      $field->latitude_longitude = $row['latitude_longitude'];
      $field->shortnote = $row['shortnote'];

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
