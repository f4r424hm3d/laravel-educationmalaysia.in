<?php

namespace App\Exports;

use App\Models\University;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UniversityListExport implements FromView
{
  /**
   * @return \Illuminate\Support\Collection
   */
  public function view(): View
  {
    return view('admin.exports.university-list', [
      'rows' => University::get()
    ]);
  }
}
