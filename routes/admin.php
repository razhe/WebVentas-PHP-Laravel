<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\BrandController;

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
    Route::get('/categories/opts',[CategoryController::class, 'getCategoriesNames']);

    Route::post('/categories/add',[CategoryController::class, 'postAddCategory']);
    Route::post('/categories/edit',[CategoryController::class, 'postEditCategory']);
    Route::get('/categories/edit/{id}',[CategoryController::class, 'getFindCategory']);
    Route::post('/categories/delete/{id}',[CategoryController::class, 'postDeleteCategory']);
    //Subcategoría
    Route::get('/subcategories',[SubCategoryController::class, 'getSubcategories']) -> name('admin.subcategories');
    Route::post('/subcategories/delete/{id}',[SubCategoryController::class, 'postDeleteSubcategory']);
    Route::post('/subcategories/add',[SubCategoryController::class, 'postAddSubcategory']);
    Route::get('/subcategories/edit/{id}',[SubCategoryController::class, 'getFindSubcategory']);
    Route::post('/subcategories/edit',[SubCategoryController::class, 'postEditSubcategory']);
    Route::get('/subcategories/find/{id}',[SubCategoryController::class, 'getSubcategoriesSelect']);
    //Marcas
    Route::get('/brands',[BrandController::class, 'getBrands']);
    Route::post('/brands/add',[BrandController::class, 'postAddBrand']);
    Route::get('/brands/edit/{id}',[BrandController::class, 'getFindBrand']);
    Route::post('/brands/edit',[BrandController::class, 'postEditBrand']);
    Route::post('/brands/delete/{id}',[BrandController::class, 'postDeleteBrand']);
});




