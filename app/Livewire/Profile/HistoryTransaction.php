<?php

namespace App\Livewire\Profile;

use App\Models\Consultation;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class HistoryTransaction extends Component
{
    use WithPagination;

    public string $activeTab = 'orders'; // Tab aktif, defaultnya 'orders'

    public function setActiveTab(string $tab)
    {
        $this->activeTab = $tab;
        $this->resetPage(); // Reset pagination saat ganti tab
    }
    public function render()
    {
        $data = [];

        if ($this->activeTab === 'orders') {
            $data['items'] = Order::where('user_id', Auth::id())
                ->latest()
                ->paginate(5, ['*'], 'ordersPage');
        } elseif ($this->activeTab === 'consultations') {
            $data['items'] = Consultation::where('user_id', Auth::id())
                ->latest('scheduled_at')
                ->paginate(5, ['*'], 'consultationsPage');
        }

        return view('livewire.profile.history-transaction', [
            'data' => $data['items']
        ]);
    }
}
