<?php

namespace App\Livewire;

use App\Models\ApplicantsModel;
use Livewire\Component;

class Applicants extends Component
{
    public $isHome = true;
    public $isDetail = false;
    public $search = '';

    public function render()
    {
        return view('livewire.applicants', ['applicants' => ApplicantsModel::where('name', 'like', '%'.$this->search.'%')->paginate(5)]);
    }
}
