<?php

namespace App\Exports;

use App\Models\UniversityProgram;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class UniversityProgramsExport implements FromView
{
  /**
   * @return \Illuminate\Support\Collection
   */
  protected $university_id;
  public function __construct(array $data)
  {
    $this->university_id = $data['university_id'];
  }
  public function view(): View
  {
    return view('admin.exports.university-programs-list', [
      'rows' => UniversityProgram::where('university_id', $this->university_id)->get()
    ]);
  }
}
