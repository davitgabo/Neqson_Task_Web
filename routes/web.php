<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', [UserController::class, 'index'])->middleware('guest')->name('login');
Route::get('/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/store', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/category', [CategoryController::class, 'index'])->middleware('auth')->name('category');
Route::get('/subcategory', [SubcategoryController::class, 'index'])->middleware('auth')->name('subcategory');
Route::get('/subsubcategory', [SubsubcategoryController::class, 'index'])->middleware('auth')->name('subsubcategory');
Route::get('/product', [ProductController::class, 'index'])->middleware('auth')->name('product');
Route::post('/add/category', [CategoryController::class, 'store'])->middleware('auth');
Route::post('/add/subcategory', [SubcategoryController::class, 'store'])->middleware('auth');
Route::post('/add/subsubcategory', [SubsubCategoryController::class, 'store'])->middleware('auth');
Route::post('/add/product', [ProductController::class, 'store'])->middleware('auth');
