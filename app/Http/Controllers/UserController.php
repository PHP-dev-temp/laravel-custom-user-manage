<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function registerUser(){
        return view('users.register');
    }

    public function registerUserStore(Request $request){
        $this->validate($request, [
            'username' => 'required|max:20',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        $identifier = str_random(128);
        $user = new User();
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->active_hash = hash('sha256', $identifier);
        $user->save();
        $link = route('user.activation') . '/' . $user->email . '/' . $identifier;
        $data = ['link' => $link];

        Mail::send('emails.activation', $data, function ($message) use ($user) {
            $message->subject('User activation link');
            $message->to($user->email);
        });
        $messages = array(
            'header' => 'User registration',
            'body' => 'Please, check your email to continue registration.');
        return view('users.activation', $messages);
    }

    public function activateUser($email = null, $code = null){
        if ($user = User::where('email', $email)->first()) {
            if($user->active_hash == hash('sha256', $code)){
                $user->active = 1;
                $user->active_hash = null;
                $user->update();
                Auth::login($user);
                // TODO return user edit page
                return redirect()->route('home');
            }
        }
        $messages = array(
            'header' => 'User account activation',
            'body' => 'Wrong activation data!');
        return view('users.activation', $messages);
    }

    public function loginUser(){
        return view('users.login');
    }

    public function loginUserCheck(Request $request){
        if ((Auth::attempt(['email' => $request['credentials'], 'password' => $request['password']], $request->has('remember'))) ||
           (Auth::attempt(['username' => $request['credentials'], 'password' => $request['password']], $request->has('remember')))) {
            if (!Auth::user()->active) {
                Auth::logout();
                Session::flash('login_error', 'Account is not active!');
                return redirect()->route('login');
            }
            return redirect()->route('home');
        } else {
            Session::flash('login_error', 'Wrong username/email or password!');
            return redirect()->route('login');
        }
    }

    public function logoutUser(){
        Auth::logout();
        return redirect()->route('home');
    }

    public function resetPasswordForm(){
        return view('users.reset_password');
    }

    public function resetPassword($email, $code){
        if ($user = User::where('email', $email)->first()){
            return view('users.new_password', ['code' => $code, 'email' => $email]);
        }
        $messages = array(
            'header' => 'Reset password',
            'body' => 'Wrong reset password code!');
        return view('users.activation', $messages);
    }

    public function resetPasswordEmailing(Request $request){
        $this->validate($request, [
            'email' => 'required|email'
        ]);
        if ($user = User::where('email', $request->get('email'))->first()) {
            $identifier = str_random(128);
            $user->recover_hash = hash('sha256', $identifier);
            $user->update();
            $link = route('reset.password') . '/' . $user->email . '/' . $identifier;
            $data = ['link' => $link];
            Mail::send('emails.reset_password', $data, function ($message) use ($user) {
                $message->subject('Reset password link');
                $message->to($user->email);
            });
            $messages = array(
                'header' => 'Reset password',
                'body' => 'Please, check your email to get reset password link.');
            return view('users.activation', $messages);
        } else {
            $messages['email_error'] = 'Email is not register in system!';
            return view('users.reset_password', $messages);
        }
    }

    public function resetNewPasswordStore(Request $request){
        $this->validate($request, [
            'password' => 'required|min:6',
        ]);
        if ($user = User::where('email', $request->get('email'))->first()) {
            if($user->recover_hash == hash('sha256', $request->get('identifier'))){
                $user->password = bcrypt($request->get('password'));
                $user->recover_hash = null;
                $user->update();
                return redirect()->route('login');
            }
        }
        $messages = array(
            'header' => 'Reset password',
            'body' => 'Wrong reset password code!');
        return view('users.activation', $messages);
    }
}
