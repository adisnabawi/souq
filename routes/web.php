<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\ListingController;
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

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/post-ad', [AdsController::class, 'index'])->name('ads')->middleware(['auth']);
Route::post('/post-ad/subcategory', [AdsController::class, 'subcategory'])->name('subcategory');
Route::post('/post-ad/submit', [AdsController::class, 'create'])->name('ads.submit')->middleware(['auth']);
Route::get('/post-ad/add-image/{id}', [AdsController::class, 'image'])->name('ads.image')->middleware(['auth']);
Route::post('/post-ad/add-image/{id}/submit', [AdsController::class, 'upload'])->name('ads.submit.image')->middleware(['auth']);
Route::get('/post-ad/delete-image/{id}', [AdsController::class, 'deleteimage'])->name('ads.image.delete')->middleware(['auth']);

Route::get('/dashboard', [IndexController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
Route::get('/ads/{id}', [ListingController::class, 'product'])->name('product');

Route::get('/edit-ad/{id}', [AdsController::class, 'edit'])->name('ads.edit')->middleware(['auth']);
Route::post('/edit-ad/submit/{id}', [AdsController::class, 'update'])->name('ads.edit.submit')->middleware(['auth']);

Route::get('/list', [ListingController::class, 'index'])->name('listing');

Route::post('/like', [AdsController::class, 'likes'])->name('likes')->middleware(['auth']);
Route::post('/unlike', [AdsController::class, 'unlikes'])->name('unlikes')->middleware(['auth']);
Route::get('/mylike', [ListingController::class, 'mylikes'])->name('like.list')->middleware(['auth']);

require __DIR__.'/auth.php';
