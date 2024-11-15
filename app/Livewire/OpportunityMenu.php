<?php

namespace App\Livewire;

use App\Models\Schema;
use Livewire\Component;
use App\Models\Category;
use App\Models\Division;
use App\Models\Opportunity;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Models\Applicant;
use App\Models\Applicants;


class OpportunityMenu extends Component
{
    public $selectedApplicant = null;
    
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';

    public $isHome = true;
    public $search = '';
    public $isDetail = false;
    public $isCreate = false;
    public $isInformation = false;
    public $isUpdate = false;

    // Input form
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
    
    // Update form
    public $update_name;
    public $update_description;
    public $update_job_description;
    public $update_job_requirement;
    
    public $opportunity;
    public $schemas;
    public $categories;
    public $divisions;
    
    public $selectedJob = null;
    public $applicants ;
    

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
        // Ambil kesempatan berdasarkan ID
        $this->opportunity = Opportunity::find($id);
    
        // Ambil applicants yang sesuai dengan id_opportunity
        $this->applicants = Applicants::where('id_opportunity', $id)->get();
    
        // Atur status tampilan
        $this->isHome = false;
        $this->isDetail = true;
        $this->isCreate = false;
        $this->isInformation = false;
        $this->isUpdate = false;
    
        // Debug output untuk memeriksa applicants
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
        $this->opportunity = Opportunity::find($id);
        $this->isHome = false;
        $this->isDetail = false;
        $this->isCreate = false;
        $this->isInformation = true;
        $this->isUpdate = false;
    }

    public function update($id)
    {
    public function update($id)
    {
        $opportunity = Opportunity::find($id);
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

    public function mount()
    {
        // Inisialisasi applicants sebagai koleksi kosong
        $this->applicants = collect();
    }

    // Fungsi untuk memilih job dan mengambil data applicant berdasarkan id_opportunity
    public function render()
    {
        $opportunities = Opportunity::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate(6);
    
        return view('livewire.opportunity-menu', [
            'opportunities' => $opportunities,
            'applicants' => $this->applicants,
        ]);
    }
    
    public function selectJob($jobId)
    {
        $this->selectedJob = Opportunity::find($jobId);
        $this->applicants = $this->selectedJob 
            ? Applicants::where('id_opportunity', $jobId)->get()
            : collect();
        
        $this->resetPage();
    }
    public function selectApplicant($id)
    {
        $this->selectedApplicant = Applicants::find($id);
        $this->fill($this->selectedApplicant->toArray()); // Fill form fields with selected applicant data
    }


    
}
    
    
    
    
