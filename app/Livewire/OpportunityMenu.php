<?php

namespace App\Livewire;

use Livewire\Component;

class OpportunityMenu extends Component
{
    public $isHome = true;
    public $isDetail = false;

    public function render()
    {
        return view('livewire.opportunity-menu');
    }

    public function home(){
        $this->isHome = true;
        $this->isDetail = false;
    }

    public function detail(){
        $this->isHome = false;
        $this->isDetail = true;
    }
}
