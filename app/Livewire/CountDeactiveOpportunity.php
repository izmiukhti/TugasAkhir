<?php

namespace App\Livewire;

use Livewire\Component;

class CountDeactiveOpportunity extends Component
{
    public function render()
    {
        return view('livewire.count-deactive-opportunity', [
            'opportunities' => rand(1, 99),]);
    }
}
