<?php

namespace App\Livewire;

use App\Models\Opportunity;
use Livewire\Component;

class CountDeactiveOpportunity extends Component
{
    public function render()
    {
        // Menghitung opportunity yang tidak aktif (berdasarkan end_date)
        $deactiveOpportunity = Opportunity::where('end_date', '<', now())->count();
        
        return view('livewire.count-deactive-opportunity', [
            'opportunities' => $deactiveOpportunity
        ]);
    }
}
