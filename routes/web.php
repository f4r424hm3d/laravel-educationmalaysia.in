<?php

use App\Http\Controllers\admin\AdminDashboard;
use App\Http\Controllers\admin\AdminLogin;
use App\Http\Controllers\admin\AuthorC;
use App\Http\Controllers\admin\BlogC;
use App\Http\Controllers\admin\BlogCategoryC;
use App\Http\Controllers\admin\CareerC;
use App\Http\Controllers\admin\CourseCategoryC;
use App\Http\Controllers\admin\CourseCategoryContentC;
use App\Http\Controllers\admin\CourseCategoryFaqC;
use App\Http\Controllers\admin\CourseModeC;
use App\Http\Controllers\admin\CourseSpecializationC;
use App\Http\Controllers\admin\CourseSpecializationContentC;
use App\Http\Controllers\admin\CourseSpecializationFaqC;
use App\Http\Controllers\admin\CourseSpecializationLevelContentC;
use App\Http\Controllers\admin\DefaultOgImageC;
use App\Http\Controllers\admin\DestinationArticleC;
use App\Http\Controllers\admin\DestinationArticleContentC;
use App\Http\Controllers\admin\DestinationArticleFaqsC;
use App\Http\Controllers\admin\DestinationC;
use App\Http\Controllers\admin\DestinationFaqC;
use App\Http\Controllers\admin\DynamicPageSeoC;
use App\Http\Controllers\admin\EmployeeC;
use App\Http\Controllers\admin\EmployeeStatusC;
use App\Http\Controllers\admin\ExamC;
use App\Http\Controllers\admin\ExamContentC;
use App\Http\Controllers\admin\ExamFaqC;
use App\Http\Controllers\admin\ExamPageTabC;
use App\Http\Controllers\admin\ExamPageTabContentC;
use App\Http\Controllers\admin\ExamTabFaqC;
use App\Http\Controllers\admin\FaqC;
use App\Http\Controllers\admin\FaqCategoryC;
use App\Http\Controllers\admin\FeesAndDeadlineC;
use App\Http\Controllers\admin\InstituteTypeC;
use App\Http\Controllers\admin\JobApplicationC;
use App\Http\Controllers\admin\JobPageC;
use App\Http\Controllers\admin\JobPageTabC;
use App\Http\Controllers\admin\JobPageTabContentC;
use App\Http\Controllers\admin\LandingPageBannerC;
use App\Http\Controllers\admin\LandingPageC;
use App\Http\Controllers\admin\LandingPageFaqC;
use App\Http\Controllers\admin\LandingPageUniversityC;
use App\Http\Controllers\admin\LevelC;
use App\Http\Controllers\admin\ProgramC;
use App\Http\Controllers\admin\StaticPageSeoC;
use App\Http\Controllers\admin\ServiceC;
use App\Http\Controllers\admin\ServiceContentC;
use App\Http\Controllers\admin\StudentC;
use App\Http\Controllers\admin\StudyModeC;
use App\Http\Controllers\admin\TestimonialC;
use App\Http\Controllers\admin\UniversityC;
use App\Http\Controllers\admin\UniversityFacilityC;
use App\Http\Controllers\admin\UniversityGalleryC;
use App\Http\Controllers\admin\UniversityOtherContentC;
use App\Http\Controllers\admin\UniversityOverviewC;
use App\Http\Controllers\admin\UniversityProgramC;
use App\Http\Controllers\admin\UniversityProgramContentC;
use App\Http\Controllers\admin\UniversityReviewC;
use App\Http\Controllers\admin\UniversityScholarshipC;
use App\Http\Controllers\admin\UniversityScholarshipContentC;
use App\Http\Controllers\admin\UniversityVideoGalleryC;
use App\Http\Controllers\admin\UploadFilesC;
use App\Http\Controllers\admin\UserC;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\front\AuthorFc;
use App\Http\Controllers\front\BlogFc;
use App\Http\Controllers\front\CompareFc;
use App\Http\Controllers\front\ContactFc;
use App\Http\Controllers\front\CourseCategoryFc;
use App\Http\Controllers\front\ExamFc;
use App\Http\Controllers\front\FaqFc;
use App\Http\Controllers\front\HomeFc;
use App\Http\Controllers\front\InquiryController;
use App\Http\Controllers\front\LibiaLandingPageFc;
use App\Http\Controllers\front\OfferLandingPageFc;
use App\Http\Controllers\front\ReviewFc;
use App\Http\Controllers\front\ServiceFc;
use App\Http\Controllers\front\SpecializationFc;
use App\Http\Controllers\front\UniversityProgramListFc;
use App\Http\Controllers\front\UniversityListFc;
use App\Http\Controllers\front\UniversityProfileCoursesFc;
use App\Http\Controllers\front\UniversityProfileFc;
use App\Http\Controllers\sitemap\SitemapController;
use App\Http\Controllers\student\ApplyProgramFc;
use App\Http\Controllers\student\StudentFc;
use App\Http\Controllers\student\StudentLoginFc;
use App\Http\Middleware\AdminLoggedIn;
use App\Http\Middleware\AdminLoggedOut;
use App\Http\Middleware\StudentLoggedIn;
use App\Http\Middleware\StudentLoggedOut;
use App\Models\Blog;
use App\Models\CourseCategory;
use App\Models\CourseSpecialization;
use App\Models\Exam;
use App\Models\Service;
use App\Models\University;
use App\Models\UniversityProgram;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Reoptimized class loader:
Route::get('/optimize', function () {
  $exitCode = Artisan::call('optimize');
  return '<h1>Reoptimized class loader</h1>';
});
Route::get('/f/optimize', function () {
  $exitCode = Artisan::call('optimize');
  return true;
});


//For MIgrate:
Route::get('/migrate', function () {
  $exitCode = Artisan::call('migrate');
  return '<h1>Migrated</h1>';
});
Route::get('/f/migrate', function () {
  $exitCode = Artisan::call('migrate');
  return true;
});

/* STUDENT ROUTES BEFORE LOGIN */
Route::middleware([StudentLoggedOut::class])->group(function () {
  Route::get('/sign-up', [StudentLoginFc::class, 'signup']);
  Route::post('/sign-up', [StudentLoginFc::class, 'register']);
  Route::get('/sign-in', [StudentLoginFc::class, 'login']);
  Route::post('/login', [StudentLoginFc::class, 'signin']);
  Route::get('/confirmed-email', [StudentLoginFc::class, 'confirmedEmail']);
  Route::post('/submit-email-otp', [StudentLoginFc::class, 'submitOtp']);
  Route::get('/account/password/reset', [StudentLoginFc::class, 'viewForgetPassword']);
  Route::post('/forget-password', [StudentLoginFc::class, 'forgetPassword']);
  Route::get('/forget-password/email-sent', [StudentLoginFc::class, 'emailSent']);
  Route::get('/email-login', [StudentLoginFc::class, 'emailLogin']);
  Route::get('/password/reset', [StudentLoginFc::class, 'viewResetPassword']);
  Route::post('/reset-password', [StudentLoginFc::class, 'resetPassword']);
  Route::get('/account/invalid_link', [StudentLoginFc::class, 'invalidLink']);
});
/* STUDENT ROUTES AFTER LOGIN */
Route::middleware([StudentLoggedIn::class])->group(function () {
  Route::prefix('/student')->group(function () {
    Route::get('/delete-school/{id}', [StudentFc::class, 'deleteSchool']);
    Route::prefix('profile')->group(function () {
      Route::get('', [StudentFc::class, 'profile']);
      Route::post('/update', [StudentFc::class, 'updateProfile']);
    });
    Route::get('/change-password', [StudentFc::class, 'viewChangePassword']);
    Route::post('/change-password', [StudentFc::class, 'changePassword']);
    Route::get('/applied-college', [StudentFc::class, 'appliedCollege']);
    Route::get('/shortlist', [StudentFc::class, 'shortlist']);
    Route::get('/account-settings', [StudentFc::class, 'settings']);
    Route::post('/personal-information', [StudentFc::class, 'submitPersonalInfo']);
    Route::post('/education-summary', [StudentFc::class, 'submitEduSum']);
    Route::post('/add-school', [StudentFc::class, 'addSchool']);
    Route::post('/update-school', [StudentFc::class, 'updateSchool']);
    Route::post('/update-test-score', [StudentFc::class, 'updateTestScore']);
    Route::post('/update-gre-score', [StudentFc::class, 'updateGRE']);
    Route::post('/update-gmat-score', [StudentFc::class, 'updateGMAT']);
    Route::post('/update-sat-score', [StudentFc::class, 'updateSAT']);
    Route::post('/update-background-info', [StudentFc::class, 'updateBI']);
    Route::post('/upload-documents', [StudentFc::class, 'updateDocs']);
    Route::get('/apply-program/{program_id}', [ApplyProgramFc::class, 'applyProgram'])->name('student.apply.program');
    Route::get('/shortlist-program/{program_id}', [ApplyProgramFc::class, 'shortlistProgram'])->name('student.shortlist.program');
    Route::get('/delete-program/{id}', [StudentFc::class, 'deleteProgram']);
    Route::get('/logout', function () {
      session()->forget('studentLoggedIn');
      session()->forget('student_id');
      return redirect('sign-in');
    });
  });
});

/* ADMIN ROUTES BEFORE LOGIN */
Route::middleware([AdminLoggedOut::class])->group(function () {
  Route::prefix('/admin')->group(function () {
    Route::get('/login/', [AdminLogin::class, 'index']);
    Route::post('/login/', [AdminLogin::class, 'login']);
    Route::get('/account/password/reset', [AdminLogin::class, 'viewForgetPassword']);
    Route::post('/forget-password', [AdminLogin::class, 'forgetPassword']);
    Route::get('/forget-password/email-sent', [AdminLogin::class, 'emailSent']);
    Route::get('/email-login', [AdminLogin::class, 'emailLogin']);
    Route::get('/password/reset', [AdminLogin::class, 'viewResetPassword']);
    Route::post('/reset-password', [AdminLogin::class, 'resetPassword']);
    Route::get('/account/invalid_link', [AdminLogin::class, 'invalidLink']);
  });
});
/* ADMIN ROUTES AFTER LOGIN */
Route::middleware([AdminLoggedIn::class])->group(function () {
  Route::get('/admin/logout/', function () {
    session()->forget('adminLoggedIn');
    return redirect('admin/login');
  });
  Route::prefix('/admin')->group(function () {
    Route::get('/', [AdminDashboard::class, 'index']);
    Route::get('/dashboard', [AdminDashboard::class, 'index']);
    Route::get('/profile', [AdminDashboard::class, 'profile']);
    Route::post('/update-profile', [AdminDashboard::class, 'updateProfile']);

    Route::prefix('/course-category')->group(function () {
      Route::get('', [CourseCategoryC::class, 'index']);
      Route::post('/store', [CourseCategoryC::class, 'store']);
      Route::get('/delete/{id}', [CourseCategoryC::class, 'delete']);
      Route::get('/update/{id}', [CourseCategoryC::class, 'index']);
      Route::post('/update/{id}', [CourseCategoryC::class, 'update']);
      Route::post('/import', [CourseCategoryC::class, 'import']);
    });
    Route::prefix('/course-category-contents/')->group(function () {
      Route::get('/get-data', [CourseCategoryContentC::class, 'getData']);
      Route::get('/delete/{id}', [CourseCategoryContentC::class, 'delete']);
      Route::post('/store', [CourseCategoryContentC::class, 'store']);
      Route::get('/{course_category_id}/', [CourseCategoryContentC::class, 'index']);
      Route::get('{course_category_id}/update/{id}', [CourseCategoryContentC::class, 'index']);
      Route::post('{course_category_id}/update/{id}', [CourseCategoryContentC::class, 'update']);
    });
    Route::prefix('/course-category-faqs/')->group(function () {
      Route::get('/get-data', [CourseCategoryFaqC::class, 'getData']);
      Route::get('/delete/{id}', [CourseCategoryFaqC::class, 'delete']);
      Route::post('/store', [CourseCategoryFaqC::class, 'store']);
      Route::get('/{course_category_id}/', [CourseCategoryFaqC::class, 'index']);
      Route::get('{course_category_id}/update/{id}', [CourseCategoryFaqC::class, 'index']);
      Route::post('{course_category_id}/update/{id}', [CourseCategoryFaqC::class, 'update']);
    });
    Route::prefix('/course-specializations')->group(function () {
      Route::get('', [CourseSpecializationC::class, 'index']);
      Route::post('/store', [CourseSpecializationC::class, 'store']);
      Route::get('/delete/{id}', [CourseSpecializationC::class, 'delete']);
      Route::get('/update/{id}', [CourseSpecializationC::class, 'index']);
      Route::post('/update/{id}', [CourseSpecializationC::class, 'update']);
      Route::post('/import', [CourseSpecializationC::class, 'import']);
      Route::get('/export', [CourseSpecializationC::class, 'export']);
      Route::get('/get-by-category', [CourseSpecializationC::class, 'getByCategory']);
    });
    Route::prefix('/course-specialization-contents/')->group(function () {
      Route::get('/get-data', [CourseSpecializationContentC::class, 'getData']);
      Route::get('/delete/{id}', [CourseSpecializationContentC::class, 'delete']);
      Route::post('/store', [CourseSpecializationContentC::class, 'store']);
      Route::get('/{specialization_id}/', [CourseSpecializationContentC::class, 'index']);
      Route::get('{specialization_id}/update/{id}', [CourseSpecializationContentC::class, 'index']);
      Route::post('{specialization_id}/update/{id}', [CourseSpecializationContentC::class, 'update']);
    });
    Route::prefix('/course-specialization-level-contents/')->group(function () {
      Route::get('/get-data', [CourseSpecializationLevelContentC::class, 'getData']);
      Route::get('/delete/{id}', [CourseSpecializationLevelContentC::class, 'delete']);
      Route::post('/store', [CourseSpecializationLevelContentC::class, 'store']);
      Route::get('/{specialization_id}/', [CourseSpecializationLevelContentC::class, 'index']);
      Route::get('{specialization_id}/update/{id}', [CourseSpecializationLevelContentC::class, 'index']);
      Route::post('{specialization_id}/update/{id}', [CourseSpecializationLevelContentC::class, 'update']);
    });
    Route::prefix('/course-specialization-faqs/')->group(function () {
      Route::get('/get-data', [CourseSpecializationFaqC::class, 'getData']);
      Route::get('/delete/{id}', [CourseSpecializationFaqC::class, 'delete']);
      Route::post('/store', [CourseSpecializationFaqC::class, 'store']);
      Route::get('/{specialization_id}/', [CourseSpecializationFaqC::class, 'index']);
      Route::get('{specialization_id}/update/{id}', [CourseSpecializationFaqC::class, 'index']);
      Route::post('{specialization_id}/update/{id}', [CourseSpecializationFaqC::class, 'update']);
    });
    Route::prefix('/programs')->group(function () {
      Route::get('', [ProgramC::class, 'index']);
      Route::post('/store', [ProgramC::class, 'store']);
      Route::get('/delete/{id}', [ProgramC::class, 'delete']);
      Route::get('/update/{id}', [ProgramC::class, 'index']);
      Route::post('/update/{id}', [ProgramC::class, 'update']);
      Route::post('/import', [ProgramC::class, 'import']);
      Route::get('/get-by-spc-and-cat', [ProgramC::class, 'getBySpcCat']);
    });
    Route::prefix('/levels')->group(function () {
      Route::get('', [LevelC::class, 'index']);
      Route::post('/store', [LevelC::class, 'store']);
      Route::get('/delete/{id}', [LevelC::class, 'delete']);
      Route::get('/update/{id}', [LevelC::class, 'index']);
      Route::post('/update/{id}', [LevelC::class, 'update']);
      Route::post('/import', [LevelC::class, 'import']);
    });

    Route::prefix('/institute-types')->group(function () {
      Route::get('', [InstituteTypeC::class, 'index']);
      Route::post('/store', [InstituteTypeC::class, 'store']);
      Route::get('/delete/{id}', [InstituteTypeC::class, 'delete']);
      Route::get('/update/{id}', [InstituteTypeC::class, 'index']);
      Route::post('/update/{id}', [InstituteTypeC::class, 'update']);
    });
    Route::prefix('/study-modes')->group(function () {
      Route::get('', [StudyModeC::class, 'index']);
      Route::post('/store', [StudyModeC::class, 'store']);
      Route::get('/delete/{id}', [StudyModeC::class, 'delete']);
      Route::get('/update/{id}', [StudyModeC::class, 'index']);
      Route::post('/update/{id}', [StudyModeC::class, 'update']);
    });
    Route::prefix('/course-modes')->group(function () {
      Route::get('', [CourseModeC::class, 'index']);
      Route::post('/store', [CourseModeC::class, 'store']);
      Route::get('/delete/{id}', [CourseModeC::class, 'delete']);
      Route::get('/update/{id}', [CourseModeC::class, 'index']);
      Route::post('/update/{id}', [CourseModeC::class, 'update']);
    });
    Route::prefix('/university')->group(function () {
      Route::get('add', [UniversityC::class, 'add']);
      Route::get('', [UniversityC::class, 'index']);
      Route::post('/store', [UniversityC::class, 'store']);
      Route::get('/delete/{id}', [UniversityC::class, 'delete']);
      Route::get('/update/{id}', [UniversityC::class, 'add']);
      Route::post('/update/{id}', [UniversityC::class, 'update']);
      Route::post('/import', [UniversityC::class, 'import']);
      Route::post('/bulk-update-import', [UniversityC::class, 'bulkUpdateImport']);
      Route::get('/export', [UniversityC::class, 'export']);
    });

    Route::get('/get-state-by-country', [UniversityC::class, 'getStateByCountry']);
    Route::get('/get-city-by-state', [UniversityC::class, 'getCityByState']);

    Route::prefix('/university-overview')->group(function () {
      Route::get('/{university_id}', [UniversityOverviewC::class, 'index']);
      Route::post('/{university_id}/store', [UniversityOverviewC::class, 'store']);
      Route::get('/delete/{id}', [UniversityOverviewC::class, 'delete']);
      Route::get('/{university_id}/update/{id}', [UniversityOverviewC::class, 'index']);
      Route::post('/{university_id}/update/{id}', [UniversityOverviewC::class, 'update']);
    });
    Route::prefix('/university-programs')->group(function () {
      Route::get('/{university_id}', [UniversityProgramC::class, 'index']);
      Route::post('/{university_id}/store', [UniversityProgramC::class, 'store']);
      Route::get('/delete/{id}', [UniversityProgramC::class, 'delete']);
      Route::get('/{university_id}/update/{id}', [UniversityProgramC::class, 'index']);
      Route::post('/{university_id}/update/{id}', [UniversityProgramC::class, 'update']);
      Route::post('/{university_id}/import', [UniversityProgramC::class, 'import']);
      Route::post('/{university_id}/bulk-update-import', [UniversityProgramC::class, 'bulkUpdateImport']);
      Route::get('/{university_id}/export', [UniversityProgramC::class, 'export']);
    });
    Route::prefix('/university-program-contents')->group(function () {
      Route::get('/get-data', [UniversityProgramContentC::class, 'getData']);
      Route::get('/delete/{id}', [UniversityProgramContentC::class, 'delete']);
      Route::post('/store', [UniversityProgramContentC::class, 'store']);
      Route::get('/{c_id}/', [UniversityProgramContentC::class, 'index']);
      Route::get('{c_id}/update/{id}', [UniversityProgramContentC::class, 'index']);
      Route::post('{c_id}/update/{id}', [UniversityProgramContentC::class, 'update']);
    });
    Route::prefix('/university-photos')->group(function () {
      Route::get('/{u_id}', [UniversityGalleryC::class, 'index']);
      Route::post('/{u_id}/store', [UniversityGalleryC::class, 'store']);
      Route::get('/delete/{id}', [UniversityGalleryC::class, 'delete']);
      Route::get('/{u_id}/update/{id}', [UniversityGalleryC::class, 'index']);
      Route::post('/{u_id}/update/{id}', [UniversityGalleryC::class, 'update']);
    });
    Route::prefix('/university-videos')->group(function () {
      Route::get('/{u_id}', [UniversityVideoGalleryC::class, 'index']);
      Route::post('/{u_id}/store', [UniversityVideoGalleryC::class, 'store']);
      Route::get('/delete/{id}', [UniversityVideoGalleryC::class, 'delete']);
      Route::get('/{u_id}/update/{id}', [UniversityVideoGalleryC::class, 'index']);
      Route::post('/{u_id}/update/{id}', [UniversityVideoGalleryC::class, 'update']);
    });
    Route::prefix('/university-facilities')->group(function () {
      Route::get('/get-data', [UniversityFacilityC::class, 'getData']);
      Route::get('/delete/{id}', [UniversityFacilityC::class, 'delete']);
      Route::post('/store', [UniversityFacilityC::class, 'store']);
      Route::get('/{u_id}/', [UniversityFacilityC::class, 'index']);
      Route::get('{u_id}/update/{id}', [UniversityFacilityC::class, 'index']);
      Route::post('{u_id}/update/{id}', [UniversityFacilityC::class, 'update']);
    });
    Route::prefix('/other-content')->group(function () {
      Route::get('/get-data', [UniversityOtherContentC::class, 'getData']);
      Route::get('/delete/{id}', [UniversityOtherContentC::class, 'delete']);
      Route::post('/store-ajax', [UniversityOtherContentC::class, 'storeAjax']);
      Route::get('/{university_id}/', [UniversityOtherContentC::class, 'index']);
      Route::get('/{university_id}/update/{id}', [UniversityOtherContentC::class, 'index']);
      Route::post('/{university_id}/update/{id}', [UniversityOtherContentC::class, 'update']);
    });
    Route::prefix('/services')->group(function () {
      Route::get('', [ServiceC::class, 'index']);
      Route::post('/store', [ServiceC::class, 'store']);
      Route::get('/delete/{id}', [ServiceC::class, 'delete']);
      Route::get('/update/{id}', [ServiceC::class, 'index']);
      Route::post('/update/{id}', [ServiceC::class, 'update']);
    });
    Route::prefix('/service-content')->group(function () {
      Route::get('/{page_id}', [ServiceContentC::class, 'index']);
      Route::post('/{page_id}/store', [ServiceContentC::class, 'store']);
      Route::get('/delete/{id}', [ServiceContentC::class, 'delete']);
      Route::get('/{page_id}/update/{id}', [ServiceContentC::class, 'index']);
      Route::post('/{page_id}/update/{id}', [ServiceContentC::class, 'update']);
    });
    Route::prefix('/exams')->group(function () {
      Route::get('', [ExamC::class, 'index']);
      Route::post('/store', [ExamC::class, 'store']);
      Route::get('/delete/{id}', [ExamC::class, 'delete']);
      Route::get('/update/{id}', [ExamC::class, 'index']);
      Route::post('/update/{id}', [ExamC::class, 'update']);
    });
    Route::prefix('/exam-page-tabs')->group(function () {
      Route::get('/get-tabs', [ExamPageTabC::class, 'getTabs']);
      Route::get('/get-data', [ExamPageTabC::class, 'getData']);
      Route::get('/delete/{id}', [ExamPageTabC::class, 'delete']);
      Route::post('/store-ajax', [ExamPageTabC::class, 'storeAjax']);
      Route::get('/{exam_id}/', [ExamPageTabC::class, 'index']);
      Route::get('/{exam_id}/update/{id}', [ExamPageTabC::class, 'index']);
      Route::post('/{exam_id}/update/{id}', [ExamPageTabC::class, 'update']);
    });
    Route::prefix('/exam-page-tab-contents')->group(function () {
      Route::get('/get-headings', [ExamPageTabContentC::class, 'getHeadings']);
      Route::get('/get-data', [ExamPageTabContentC::class, 'getData']);
      Route::get('/delete/{id}', [ExamPageTabContentC::class, 'delete']);
      Route::post('/store-ajax', [ExamPageTabContentC::class, 'storeAjax']);
      Route::get('/{tab_id}/', [ExamPageTabContentC::class, 'index']);
      Route::get('/{tab_id}/update/{id}', [ExamPageTabContentC::class, 'index']);
      Route::post('/{tab_id}/update/{id}', [ExamPageTabContentC::class, 'update']);
    });
    Route::prefix('/job-pages')->group(function () {
      Route::get('', [JobPageC::class, 'index']);
      Route::post('/store', [JobPageC::class, 'store']);
      Route::get('/delete/{id}', [JobPageC::class, 'delete']);
      Route::get('/update/{id}', [JobPageC::class, 'index']);
      Route::post('/update/{id}', [JobPageC::class, 'update']);
    });
    Route::prefix('/job-page-tabs')->group(function () {
      Route::get('/get-data', [JobPageTabC::class, 'getData']);
      Route::get('/delete/{id}', [JobPageTabC::class, 'delete']);
      Route::post('/store-ajax', [JobPageTabC::class, 'storeAjax']);
      Route::get('/{page_id}/', [JobPageTabC::class, 'index']);
      Route::get('/{page_id}/update/{id}', [JobPageTabC::class, 'index']);
      Route::post('/{page_id}/update/{id}', [JobPageTabC::class, 'update']);
    });
    Route::prefix('/job-page-tab-contents')->group(function () {
      Route::get('/get-data', [JobPageTabContentC::class, 'getData']);
      Route::get('/delete/{id}', [JobPageTabContentC::class, 'delete']);
      Route::post('/store-ajax', [JobPageTabContentC::class, 'storeAjax']);
      Route::get('/{tab_id}/', [JobPageTabContentC::class, 'index']);
      Route::get('/{tab_id}/update/{id}', [JobPageTabContentC::class, 'index']);
      Route::post('/{tab_id}/update/{id}', [JobPageTabContentC::class, 'update']);
    });
    Route::prefix('/exam-tab-faqs')->group(function () {
      Route::get('/get-data', [ExamTabFaqC::class, 'getData']);
      Route::get('/delete/{id}', [ExamTabFaqC::class, 'delete']);
      Route::post('/store-ajax', [ExamTabFaqC::class, 'storeAjax']);
      Route::get('/{exam_id}/', [ExamTabFaqC::class, 'index']);
      Route::get('/{exam_id}/update/{id}', [ExamTabFaqC::class, 'index']);
      Route::post('/{exam_id}/update/{id}', [ExamTabFaqC::class, 'update']);
    });
    Route::prefix('/exam-faqs')->group(function () {
      Route::get('/get-data', [ExamFaqC::class, 'getData']);
      Route::get('/delete/{id}', [ExamFaqC::class, 'delete']);
      Route::post('/store-ajax', [ExamFaqC::class, 'storeAjax']);
      Route::get('/{exam_id}/', [ExamFaqC::class, 'index']);
      Route::get('/{exam_id}/update/{id}', [ExamFaqC::class, 'index']);
      Route::post('/{exam_id}/update/{id}', [ExamFaqC::class, 'update']);
    });
    Route::prefix('/exam-content')->group(function () {
      Route::get('/{exam_id}', [ExamContentC::class, 'index']);
      Route::post('/{exam_id}/store', [ExamContentC::class, 'store']);
      Route::get('/delete/{id}', [ExamContentC::class, 'delete']);
      Route::get('/{exam_id}/update/{id}', [ExamContentC::class, 'index']);
      Route::post('/{exam_id}/update/{id}', [ExamContentC::class, 'update']);
    });

    Route::prefix('/blog-category')->group(function () {
      Route::get('', [BlogCategoryC::class, 'index']);
      Route::post('/store', [BlogCategoryC::class, 'store']);
      Route::get('/delete/{id}', [BlogCategoryC::class, 'delete']);
      Route::get('/update/{id}', [BlogCategoryC::class, 'index']);
      Route::post('/update/{id}', [BlogCategoryC::class, 'update']);
    });
    Route::prefix('/blogs')->group(function () {
      Route::get('', [BlogC::class, 'index']);
      Route::post('/store', [BlogC::class, 'store']);
      Route::get('/delete/{id}', [BlogC::class, 'delete']);
      Route::get('/update/{id}', [BlogC::class, 'index']);
      Route::post('/update/{id}', [BlogC::class, 'update']);
    });

    Route::prefix('/users')->group(function () {
      Route::get('', [UserC::class, 'index']);
      Route::post('/store', [UserC::class, 'store']);
      Route::get('/delete/{id}', [UserC::class, 'delete']);
      Route::get('/update/{id}', [UserC::class, 'index']);
      Route::post('/update/{id}', [UserC::class, 'update']);
    });
    Route::prefix('/employees')->group(function () {
      Route::get('', [EmployeeC::class, 'index']);
      Route::post('/store', [EmployeeC::class, 'store']);
      Route::get('/get-data', [EmployeeC::class, 'getData']);
      Route::get('/delete/{id}', [EmployeeC::class, 'delete']);
      Route::get('/update/{id}', [EmployeeC::class, 'index']);
      Route::post('/update/{id}', [EmployeeC::class, 'update']);
    });
    Route::prefix('/employee-statuses')->group(function () {
      Route::get('', [EmployeeStatusC::class, 'index']);
      Route::post('/store', [EmployeeStatusC::class, 'store']);
      Route::get('/get-data', [EmployeeStatusC::class, 'getData']);
      Route::get('/delete/{id}', [EmployeeStatusC::class, 'delete']);
      Route::get('/update/{id}', [EmployeeStatusC::class, 'index']);
      Route::post('/update/{id}', [EmployeeStatusC::class, 'update']);
    });

    Route::prefix('/static-page-seos')->group(function () {
      Route::get('/', [StaticPageSeoC::class, 'index']);
      Route::post('/store/', [StaticPageSeoC::class, 'store']);
      Route::get('/delete/{id}/', [StaticPageSeoC::class, 'delete']);
      Route::get('/update/{id}/', [StaticPageSeoC::class, 'index']);
      Route::post('/update/{id}/', [StaticPageSeoC::class, 'update']);
    });
    Route::prefix('/dynamic-page-seos')->group(function () {
      Route::get('/', [DynamicPageSeoC::class, 'index']);
      Route::get('add/', [DynamicPageSeoC::class, 'index']);
      Route::post('/store/', [DynamicPageSeoC::class, 'store']);
      Route::get('/delete/{id}/', [DynamicPageSeoC::class, 'delete']);
      Route::get('/update/{id}/', [DynamicPageSeoC::class, 'index']);
      Route::post('/update/{id}/', [DynamicPageSeoC::class, 'update']);
    });
    Route::prefix('/default-og-image')->group(function () {
      Route::get('/', [DefaultOgImageC::class, 'index']);
      Route::get('add/', [DefaultOgImageC::class, 'index']);
      Route::post('/store/', [DefaultOgImageC::class, 'store']);
      Route::get('/delete/{id}/', [DefaultOgImageC::class, 'delete']);
      Route::get('/update/{id}/', [DefaultOgImageC::class, 'index']);
      Route::post('/update/{id}/', [DefaultOgImageC::class, 'update']);
    });

    Route::prefix('/university-scholarships/')->group(function () {
      Route::get('/get-data', [UniversityScholarshipC::class, 'getData']);
      Route::get('/delete/{id}', [UniversityScholarshipC::class, 'delete']);
      Route::post('/store-ajax', [UniversityScholarshipC::class, 'storeAjax']);
      Route::get('/{university_id}/', [UniversityScholarshipC::class, 'index']);
      Route::get('{university_id}/update/{id}', [UniversityScholarshipC::class, 'index']);
      Route::post('{university_id}/update/{id}', [UniversityScholarshipC::class, 'update']);
    });
    Route::prefix('/university-scholarship-contents/')->group(function () {
      Route::get('/get-data', [UniversityScholarshipContentC::class, 'getData']);
      Route::get('/delete/{id}', [UniversityScholarshipContentC::class, 'delete']);
      Route::post('/store-ajax', [UniversityScholarshipContentC::class, 'storeAjax']);
      Route::get('/{scholarship_id}/', [UniversityScholarshipContentC::class, 'index']);
      Route::get('{scholarship_id}/update/{id}', [UniversityScholarshipContentC::class, 'index']);
      Route::post('{scholarship_id}/update/{id}', [UniversityScholarshipContentC::class, 'update']);
    });
    Route::prefix('leads')->group(function () {
      Route::get('', [StudentC::class, 'index']);
      Route::get('/add', [StudentC::class, 'add']);
      Route::get('/update/{id}', [StudentC::class, 'add']);
      Route::post('/update/{id}', [StudentC::class, 'update']);
      Route::get('/delete/{id}', [StudentC::class, 'delete']);
      Route::post('/store', [StudentC::class, 'store']);
      Route::get('get-quick-info', [StudentC::class, 'getQuickInfo']);
      Route::get('/update-quick-info/', [StudentC::class, 'updateQuickInfo']);
      Route::get('/fetch-last-updated-record/{id}', [StudentC::class, 'fetchLastRecord']);


      Route::get('/add2', [StudentC::class, 'add2']);
      Route::post('/store-ajax', [StudentC::class, 'storeAjax']);
    });
    Route::prefix('/university-reviews')->group(function () {
      Route::get('/', [UniversityReviewC::class, 'index']);
      Route::get('/get-data', [UniversityReviewC::class, 'getData']);
      Route::get('/delete/{id}', [UniversityReviewC::class, 'delete']);
      Route::post('/store-ajax', [UniversityReviewC::class, 'storeAjax']);
      Route::get('/update/{id}', [UniversityReviewC::class, 'index']);
      Route::post('/update/{id}', [UniversityReviewC::class, 'update']);
    });
    Route::prefix('/upload-files')->group(function () {
      Route::get('/', [UploadFilesC::class, 'index']);
      Route::get('/get-data', [UploadFilesC::class, 'getData']);
      Route::get('/delete/{id}', [UploadFilesC::class, 'delete']);
      Route::post('/store-ajax', [UploadFilesC::class, 'storeAjax']);
      Route::get('/update/{id}', [UploadFilesC::class, 'index']);
      Route::post('/update/{id}', [UploadFilesC::class, 'update']);
    });
    Route::prefix('/authors')->group(function () {
      Route::get('/', [AuthorC::class, 'index']);
      Route::get('/get-data', [AuthorC::class, 'getData']);
      Route::get('/delete/{id}', [AuthorC::class, 'delete']);
      Route::post('/store-ajax', [AuthorC::class, 'storeAjax']);
      Route::get('/update/{id}', [AuthorC::class, 'index']);
      Route::post('/update/{id}', [AuthorC::class, 'update']);
    });
    Route::prefix('/users')->group(function () {
      Route::get('/', [UserC::class, 'index']);
      Route::get('/get-data', [UserC::class, 'getData']);
      Route::get('/delete/{id}', [UserC::class, 'delete']);
      Route::post('/store-ajax', [UserC::class, 'storeAjax']);
      Route::get('/update/{id}', [UserC::class, 'index']);
      Route::post('/update/{id}', [UserC::class, 'update']);
    });
    Route::prefix('/testimonials')->group(function () {
      Route::get('/', [TestimonialC::class, 'index']);
      Route::get('/get-data', [TestimonialC::class, 'getData']);
      Route::get('/delete/{id}', [TestimonialC::class, 'delete']);
      Route::post('/store-ajax', [TestimonialC::class, 'storeAjax']);
      Route::get('/update/{id}', [TestimonialC::class, 'index']);
      Route::post('/update/{id}', [TestimonialC::class, 'update']);
    });
    Route::prefix('/destination-articles')->group(function () {
      Route::get('/', [DestinationArticleC::class, 'index']);
      Route::get('/get-data', [DestinationArticleC::class, 'getData']);
      Route::post('/store-ajax', [DestinationArticleC::class, 'storeAjax']);
      Route::get('/update/{id}', [DestinationArticleC::class, 'index']);
      Route::post('/update/{id}', [DestinationArticleC::class, 'update']);
      Route::get('/delete/{id}', [DestinationArticleC::class, 'delete']);
    });
    Route::prefix('/destination-article-contents')->group(function () {
      Route::get('/get-headings', [DestinationArticleContentC::class, 'getHeadings']);
      Route::get('/get-data', [DestinationArticleContentC::class, 'getData']);
      Route::get('/delete/{id}', [DestinationArticleContentC::class, 'delete']);
      Route::post('/store-ajax', [DestinationArticleContentC::class, 'storeAjax']);
      Route::get('/{article_id}/', [DestinationArticleContentC::class, 'index']);
      Route::get('/{article_id}/update/{id}', [DestinationArticleContentC::class, 'index']);
      Route::post('/{article_id}/update/{id}', [DestinationArticleContentC::class, 'update']);
    });
    Route::prefix('/destination-article-faqs')->group(function () {
      Route::get('/get-data', [DestinationArticleFaqsC::class, 'getData']);
      Route::get('/delete/{id}', [DestinationArticleFaqsC::class, 'delete']);
      Route::post('/store-ajax', [DestinationArticleFaqsC::class, 'storeAjax']);
      Route::get('/{destination_article_id}/', [DestinationArticleFaqsC::class, 'index']);
      Route::get('/{destination_article_id}/update/{id}', [DestinationArticleFaqsC::class, 'index']);
      Route::post('/{destination_article_id}/update/{id}', [DestinationArticleFaqsC::class, 'update']);
    });
    Route::prefix('/career')->group(function () {
      Route::get('/', [CareerC::class, 'index']);
      Route::get('/get-data', [CareerC::class, 'getData']);
      Route::post('/store-ajax', [CareerC::class, 'storeAjax']);
      Route::get('/update/{id}', [CareerC::class, 'index']);
      Route::post('/update/{id}', [CareerC::class, 'update']);
      Route::get('/delete/{id}', [CareerC::class, 'delete']);
    });
    Route::prefix('/job-application')->group(function () {
      Route::get('/', [JobApplicationC::class, 'index']);
      Route::get('/get-data', [JobApplicationC::class, 'getData']);
      Route::get('/delete/{id}', [JobApplicationC::class, 'delete']);
      Route::post('/store-ajax', [JobApplicationC::class, 'storeAjax']);
      Route::get('/update/{id}', [JobApplicationC::class, 'index']);
      Route::post('/update/{id}', [JobApplicationC::class, 'update']);
    });
    Route::prefix('/faq-categories')->group(function () {
      Route::get('/', [FaqCategoryC::class, 'index']);
      Route::get('/get-data', [FaqCategoryC::class, 'getData']);
      Route::post('/store', [FaqCategoryC::class, 'store']);
      Route::get('/update/{id}', [FaqCategoryC::class, 'index']);
      Route::post('/update/{id}', [FaqCategoryC::class, 'update']);
      Route::get('/delete/{id}', [FaqCategoryC::class, 'delete']);
    });
    Route::prefix('/faqs')->group(function () {
      Route::get('/', [FaqC::class, 'index']);
      Route::get('/get-data', [FaqC::class, 'getData']);
      Route::post('/store', [FaqC::class, 'store']);
      Route::get('/update/{id}', [FaqC::class, 'index']);
      Route::post('/update/{id}', [FaqC::class, 'update']);
      Route::get('/delete/{id}', [FaqC::class, 'delete']);
    });
    Route::prefix('/landing-pages')->group(function () {
      Route::get('', [LandingPageC::class, 'index']);
      Route::get('get-data', [LandingPageC::class, 'getData']);
      Route::get('/delete/{id}', [LandingPageC::class, 'delete']);
      Route::get('/update/{id}', [LandingPageC::class, 'index']);
      Route::post('/update/{id}', [LandingPageC::class, 'update']);
      Route::post('/store', [LandingPageC::class, 'store']);
    });
    Route::prefix('/landing-page-banners')->group(function () {
      Route::get('/get-data', [LandingPageBannerC::class, 'getData']);
      Route::get('/delete/{id}', [LandingPageBannerC::class, 'delete']);
      Route::post('/store', [LandingPageBannerC::class, 'store']);
      Route::get('/{landing_page_id}/', [LandingPageBannerC::class, 'index']);
      Route::get('{landing_page_id}/update/{id}', [LandingPageBannerC::class, 'index']);
      Route::post('{landing_page_id}/update/{id}', [LandingPageBannerC::class, 'update']);
    });
    Route::prefix('/landing-page-faqs')->group(function () {
      Route::get('/get-data', [LandingPageFaqC::class, 'getData']);
      Route::get('/delete/{id}', [LandingPageFaqC::class, 'delete']);
      Route::post('/store', [LandingPageFaqC::class, 'store']);
      Route::get('/{landing_page_id}/', [LandingPageFaqC::class, 'index']);
      Route::get('{landing_page_id}/update/{id}', [LandingPageFaqC::class, 'index']);
      Route::post('{landing_page_id}/update/{id}', [LandingPageFaqC::class, 'update']);
    });
    Route::prefix('/landing-page-universities')->group(function () {
      Route::get('/get-data', [LandingPageUniversityC::class, 'getData']);
      Route::get('/delete/{id}', [LandingPageUniversityC::class, 'delete']);
      Route::post('/store', [LandingPageUniversityC::class, 'store']);
      Route::get('/{landing_page_id}/', [LandingPageUniversityC::class, 'index']);
      Route::get('{landing_page_id}/update/{id}', [LandingPageUniversityC::class, 'index']);
      Route::post('{landing_page_id}/update/{id}', [LandingPageUniversityC::class, 'update']);
    });
  });
  Route::prefix('common')->group(function () {
    Route::get('/change-status', [CommonController::class, 'changeStatus']);
    Route::get('/update-field', [CommonController::class, 'updateFieldById']);
    Route::get('/update-bulk-field', [CommonController::class, 'updateBulkField']);
    Route::get('/bulk-delete', [CommonController::class, 'bulkDelete']);
    Route::get('/get-country-by-destination', [CommonController::class, 'getCountryByDestination']);
    Route::get('/slugify', [CommonController::class, 'slugify']);
  });
});


// SITE MAP
Route::get('sitemap.xml', [SitemapController::class, 'sitemap']);
Route::get('sitemap-home.xml', [SitemapController::class, 'home']);
Route::get('sitemap-exams.xml', [SitemapController::class, 'exam']);
Route::get('sitemap-services.xml', [SitemapController::class, 'services']);
Route::get('sitemap-select-university.xml', [SitemapController::class, 'selectuni']);
Route::get('sitemap-university.xml', [SitemapController::class, 'university']);
Route::get('sitemap-specialization.xml', [SitemapController::class, 'specialization']);
Route::get('sitemap-course.xml', [SitemapController::class, 'courses']);
Route::get('sitemap-get-info.xml', [SitemapController::class, 'article']);
Route::get('sitemap-course-level.xml', [SitemapController::class, 'sitemapCourseLevel']);
Route::get('sitemap-courses-in-malaysia.xml', [SitemapController::class, 'sitemapCoursesInMalaysia']);


/* FRONT ROUTES */

Route::get('/', [HomeFc::class, 'index'])->name('home');
Route::get('/home', [HomeFc::class, 'index']);

Route::get('/specialization', [SpecializationFc::class, 'index'])->name('specializations');
Route::get('/stream/{slug}', [SpecializationFc::class, 'detail'])->name('specialization.detail');

Route::get('/course/{slug}', [CourseCategoryFc::class, 'detail'])->name('category.detail');


Route::get('/faqs', [FaqFc::class, 'index'])->name('faqs');
//Route::get('/faq/scholarship', [FaqFc::class, 'SchFaq'])->name('faq.scholarship');

Route::get('privacy-policy', [HomeFc::class, 'privacyPolicy'])->name('pp');
Route::get('terms-and-conditions', [HomeFc::class, 'termsConditions'])->name('tc');

Route::get('reviews', [ReviewFc::class, 'reviews'])->name('reviews');
Route::get('write-a-review', [ReviewFc::class, 'index'])->name('write.review');
Route::post('add-review', [ReviewFc::class, 'addReview'])->name('add.review');
Route::get('reviews/get-programs', [ReviewFc::class, 'getProgramsByUniversity'])->name('review.get.programs');


Route::get('what-people-say', [HomeFc::class, 'whatPeopleSay'])->name('wps');
Route::get('who-we-are', [HomeFc::class, 'whoWeAre'])->name('wwa');
Route::get('contact-us', [ContactFc::class, 'index'])->name('contact');

Route::get('select-university', [HomeFc::class, 'SelectUniversities'])->name('select.university');
Route::get('select-level', [HomeFc::class, 'SelectLevel'])->name('select.level');

Route::get('compare', [CompareFc::class, 'index'])->name('compare');


Route::get('get-info', [BlogFc::class, 'index'])->name('blog');
Route::get('get-info/{category_slug}', [BlogFc::class, 'blogByCategory'])->name('blog.category');
Route::get('get-info/{category_slug}/{slug}', [BlogFc::class, 'detail'])->name('blog.detail');


Route::get('scholarship/education-fair-in-libya-2025', [LibiaLandingPageFc::class, 'index'])->name('libia.page');
Route::get('scholarship/education-fair-in-libya-2025/courses', [LibiaLandingPageFc::class, 'courses'])->name('libia.courses');
Route::get('scholarship/education-fair-in-libya-2025/institutions', [LibiaLandingPageFc::class, 'institutions'])->name('libia.institutions');

Route::post('/libia/register', [LibiaLandingPageFc::class, 'register'])->name('libia.register');
Route::post('/libia/fetch-program', [LibiaLandingPageFc::class, 'getProgramsByUniversity'])->name('libia.fetch.program');

Route::get('/transfer-service-data', [ServiceFc::class, 'transferSitePageData']);

Route::get('/services', [ServiceFc::class, 'index'])->name('services');
$services = Service::where('website', 'MYS')->get();
foreach ($services as $row) {
  Route::get($row->uri, [ServiceFc::class, 'serviceDetail']);
}

Route::get('/exams', [ExamFc::class, 'index'])->name('exams');
$exams = Exam::where('website', 'MYS')->get();
foreach ($exams as $row) {
  Route::get($row->uri, [ExamFc::class, 'examDetail']);
}

Route::get('/scholarships', [OfferLandingPageFc::class, 'index'])->name('scholarships');
Route::get('/scholarship/{slug}', [OfferLandingPageFc::class, 'PageDetail'])->name('scholarship.detail');


Route::prefix('/inquiry')->group(function () {
  Route::post('/inquiry/university-profile-form', [InquiryController::class, 'universityProfile'])->name('inquiry.university.profile');
  Route::post('/inquiry/stream-page-inquiry', [InquiryController::class, 'streamPage'])->name('stream.inquiry');
  Route::post('/inquiry/simple-form', [InquiryController::class, 'simpleForm'])->name('simple.inquiry');

  Route::post('/inquiry/brochure-request', [InquiryController::class, 'brochureRequest'])->name('brochure.inquiry');
});






Route::get('/articles', [BlogFc::class, 'index']);
Route::get('/articles/{slug}', [BlogFc::class, 'blogByCategory']);
$blogs = Blog::all();
foreach ($blogs as $row) {
  Route::get('{category}/' . $row->slug, [BlogFc::class, 'blogdetail']);
}

Route::get('author/{slug}' . $row->slug, [AuthorFc::class, 'index']);

// UNIVERSITIES IN MALAYSIA ROUTES START

Route::get('universities-in-malaysia', [UniversityListFc::class, 'index'])->name('uim');

$instTYpe = University::select('institute_type')->where(['status' => 1])->where('institute_type', '!=', null)->groupBy('institute_type')->get();
foreach ($instTYpe as $row) {
  Route::get($row->instituteType->seo_title_slug . '-in-malaysia', [UniversityListFc::class, 'index']);
}

// Generate routes for universities by state
$states = University::select('state')->where(['status' => 1])->where('state', '!=', '')->distinct()->get();

foreach ($states as $state) {
  $state_slug = slugify($state->state); // Slugify the state name
  Route::get('universities-in-' . $state_slug, [UniversityListFc::class, 'index']);
}

$uniqueCombinations = University::select('institute_type', 'state')->whereNotNull('institute_type')->where('institute_type', '!=', '')->whereNotNull('state')->where('state', '!=', '')->distinct()->get();

// Generate routes dynamically
foreach ($uniqueCombinations as $row) {
  $state_slug = slugify($row->state);
  Route::get($row->instituteType->seo_title_slug . '-in-' . $state_slug, [UniversityListFc::class, 'index']);
}

Route::get('universities-in-malaysia/apply-filter', [UniversityListFc::class, 'applyFilter'])->name('university.list.apply.filter');
Route::get('universities-in-malaysia/remove-filter', [UniversityListFc::class, 'removeFilter'])->name('university.list.remove.filter');
Route::get('universities-in-malaysia/remove-all-filter', [UniversityListFc::class, 'removeAllFilter'])->name('university.list.remove.all.filter');
// UNIVERSITIES IN MALAYSIA ROUTES END

// Fetch course levels and dynamically create routes
$levels = DB::table('university_programs')->select('level')->where('website', site_var)->groupBy('level')->get();

foreach ($levels as $level) {
  $level_slug = strtolower($level->level); // Convert level to lowercase
  Route::get('courses/' . $level_slug, [HomeFc::class, 'Courses']);
}

// UNIVERSITY PROFILE ROUTES START HERE

Route::prefix('university/{university_slug}')->group(function () {
  Route::get('/', [UniversityProfileFc::class, 'index'])->name('university.overview');
  Route::get('/gallery', [UniversityProfileFc::class, 'gallery'])->name('university.gallery');
  Route::get('/video', [UniversityProfileFc::class, 'videos'])->name('university.video');
  Route::get('/reviews', [UniversityProfileFc::class, 'reviews'])->name('university.reviews');
  Route::get('/news', [UniversityProfileFc::class, 'news'])->name('university.news');
  Route::get('/news/{news_slug}', [UniversityProfileFc::class, 'newsDetail'])->name('university.news.details');
  Route::get('/courses', [UniversityProfileCoursesFc::class, 'index'])->name('university.courses');
  Route::get('/course/{course_slug}', [UniversityProfileCoursesFc::class, 'courseDetail'])->name('university.course.details');
});
$levels = UniversityProgram::select('level')->where(['status' => 1])->where('level', '!=', '')->where('level', '!=', null)->distinct()->get();
foreach ($levels as $row) {
  Route::get('university/{university_slug}/' . slugify($row->level) . '-courses', [UniversityProfileCoursesFc::class, 'index']);
}

Route::prefix('/university-course-list')->group(function () {
  Route::get('/level', [UniversityProfileCoursesFc::class, 'applyLevelFilter']);
  Route::get('/category', [UniversityProfileCoursesFc::class, 'applyCategoryFilter']);
  Route::get('/specialization', [UniversityProfileCoursesFc::class, 'applySpecializationFilter']);
  Route::get('/apply-filter', [UniversityProfileCoursesFc::class, 'applyFilter']);
  Route::get('/remove-filter', [UniversityProfileCoursesFc::class, 'removeFilter']);
  Route::get('/remove-all-filter', [UniversityProfileCoursesFc::class, 'removeAllFilter']);
});

// COURSES IN MALAYSIA ROUTES FRONT

Route::get('courses-in-malaysia', [UniversityProgramListFc::class, 'index']);

$levels = UniversityProgram::select('level')->groupBy('level')->get();
foreach ($levels as $level) {
  $level_slug = slugify($level->level); // Slugify the level name
  Route::get($level_slug . '-courses', [UniversityProgramListFc::class, 'filterUniversity']);
}

$categories = CourseCategory::whereHas('programs')->select('slug')->orderBy('name')->get();
foreach ($categories as $category) {
  Route::get($category->slug . '-courses', [UniversityProgramListFc::class, 'filterUniversity']);
}

$specializations = CourseSpecialization::whereHas('programs')->select('slug')->orderBy('name')->get();

foreach ($specializations as $row) {
  Route::get($row->slug . '-courses', [UniversityProgramListFc::class, 'filterUniversity']);
}

Route::prefix('courses-in-malaysia')->group(function () {
  Route::get('/remove-filter', [UniversityProgramListFc::class, 'removeFilter'])->name('cl.remove.filter');
  Route::get('/remove-all-filter', [UniversityProgramListFc::class, 'removeAllFilter'])->name('cl.remove.all.filter');
  Route::get('/apply-custom-filter', [UniversityProgramListFc::class, 'applyFilter'])->name('cl.apply.custom.filter');
});

// COURSES IN MALAYSIA ROUTES END
