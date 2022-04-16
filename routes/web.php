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
use App\Http\Controllers\TransbankController;
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
Route::post('/profile/update-profile', [UserProfileController::class, 'postUpdateProfile']) -> name('profile.postupdateProfile');
Route::post('/profile/update-password', [UserProfileController::class, 'postUpdatePassword']) -> name('profile.postupdatePassword');

Route::get('/profile/regiones', [UserProfileController::class, 'getRegiones']) -> name('profile.regiones');
Route::post('/profile/comunas/{id}', [UserProfileController::class, 'getComunas']) -> name('profile.comunas');
Route::post('/profile/create-address', [UserProfileController::class, 'postSaveAddress']) -> name('profile.postcreateAddress');
Route::post('/profile/delete-address', [UserProfileController::class, 'postRemoveAddress']) -> name('profile.postdeleteAddress');


//Router auth
Route::get('/login', [AuthController::class, 'getLogin']) -> name('auth.login'); 
Route::get('/recover', [AuthController::class, 'getRecover']) -> name('auth.recover');
Route::get('/reset', [AuthController::class, 'getReset']) -> name('auth.reset');
Route::get('/change-password', [AuthController::class, 'getChangePassword']) -> name('auth.changepassword');        
Route::post('/login', [AuthController::class, 'postLogin']) -> name('auth.postlogin');
Route::post('/recover', [AuthController::class, 'postRecover']) -> name('auth.postrecover'); 
Route::post('/reset', [AuthController::class, 'postReset']) -> name('auth.postreset');
Route::post('/change-password', [AuthController::class, 'postChangePassword']) -> name('auth.postchangepassword');  

Route::get('/logout', [AuthController::class, 'getLogout']) -> name('auth.logout');

Route::get('/register', [AuthController::class, 'getRegister']) -> name('auth.register');
Route::post('/register', [AuthController::class, 'postRegister'])-> name('auth.postregister');
//Detalles del producto
Route::get('/details-product', [DetailProductController::class, 'getDetailProduct']) -> name('details-product');

//Carrito
Route::get('/cart', [CartController::class, 'getCart']) -> name('cart');
Route::get('/cart/add', [CartController::class, 'postAddToCart'])-> name('cart.add');
Route::get('/cart/list', [CartController::class, 'getListCart'])-> name('cart.list');
Route::get('/cart/update', [CartController::class, 'getCartUpdate'])-> name('cart.update');
Route::get('/cart/remove', [CartController::class, 'getCartRemove'])-> name('cart.remove');

//catalogo productos
Route::get('/products', [ProductsController::class, 'getProducts']) -> name('products');
Route::get('/products/{subcategory}', [ProductsController::class, 'getProductsBySubcat']) -> name('products.subcategory');
Route::post('/product/search/', [ProductsController::class, 'postSearchProducts']) -> name('products.postsearch');
Route::post('/products/filter', [ProductsController::class, 'postShopFilter']) -> name('products.postfilter');

//checkout
Route::get('/checkout/customer-information', [CheckoutController::class, 'getCustomerInfo'])-> name('checkout.customerinformation');
Route::get('/checkout/payment-method', [CheckoutController::class, 'getPaymentMethod'])-> name('checkout.payment-method');
Route::get('/checkout/summary-payment', [CheckoutController::class, 'getSummaryPayment'])-> name('checkout.summary-payment');
Route::get('/checkout/purchase-detail', [CheckoutController::class, 'getPurchaseDetail'])-> name('checkout.purchase-detail');

Route::post('/checkout/save-guest-data', [CheckoutController::class, 'postSaveGuest'])-> name('checkout.postsave-guest-data');
Route::post('/checkout/save-user-data', [CheckoutController::class, 'postSaveUser'])-> name('checkout.post-save-user-data');

Route::post('/checkout/save-payment-method', [CheckoutController::class, 'postCheckoutPaymentMethod'])-> name('checkout.postsave-payment-method');

//transbank
Route::post('/transbank/iniciar-compra', [TransbankController::class, 'postIniciarCompra'])-> name('transbank.postiniciar-compra');
Route::post('/transbank/refud-pay', [TransbankController::class, 'postDevolverPago'])-> name('transbank.postdevolver-pago');