<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CheckOngkirController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\KategoriController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);

Auth::routes();

Route::middleware(['auth', 'checkRole:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::resource('/admin/user', UserController::class);
    Route::resource('/admin/kategori', KategoriController::class);
    Route::resource('/admin/produk', ProdukController::class);
    Route::resource('/admin/pesanan', PesananController::class);
    Route::resource('/admin/banner', BannerController::class);
    Route::post('/admin/produk/{id}/foto', [ProdukController::class, 'addFoto'])->name('produk.foto');
    Route::delete('/admin/produk/{id}/delete', [ProdukController::class, 'deleteFoto'])->name('produk.foto.delete');
});

Route::get('/produk', [HomeController::class, 'produk'])->name('produk');
Route::get('/produk/{slug}', [HomeController::class, 'detailProduk']);
Route::get('keranjang', [CartController::class, 'cartList'])->name('keranjang');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
Route::get('/cart/decrease/{id}', [CartController::class, 'decreaseQuantity'])->name('decreaseQuantity');
Route::get('/cart/increase/{id}', [CartController::class, 'increaseQuantity'])->name('increaseQuantity');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/ongkir', [CartController::class, 'check_ongkir']);
    Route::get('/province', [CartController::class, 'getProvince']);
    Route::get('/city/{id}', [CartController::class, 'getCity']);
    Route::get('/origin={city_origin}&destination={city_destination}&weight={weight}&courier={courier}', [CartController::class, 'getOngkir']);
    Route::post('/order_store', [CartController::class, 'order_store'])->name('order_store');
    Route::delete('/pesanan/{id}', [CartController::class, 'destroy'])->name('pesanan.destroy');
    Route::get('/pesanan_saya', [CartController::class, 'pesanan_saya'])->name('pesanan_saya');
    Route::get('/pesanan_saya/invoice/{id}', [CartController::class, 'invoice'])->name('pesanan_saya.invoice');
    Route::get('/pesanan_saya/bayar/{id}', [CartController::class, 'bayar'])->name('pesanan_saya.bayar');
    Route::get('/order-lowest-price', [CartController::class, 'orderLowestPrice'])->name('orderLowestPrice');

    // Route::get('/invoice', [CartController::class, 'invoice'])->name('invoice');
});
