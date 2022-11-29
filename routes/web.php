<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\SubsubcategoryController;
use App\Http\Controllers\UserController;
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

Route::get('/', [AuthController::class, 'index'])->middleware('guest')->name('login');
Route::get('/register', [AuthController::class, 'create'])->middleware('guest');
Route::post('/store', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/admin/product', [ProductController::class, 'index'])->middleware('auth')->name('product');
Route::get('/admin/gallery', [ImageController::class, 'index'])->middleware('auth')->name('product');
Route::get('/admin/gallery/{id}', [ImageController::class, 'show'])->middleware('auth')->name('product');
Route::post('/add/product', [ProductController::class, 'store'])->middleware('auth');
Route::post('/add/image', [ImageController::class, 'store'])->middleware('auth');
Route::put('/edit/product/path', [ProductController::class, 'editPath'])->middleware('auth');
Route::get('/admin/{category}', [CategoryController::class, 'index'])->middleware('auth')->name('category');
Route::post('/add/{category}', [CategoryController::class, 'store'])->middleware('auth');
Route::put('/edit/{category}', [CategoryController::class, 'edit'])->middleware('auth');
Route::delete('/delete/{category}', [CategoryController::class, 'delete'])->middleware('auth');
