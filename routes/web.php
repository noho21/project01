<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\CustomAuthenticatedSessionController;



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

Route::get('/home', function () {
    return view('home'); 
}) -> middleware(['auth']) -> name('home');

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [CustomAuthenticatedSessionController::class, 'store'])
    ->name('login');

Route::get('/login', [CustomAuthenticatedSessionController::class, 'create'])
    ->name('login.form');

Route::get('/dashboard', function () {
    return view('/product');
}) -> middleware(['auth', 'verified']) -> name('dashboard');

Route::middleware('auth') -> group(function () {
    Route::get('/profile', [ProfileController::class, 'edit']) -> name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update']) -> name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy']) -> name('profile.destroy');
});

require __DIR__.'/auth.php';



Auth::routes();

Route::get('/product', [App\Http\Controllers\ProductController::class, 'index']) -> name('product.index');

/* 新規作成ページ */
Route::get('/product/new', [App\Http\Controllers\ProductController::class, 'new']) -> name('product.new');

/* 新規追加処理 */
Route::post('/product/create', [App\Http\Controllers\ProductController::class, 'create']) -> name('product.create');

/* 詳細ページ */
Route::get('/product/show/{id}', [App\Http\Controllers\ProductController::class, 'show']) -> name('product.show');

/* 編集ページ */
Route::get('/product/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit']) -> name('product.edit');

/* 編集処理 */
Route::post('/product/update', [App\Http\Controllers\ProductController::class, 'update']) -> name('product.update');

/* 削除処理 */
Route::post('/product/delete', [App\Http\Controllers\ProductController::class, 'delete']) -> name('product.delete');

/* ファイル処理 */
Route::get('/product/getfile/{id}', [ProductController::class, 'getfile']) -> name('product.filename');
