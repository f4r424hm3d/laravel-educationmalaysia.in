<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommonController extends Controller
{
  public function getSubStatusByStatus(Request $request)
  {
    //echo $id;
    $field = DB::table('lead_sub_statuses')->where('status_id', $request['status_id'])->get();
    $output = '<option value="">Select</option>';
    foreach ($field as $row) {
      $output .= '<option value="' . $row->id . '">' . $row->sub_status . '</option>';
    }
    echo $output;
  }
  public function changeStatus(Request $request)
  {
    echo $result = DB::table($request->tbl)->where('id', $request->id)->update(['status' => DB::raw('1 - status')]);
    //echo $result = DB::table($request->tbl)->where('id', $request->id)->update(['status' => $request->val]);
  }
  public function updateField(Request $request)
  {
    echo $result = DB::table($request->tbl)->whereIn('id', $request->ids)->update([$request->col => $request->val]);
  }
  public function updateFieldById(Request $request)
  {
    return $result = DB::table($request->tbl)->where('id', $request->id)->update([$request->col => $request->val]);
  }
  public function updateBulkField(Request $request)
  {
    $result = DB::table($request->tbl)->whereIn('id', $request->ids)->update([$request->col => $request->val]);
    return response()->json(['affected_rows' => $result]);
  }
  public function bulkDelete(Request $request)
  {
    $result = DB::table($request->tbl)->whereIn('id', $request->ids)->delete();
    return response()->json(['affected_rows' => $result]);
  }


  public function getCountryByDestination(Request $request)
  {
    //echo $id;
    $field = DB::table('destinations')->where('id', $request['destination_id'])->first();
    $output = $field->country;
    echo $output;
  }

  public function slugify(Request $request)
  {
    //echo $id;
    $output = slugify($request->text);
    echo $output;
  }
}
