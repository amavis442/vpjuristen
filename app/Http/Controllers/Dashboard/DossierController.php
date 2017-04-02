<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DossierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index(Request $request)
    {
        return view('dashboard.dossier.index');
    }
}
