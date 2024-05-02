<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
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
//Frontend

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/trang-chu', [HomeController::class, 'index'])->name('trang-chu');
//danh muc san pham trang chu
Route::get('/danh-muc-san-pham/{category_id}', [CategoryProduct::class, 'show_category_home'])->name('danh-muc-san-pham');
//chi tiet san pham trang chu
Route::get('/chi-tiet-san-pham/{product_id}', [ProductController::class, 'details_product'])->name('chi-tiet-san-pham');



//Backend
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/dashboard', [AdminController::class, 'show_dashboard'])->name('dashboard');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
Route::post('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');

//category product
Route::get('/add-category-product', [CategoryProduct::class, 'add_category_product'])->name('add-category-product');
Route::get('/all-category-product', [CategoryProduct::class, 'all_category_product'])->name('all-category-product');
Route::post('/save-category-product', [CategoryProduct::class, 'save_category_product'])->name('save-category-product');
Route::get('/unactive-category-product/{category_product_id}', [CategoryProduct::class, 'unactive_category_product'])->name('unactive-category-product');
Route::get('/active-category-product/{category_product_id}', [CategoryProduct::class, 'active_category_product'])->name('active-category-product');
Route::get('/edit-category-product/{category_product_id}', [CategoryProduct::class, 'edit_category_product'])->name('edit-category-product');
Route::get('/delete-category-product/{category_product_id}', [CategoryProduct::class, 'delete_category_product'])->name('delete-category-product');
Route::post('/update-category-product/{category_product_id}', [CategoryProduct::class, 'update_category_product'])->name('update-category-product');

//product
Route::get('/add-product', [ProductController::class, 'add_product'])->name('add-product');
Route::get('/all-product', [ProductController::class, 'all_product'])->name('all-product');
Route::post('/save-product', [ProductController::class, 'save_product'])->name('save-product');
Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product'])->name('unactive-product');
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product'])->name('active-product');
Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product'])->name('edit-product');
Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product'])->name('delete-product');
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product'])->name('update-product');
//cart
Route::post('/save-cart', [CartController::class, 'save_cart'])->name('save-cart');
Route::get('/show-cart', [CartController::class, 'show_cart'])->name('show-cart');
Route::get('/delete-to-cart/{rowId}', [CartController::class, 'delete_to_cart'])->name('delete-to-cart');
Route::get('/update-cart-quantity/{rowId}/{qty}', [CartController::class, 'update_cart_quantity'])->name('update-cart-quantity');

//checkout
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout'])->name('login-checkout');
Route::post('/add-customer', [CheckoutController::class, 'add_customer'])->name('add-customer');
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');