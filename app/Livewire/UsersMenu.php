<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UsersMenu extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';

    public $isHome = true;
    public $isCreate = false;
    public $isEdit = false;
    public $isShow = false;
    public $search = '';
    public $id, $name, $email, $password,$phone_number;

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

    public function setUpdate($id) {
        // Validasi input
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id, // Unique email validation kecuali ID saat ini
            'password' => ['nullable', password::min(8)], // Password opsional, minimal 8 karakter jika diisi
            'phone_number' => 'required|string|max:15',
        ]);

        $user = User::find($id);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'phone_number' => $this->phone_number

        ]);

        session()->flash('success', 'User updated successfully.');
        $this->reset('name', 'email','password','phone_number');
        $this->back();
    }

    public function destroy($id){
        User::find($id)->delete();
        session()->flash('success', 'User deleted successfully.');
        $this->back();
    }
}
