<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\ImageController;

use App\Http\Controllers\PageController;

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

Route::controller(AuthController::class)->group(function()
{
    Route::get('/admin','index')->middleware('guest')->name('login');
    Route::get('/register','create')->middleware('guest');
    Route::post('/store','register');
    Route::post('/login','login');
    Route::post('/logout','logout');
});

Route::controller(PageController::class)->group(function()
{
    Route::get('/','index');
    Route::get('/category/{id1}/{id2}/{id3}','products');
    Route::get('/category/{id1}/{id2}','lastLayer');
    Route::get('/category/{id}','show');
    Route::get('/product/{id}','gallery');
});

Route::middleware('auth')->group(function()
{
    Route::controller(ProductController::class)->group(function()
    {
        Route::get('/admin/product','index')->name('product');
        Route::put('/edit/product/path','editPath');
        Route::post('/add/product','store');
        Route::delete('/delete/product/{id}','delete');
    });

    Route::controller(ImageController::class)->group(function()
    {
        Route::get('/admin/gallery/{id}','show')->name('images');
        Route::post('/add/image','store');
        Route::delete('/delete/image/{id}','delete');
        Route::put('/change/image','change');
    });

    Route::controller(CategoryController::class)->group(function()
    {
        Route::get('/admin/{category}','index')->name('category');
        Route::post('/add/{category}','store');
        Route::put('/edit/{category}','edit');
        Route::delete('/delete/{category}/{id}','delete');
    });
});
