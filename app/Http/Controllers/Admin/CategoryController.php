<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(){
        $this-> middleware('auth');
        $this-> middleware('admincheck');
    }
    public function getCategories(){
        return view('Admin.categories');
    }
    public function postAddCategory(){
        return 'categoría agregada!';
    }
}
