<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
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
    return redirect('/menu');
});
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin', [ProductController::class, 'index'])->middleware('admin');
Route::get('/getProduct', [ProductController::class, 'getProduct'])->middleware('admin');
Route::get('/getProductById', [ProductController::class, 'getProductById']);
Route::post('/addProduct', [ProductController::class, 'addProduct'])->middleware('admin');
Route::delete('/deleteProduct', [ProductController::class, 'deleteProduct'])->middleware('admin');
Route::put('/updateProduct', [ProductController::class, 'updateProduct'])->middleware('admin');

Route::get('/menu', [MenuController::class, 'index']);
Route::post('/addToCart', [MenuController::class, 'addToCart']);
Route::get('/getCart', [MenuController::class, 'getCart']);
Route::post('/deleteCart', [MenuController::class, 'deleteCart']);
