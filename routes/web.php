<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//トップページ
Route::get('/', [ShopController::class, 'index'])->name('home');
Route::get('/detail/{shop_id}', [ShopController::class, 'detail'])->name('detail');
Route::get('/search', [ShopController::class, 'search'])->name('search');

//認証済みユーザのみアクセス可能
Route::middleware(['verified'])->group(function () {

    //お気に入り
    Route::post('/favorite', [FavoriteController::class, 'favorite'])->name('favorite');
    Route::delete('/favorite', [FavoriteController::class, 'removeFavorite'])->name('removeFavorite');

    //予約
    Route::resource('reservations', ReservationController::class)->except(['index', 'create', 'show']);

    //thanksページ
    Route::get('/thanks', function () {
        return view('thanks');
    })->name('thanks');

    //決済
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');
    Route::post('/stripe-webhook', [PaymentController::class, 'handleWebhook'])->name('stripe.webhook');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');


    //レビュー
    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');

    //マイページ
    Route::get('/mypage', [ProfileController::class, 'index'])->name('profile.index');
});

//店舗代表者用
Route::middleware('can:manager')->prefix('managers')->group(function () {
    Route::get('create', [ManagerController::class, 'create'])->name('managers.create');
    Route::post('store', [ManagerController::class, 'store'])->name('managers.store');
    Route::get('edit/{id}', [ManagerController::class, 'edit'])->name('managers.edit');
    Route::patch('update/{id}', [ManagerController::class, 'update'])->name('managers.update');
    Route::get('dashboard', [ManagerController::class, 'dashboard'])->name('managers.dashboard');
    Route::get('index', [ManagerController::class, 'index'])->name('managers.index');
});

//管理者用
Route::middleware('can:admin')->group(function () {
    Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/create', [AdminController::class, 'createManager'])->name('admin.create');
    Route::post('/admin/store', [AdminController::class, 'storeManager'])->name('admin.store');
    Route::get('/admin/notification/create', [AdminController::class, 'createNotification'])->name('admin.notification.create');
    Route::post('/admin/notification/send', [AdminController::class, 'sendNotification'])->name('admin.notification.send');
});



require __DIR__ . '/auth.php';
