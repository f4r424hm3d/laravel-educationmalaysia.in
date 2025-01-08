<?php

namespace App\Imports;

use App\Models\CourseSpecialization;
use App\Models\UniversityProgram;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UniversityProgramBulkUpdateImport implements ToCollection, WithHeadingRow, WithChunkReading, WithBatchInserts
{
  /**
   * @param Collection $collection
   */
  // public function __construct(array $data)
  // {
  //   $this->group_id = $data['group_id'];
  //   $this->question_type = $data['question_type'];
  // }
  protected $university_id;
  public function __construct(array $data)
  {
    $this->university_id = $data['university_id'];
  }
  public function startRow(): int
  {
    return 2;
  }
  public function collection(collection $rows)
  {
    $rowsInserted = 0;
    $totalRows = 0;
    foreach ($rows as $row) {
      $spc = CourseSpecialization::find($row['specialization_id']);

      $field = UniversityProgram::find($row['id']);
      $field->course_category_id = $spc->course_category_id;
      $field->specialization_id = $row['specialization_id'];
      $field->course_name = $row['course_name'];
      $field->slug = slugify($row['course_name']);
      $field->level = $row['level'];
      $field->duration = $row['duration'];
      $field->study_mode = $row['study_mode'];
      $field->intake = $row['intake'];
      $field->application_deadline = $row['application_deadline'];
      $field->tution_fee = $row['tution_fee'];
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
