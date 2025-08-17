<?php

namespace App\Livewire\Consultation;

use App\Models\OwnerProfile;
use Livewire\Component;

class Consultation extends Component
{
    public ?OwnerProfile $profile;

    public function mount()
    {
        // Ambil data profil owner yang pertama dari database
        $this->profile = OwnerProfile::first();
    }
    public function render()
    {
        return view('livewire.consultation.consultation');
    }
}
