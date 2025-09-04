<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Auth\VerifyOtp;
use App\Livewire\Consultation\BookingConsultation as ConsultationBookingConsultation;
use App\Livewire\Product\Checkout;
use App\Livewire\Product\ProductDetail as ProductProductDetail;
use App\Livewire\Profile\HistoryTransaction;
use App\Livewire\Profile\OrderDetail;



Route::view('/', 'home')->name('home');
Route::view('/shop', 'shop')->name('shop');
Route::get('/product/{slug}', ProductProductDetail::class)->name('product.detail');
Route::view('cart', 'cart')->name('cart');
Route::get('/consultation', ConsultationBookingConsultation::class)->name('consultation');
Route::get('/tentang-kami', function () {
    return view('about');
})->name('about');

Route::get('/verfiy-otp', VerifyOtp::class)->name('verfiy-otp');


Route::middleware('auth')->group(function () {
    
    Route::get('/checkout', Checkout::class)->name('checkout');
    
    Route::get('/ativity', HistoryTransaction::class)->name('history'); 
    
    Route::get('/my-orders/{order_number}', OrderDetail::class)->name('order.detail');
    
    Route::view('dashboard', 'dashboard')
    ->middleware(['verified'])
    ->name('dashboard');
    
    Route::view('profile', 'profile')
    ->name('profile');
});

require __DIR__.'/auth.php';