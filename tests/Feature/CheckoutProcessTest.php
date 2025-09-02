<?php

namespace Tests\Feature;

use App\Livewire\Product\Checkout;
use App\Models\Cart_item; // <-- Import Cart_item
use App\Models\Product;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CheckoutProcessTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function new_order_notification_is_sent_to_owner_and_staff(): void
    {
        // 1. Arrange (Persiapan)
        // ========================
        $roleOwner = Role::create(['name' => 'owner']);
        $rolePegawai = Role::create(['name' => 'pegawai']);
        $roleCustomer = Role::create(['name' => 'customer']);

        $owner = User::factory()->create()->assignRole($roleOwner);
        $pegawai = User::factory()->create()->assignRole($rolePegawai);
        $customer = User::factory()->create()->assignRole($roleCustomer);

        $product = Product::factory()->create(['stock' => 10]);

        // BUAT DATA CART ITEM UNTUK CUSTOMER
        Cart_item::factory()->create([
            'user_id' => $customer->id,
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        Notification::fake();

        // 2. Act (Aksi)
        // ========================
        // Sekarang mount() akan berjalan lancar karena ada item di keranjang
        Livewire::actingAs($customer)
            ->test(Checkout::class)
            // ->set('items', ...) -> Baris ini tidak perlu lagi, karena mount() sudah mengisinya
            ->set('customer_phone', '08123456789')
            ->set('shipping_address', 'Alamat tes')
            ->set('payment_method', 'transfer')
            ->call('placeOrder');

        // 3. Assert (Pengecekan)
        // ========================
        $this->assertDatabaseHas('orders', [
            'user_id' => $customer->id,
        ]);

        Notification::assertSentTo(
            [$owner], NewOrderNotification::class
        );

        Notification::assertSentTo(
            [$pegawai], NewOrderNotification::class
        );

        Notification::assertNotSentTo(
            [$customer], NewOrderNotification::class
        );
    }
}