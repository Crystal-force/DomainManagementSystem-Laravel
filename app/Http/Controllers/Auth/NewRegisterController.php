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

class NewRegisterController extends Controller
{
    public function index() {
      return view('auth.register');
    }

    public function register(Request $request) {
      $email = $request->email;
      $name = $request->name;
      $password = Hash::make($request->password);
      
      $res = User::where('email', $email)->first();
      if(!is_null($res)) {
        return response()->json(['data' => '0']);
      }
      else {
        $userData = [
          'name' => $name,
          'email' => $email,
          'password' => $password,
        ];
       
        $usernew = User::create($userData);
        return response()->json(['data' => '1']);
      }
    }
}
