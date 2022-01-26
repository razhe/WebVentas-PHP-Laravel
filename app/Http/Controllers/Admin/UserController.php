<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(){
        $this-> middleware('auth');
        $this-> middleware('admincheck');
    }
    public function getUsers(){
        $users = User::orderBy('id', 'Asc')->get();
        $usersData = ['users' => $users];
        return view('Admin.users', $usersData);
    }
    public function postAddUser(){
        return 'Usuario agregado';
    }
}
