<?php

namespace App\Livewire;

use App\Models\Opportunity;
use App\Models\Opportunity;
use Livewire\Component;

class CountActiveOpportunity extends Component
{
    public function render()
    {
        // Menggunakan query scope untuk menghitung kesempatan yang masih aktif
        $activeOpportunityCount = Opportunity::active()->count();
        
        return view('livewire.count-active-opportunity', [
            'opportunities' => $activeOpportunityCount
        ]);
            'opportunities' => $activeOpportunityCount
        ]);
    }
}
