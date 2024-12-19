<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\DefaultOgImage;
use App\Models\DynamicPageSeo;
use App\Models\University;
use App\Models\UniversityProgram;
use App\Models\UniversityReviews;
use Illuminate\Http\Request;

class UniversityReviewFc extends Controller
{
  public function index($university_slug, Request $request)
  {
    $university_slug = $request->segment(1);
    $university = University::where(['slug' => $university_slug])->firstOrFail();

    $totalrating = UniversityReviews::where(['university_id' => $university->id, 'status' => 1])->sum('rating');
    $tcir = UniversityReviews::where(['university_id' => $university->id, 'status' => 1])->sum('infrastructure_rating');
    $tcfr = UniversityReviews::where(['university_id' => $university->id, 'status' => 1])->sum('faculty_rating');
    $tcpr = UniversityReviews::where(['university_id' => $university->id, 'status' => 1])->sum('placement_rating');
    $tchr = UniversityReviews::where(['university_id' => $university->id, 'status' => 1])->sum('hostel_rating');

    $rows = UniversityReviews::where(['university_id' => $university->id, 'status' => 1]);
    $rows = $rows->paginate(10)->withQueryString();
    if ($rows->count() == 0) {
      abort(404);
    }

    $total = $rows->total();
    $cp = $rows->currentPage();
    $pp = $rows->perPage();
    $i = ($cp - 1) * $pp + 1;

    $page_url = url()->current();

    $wrdseo = ['url' => 'university-reviews'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();
    $dogimg = DefaultOgImage::default()->first();

    $title = $university->name;
    $site =  'educationmalaysia.in';
    $tagArray = ['title' => $title, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site];

    $meta_title = $university->meta_title == '' ? $dseo->meta_title : $university->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $university->meta_keyword == '' ? $dseo->meta_keyword : $university->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $university->page_content == '' ? $dseo->page_content : $university->page_content;
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $university->meta_description == '' ? $dseo->meta_description : $university->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $dogimg->file_path;

    $avrgRating = $totalrating / $total;
    $avrgRating = sprintf("%.1f", $avrgRating);
    $air = $tcir / $total;
    $afr = $tcfr / $total;
    $apr = $tcpr / $total;
    $ahr = $tchr / $total;

    $data = compact('university', 'rows', 'i', 'total', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'avrgRating', 'air', 'afr', 'apr', 'ahr');
    return view('front.university-reviews')->with($data);
  }
  public function writeReview($university_slug, Request $request)
  {
    $university_slug = $request->segment(1);
    $university = University::where(['slug' => $university_slug])->firstOrFail();
    $programs = UniversityProgram::where(['university_id' => $university->id])->get();

    $page_url = url()->current();

    $wrdseo = ['url' => 'university-write-review'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();
    $dogimg = DefaultOgImage::default()->first();
    $title = $university->name;
    $site =  'educationmalaysia.in';
    $tagArray = ['title' => $title, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site];

    $meta_title = $university->meta_title == '' ? $dseo->meta_title : $university->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $university->meta_keyword == '' ? $dseo->meta_keyword : $university->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $university->page_content == '' ? $dseo->page_content : $university->page_content;
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $university->meta_description == '' ? $dseo->meta_description : $university->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $dogimg->file_path;

    $data = compact('university', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'programs');
    return view('front.university-write-review')->with($data);
  }
  public function addReview(Request $request)
  {
    // printArray($request->all());
    // die;
    $university = University::find($request->university_id);
    $request->validate(
      [
        'university_id' => 'required',
        'name' => 'required',
        'email' => 'required',
        'mobile' => 'required',
        'program' => 'nullable',
        'passing_year' => 'required',
        'title' => 'required',
        'review' => 'required',
        'rating' => 'required',
        'infrastructure_review' => 'required',
        'infrastructure_rating' => 'required',
        'faculty_review' => 'required',
        'faculty_rating' => 'required',
        'placement_review' => 'required',
        'placement_rating' => 'required',
        'hostel_review' => 'required',
        'hostel_rating' => 'required',
      ]
    );
    $field = new UniversityReviews;
    $field->university_id = $request['university_id'];
    $field->program_id = $request['program'];
    $field->name = $request['name'];
    $field->email = $request['email'];
    $field->mobile = $request['mobile'];
    $field->passing_year = $request['passing_year'];
    $field->title = $request['title'];
    $field->review = $request['review'];
    $field->rating = $request['rating'];
    $field->infrastructure_review = $request['infrastructure_review'];
    $field->infrastructure_rating = $request['infrastructure_rating'];
    $field->faculty_review = $request['faculty_review'];
    $field->faculty_rating = $request['faculty_rating'];
    $field->placement_review = $request['placement_review'];
    $field->placement_rating = $request['placement_rating'];
    $field->hostel_review = $request['hostel_review'];
    $field->hostel_rating = $request['hostel_rating'];
    $field->save();
    session()->flash('smsg', 'You review has been added successfully.');
    return redirect(url($university->slug . '/write-a-review'));
  }
}
