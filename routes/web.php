<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhoneController;

Route::get('/', [PhoneController::class, 'index'])->name('phones.index');
Route::get('/privacy', [PhoneController::class, 'privacy'])->name('phones.privacy');
Route::get('/create', [PhoneController::class, 'create'])->name('phones.create');
Route::get('/about', [PhoneController::class, 'about'])->name('phones.about');
Route::get('/card', [PhoneController::class, 'show'])->name('phones.show');
Route::get('/qr', [PhoneController::class, 'qrcode'])->name('phones.qrcode');