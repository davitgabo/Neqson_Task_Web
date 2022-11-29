<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
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

Route::get('/', [PageController::class, 'index']);
Route::get('/category/{id1}/{id2}/{id3}', [PageController::class, 'products']);
Route::get('/category/{id1}/{id2}', [PageController::class, 'lastLayer']);
Route::get('/category/{id}', [PageController::class, 'show']);
Route::get('/admin', [UserController::class, 'index'])->middleware('guest')->name('login');
Route::get('/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/store', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/admin/product', [ProductController::class, 'index'])->middleware('auth')->name('product');
Route::post('/add/product', [ProductController::class, 'store'])->middleware('auth');
Route::delete('/delete/product', [ProductController::class, 'delete'])->middleware('auth');
Route::get('/admin/{category}', [CategoryController::class, 'index'])->middleware('auth')->name('category');
Route::post('/add/{category}', [CategoryController::class, 'store'])->middleware('auth');
Route::put('/edit/{category}', [CategoryController::class, 'edit'])->middleware('auth');
Route::delete('/delete/{category}', [CategoryController::class, 'delete'])->middleware('auth');
