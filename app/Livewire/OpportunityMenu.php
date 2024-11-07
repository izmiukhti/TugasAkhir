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

    public $id;
    // end of update form
    public $opportunity;
    public $schemas;
    public $categories;
    public $divisions;

    public function render()
    {
        return view('livewire.opportunity-menu', ['opportunities' => Opportunity::where('name', 'like', '%' . $this->search . '%')->orderBy('created_at', 'DESC')->paginate(6)]);
    }

    public function home()
    {
        $this->isHome = true;
        $this->isDetail = false;
        $this->isCreate = false;
        $this->isInformation = false;
        $this->isUpdate = false;

        $this->reset('name', 'description', 'job_description', 'job_requirement', 'quotas', 'location', 'schema', 'open_date', 'close_date', 'opportunity');
    }

    public function detail($id)
    {
        $opportunity = Opportunity::find($id);
        $this->opportunity = $opportunity;
        $this->isHome = false;
        $this->isDetail = true;
        $this->isCreate = false;
        $this->isInformation = false;
        $this->isUpdate = false;
    }

    public function create()
    {
        $this->isHome = false;
        $this->isCreate = true;
        $this->isDetail = false;
        $this->isInformation = false;
        $this->isUpdate = false;

        $this->schemas = Schema::all();
        $this->categories = Category::all();
        $this->divisions = Division::all();
    }

    public function store()
    {
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

        Opportunity::create([
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

    public function information($id)
    {
        $opportunity = Opportunity::find($id);

        $this->opportunity = $opportunity;

        $this->isHome = false;
        $this->isDetail = false;
        $this->isCreate = false;
        $this->isInformation = true;
        $this->isUpdate = false;
    }

    public function update($id)
    {
        $opportunity = Opportunity::find($id);

        // $this->opportunity = $opportunity;

        $this->id = $opportunity->id;
        $this->name = $opportunity->name;
        $this->description = $opportunity->description;
        $this->job_description = $opportunity->job_description;
        $this->job_requirement = $opportunity->job_requirements;

        $this->isHome = false;
        $this->isDetail = false;
        $this->isCreate = false;
        $this->isInformation = false;
        $this->isUpdate = true;
    }

    public function setUpdate()
    {
        // Validasi input
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255|',
            'job_description' => 'required|string|max:255',
            'job_requirement' => 'required|string|max:255',
        ]);

        $opportunity = Opportunity::find($this->id);
        $opportunity->update([
            'name' => $this->name,
            'description' => $this->description,
            'job_description' => $this->job_description,
            'job_requirement' => $this->job_requirement,
        ]);
        session()->flash('success', 'Opportunity created successfully.');
        $this->home();
    }

    public function destroy($id)
    {
        $opportunity = Opportunity::find($id);

        if ($opportunity) {
            $opportunity->forceDelete();
            session()->flash('success', 'Opportunity deleted permanently.');
        } else {
            $this->home();
        }
        $this->home();
    }
}
