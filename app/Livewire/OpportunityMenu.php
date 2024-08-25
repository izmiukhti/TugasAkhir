<?php

namespace App\Livewire;

use Livewire\Component;

class OpportunityMenu extends Component
{
    public $isHome = true;
    
    public function render()
    {
        return view('livewire.opportunity-menu');
    }
}
