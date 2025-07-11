<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\HeaderController;
use App\Http\Controllers\Admin\PortofolioController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/feedback/store', [HomeController::class, 'sendFeedback'])->name('feedback.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update.avatar');

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/admin/dashboard', 'index')->name('admin.dashboard');
    });
    Route::controller(SettingController::class)->group(function () {
        Route::get('/admin/setting', 'index')->name('admin.setting');
        Route::post('/admin/setting/update', 'updateData')->name('admin.setting.update');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/admin/user', 'index')->name('admin.user');
        Route::post('/admin/user/add', 'addUser')->name('admin.user.add');
        Route::post('/admin/user/edit', 'editUser')->name('admin.user.edit');
        Route::post('/admin/user/delete', 'deleteUser')->name('admin.user.delete');
    });
    Route::controller(HeaderController::class)->group(function () {
        Route::get('/admin/header', 'index')->name('admin.header');
        Route::post('/admin/header/edit', 'editHeader')->name('admin.header.edit');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/admin/product', 'index')->name('admin.product');
        Route::post('/admin/product/add', 'addProduct')->name('admin.product.add');
        Route::post('/admin/product/edit', 'editProduct')->name('admin.product.edit');
        Route::post('/admin/product/delete', 'deleteProduct')->name('admin.product.delete');
        Route::post('/admin/product/status', 'statusProduct')->name('admin.product.status');
    });
    Route::controller(PortofolioController::class)->group(function () {
        Route::get('/admin/portofolio', 'index')->name('admin.portofolio');
        Route::post('/admin/portofolio/add', 'addPortofolio')->name('admin.portofolio.add');
        Route::post('/admin/portofolio/edit', 'editPortofolio')->name('admin.portofolio.edit');
        Route::post('/admin/portofolio/delete', 'deletePortofolio')->name('admin.portofolio.delete');
        Route::post('/admin/portofolio/status', 'statusPortofolio')->name('admin.portofolio.status');
    });
    Route::controller(AboutController::class)->group(function () {
        Route::get('/admin/about', 'index')->name('admin.about');
        Route::post('/admin/about/add', 'addAbout')->name('admin.about.add');
        Route::post('/admin/about/edit', 'editAbout')->name('admin.about.edit');
        Route::post('/admin/about/delete', 'deleteAbout')->name('admin.about.delete');
    });
    Route::controller(FeedbackController::class)->group(function () {
        Route::get('/admin/feedback', 'index')->name('admin.feedback');
        Route::post('/admin/feedback/toggle', [FeedbackController::class, 'toggle'])->name('admin.feedback.toggle');
    });
    Route::controller(ContactController::class)->group(function () {
        Route::get('/admin/contact', 'index')->name('admin.contact');
        Route::post('/admin/contact/edit', 'editContact')->name('admin.contact.edit');
    });
    Route::controller(SocialController::class)->group(function () {
        Route::get('/admin/social', 'index')->name('admin.social');
        Route::post('/admin/social/edit', 'editSocial')->name('admin.social.edit');
    });

    // Route::get('/user/home', function () {
    //     return view('home');
    // })->name('home');
});
require __DIR__ . '/auth.php';
