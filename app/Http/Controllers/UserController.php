<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

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
        return redirect()->route('home');
    }
}
