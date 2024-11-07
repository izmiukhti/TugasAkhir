<?php

namespace App\Livewire;

use App\Models\Applicant;
use App\Models\ApplicantsModel;
use Livewire\Component;
use Livewire\WithPagination;

class ApplicantMenu extends Component
{
    use WithPagination;

    public $name, $email, $phone_number, $gender_id, $birth_date, $domicile_address, $religion_id, $marital_id, $education_id, $education_institution, $majority, $gpa, $graduate_status, $graduate_year, $information_from, $portfolio_link, $cv_file;
    public $isHome = true, $isCreate = false, $isUpdate = false;
    public $search = '';
    public $applicant_id;
    public $applicants;

    public function mount()
    {
        $this->applicants = ApplicantsModel::paginate(10);
    }

    public function render()
    {
        return view('livewire.applicant-menu', ['applicants' => ApplicantsModel::where('name', 'like', '%'.$this->search.'%')->paginate(5)]);
    }

    // Reset form fields
    public function resetFields()
    {
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

    // Menampilkan halaman awal dengan daftar pelamar
    public function home()
    {
        $this->resetFields();
        $this->isHome = true;
        $this->isCreate = false;
        $this->isUpdate = false;
    }

    // Menampilkan halaman form untuk create applicant
    public function create()
    {
        $this->resetFields();
        $this->isCreate = true;
        $this->isHome = false;
    }

    // Simpan data applicant baru
    public function save()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'gender_id' => 'required',
            'birth_date' => 'required|date',
            'domicile_address' => 'required|string',
            'religion_id' => 'required',
            'marital_id' => 'required',
            'education_id' => 'required',
            'education_institution' => 'required|string',
            'majority' => 'required|string',
            'gpa' => 'required|string',
            'graduate_status' => 'required|string',
            'graduate_year' => 'required|numeric',
            'information_from' => 'required|string',
            'portfolio_link' => 'nullable|string',
            'cv_file' => 'required|string',
        ]);

        Applicants::create([
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
        ]);

        session()->flash('success', 'Applicant created successfully.');
        $this->home();
    }

}
