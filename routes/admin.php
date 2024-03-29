<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SalesController;


Route::prefix('/admin')->group(function(){
    //dashboard
    Route::get('/', [DashboardController::class, 'getDashboard']);
    Route::get('/dashboard/sales-per-year/{year}',[DashboardController::class, 'getSalesPerYear']);
    Route::get('/dashboard/products-sold/{year}',[DashboardController::class, 'getProductsSoldPerYear']);
    //Modulo usuarios
    Route::get('/users', [UserController::class, 'getUsers']);
    Route::post('/users/add', [UserController::class, 'postAddUser']);
    Route::post('/users/delete/{id}', [UserController::class, 'postDeleteUser']);
    Route::get('/users/edit/{id}',[UserController::class, 'getFindUser']);
    Route::post('/users/edit',[UserController::class, 'postEditUser']);

    //Modulo productos
    Route::get('/products',[ProductController::class, 'getProducts']);
    Route::post('/products/add',[ProductController::class, 'postAddProduct']);
    Route::get('/products/edit/{id}',[ProductController::class, 'getFindProduct']);
    Route::post('/products/edit/',[ProductController::class, 'postEditProduct']);
    Route::post('/products/delete',[ProductController::class, 'postRemoveProduct']);
    
    //Categorías
    Route::get('/categories',[CategoryController::class, 'getCategories']);
    Route::get('/categories/opts',[CategoryController::class, 'getCategoriesNames']);

    Route::post('/categories/add',[CategoryController::class, 'postAddCategory']);
    Route::post('/categories/edit',[CategoryController::class, 'postEditCategory']);
    Route::get('/categories/edit/{id}',[CategoryController::class, 'getFindCategory']);
    Route::post('/categories/delete/{id}',[CategoryController::class, 'postDeleteCategory']);
    
    //Subcategoría
    Route::get('/subcategories/get',[SubCategoryController::class, 'getSubcategoriesNames']);

    Route::get('/subcategories',[SubCategoryController::class, 'getSubcategories']) -> name('admin.subcategories');
    Route::post('/subcategories/delete/{id}',[SubCategoryController::class, 'postDeleteSubcategory']);
    Route::post('/subcategories/add',[SubCategoryController::class, 'postAddSubcategory']);
    Route::get('/subcategories/edit/{id}',[SubCategoryController::class, 'getFindSubcategory']);
    Route::post('/subcategories/edit',[SubCategoryController::class, 'postEditSubcategory']);
    Route::get('/subcategories/find/{id}',[SubCategoryController::class, 'getSubcategoriesSelect']);
    //Marcas
    Route::get('/brands/opts',[BrandController::class, 'getBrandsNames']);

    Route::get('/brands',[BrandController::class, 'getBrands']);
    Route::post('/brands/add',[BrandController::class, 'postAddBrand']);
    Route::get('/brands/edit/{id}',[BrandController::class, 'getFindBrand']);
    Route::post('/brands/edit',[BrandController::class, 'postEditBrand']);
    Route::post('/brands/delete/{id}',[BrandController::class, 'postDeleteBrand']);

    //Customización
    route::get('/banner',[SettingsController::class, 'getBannerCustomize']);
    route::post('/banner/change-banner',[SettingsController::class, 'postChangeBanner']);

    route::get('/web-parameters/config',[SettingsController::class, 'getWebCustomize']);
    route::post('/web-parameters/global-config/save',[SettingsController::class, 'postGlobalConfigSave']);

    //Ventas
    route::get('/sales',[SalesController::class, 'getSales']);
    route::get('/sale-detail',[SalesController::class, 'getSaleDetail']);

    route::post('/sales/change-order-status-webpay',[SalesController::class, 'postChangeOrderStatusWebPay']);
    route::post('/sales/change-order-status-bankTransfer',[SalesController::class, 'postChangeOrderStatusBankTransfer']);
});




