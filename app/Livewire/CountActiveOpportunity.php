<?php

namespace App\Livewire;

use App\Models\Opportunity;
use Livewire\Component;

class CountActiveOpportunity extends Component
{
    public function render()
    {
        $activeOpportunityCount = Opportunity::active()->count();
        
        return view('livewire.count-active-opportunity', [
            'opportunities' => $activeOpportunityCount
        ]);
    }
}
