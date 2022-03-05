<?php
use Illuminate\Support\Facades\Route;
//Importante poner esta ruta de abajo porque sino no deja llamar a la clase
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DetailProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CheckoutController;
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

//main

//Route::get('/load/products/content/{section}', [MainController::class, 'getContentLoadProducts']) -> name();

//Home
Route::get('/', [HomeController::class, 'getHome']) -> name('home');
//perfil usuario
Route::get('/profile', [UserProfileController::class, 'getProfile']) -> name('profile');
Route::post('/profile/update-profile', [UserProfileController::class, 'postUpdateProfile']) -> name('profile');
Route::post('/profile/update-password', [UserProfileController::class, 'postUpdatePassword']) -> name('profile');

Route::get('/profile/regiones', [UserProfileController::class, 'getRegiones']) -> name('profile');
Route::post('/profile/comunas/{id}', [UserProfileController::class, 'getComunas']);
Route::post('/profile/create-address', [UserProfileController::class, 'postSaveAddress']);
Route::post('/profile/delete-address', [UserProfileController::class, 'postRemoveAddress']);


//Router auth
Route::get('/login', [AuthController::class, 'getLogin']) -> name('login'); 
Route::get('/recover', [AuthController::class, 'getRecover']) -> name('recover');
Route::get('/reset', [AuthController::class, 'getReset']) -> name('reset');
Route::get('/change-password', [AuthController::class, 'getChangePassword']) -> name('change-password');        
Route::post('/login', [AuthController::class, 'postLogin']);
Route::post('/recover', [AuthController::class, 'postRecover']) -> name('recover'); 
Route::post('/reset', [AuthController::class, 'postReset']) -> name('reset');
Route::post('/change-password', [AuthController::class, 'postChangePassword']) -> name('change-password');  

Route::get('/logout', [AuthController::class, 'getLogout']) -> name('logout');

Route::get('/register', [AuthController::class, 'getRegister']) -> name('register');
Route::post('/register', [AuthController::class, 'postRegister']);
//Detalles del producto
Route::get('/details-product', [DetailProductController::class, 'getDetailProduct']) -> name('details-product');

//Carrito
Route::get('/cart', [CartController::class, 'getCart']);
Route::get('/cart/add', [CartController::class, 'postAddToCart']);
Route::get('/cart/list', [CartController::class, 'getListCart']);
Route::get('/cart/update', [CartController::class, 'getCartUpdate']);
Route::get('/cart/remove', [CartController::class, 'getCartRemove']);
//catalogo productos
Route::get('/products', [ProductsController::class, 'getProducts']) -> name('products');
Route::get('/products/{subcategory}', [ProductsController::class, 'getProductsBySubcat']) -> name('products.subcategory');
Route::post('/product/search/', [ProductsController::class, 'postSearchProducts']) -> name('products.search');
Route::post('/products/filter', [ProductsController::class, 'postShopFilter']) -> name('products.filter');

//checkout
Route::get('/checkout/customer-information', [CheckoutController::class, 'getCustomerInfo']) -> name('checkout.customer');
Route::get('/checkout/payment-method', [CheckoutController::class, 'getPaymentMethod']) -> name('checkout.customer');