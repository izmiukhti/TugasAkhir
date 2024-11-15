<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Education;
use App\Models\Gender;
use App\Models\GraduatedStatus;
use App\Models\Marital;
use App\Models\Opportunity;
use App\Models\Religion;
use App\Models\Religion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    public function index()
    {
        $opportunities = Opportunity::latest()->get();
        return view('welcome', compact('opportunities'));
    }

    public function show($id)
    {

        $opportunity = Opportunity::find($id);

        $religions = Religion::all();
        $genders = Gender::all();
        $maritalStatuses = Marital::all();
        $educations = Education::all();
        $graduate_status = GraduatedStatus::all();
        
        if ($opportunity) {
            $opportunity->clicked = $opportunity->clicked + 1;
            $opportunity->save();
            return view('detailopportunity', compact('opportunity', 'genders', 'religions', 'maritalStatuses', 'educations','graduate_status'));
        }
        else {
            return redirect()->route('opportunty.index')->with('error', 'Opportunity ');
        }
        
    }
    
    public function store(Request $request, $id)
{

//    Validasi data yang dikirim
    $request->validate([
        'fullname' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone_number' => 'required|string|max:15',
        'portfolio_link' => 'nullable|url',
        'cv_path' => 'required|file|mimes:pdf,doc,docx|max:2048', // Validasi file CV
        'gender' => 'required|string',
        'birthdate' => 'required|date',
        'address' => 'required|string',
        'religion' => 'required|string',
        'marital_status' => 'required|string',
        'last_education' => 'required|string',
        'education_name' => 'required|string',
        'major_name' => 'required|string',
        'gpa' => 'nullable|numeric',
        'graduate_status' => 'required|boolean', // Ubah ke boolean jika berupa angka 1 atau 0
        'graduate_year' => 'required|integer',
        'know_opportunity_form' => 'nullable|string',
    ]);
    // dd("halo");

    // Upload CV dan simpan path-nya
    $cvPath = $request->file('cv_path')->store('cvs', 'public');
    $gender = Gender::where("name", $request->gender)->first();
    $religion = Religion::where("name", $request->religion)->first();
    $marital = Marital::find($request->marital_status);
    $education = Education::find($request->last_education);
    $education_name = Education::where("name", $request->education_name)->first();
    // Buat instance model dan isi datanya
    $applicant = new Applicant();
    
    // Set UUID untuk kolom id
    $applicant->id = (string) Str::uuid(); // Menghasilkan UUID baru
    $applicant->name = $request->fullname;
    $applicant->email = $request->email;
    $applicant->phone_number = $request->phone_number;
    $applicant->portfolio_link = $request->portfolio_link;
    $applicant->opportunity_id = $id; // Ambil dari parameter route
    $applicant->cv_file = $cvPath;
    $applicant->gender_id = $gender->id;
    $applicant->birth_date = $request->birthdate;
    $applicant->domicile_address = $request->address;
    $applicant->religion_id = $religion->id;
    $applicant->marital_id = $marital->id;
    $applicant->education_id = $education->id;
    $applicant->education_institution = $education->name;
    $applicant->majority = $request->major_name;
    $applicant->gpa = $request->gpa;
    $applicant->graduate_status = $request->graduate_status;
    $applicant->graduate_year = $request->graduate_year;
    $applicant->information_from = $request->know_opportunity_form;

    try {
        // Simpan data ke database
        $applicant->save();
        return redirect()->back()->with('success', 'Application submitted successfully.');
    } catch (\Exception $e) {
        // Menangani kesalahan jika terjadi saat penyimpanan
        return redirect()->back()->with('error', 'Failed to submit application: ' . $e->getMessage());
    }
}
}