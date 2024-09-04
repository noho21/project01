<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;


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

/*Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('/product',[App\Http\Controllers\ProductController::class,'index']) -> name('product.index');

/* 新規作成ページ */
Route::get('/product/new',[App\Http\Controllers\ProductController::class,'new']) -> name('product.new');

/* 新規追加処理 */
Route::post('/product/create',[App\Http\Controllers\ProductController::class,'create']) -> name('product.create');

