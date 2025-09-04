<?php

namespace App\Exports;

use App\Models\CourseSpecialization;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class SpecializationExport implements FromView
{
  public function view(): View
  {
    return view('admin.exports.specializations-list', [
      'rows' => CourseSpecialization::where('website', 'MYS')->get()
    ]);
  }
}
