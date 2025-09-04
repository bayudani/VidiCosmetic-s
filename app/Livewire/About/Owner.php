<?php

namespace App\Livewire\About;

use App\Models\OwnerProfile;
use Livewire\Component;

class Owner extends Component
{

    // ambil data user dengan role owner
    public $owner;
    public function mount()
    {
        $this->owner = OwnerProfile::first();
    }
    public function render()
    {
        return view('livewire.about.owner');
    }
}
