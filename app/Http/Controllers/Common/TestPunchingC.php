<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Punching;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class TestPunchingC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'test/abc/punching';
  }
  public function index(Request $request, $id = null)
  {
    $users = User::other()->active()->get();
    $punchTypes = [
      'in' => 'in',
      'lunch start' => 'lunch start',
      'lunch end' => 'lunch end',
      'break start' => 'break start',
      'break end' => 'break end',
      'out' => 'out',
    ];
    $rows = Punching::orderBy('id', 'DESC');
    if ($request->has('user') && $request->user != '') {
      $rows = $rows->where('user_id', $request->user);
    }
    $rows = $rows->paginate(20)->withQueryString();

    $cp = $rows->currentPage();
    $pp = $rows->perPage();
    $i = ($cp - 1) * $pp + 1;
    if ($id != null) {
      $sd = Punching::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url($this->page_route . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect($this->page_route);
      }
    } else {
      $ft = 'add';
      $url = url($this->page_route . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Test Punching";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'i', 'users', 'punchTypes');
    return view('test.punching')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'user_id' => 'required',
      ]
    );
    $agent = new Agent();
    $browser = $request->input('browser') ?? $agent->browser();
    $browserVersion = $request->input('browser_version') ?? $agent->version($browser);
    $os = $request->input('os') ?? 'Windows 10';
    $ipAddress = $request->input('ip_address') ?? $request->ip();

    $userId = $request->user_id;
    $punchType = $request->input('punch_type');
    $punchAt = $request->input('punch_at');

    $count = Punching::where('user_id', $userId)->where('punch_type', $punchType)->whereDate('punch_at', date('Y-m-d', strtotime($punchAt)))->count();

    if ($count == 0) {
      $field = new Punching();
      $field->user_id = $userId;
      $field->punch_type = $punchType;
      $field->punch_at = $punchAt;
      $field->browser = $browser;
      $field->browser_version = $browserVersion;
      $field->os = $os;
      $field->ip_address = $ipAddress;
      $field->save();

      session()->flash('smsg', 'Success.');
    } else {
      session()->flash('smsg', 'Duplicate record Found.');
    }
    return redirect('test/abc/punching/');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = Punching::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'user_id' => 'required',
      ]
    );

    $agent = new Agent();

    $browser = $request->input('browser', $agent->browser());
    $browserVersion = $request->input('browser_version', $agent->version($browser));
    $os = $request->input('os', 'Windows 10');
    $ipAddress = $request->input('ip_address', $request->ip());

    $userId = $request->user_id;
    $punchType = $request->input('punch_type');
    $punchAt = $request->input('punch_at');

    $field = Punching::find($id);
    $field->user_id = $userId;
    $field->punch_type = $punchType;
    $field->punch_at = $punchAt;
    $field->browser = $browser;
    $field->browser_version = $browserVersion;
    $field->os = $os;
    $field->ip_address = $ipAddress;
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('test/abc/punching/');
  }
}
