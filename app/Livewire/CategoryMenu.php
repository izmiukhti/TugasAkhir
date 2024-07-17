<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class CategoryMenu extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $isHome = true;
    public $isCreate = false;
    public $name, $description;
    public $search;

    public function render()
    {
        return view('livewire.category-menu', [
            'categories' => Category::where('name', 'like', '%'.$this->search.'%')->paginate(5)
        ]);
    }

    public function create(){
        $this->isHome = false;
        $this->isCreate = true;
    }

    public function home(){
        $this->isHome = true;
        $this->isCreate = false;

        $this->reset('name', 'description');
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
