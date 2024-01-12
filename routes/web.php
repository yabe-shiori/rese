<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/mypage', [ProfileController::class, 'index'])->name('profile.index');
});

Route::get('/', [ShopController::class, 'index'])->name('home');
Route::get('/detail/{shop_id}', [ShopController::class, 'detail'])->name('detail');
Route::get('/search', [ShopController::class, 'search'])->name('search');

//お気に入り
Route::post('/favorite', [FavoriteController::class, 'favorite'])->name('favorite');
Route::delete('/favorite', [FavoriteController::class, 'removeFavorite'])->name('removeFavorite');

//予約
Route::resource('reservations', ReservationController::class);

//レビュー
Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');

require __DIR__.'/auth.php';
