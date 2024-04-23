<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
  
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

//frontend
Route::get('/', [HomeController::class, 'index']);

Route::get('/trang-chu','App\Http\Controllers\HomeController@index');

Route::get('/shop','App\Http\Controllers\ShopController@index');

// sản phẩm theo từng danh mục
Route::get('/danh-muc-san-pham/{category_product_slug}','App\Http\Controllers\ShopController@show_category_product');

// sản phẩm theo thương hiệu
Route::get('/thuong-hieu-san-pham/{brand_slug}','App\Http\Controllers\ShopController@show_brand_product');

//chi tiết sản phẩm
Route::get('/chi-tiet-san-pham/{product_slug}','App\Http\Controllers\ShopDetailController@detail_product');

//giỏ hàng
Route::post('/save-cart','App\Http\Controllers\CartController@save_cart');

Route::get('/show-cart','App\Http\Controllers\CartController@show_cart');

Route::get('/delete-cart/{rowId}','App\Http\Controllers\CartController@delete_cart');

Route::post('/update-cart','App\Http\Controllers\CartController@update_cart');



Route::get('/contact','App\Http\Controllers\ContactController@index');

//backend
Route::get('/admin','App\Http\Controllers\AdminController@index');

Route::get('/dashboard','App\Http\Controllers\AdminController@show_dashboard');

Route::post('/admin-dashboard','App\Http\Controllers\AdminController@dashboard');

Route::get('/log-out','App\Http\Controllers\AdminController@log_out');

//Category Product
Route::get('/add-category-product','App\Http\Controllers\CategoryProductController@add_category_product');

Route::get('/all-category-product','App\Http\Controllers\CategoryProductController@all_category_product');

Route::post('/save-category-product','App\Http\Controllers\CategoryProductController@save_category_product');

Route::get('/edit-category-product/{category_product_id}','App\Http\Controllers\CategoryProductController@edit_category_product');

Route::post('/update-category-product/{category_product_id}','App\Http\Controllers\CategoryProductController@update_category_product');

Route::get('/delete-category-product/{category_product_id}','App\Http\Controllers\CategoryProductController@delete_category_product');

Route::get('/active-category-product/{category_product_id}','App\Http\Controllers\CategoryProductController@active_category_product');

Route::get('/unactive-category-product/{category_product_id}','App\Http\Controllers\CategoryProductController@unactive_category_product');

Route::post('/search-category-product','App\Http\Controllers\CategoryProductController@search_category_product');

//Brand
Route::get('/add-brand','App\Http\Controllers\BrandController@add_brand');

Route::get('/all-brand','App\Http\Controllers\BrandController@all_brand');

Route::post('/save-brand','App\Http\Controllers\BrandController@save_brand');

Route::get('/edit-brand/{brand_id}','App\Http\Controllers\BrandController@edit_brand');

Route::post('/update-brand/{brand_id}','App\Http\Controllers\BrandController@update_brand');

Route::get('/delete-brand/{brand_id}','App\Http\Controllers\BrandController@delete_brand');

Route::get('/active-brand/{brand_id}','App\Http\Controllers\BrandController@active_brand');

Route::get('/unactive-brand/{brand_id}','App\Http\Controllers\BrandController@unactive_brand');

Route::post('/search-brand','App\Http\Controllers\BrandController@search_brand');

//Product
Route::get('/add-product','App\Http\Controllers\ProductController@add_product');

Route::get('/all-product','App\Http\Controllers\ProductController@all_product');

Route::post('/save-product','App\Http\Controllers\ProductController@save_product');

Route::get('/edit-product/{product_id}','App\Http\Controllers\ProductController@edit_product');

Route::post('/update-product/{product_id}','App\Http\Controllers\ProductController@update_product');

Route::get('/delete-product/{product_id}','App\Http\Controllers\ProductController@delete_product');

Route::get('/active-product/{product_id}','App\Http\Controllers\ProductController@active_product');

Route::get('/unactive-product/{product_id}','App\Http\Controllers\ProductController@unactive_product');

Route::post('/search-product','App\Http\Controllers\ProductController@search_product');

