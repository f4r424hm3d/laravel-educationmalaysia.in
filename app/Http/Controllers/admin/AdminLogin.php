<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

class AdminLogin extends Controller
{
  public function index()
  {
    return view('admin.auth.login');
  }
  public function login(Request $request)
  {
    //printArray($request->all());
    //die;
    $field = User::where('role', 'admin')->where('email', $request['username'])->first();
    // printArray($field->toArray());
    // die;
    if (is_null($field)) {
      session()->flash('emsg', 'Email address not exist.');
      return redirect('admin/login');
    } else {
      if (Hash::check($request['password'], $field->password)) {
        if ($field->status == 1) {
          $lc = $field->login_count == '' ? 0 : $field->login_count + 1;
          $field->login_count = $lc;
          $field->last_login = date("Y-m-d H:i:s");
          $field->save();
          session()->flash('smsg', 'Succesfully logged in');
          $request->session()->put('adminLoggedIn', ['user_id' => $field->id, 'user_name' => $field->name, 'username' => $request['username']]);
          return redirect('admin/dashboard');
        } else {
          session()->flash('emsg', 'You dont have permission to login. Please contact admin.');
          return redirect('admin/login');
        }
      } else {
        session()->flash('emsg', 'Incorrect password entered');
        return redirect('admin/login');
      }
    }
  }
  public function viewForgetPassword()
  {
    return view('admin.auth.forget-password');
  }
  public function forgetPassword(Request $request)
  {
    // printArray($request->all());
    // die;
    $remember_token = Str::random(45);
    $otp_expire_at = date("YmdHis", strtotime("+30 minutes"));
    $field = User::whereEmail($request['email'])->first();
    if (is_null($field)) {
      session()->flash('emsg', 'Entered wrong email address. Please check.');
      return redirect('admin/account/password/reset');
    } else {
      $login_link = url('admin/email-login/?uid=' . $field->id . '&token=' . $remember_token);

      $reset_password_link = url('admin/password/reset/?uid=' . $field->id . '&token=' . $remember_token);

      $emaildata = ['name' => $field->name, 'id' => $field->id, 'remember_token' => $remember_token, 'login_link' => $login_link, 'reset_password_link' => $reset_password_link];

      $dd = ['to' => $request['email'], 'to_name' => $field->name, 'subject' => 'Password Reset'];

      $chk = Mail::send(
        'mails.admin.forget-password-link',
        $emaildata,
        function ($message) use ($dd) {
          $message->to($dd['to'], $dd['to_name']);
          $message->subject($dd['subject']);
          $message->priority(1);
        }
      );
      if ($chk == false) {
        $emsg = response()->Fail('Sorry! Please try again latter');
        session()->flash('emsg', $emsg);
        return redirect('admin/account/password/reset');
      } else {
        $field->remember_token = $remember_token;
        $field->otp_expire_at = $otp_expire_at;
        $field->save();
        $request->session()->put('forget_password_email', $request['email']);
        return redirect('admin/forget-password/email-sent');
      }
    }
  }
  public function emailSent()
  {
    return view('admin.auth.email-sent');
  }
  public function emailLogin(Request $request)
  {
    //printArray($request->all());
    //die;
    $id = $request['uid'];
    $remember_token = $request['token'];
    $where = ['id' => $id, 'remember_token' => $remember_token];
    $field = User::where($where)->first();
    $current_time = date("YmdHis");
    //printArray($field->all());
    if (is_null($field)) {
      return redirect('admin/account/invalid_link');
    } else {
      if ($current_time > $field->otp_expire_at) {
        return redirect('admin/account/invalid_link');
      } else {
        $lc = $field->login_count == '' ? 0 : $field->login_count + 1;
        $field->login_count = $lc;
        $field->last_login = date("Y-m-d H:i:s");
        $field->remember_token = null;
        $field->otp_expire_at = null;
        $field->save();
        session()->flash('smsg', 'Succesfully logged in');
        $request->session()->put('adminLoggedIn', ['user_id' => $field->id, 'user_name' => $field->name, 'username' => $request['username']]);
        return redirect('admin/dashboard');
      }
    }
  }
  public function invalidLink()
  {
    return view('admin.auth.invalid-link');
  }
  public function viewResetPassword(Request $request)
  {
    //printArray($request->all());
    //die;
    $id = $request['uid'];
    $remember_token = $request['token'];
    $where = ['id' => $id, 'remember_token' => $remember_token];
    $field = User::where($where)->first();
    $current_time = date("YmdHis");
    //printArray($field->all());
    if (is_null($field)) {
      return redirect('admin/account/invalid_link');
    } else {
      return view('admin.auth.reset-password');
    }
  }
  public function resetPassword(Request $request)
  {
    //printArray($request->all());
    //die;
    $request->validate(
      [
        'new_password' => ['required', 'string', Password::min(8)->mixedCase()->numbers()->symbols()],
        'confirm_new_password' => 'required|same:new_password'
      ]
    );
    $id = $request['id'];
    $remember_token = $request['remember_token'];
    $where = ['id' => $id, 'remember_token' => $remember_token];
    $field = User::where($where)->first();
    $current_time = date("YmdHis");
    //printArray($field->all());
    if (is_null($field)) {
      return redirect('admin/account/invalid_link');
    } else {
      if ($current_time > $field->otp_expire_at) {
        return redirect('admin/account/invalid_link');
      } else {
        $lc = $field->login_count == '' ? 0 : $field->login_count + 1;
        $field->login_count = $lc;
        $field->last_login = date("Y-m-d H:i:s");
        $field->remember_token = null;
        $field->otp_expire_at = null;
        $field->password = $request['new_password'];
        $field->save();
        session()->flash('smsg', 'Password has been reset succesfully.');
        $request->session()->put('adminLoggedIn', ['user_id' => $field->id, 'user_name' => $field->name, 'username' => $request['username']]);
        return redirect('admin/dashboard');
      }
    }
  }
}
