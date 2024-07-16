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
    public $id, $name, $email;

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

    public function edit($id){
        $this->isHome = false;
        $this->isCreate = false;
        $this->isEdit = true;
        $this->isShow = false;
        $user = User::find($id);
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function show($id){
        $this->isHome = false;
        $this->isCreate = false;
        $this->isEdit = false;
        $this->isShow = true;
        $user = User::find($id);
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function back(){
        $this->isHome = true;
        $this->isCreate = false;
        $this->isEdit = false;
        $this->isShow = false;

        $this->reset('id', 'name', 'email');
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

        session()->flash('success', 'User created successfully.');
        $this->reset('name', 'email');
        $this->back();
    }

    public function setUpdate($id){
        $this->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user = User::find($id);
        $user->update([
            'name' => $this->name,
            'email' => $this->email
        ]);

        session()->flash('success', 'User updated successfully.');
        $this->reset('name', 'email');
        $this->back();
    }

    public function destroy($id){
        User::find($id)->delete();
        session()->flash('success', 'User deleted successfully.');
        $this->back();
    }
}
