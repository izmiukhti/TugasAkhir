<?php

namespace App\Livewire;

use Livewire\Component;

class User extends Component
{
    public $isHome = true;
    public $isCreate = false;
    public $isEdit = false;
    public $isShow = false;

    public function render()
    {
        return view('livewire.user');
    }

    public function newuser(){
        $this->isHome = false;
        $this->isCreate = true;
        $this->isEdit = false;
        $this->isShow = false;
    }
}
