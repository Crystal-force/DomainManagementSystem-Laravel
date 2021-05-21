<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\User;
use Session;

class NewLoginController extends Controller
{
    public function index() {
      if (Session::get('user'))
        {
          return back()->withInput();
        }
        else 
        {
          Auth::logout();
          return view('auth.login');
          // return Redirect::to('/login');
        }
    }

    public function login(Request $request) {
      $credentials  = $request->only('email', 'password');
        
        if (Auth::attempt($credentials )) {
          $request->session()->regenerate();
          
          Session::put('user', $credentials);
          
          return response()->json(['data'=> '1']);
        }
        else {
          return response()->json(['data' => '0']);
        }
    }

    public function logout(Request $request) {
      Session::flush();
      Auth::logout();
        return Redirect::to('/');
    }
}
