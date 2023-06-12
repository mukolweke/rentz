<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'tenant') {
            return redirect()->route('tenant.dashboard');
        }

        return Inertia::render('Home/Index', [
            'label' => 'Home'
        ]);
    }
}
