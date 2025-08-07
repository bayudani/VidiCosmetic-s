<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

Route::view('/shop','shop')
    ->name('shop');

// product detail page
Route::view('/product-detail','product-detail')->name('detail');
Route::view('cart', 'cart')
    ->name('cart');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
