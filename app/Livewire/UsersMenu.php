<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Hash;

class UsersMenu extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';

    public $isHome = true;
    public $isCreate = false;
    public $isEdit = false;
    public $isShow = false;
    public $search = '';
    public $name, $email;

    public function render()
    {
        return view('livewire.users-menu', ['users' => User::where('name', 'like', '%'.$this->search.'%')->paginate(5)]);
    }

    public function newuser(){
        $this->isHome = false;
        $this->isCreate = true;
        $this->isEdit = false;
        $this->isShow = false;
    }

    public function back(){
        $this->isHome = true;
        $this->isCreate = false;
        $this->isEdit = false;
        $this->isShow = false;
    }

    public function save(){
        $this->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make('password')
        ]);

        $this->back();
    }
}
