<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Division;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class DivisiMenu extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $isHome = true;
    public $search = '';

    public function render()
    {
        return view('livewire.divisi-menu', ['divisions' => Division::where('name', 'like', '%'.$this->search.'%')->paginate(5)]);
    }
}
