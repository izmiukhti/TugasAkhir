<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoryMenu extends Component
{
    public $isHome = true;
    public $isCreate = false;
    public $name, $description;

    public function render()
    {
        return view('livewire.category-menu', [
            'categories' => Category::all()
        ]);
    }

    public function create(){
        $this->isHome = false;
        $this->isCreate = true;
    }

    public function home(){
        $this->isHome = true;
        $this->isCreate = false;
    }

    public function save(){
        $this->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        Category::create([
            'name' => $this->name,
            'description' => $this->description
        ]);

        session()->flash('success', 'Category created successfully.');
        $this->reset('name', 'description');
        $this->home();
    }
}
