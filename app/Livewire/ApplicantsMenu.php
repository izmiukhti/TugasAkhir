<?php

namespace App\Livewire;

use App\Models\Applicants;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class ApplicantsMenu extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    public $isHome = true;
    public $isCreate = false;
    public $isEdit = false;
    public $isShow = false;
    public $fullname, $email, $phone_number;
    public $search = '';

    // Fungsi render untuk menampilkan data applicant yang dipaginasi
    public function render()
    {
        return view('livewire.applicants-menu', [
            'applicants' => Applicants::where('fullname', 'like', '%' . $this->search . '%')->paginate(5)
        ]);
    }

    // Fungsi show untuk menampilkan detail applicant
    public function show($id)
    {
        $this->isHome = false;
        $this->isCreate = false;
        $this->isEdit = false;
        $this->isShow = true;

        // Mendapatkan data applicant berdasarkan ID
        $applicant = Applicants::find($id);

        // Mengecek apakah applicant ditemukan
        if ($applicant) {
            $this->fullname = $applicant->fullname;
            $this->email = $applicant->email;
            $this->phone_number = $applicant->phone_number;
        } else {
            session()->flash('error', 'Applicant not found.');
            $this->back(); // Kembali ke halaman utama jika applicant tidak ditemukan
        }
    }

    // Fungsi untuk kembali ke halaman utama
    public function back()
    {
        $this->isHome = true;
        $this->isCreate = false;
        $this->isEdit = false;
        $this->isShow = false;

        // Reset data form
        $this->reset('fullname', 'email', 'phone_number');
    }
    public function destroy($id) {
        $applicant = Applicants::find($id);
    
        if ($applicant) {
            $applicant->forceDelete();
            session()->flash('success', 'User deleted permanently');
        }else{
            $this->back();
        }
    }
}
