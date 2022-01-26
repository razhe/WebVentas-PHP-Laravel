<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

Route::prefix('/admin')->group(function(){
    Route::get('/', [DashboardController::class, 'getDashboard']);
    Route::get('/users', [UserController::class, 'getUsers']);
    Route::post('/users', [UserController::class, 'postAddUser']);
    
    //Modulo productos
    Route::get('/products',[ProductController::class, 'getProducts']);
    Route::post('/products',[ProductController::class, 'postAddProduct']);
    //Categorías
    Route::get('/categories',[CategoryController::class, 'getCategories']);
    Route::post('/categories',[CategoryController::class, 'postAddCategory']);
});




