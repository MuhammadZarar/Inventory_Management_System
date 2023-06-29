<?php

use App\Http\Controllers\category_controller;
use App\Http\Controllers\invoice_controller;
use App\Http\Controllers\product_controller;
use App\Http\Controllers\report_controller;
use App\Http\Controllers\user_controller;
use App\Models\product;
use Illuminate\Support\Facades\Route;

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

Route::controller(user_controller::class)->group(function () {
    Route::get('/', 'view_login')->name('view_login');
    Route::post('/check-login', 'check_login')->name('check_login');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(category_controller::class)->group(function () {
    Route::get('/add-category', 'category_add')->name('add_category');
    Route::post('/store-category', 'category_store')->name('store_category');
    Route::get('/list-category', 'category_list')->name('list_category');
    Route::get('/get-category', 'category_get')->name('get_category');
    Route::get('/edit-category/{code}', 'category_edit')->name('edit_category');
    Route::post('/update-category', 'category_update')->name('update_category');
    Route::delete('/delete-category/{code}', 'category_delete')->name('delete_category');
});

Route::controller(product_controller::class)->group(function () {
    Route::get('/add-product', 'product_add')->name('add_product');
    Route::post('/store-product', 'product_store')->name('store_product');
    Route::get('/list-product', 'product_list')->name('list_product');
    Route::get('/get-product', 'product_get')->name('get_product');
    Route::get('/edit-product/{code}', 'product_edit')->name('edit_product');
    Route::post('/update-product', 'product_update')->name('update_product');
    Route::delete('/delete-product/{code}', 'product_delete')->name('delete_product');
});

Route::controller(invoice_controller::class)->group(function () {
    Route::get('/add-invoice', 'invoice_add')->name('add_invoice');
    Route::get('/invoice-product/{code}', 'invoice_product')->name('invoice_product');
    Route::post('/store-invoice', 'invoice_store')->name('store_invoice');
    Route::get('/list-invoice', 'invoice_list')->name('list_invoice');
    Route::get('/get-invoice', 'invoice_get')->name('get_invoice');
    // Route::get('/view-invoice/{code}', 'invoice_view')->name('view_invoice');
    // Route::get('/edit-invoice/{code}', 'invoice_edit')->name('edit_invoice');
    Route::get('/print-invoice/{code}', 'invoice_print')->name('print_invoice');
    // Route::post('/update-invoice', 'invoice_update')->name('update_invoice');
    // Route::delete('/delete-invoice/{code}', 'invoice_delete')->name('delete_invoice');
});

Route::controller(report_controller::class)->group(function () {
    Route::get('/daily-report', 'report_daily')->name('report_daily');
});