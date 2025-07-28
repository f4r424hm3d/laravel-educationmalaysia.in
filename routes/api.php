<?php

use App\Http\Controllers\Api\CountryApi;
use App\Http\Controllers\Api\ExamApi;
use App\Http\Controllers\Api\SpecializationApi;
use App\Http\Controllers\Api\StaticPageSeoApi;
use App\Http\Middleware\CheckApiKey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::post('/login', function (Request $request) {
  $request->validate([
    'email' => 'required|email',
    'password' => 'required',
  ]);

  $user = User::where('email', $request->email)->first();

  if (!$user || !Hash::check($request->password, $user->password)) {
    return response()->json([
      'message' => 'Invalid credentials'
    ], 401);
  }

  $token = $user->createToken('api-token')->plainTextToken;

  return response()->json([
    'token' => $token,
    'user' => $user,
  ]);
});

Route::get('/test', function () {
  return response()->json(['message' => 'Test successful']);
});

Route::middleware([CheckApiKey::class])->group(function () {
  Route::get('/countries', [CountryApi::class, 'index']);
  Route::get('/phonecodes', [CountryApi::class, 'phonecodes']);

  Route::get('/specializations', [SpecializationApi::class, 'index']);
  Route::get('/filter/specializations', [SpecializationApi::class, 'byFilter']);
  Route::get('/specialization-detail-by-id/{id}', [SpecializationApi::class, 'detailById']);
  Route::get('/specialization-detail-by-slug/{slug}', [SpecializationApi::class, 'detailBySlug']);


  Route::get('/exams', [ExamApi::class, 'index']);
  Route::get('/exam-details/{uri}', [ExamApi::class, 'examDetail']);

  Route::get('/static-page-seo/{page?}', [StaticPageSeoApi::class, 'getSeoData'])->where('page', '.*');
});
