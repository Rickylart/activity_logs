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

Route::middleware(['auth'])->group(function(){
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    // Route::get('/add-product', function () {
    //     return view('add-product');
    // })->name('add-product');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class,'index'])->name('dashboard');

    //***************Products Route */
    Route::get('/add-product', [App\Http\Controllers\ProductsController::class,'index'])->name('add-product');
    Route::post('/store-product', [App\Http\Controllers\ProductsController::class,'add_product'])->name('store');
    Route::get('/show-product/{id?}', [App\Http\Controllers\ProductsController::class,'edit_product'])->name('edit');
    Route::post('/update-product', [App\Http\Controllers\ProductsController::class,'update_product'])->name('update');
    Route::post('/destroy-product', [App\Http\Controllers\ProductsController::class,'destroy_product'])->name('destroy');
     //***************Products Route */
});

require __DIR__.'/auth.php';
