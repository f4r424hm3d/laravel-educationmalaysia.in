<?php

namespace App\Providers;

use App\Models\Country;
use App\Models\CourseCategory;
use App\Models\Exam;
use App\Models\Level;
use App\Models\SitePage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class HeaderServiceProvider extends ServiceProvider
{
  public function boot()
  {
    View::composer('front.layouts.header', function ($view) {
      $view->with([
        'exams' => Exam::where('hview', 1)->where('website', site_var)->inRandomOrder()->limit(4)->get(),
        'sitePages' => SitePage::where('hview', 1)->inRandomOrder()->limit(4)->get(),
        'phonecodesSF' => Country::select('phonecode', 'name')->where('phonecode', '!=', '0')->orderBy('phonecode', 'asc')->get(),
        'countriesSF' => Country::orderBy('name', 'asc')->get(),
        'levels' => Level::groupBy('level')->orderBy('level', 'ASC')->get(),
        'course_categories' => CourseCategory::orderBy('name', 'asc')->get(),
        'modalCaptcha' => generateMathQuestion(),
      ]);

      session(['modal_captcha_answer' => generateMathQuestion()['answer']]);
    });
  }
}
