<?php

namespace App\Livewire;

use Livewire\Component;

class CountOpportunity extends Component
{
    public function render()
    {
        return view('livewire.count-opportunity', [
            'opportunities' => 15]);
    }
}
