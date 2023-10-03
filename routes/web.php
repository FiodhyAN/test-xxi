<?php

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
    return view('login');
});

Route::get('/product', [ProductController::class, 'index']);
Route::get('/getProduct', [ProductController::class, 'getProduct'])->name('getProduct');
Route::get('/getProductById', [ProductController::class, 'getProductById'])->name('getProductById');
Route::post('/addProduct', [ProductController::class, 'addProduct'])->name('addProduct');
Route::delete('/deleteProduct', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
Route::put('/updateProduct', [ProductController::class, 'updateProduct'])->name('updateProduct');

Route::get('/menu', [MenuController::class, 'index']);
