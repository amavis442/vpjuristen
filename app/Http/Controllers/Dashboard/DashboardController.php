<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:dashboard']);
    }

    //
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->hasRole('client')) {
            $user->companies()->first()->dossiers();
        }


        return view('dashboard.dashboard');
    }
}
