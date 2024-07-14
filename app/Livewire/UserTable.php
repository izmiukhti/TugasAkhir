<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserTable extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.user-table', [
            'users' => User::where('name', 'like', '%'.$this->search.'%')->paginate(10),
        ]);
    }
}
