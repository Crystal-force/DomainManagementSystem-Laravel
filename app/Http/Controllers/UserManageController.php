<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserManageController extends Controller
{
    public function index() {
      return view('usermanagement');
    }
}
