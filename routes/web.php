<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\CategoryPost;


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
Route::post('/tim-kiem', [HomeController::class, 'search'])->name('tim-kiem');
//danh muc san pham trang chu
Route::get('/danh-muc-san-pham/{category_id}', [CategoryProduct::class, 'show_category_home'])->name('danh-muc-san-pham');
//chi tiet san pham trang chu
Route::get('/chi-tiet-san-pham/{product_id}', [ProductController::class, 'details_product'])->name('chi-tiet-san-pham');



//Backend
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/dashboard', [AdminController::class, 'show_dashboard'])->name('dashboard');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
Route::post('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');

//category post
Route::get('/add-category-post', [CategoryPost::class, 'add_category_post'])->name('add-category-post');
Route::post('/save-category-post', [CategoryPost::class, 'save_category_post'])->name('save-category-post');
Route::get('/all-category-post', [CategoryPost::class, 'all_category_post'])->name('all-category-post');
Route::get('/danh-muc-bai-viet/{category_post_slug}', [CategoryPost::class, 'danh_muc_bai_viet'])->name('danh-muc-bai-viet');
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
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax'])->name('add-cart-ajax');
Route::get('/gio-hang', [CartController::class, 'gio_hang'])->name('gio-hang');
//checkout
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout'])->name('login-checkout');
Route::post('/add-customer', [CheckoutController::class, 'add_customer'])->name('add-customer');
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/save-checkout-customer', [CheckoutController::class, 'save_checkout_customer'])->name('save-checkout-customer');
Route::get('/payment', [CheckoutController::class, 'payment'])->name('payment');
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout'])->name('logout-checkout');
Route::post('/login-customer', [CheckoutController::class, 'login_customer'])->name('login-customer');
Route::post('/order-place', [CheckoutController::class, 'order_place'])->name('order-place');

//order
Route::get('/manage-order', [CheckoutController::class, 'manage_order'])->name('manage-order');
Route::get('/view-order/{orderId}', [CheckoutController::class, 'view_order'])->name('view-order');
Route::get('/delete-order/{orderId}', [CheckoutController::class, 'delete_order'])->name('delete-order');

//send mail
Route::get('/send-mail', [HomeController::class, 'send_mail'])->name('send-mail');

//slider
Route::get('/add-slider', [SliderController::class, 'add_slider'])->name('add-slider');
Route::get('/manage-slider', [SliderController::class, 'manage_slider'])->name('manage-slider');
Route::post('/insert-slider', [SliderController::class, 'insert_slider'])->name('insert-slider');
Route::get('/unactive-slide/{slide_id}', [SliderController::class, 'unactive_slide'])->name('unactive-slide');
Route::get('/active-slide/{slide_id}', [SliderController::class, 'active_slide'])->name('active-slide');
Route::get('/delete-slide/{slide_id}', [SliderController::class, 'delete_slide'])->name('delete-slide');
Route::get('/edit-slide/{slide_id}', [SliderController::class, 'edit_slide'])->name('edit-slide');
Route::post('/update-slide/{slide_id}', [SliderController::class, 'update_slide'])->name('update-slide');

