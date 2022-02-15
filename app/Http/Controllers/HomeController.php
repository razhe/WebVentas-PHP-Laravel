<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __Construct(){
        $this -> middleware('auth');
    }
    public function getHome()
    {
        return view('home');
    }
}
