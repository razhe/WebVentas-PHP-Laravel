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
Route::post('/profile/update-profile', [UserProfileController::class, 'postUpdateProfile']) -> name('profile.updateProfile');
Route::post('/profile/update-password', [UserProfileController::class, 'postUpdatePassword']) -> name('profile.updatePassword');

Route::get('/profile/regiones', [UserProfileController::class, 'getRegiones']) -> name('profile.regiones');
Route::post('/profile/comunas/{id}', [UserProfileController::class, 'getComunas']) -> name('profile.comunas');
Route::post('/profile/create-address', [UserProfileController::class, 'postSaveAddress']) -> name('profile.createAddress');
Route::post('/profile/delete-address', [UserProfileController::class, 'postRemoveAddress']) -> name('profile.deleteAddress');


//Router auth
Route::get('/login', [AuthController::class, 'getLogin']) -> name('getLogin'); 
Route::get('/recover', [AuthController::class, 'getRecover']) -> name('getRecover');
Route::get('/reset', [AuthController::class, 'getReset']) -> name('getReset');
Route::get('/change-password', [AuthController::class, 'getChangePassword']) -> name('getChange.password');        
Route::post('/login', [AuthController::class, 'postLogin']) -> name('login');
Route::post('/recover', [AuthController::class, 'postRecover']) -> name('postRecover'); 
Route::post('/reset', [AuthController::class, 'postReset']) -> name('postReset');
Route::post('/change-password', [AuthController::class, 'postChangePassword']) -> name('postChange.password');  

Route::get('/logout', [AuthController::class, 'getLogout']) -> name('logout');

Route::get('/register', [AuthController::class, 'getRegister']);
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
Route::get('/checkout/customer-information', [CheckoutController::class, 'getCustomerInfo']);
Route::get('/checkout/payment-method', [CheckoutController::class, 'getPaymentMethod']);
Route::get('/checkout/summary-payment', [CheckoutController::class, 'getSummaryPayment']);

Route::post('/checkout/save-guest-data', [CheckoutController::class, 'postSaveGuest']);
Route::post('/checkout/save-user-data', [CheckoutController::class, 'postSaveUser']);

Route::post('/checkout/save-payment-method', [CheckoutController::class, 'postCheckoutPaymentMethod']);