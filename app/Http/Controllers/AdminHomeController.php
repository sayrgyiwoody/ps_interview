<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function home(){
        return view('admin.home'); // -> direct to admin home page
    }
}
