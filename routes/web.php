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
use App\Http\Controllers\CsvImportController;



Route::get('/shops/{shop}/review/create', [ReviewController::class, 'create'])->name('review.create');

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

    //口コミ

    Route::post('/shops/{shop}/review', [ReviewController::class, 'store'])->name('review.store');
    Route::get('/review/{review}/edit', [ReviewController::class, 'edit'])->name('review.edit');
    Route::patch('/review/{review}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/review/{review}', [ReviewController::class, 'destroy'])->name('review.destroy');

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
    Route::get('/admin/create-shop', [AdminController::class, 'createShop'])->name('admin.createShop');
    Route::post('/csv/import', [CsvImportController::class, 'upload'])->name('csv.import');
});



require __DIR__ . '/auth.php';
