<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryApi extends Controller
{
  public function index(Request $request)
  {
    $search = $request->query('search');
    $orderBy = $request->query('orderBy', 'name');
    $orderIn = $request->query('orderIn', 'asc');
    $limit = $request->query('limit');

    $query = Country::query();

    if ($search) {
      $query->where('name', 'like', '%' . $search . '%');
    }

    $query->orderBy($orderBy, $orderIn);

    if ($limit) {
      $query->limit((int) $limit);
    }

    $countries = $query->get();

    return response()->json([
      'status' => true,
      'data' => $countries
    ]);
  }
  public function phonecodes(Request $request)
  {
    $search = $request->query('search');
    $orderBy = $request->query('orderBy', 'phonecode');
    $orderIn = $request->query('orderIn', 'asc');
    $limit = $request->query('limit');

    $query = Country::select('id', 'name', 'phonecode')->where('phonecode', '!=', 0);

    if ($search) {
      $query->where('name', 'like', '%' . $search . '%');
    }

    $query->orderBy($orderBy, $orderIn);

    if ($limit) {
      $query->limit((int) $limit);
    }

    $countries = $query->get();

    return response()->json([
      'status' => true,
      'data' => $countries
    ]);
  }
}
