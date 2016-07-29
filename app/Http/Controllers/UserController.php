<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
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
        $user = new User();
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->save();

        // We should send activation mail with link .../activation/email/$identifier (it is str_random(128))
        // and in database field active hash to save bcrypt ($identifier) to check activation link
        return redirect()->route('user.activation');
    }

    public function activateUser(){
        return view('users.activation');
    }

    public function loginUser(){
        return view('users.login');
    }

    public function loginUserCheck(Request $request){
        if ((Auth::attempt(['email' => $request['credentials'], 'password' => $request['password']], $request->has('remember'))) ||
           (Auth::attempt(['username' => $request['credentials'], 'password' => $request['password']], $request->has('remember')))) {
            // Authentication passed...
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
}
