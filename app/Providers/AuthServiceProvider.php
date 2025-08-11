<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Category;
use App\Models\Order;
use App\Models\Order_item;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

// --- IMPORT MODEL DAN POLICY YANG DIBUTUHKAN ---
use App\Models\Product;
use App\Models\Product_image;
use App\Models\Store_galery;
use App\Policies\CategoryPolicy;
use App\Policies\GaleryPolicy;
use App\Policies\OrderItemPolicy;
use App\Policies\ProductImagePolicy;
use App\Policies\ProductPolicy;
// Tambahkan model dan policy lain di sini nanti, contoh:
// use App\Models\Category;
// use App\Policies\CategoryPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',

        Product::class => ProductPolicy::class,
        Category::class => CategoryPolicy::class,
        Order_item::class => OrderItemPolicy::class,
        Order::class => OrderItemPolicy::class,
        Store_galery::class => GaleryPolicy::class,
        Product_image::class => ProductImagePolicy::class,
        
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
