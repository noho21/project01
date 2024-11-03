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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home'); 
})->middleware(['auth'])->name('home');

Route::post('/login', [CustomAuthenticatedSessionController::class, 'store'])
    ->name('login');

Route::get('/login', [CustomAuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
}) -> middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
});

require __DIR__.'/auth.php';

Route::get('/products', [ProductController::class, 'index'])->name('product.index');

/* 新規作成ページ */
Route::get('/product/new', [ProductController::class, 'new'])->name('product.new');

/* 新規追加処理 */
Route::post('/product/store', [ProductController::class, 'create'])->name('product.store');

/* メーカー情報登録画面と登録処理 */
Route::get('/company/create', [ProductController::class, 'showCompanyForm'])->name('company.create');
Route::post('/company', [ProductController::class, 'storeCompany'])->name('company.store');

/* 詳細ページ */
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

/* 編集ページ */
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');

/* 編集処理 */
Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');

/* 削除処理 */
Route::post('/product/delete', [ProductController::class, 'delete'])->name('product.delete');

/* ファイル処理 */
Route::get('/product/getfile/{id}', [ProductController::class, 'getfile'])->name('product.getfile');
