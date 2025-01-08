<?php

namespace App\Imports;

use App\Models\CourseSpecialization;
use App\Models\UniversityProgram;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UniversityProgramImport implements ToCollection, WithHeadingRow, WithChunkReading, WithBatchInserts
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
    $exist = 0;
    $spcArr = [];
    foreach ($rows as $row) {
      $where = [
        'university_id' => $this->university_id,
        'specialization_id' => $row['specialization_id'],
        'level' => $row['level'],
        'course_name' => $row['course_name'],
      ];
      $data = UniversityProgram::where($where)->count();
      if ($data == 0) {
        $spc = CourseSpecialization::find($row['specialization_id']);
        if ($spc != false) {
          UniversityProgram::create([
            'university_id' => $this->university_id,
            'course_category_id' => $spc->course_category_id,
            'specialization_id' => $row['specialization_id'],
            'level' => $row['level'],
            'course_name' => $row['course_name'],
            'slug' => slugify($row['course_name']),
            'duration' => $row['duration'],
            'study_mode' => implode(',', $row['study_mode']),
            'intake' => implode(',', $row['intake']),
            'application_deadline' => $row['application_deadline'],
            'tution_fee' => $row['tution_fee'],
            'overview' => $row['overview'],
            'entry_requirement' => $row['entry_requirement'],
            'exam_required' => $row['exam_required'],
            'mode_of_instruction' => $row['mode_of_instruction'],
            'scholarship_info' => $row['scholarship_info'],
          ]);
          $rowsInserted++;
        } else {
          $spcArr[] = $row['specialization_id'];
        }
      } else {
        $exist++;
      }
      $totalRows++;
    }
    $spcjson = json_encode($spcArr);
    $nir = $totalRows - $rowsInserted;
    $emsg = '';
    if ($rowsInserted > 0) {
      session()->flash('smsg', $rowsInserted . ' out of ' . $totalRows . ' rows imported succesfully.');
      if (count($spcArr) > 0) {
        $emsg .= 'There are ' . count($spcArr) . ' entry with wrong specialization id. List of wrong id : ' . $spcjson . '. ';
      }
      if ($exist > 0) {
        $emsg .= $exist . ' rows with same data already exist.';
        session()->flash('emsg', $emsg);
      }
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
