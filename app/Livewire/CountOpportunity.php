<?php

namespace App\Livewire;

use App\Models\Opportunity;
use Livewire\Component;

class CountOpportunity extends Component
{
    public function render()
    {
        // Hitung total opportunity dari database
        $opportunityCount = Opportunity::count();

        return view('livewire.count-opportunity', [
            'opportunities' => $opportunityCount,
        ]);
    }
}
