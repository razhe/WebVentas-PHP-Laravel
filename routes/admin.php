<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

Route::prefix('/admin')->group(function(){
    Route::get('/', [DashboardController::class, 'getDashboard']);
    //Modulo usuarios
    Route::get('/users', [UserController::class, 'getUsers']);
    Route::post('/users/add', [UserController::class, 'postAddUser']);
    Route::post('/users/delete/{id}', [UserController::class, 'postDeleteUser']);
    Route::get('/users/edit/{id}',[UserController::class, 'getFindUser']);
    Route::post('/users/edit',[UserController::class, 'postEditUser']);

    //Modulo productos
    Route::get('/products',[ProductController::class, 'getProducts']);
    Route::post('/products',[ProductController::class, 'postAddProduct']);
    //Categorías
    Route::get('/categories',[CategoryController::class, 'getCategories']);
    Route::post('/categories/add',[CategoryController::class, 'postAddCategory']);
    Route::post('/categories/edit',[CategoryController::class, 'postEditCategory']);
    Route::get('/categories/edit/{id}',[CategoryController::class, 'getFindCategory']);
    Route::post('/categories/delete/{id}',[CategoryController::class, 'postDeleteCategory']);
});




