<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\Request;

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
        $opportunity->clicked = $opportunity->clicked + 1;
        $opportunity->save();
        return view('detailopportunity', compact('opportunity'));
    }
}
