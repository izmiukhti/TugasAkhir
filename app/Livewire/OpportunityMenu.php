<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Opportunity;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class OpportunityMenu extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $isHome = true;
    public $search = '';
    public $isDetail = false;
    public $isCreate = false;
    public $name, $description, $job_description, $job_requirement, $quotas, $location, $schema, $open_date, $close_date, $opportunity;

    public function render()
    {
        return view('livewire.opportunity-menu', ['opportunities' => Opportunity::where('name', 'like', '%'.$this->search.'%')->paginate(6)]);
    }

    public function home(){
        $this->isHome = true;
        $this->isDetail = false;
        $this->isCreate = false;

        $this->reset('name', 'description', 'job_description', 'job_requirement', 'quotas', 'location', 'schema', 'open_date', 'close_date', 'opportunity');
    }

    public function detail($id){
        $opportunity = Opportunity::find($id);

        $this->opportunity = $opportunity;

        $this->isHome = false;
        $this->isDetail = true;
        $this->isCreate = false;
    }

    public function create(){
        $this->isHome = false;
        $this->isCreate = true;
        $this->isDetail = false;
    }

    public function store(){
        // dd($this->name, $this->description, $this->job_description, $this->job_requirement, $this->quotas, $this->location, $this->schema, $this->open_date, $this->close_date);
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'job_description' => 'required',
            'job_requirement' => 'required',
            'quotas' => 'required',
            'location' => 'required',
            'schema' => 'required',
            'open_date' => 'required',
            'close_date' => 'required',
        ]);

        $opportunity = Opportunity::create([
            'name' => $this->name,
            'description' => $this->description,
            'job_description' => $this->job_description,
            'job_requirements' => $this->job_requirement,
            'quota' => $this->quotas,
            'location' => $this->location,
            'schema' => $this->schema,
            'start_date' => $this->open_date,
            'end_date' => $this->close_date,
        ]);

        session()->flash('success', 'Opportunity created successfully.');
        $this->home();
    }
}
