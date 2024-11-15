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
    public $isCreate = false;
    public $isUpdate = false;
    public $id;
    public $name;
    public $description;

    public function render()
    {
        return view('livewire.divisi-menu', ['divisions' => Division::where('name', 'like', '%'.$this->search.'%')->paginate(5)]);
    }

    public function create()
    {
        $this->isCreate = true;
        $this->isHome = false;
    }

    public function home()
    {
        $this->isCreate = false;
        $this->isUpdate = false;
        $this->isHome = true;

        $this->reset('id', 'name', 'description');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|unique:divisions',
            'description' => 'required',
        ]);

        Division::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Division created successfully.');
        $this->home();
    }

    public function delete($id)
    {
        $division = Division::find($id);
        
        if ($division) {
            if ($division->opportunities()->count() > 0) { 
                session()->flash('error', 'Division cannot be deleted because it is being used by one or more opportunities.');
            } else {
                $division->delete(); 
                session()->flash('success', 'Division deleted successfully.');
            }
        } else {
            session()->flash('error', 'Division not found.');
        }
    }
    


    public function update($id)
    {
        $division = Division::find($id);
        $this->id = $division->id;
        $this->name = $division->name;
        $this->description = $division->description;

        $this->isUpdate = true;
        $this->isHome = false;
    }

    public function saveUpdate($id)
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Division::find($id)->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Division updated successfully.');
        $this->home();
    }
}