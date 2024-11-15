<?php

namespace App\Http\Livewire;

use App\Models\Applicant;
use App\Models\Opportunity;
use Illuminate\Support\Str;
use Livewire\Component;

class ApplicantMenu extends Component
{
    public $applicants = [];
    public $selectedApplicant;
    public $opportunity_id, $name, $email, $phone_number, $gender_id, $birth_date, $domicile_address;
    public $religion_id, $marital_id, $education_id, $education_institution;
    public $majority, $gpa, $graduate_status, $graduate_year, $information_from;
    public $portfolio_link, $cv_file;
    public $selectedOpportunityId;
    public $search;

    protected $rules = [
        'opportunity_id' => 'required|uuid',
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:applicants,email',
        'phone_number' => 'required|string|max:20',
        'gender_id' => 'required|integer',
        'birth_date' => 'required|date',
        'domicile_address' => 'required|string|max:255',
        'religion_id' => 'required|integer',
        'marital_id' => 'required|integer',
        'education_id' => 'required|integer',
        'education_institution' => 'required|string|max:255',
        'majority' => 'required|string|max:255',
        'gpa' => 'required|string|max:10',
        'graduate_status' => 'required|string|max:10',
        'graduate_year' => 'required|string|max:4',
        'information_from' => 'required|string|max:255',
        'portfolio_link' => 'nullable|url',
        'cv_file' => 'required|string|max:255',
    ];

    protected $listeners = ['showOpportunityDetails'];

    public function mount()
    {
        // Muat awal daftar applicants berdasarkan selectedOpportunityId jika ada
        $this->loadApplicants();
    }

    public function loadApplicants()
    {
        if ($this->selectedOpportunityId) {
            $this->applicants = Applicant::where('opportunity_id', $this->selectedOpportunityId)
                ->where('name', 'like', '%' . $this->search . '%')
                ->get();
        } else {
            $this->applicants = Applicant::where('name', 'like', '%' . $this->search . '%')->get();
        }
    }

    public function updatedSelectedOpportunityId()
    {
        $this->loadApplicants();
    }

    public function updatedSearch()
    {
        $this->loadApplicants();
    }

    public function showOpportunityDetails($id)
    {
        $applicant = Applicant::find($id);
        if ($applicant) {
            $this->fill($applicant->toArray());
        } else {
            session()->flash('error', 'Applicant not found.');
        }
    }

    public function selectApplicant($id)
    {
        $this->selectedApplicant = Applicant::find($id);
        if ($this->selectedApplicant) {
            $this->fill($this->selectedApplicant->toArray());
        }
    }

    public function save()
    {
        $this->validate();

        // Membuat UUID secara otomatis untuk id
        $applicantData = [
            'id' => (string) Str::uuid(),
            'opportunity_id' => $this->opportunity_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'gender_id' => $this->gender_id,
            'birth_date' => $this->birth_date,
            'domicile_address' => $this->domicile_address,
            'religion_id' => $this->religion_id,
            'marital_id' => $this->marital_id,
            'education_id' => $this->education_id,
            'education_institution' => $this->education_institution,
            'majority' => $this->majority,
            'gpa' => $this->gpa,
            'graduate_status' => $this->graduate_status,
            'graduate_year' => $this->graduate_year,
            'information_from' => $this->information_from,
            'portfolio_link' => $this->portfolio_link,
            'cv_file' => $this->cv_file,
        ];

        Applicant::create($applicantData);

        session()->flash('message', 'Applicant saved successfully');
        $this->resetFields();
        $this->loadApplicants(); // Refresh daftar applicants setelah menyimpan
    }

    public function resetFields()
    {
        $this->selectedApplicant = null;
        $this->opportunity_id = '';
        $this->name = '';
        $this->email = '';
        $this->phone_number = '';
        $this->gender_id = '';
        $this->birth_date = '';
        $this->domicile_address = '';
        $this->religion_id = '';
        $this->marital_id = '';
        $this->education_id = '';
        $this->education_institution = '';
        $this->majority = '';
        $this->gpa = '';
        $this->graduate_status = '';
        $this->graduate_year = '';
        $this->information_from = '';
        $this->portfolio_link = '';
        $this->cv_file = '';
    }

    public function render()
{
    // Periksa apakah ada selectedOpportunityId
    if ($this->selectedOpportunityId) {
        // Hanya ambil applicants yang memiliki opportunity_id yang sesuai
        $applicants = Applicant::where('opportunity_id', $this->selectedOpportunityId)
            ->where('name', 'like', '%' . $this->search . '%') // Jika ada filter pencarian
            ->get();
            dd($applicants);
    } else {
        // Jika tidak ada selectedOpportunityId, mungkin tampilkan kosong atau semua data
        $applicants = collect(); // Atau Applicant::all() jika perlu semua data
    }

    return view('livewire.detailopportunity', [
        'applicants' => $applicants,
    ]);
}

}
