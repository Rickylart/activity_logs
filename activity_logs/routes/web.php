<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::middleware(['auth','checkStatus'])->group(function(){
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    // Route::get('/add-product', function () {
    //     return view('add-product');
    // })->name('add-product');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class,'index'])->name('dashboard');
    Route::get('/users', [App\Http\Controllers\HomeController::class,'user'])->name('user');

    //************Users Route */
    Route::get('/users/{id?}', [App\Http\Controllers\HomeController::class,'status'])->name('status');
    //************Users Route */

    //***************Products Route */
    Route::get('/add-product', [App\Http\Controllers\ProductsController::class,'index'])->name('add-product');
    Route::post('/store-product', [App\Http\Controllers\ProductsController::class,'add_product'])->name('store');
    Route::get('/show-product/{id?}', [App\Http\Controllers\ProductsController::class,'edit_product'])->name('edit');
    Route::patch('/update-product/{id?}', [App\Http\Controllers\ProductsController::class,'update_product'])->name('update');
    Route::delete('/destroy-product/{id?}', [App\Http\Controllers\ProductsController::class,'destroy_product'])->name('destroy');
    Route::patch('/product_status/{id?}', [App\Http\Controllers\ProductsController::class,'product_status'])->name('product_status');
    Route::get('/product_comment/{id?}', [App\Http\Controllers\ProductsController::class,'give_product_comment'])->name('give_product_comment');
     //***************Products Route */
});

require __DIR__.'/auth.php';
