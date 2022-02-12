<?php
use Illuminate\Support\Facades\Route;
//Importante poner esta ruta de abajo porque sino no deja llamar a la clase
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductCatalogController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//DESARROLLO
//Home
Route::view('/', 'home')->name('home');
//Router auth
Route::get('/login', [AuthController::class, 'getLogin']) -> name('login');  
Route::post('/login', [AuthController::class, 'postLogin']);

Route::get('/logout', [AuthController::class, 'getLogout']) -> name('logout');

Route::get('/register', [AuthController::class, 'getRegister']) -> name('register');
Route::post('/register', [AuthController::class, 'postRegister']);
//Detalles del producto
Route::get('/details-product', [ProductController::class, 'getDetailProduct']);

//Carrito
Route::get('/cart', [CartController::class, 'getCart']);
//catalogo productos
Route::get('/product-catalog', [ProductCatalogController::class, 'getProducts']);