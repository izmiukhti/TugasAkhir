<?php

namespace App\Livewire;

use App\Models\Schema;
use Livewire\Component;
use App\Models\Category;
use App\Models\Division;
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
    public $isInformation = false;
    public $isUpdate = false;
    // input form
    public $name;
    public $description;
    public $job_description;
    public $job_requirement;
    public $division;
    public $category;
    public $schema;
    public $quotas;
    public $location;
    public $open_date;
    public $close_date;
    //  end of form
    // update form
    public $update_name;
    public $update_description;
    public $update_job_description;
    public $update_job_requirement;
    // end of update form
    public $opportunity;
    public $schemas;
    public $categories;
    public $divisions;

    public function render(){
        return view('livewire.opportunity-menu', ['opportunities' => Opportunity::where('name', 'like', '%'.$this->search.'%')->orderBy('created_at','DESC')->paginate(6)]);
    }

    public function home(){
        $this->isHome = true;
        $this->isDetail = false;
        $this->isCreate = false;
        $this->isInformation = false;
        $this->isUpdate = false;

        $this->reset('name', 'description', 'job_description', 'job_requirement', 'quotas', 'location', 'schema', 'open_date', 'close_date', 'opportunity');
    }

    public function detail($id){
        $opportunity = Opportunity::find($id);
        $this->opportunity = $opportunity;
        $this->isHome = false;
        $this->isDetail = true;
        $this->isCreate = false;
        $this->isInformation = false;
        $this->isUpdate = false;
    }

    public function create(){
        $this->isHome = false;
        $this->isCreate = true;
        $this->isDetail = false;
        $this->isInformation = false;
        $this->isUpdate = false;

        $this->schemas = Schema::all();
        $this->categories = Category::all();
        $this->divisions = Division::all();
    }

    public function store(){
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'job_description' => 'required',
            'job_requirement' => 'required',
            'quotas' => 'required',
            'location' => 'required',
            'division' => 'required',
            'category' => 'required',
            'schema' => 'required',
            'open_date' => 'required',
            'close_date' => 'required|after:open_date',
        ]);

        $opportunity = Opportunity::create([
            'name' => $this->name,
            'description' => $this->description,
            'job_description' => $this->job_description,
            'job_requirements' => $this->job_requirement,
            'quota' => $this->quotas,
            'location' => $this->location,
            'division_id' => $this->division,
            'category_id' => $this->category,
            'schema_id' => $this->schema,
            'start_date' => $this->open_date,
            'end_date' => $this->close_date,
        ]);

        session()->flash('success', 'Opportunity created successfully.');
        $this->home();
    }

    public function information($id){
        $opportunity = Opportunity::find($id);

        $this->opportunity = $opportunity;

        $this->isHome = false;
        $this->isDetail = false;
        $this->isCreate = false;
        $this->isInformation = true;
        $this->isUpdate = false;
    }

    public function update($id){
        $opportunity = Opportunity::find($id);

        // $this->opportunity = $opportunity;

        $this->update_name = $opportunity->name;
        $this->update_description = $opportunity->description;
        $this->update_job_description = $opportunity->job_description;
        $this->update_job_requirement = $opportunity->job_requirements;

        $this->isHome = false;
        $this->isDetail = false;
        $this->isCreate = false;
        $this->isInformation = false;
        $this->isUpdate = true;
    }
    
    public function delete($id){
        $opportunity = Opportunity::find($id);
        $opportunity->delete();

        session()->flash('success', 'Opportunity deleted successfully.');
        $this->home();
    }
}
