<?php

use Illuminate\Support\Facades\Route;

// Import semua komponen Livewire di sini biar rapi
use App\Livewire\Auth\VerifyOtp;
use App\Livewire\Consultation\BookingConsultation as ConsultationBookingConsultation;
// use App\Livewire\Product\BookingConsultation;
use App\Livewire\Product\Checkout;
// use App\Livewire\Product\DetailProduct as ProductDetail; // Menggunakan alias untuk menghindari konflik nama
use App\Livewire\Product\ProductDetail as ProductProductDetail;
use App\Livewire\Profile\HistoryTransaction;
use App\Livewire\Profile\OrderDetail;



// == HALAMAN PUBLIK (Bisa diakses siapa saja) ==
Route::view('/', 'home')->name('home');
Route::view('/shop', 'shop')->name('shop');
Route::get('/product/{slug}', ProductProductDetail::class)->name('product.detail');
Route::view('cart', 'cart')->name('cart');
Route::get('/consultation', ConsultationBookingConsultation::class)->name('consultation');


// == PROSES AUTENTIKASI ==
// Rute untuk verifikasi OTP (nama tetap 'verfiy-otp' sesuai permintaan)
Route::get('/verfiy-otp', VerifyOtp::class)->name('verfiy-otp');
// Ini manggil semua rute login, register, logout, dll dari Breeze.
require __DIR__.'/auth.php';


// == HALAMAN KHUSUS PENGGUNA (Wajib Login) ==
Route::middleware('auth')->group(function () {
    
    Route::get('/checkout', Checkout::class)->name('checkout');
    
    // Nama route tetap 'history' dengan URL '/ativity'
    Route::get('/ativity', HistoryTransaction::class)->name('history'); 
    
    // Nama route tetap 'order.detail'
    Route::get('/my-orders/{order_number}', OrderDetail::class)->name('order.detail');

    // Rute bawaan Breeze untuk Dashboard & Profil
    Route::view('dashboard', 'dashboard')
        ->middleware(['verified'])
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->name('profile');
});
