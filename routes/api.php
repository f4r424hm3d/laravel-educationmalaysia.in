<?php

use App\Http\Controllers\Api\BlogApi;
use App\Http\Controllers\Api\CountryApi;
use App\Http\Controllers\Api\CoursesInMalaysiaApi;
use App\Http\Controllers\Api\DropdownListApi;
use App\Http\Controllers\Api\ExamApi;
use App\Http\Controllers\Api\FaqApi;
use App\Http\Controllers\Api\HomeApi;
use App\Http\Controllers\Api\ScholarshipApi;
use App\Http\Controllers\Api\ServiceApi;
use App\Http\Controllers\Api\SpecializationApi;
use App\Http\Controllers\Api\StaticPageSeoApi;
use App\Http\Controllers\Api\StudentAuthApi;
use App\Http\Controllers\Api\UniversityApi;
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

  Route::get('levels', [DropdownListApi::class, 'levels']);
  Route::get('course-categories', [DropdownListApi::class, 'courseCategories']);

  Route::get('/specializations', [SpecializationApi::class, 'index']);
  Route::get('/filter/specializations', [SpecializationApi::class, 'byFilter']);
  Route::get('/specialization-detail-by-id/{id}', [SpecializationApi::class, 'detailById']);
  Route::get('/specialization-detail-by-slug/{slug}', [SpecializationApi::class, 'detailBySlug']);

  Route::get('/exams', [ExamApi::class, 'index']);
  Route::get('/exam-details/{uri}', [ExamApi::class, 'examDetail']);

  Route::get('blog', [BlogApi::class, 'index']);
  Route::get('blog-by-category/{category_slug}', [BlogApi::class, 'blogByCategory']);
  Route::get('blog-details/{category_slug}/{slug}', [BlogApi::class, 'detail']);

  Route::get('/static-page-seo/{page?}', [StaticPageSeoApi::class, 'getSeoData'])->where('page', '.*');

  Route::get('/home', [HomeApi::class, 'index']);
  Route::get('/courses/{level_slug}', [HomeApi::class, 'coursesByLevel']);
  Route::get('/course-category/{slug}', [HomeApi::class, 'courseCategoryDetail']);

  Route::get('services', [ServiceApi::class, 'index']);
  Route::get('service-details/{uri}', [ServiceApi::class, 'serviceDetail']);

  Route::get('/universities', [UniversityApi::class, 'selectUniversity']);
  Route::get('universities/universities-in-malaysia', [UniversityApi::class, 'universitiesInMalaysia']);

  Route::get('university-details/{uname}', [UniversityApi::class, 'universityDetail']);
  Route::get('university-overview/{uname}', [UniversityApi::class, 'overview']);
  Route::get('university-gallery/{uname}', [UniversityApi::class, 'gallery']);
  Route::get('university-videos/{uname}', [UniversityApi::class, 'videos']);
  Route::get('university-courses/{uname}', [UniversityApi::class, 'courses']);
  Route::get('university-course-details/{uname}/{course_slug}', [UniversityApi::class, 'courseDetail']);

  Route::get('courses-in-malaysia', [CoursesInMalaysiaApi::class, 'index']);


  Route::get('scholarships', [ScholarshipApi::class, 'index']);
  Route::get('scholarship-details/{slug}', [ScholarshipApi::class, 'details']);

  Route::get('faqs', [FaqApi::class, 'index']);
  Route::get('faq-details/{category_slug}', [FaqApi::class, 'details']);
});


// STUDENT AUTH API ROUTES
Route::prefix('student')->group(function () {
  Route::post('/register', [StudentAuthApi::class, 'register']);
  Route::post('/verify-otp', [StudentAuthApi::class, 'verifyOtp']);
  Route::post('/resend-otp', [StudentAuthApi::class, 'resendOtp']);

  Route::post('/login', [StudentAuthApi::class, 'login']);
  Route::post('/logout', [StudentAuthApi::class, 'logout'])->middleware('auth:sanctum');
});
