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
      $study_mode = explode(',', $row['study_mode']);
      $study_mode = json_encode($study_mode);
      $course_mode = explode(',', $row['course_mode']);
      $course_mode = json_encode($course_mode);
      $field = UniversityProgram::find($row['id']);
      $field->course_category_id = $spc->course_category_id;
      $field->specialization_id = $row['specialization_id'];
      $field->program_name = $row['program_name'];
      $field->program_slug = slugify($row['program_name']);
      $field->level_id = $row['level_id'];
      $field->duration = $row['duration'];
      $field->study_mode = $study_mode;
      $field->course_mode = $course_mode;
      $field->tution_fees = $row['tution_fees'];
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
