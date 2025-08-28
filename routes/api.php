<?php

use App\Http\Controllers\Api\BlogApi;
use App\Http\Controllers\Api\CountryApi;
use App\Http\Controllers\Api\CoursesInMalaysiaApi;
use App\Http\Controllers\Api\DropdownListApi;
use App\Http\Controllers\Api\ExamApi;
use App\Http\Controllers\Api\FaqApi;
use App\Http\Controllers\Api\HomeApi;
use App\Http\Controllers\Api\InquiryApi;
use App\Http\Controllers\Api\ScholarshipApi;
use App\Http\Controllers\Api\ServiceApi;
use App\Http\Controllers\Api\SpecializationApi;
use App\Http\Controllers\Api\StaticPageSeoApi;
use App\Http\Controllers\Api\StudentAuthApi;
use App\Http\Controllers\Api\StudentProfileApi;
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
  Route::get('genders', [DropdownListApi::class, 'genders']);
  Route::get('marital-statuses', [DropdownListApi::class, 'maritalStatuses']);

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

  Route::prefix('/inquiry')->group(function () {
    Route::post('/university-profile-form', [InquiryApi::class, 'universityProfile'])->name('inquiry.university.profile');
    Route::post('/stream-page-inquiry', [InquiryApi::class, 'streamPage'])->name('stream.inquiry');
    Route::post('/simple-form', [InquiryApi::class, 'simpleForm'])->name('simple.inquiry');

    Route::post('/brochure-request', [InquiryApi::class, 'brochureRequest'])->name('brochure.inquiry');
    Route::post('/modal-form', [InquiryApi::class, 'modalForm'])->name('modal.submit');
  });
});


// STUDENT AUTH API ROUTES
Route::prefix('student')->group(function () {
  Route::post('/register', [StudentAuthApi::class, 'register']);
  Route::post('/verify-otp', [StudentAuthApi::class, 'verifyOtp']);
  Route::post('/resend-otp', [StudentAuthApi::class, 'resendOtp']);

  Route::post('/login', [StudentAuthApi::class, 'login']);

  // Protected routes require Sanctum auth
  Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [StudentProfileApi::class, 'profile']);
    Route::get('/schools', [StudentProfileApi::class, 'schools']);
    Route::get('/school/{id}', [StudentProfileApi::class, 'school']);
    Route::get('/documents', [StudentProfileApi::class, 'documents']);

    Route::post('/personal-information', [StudentProfileApi::class, 'submitPersonalInfo']);
    Route::post('/education-summary', [StudentProfileApi::class, 'submitEduSum']);
    Route::post('/add-school', [StudentProfileApi::class, 'addSchool']);
    Route::post('/update-school', [StudentProfileApi::class, 'updateSchool']);
    Route::delete('/delete-school/{id}', [StudentProfileApi::class, 'deleteSchool']);
    Route::post('/update-test-score', [StudentProfileApi::class, 'updateTestScore']);
    Route::post('/update-gre-score', [StudentProfileApi::class, 'updateGRE']);
    Route::post('/update-gmat-score', [StudentProfileApi::class, 'updateGMAT']);
    Route::post('/update-sat-score', [StudentProfileApi::class, 'updateSAT']);
    Route::post('/update-background-info', [StudentProfileApi::class, 'updateBI']);
    Route::post('/upload-documents', [StudentProfileApi::class, 'updateDocs']);

    Route::get('/applied-college', [StudentProfileApi::class, 'appliedCollege']);
    Route::get('/shortlist', [StudentProfileApi::class, 'shortlist']);

    Route::post('/change-password', [StudentProfileApi::class, 'changePassword']);
    Route::post('/logout', [StudentProfileApi::class, 'logout']);
  });
});
