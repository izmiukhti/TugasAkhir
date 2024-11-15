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
    public $isUpdate = false;
    public $id, $name, $description;
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

    public function update($id){
        $this->isHome = false;
        $this->isUpdate = true;

        $category = Category::find($id);
        $this->id = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;
    }

    public function home(){
        $this->isHome = true;
        $this->isCreate = false;
        $this->isUpdate = false;

        $this->reset('name', 'description');
    }

    public function save(){
        $this->validate([
            'name' => 'required|unique:categories',
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

    public function setUpdate($id){
        $this->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        Category::find($id)->update([
            'name' => $this->name,
            'description' => $this->description
        ]);

        session()->flash('success', 'Category updated successfully.');
        $this->reset('name', 'description');
        $this->home();
    }

    public function destroy($id)
    {
        $division = Category::find($id);
        
        if ($division) {
            if ($division->opportunities()->count() > 0) { 
                session()->flash('error', 'Category cannot be deleted ');
            } else {
                $division->delete();
                session()->flash('success', 'Category deleted successfully.');
            }
        } else {
            session()->flash('error', 'Category not found.');
        }
    }
}
