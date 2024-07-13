<?php

namespace App\Livewire;

use Livewire\Component;

class CountActiveOpportunity extends Component
{
    public function render()
    {
        return view('livewire.count-active-opportunity', [
            'opportunities' => rand(1, 99),]);
    }
}
