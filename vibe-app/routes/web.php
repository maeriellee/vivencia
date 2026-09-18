<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [HomeController::class, 'menu'])->name('menu');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/order', [HomeController::class, 'order'])->name('order');
Route::post('/payment', [HomeController::class, 'payment'])->name('payment');
Route::post('/payment/complete', [HomeController::class, 'completePayment'])->name('payment.complete');
Route::get('/customer/login', [HomeController::class, 'customerLogin'])->name('customer.login');
Route::post('/customer/login', [HomeController::class, 'customerAuthenticate'])->name('customer.authenticate');
Route::get('/customer/dashboard', [HomeController::class, 'customerDashboard'])->name('customer.dashboard');
Route::post('/customer/profile', [HomeController::class, 'customerProfileUpdate'])->name('customer.profile.update');
Route::post('/customer/logout', [HomeController::class, 'customerLogout'])->name('customer.logout');
Route::get('/collection', [HomeController::class, 'collection'])->name('collection');
Route::get('/admin/login', [HomeController::class, 'adminLogin'])->name('admin.login');
Route::post('/admin/login', [HomeController::class, 'adminAuthenticate'])->name('admin.authenticate');
Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
Route::post('/admin/logout', [HomeController::class, 'adminLogout'])->name('admin.logout');
Route::get('/{page}', [HomeController::class, 'construction'])
    ->whereIn('page', ['pre-order', 'gallery'])
    ->name('construction');
Route::post('/generate', [HomeController::class, 'generate'])->name('generate');
