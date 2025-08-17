<?php

namespace App\Livewire\Product;

use App\Models\BankAccount;
use App\Models\Cart_item;
// use App\Models\CartItem;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\WithFileUploads; // <-- Import untuk upload file


#[Layout('layouts.app')]
class Checkout extends Component
{
    use WithFileUploads;

    #[Url]
    public ?string $product_slug = null;

    public array $items = [];
    public float $subtotal = 0;
    public float $total = 0;

    // Properti untuk form
    public string $customer_name = '';
    public string $customer_phone = '';
    public string $shipping_address = '';
    public string $delivery_method = 'pickup';
    public string $payment_method = '';
    public $proof_of_transaction;

    // Properti untuk mengontrol step
    public int $currentStep = 1;

    public function mount()
    {
        // ... (logika mount tetap sama) ...
        if ($this->product_slug) {
            $product = Product::where('slug', $this->product_slug)->firstOrFail();
            $this->items = [
                0 => [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_price' => $product->price,
                    'product_image' => $product->images->first()?->image,
                    'quantity' => 1,
                    'stock' => $product->stock,
                ]
            ];
        } else {
            $cartItems = Cart_item::with('product.images')->where('user_id', Auth::id())->get();
            foreach ($cartItems as $index => $item) {
                $this->items[$index] = [
                    'cart_item_id' => $item->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'product_price' => $item->product->price,
                    'product_image' => $item->product->images->first()?->image,
                    'quantity' => $item->quantity,
                    'stock' => $item->product->stock,
                ];
            }
        }
        if (empty($this->items)) { return $this->redirect(route('shop')); }
        $this->customer_name = Auth::user()->name;
        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->subtotal = collect($this->items)->sum(fn($item) => $item['product_price'] * $item['quantity']);
        $this->total = $this->subtotal;
    }

    // Fungsi untuk pindah ke step selanjutnya
    public function goToNextStep()
    {
        // Validasi data di step saat ini sebelum lanjut
        if ($this->currentStep == 1) {
            $this->validate([
                'customer_name' => 'required|string|max:255',
                'customer_phone' => 'required|string|max:20',
                'shipping_address' => 'required|string',
            ]);
        } elseif ($this->currentStep == 2) {
            $this->validate([
                'delivery_method' => 'required|in:pickup,delivery',
                'payment_method' => 'required|string',
                'proof_of_transaction' => 'nullable|image|max:2048',
            ]);
        }

        if ($this->currentStep < 3) {
            $this->currentStep++;
        }
    }

    // Fungsi untuk kembali ke step sebelumnya
    public function goToPreviousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function placeOrder()
    {
        // Validasi data
        $this->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'delivery_method' => 'required|in:pickup,delivery',
            'payment_method' => 'required|string',
            'proof_of_transaction' => 'nullable|image|max:2048',
        ]);

        $proofPath = null;
        if ($this->proof_of_transaction) {
            $proofPath = $this->proof_of_transaction->store('proofs', 'public');
        }
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'INV-' . time() . '-' . Auth::id(),
            'total_amount' => $this->total,
            'order_status' => 'pending',
            'payment_status' => 'unpaid',
            'payment_method' => $this->payment_method,
            'shipping_address' => $this->shipping_address,
            'delivery_method' => $this->delivery_method,
            'proof_of_transaction' => $proofPath,
        ]);
        foreach ($this->items as $item) {
            Order_item::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['product_price'],
            ]);
            Product::find($item['product_id'])->decrement('stock', $item['quantity']);
        }
        if (!$this->product_slug) { Cart_item::where('user_id', Auth::id())->delete(); }
        $this->dispatch('cart-updated');
        session()->flash('message', 'Pesanan Anda berhasil dibuat!');
        return $this->redirect(route('history'));
        
    }


    public function incrementQuantity(int $itemIndex)
    {
        if (isset($this->items[$itemIndex]) && $this->items[$itemIndex]['quantity'] < $this->items[$itemIndex]['stock']) {
            $this->items[$itemIndex]['quantity']++;
            $this->calculateTotals();
        }
    }

    // Fungsi untuk mengurangi jumlah di halaman checkout
    public function decrementQuantity(int $itemIndex)
    {
        if (isset($this->items[$itemIndex]) && $this->items[$itemIndex]['quantity'] > 1) {
            $this->items[$itemIndex]['quantity']--;
            $this->calculateTotals();
        }
    }

    public function render()
    {
        $bankAccounts = BankAccount::all();
        return view('livewire.product.checkout', [
            'bankAccounts' => $bankAccounts
        ]);
    }
}
