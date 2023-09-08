<?php

namespace App\Http\Controllers;

use App\Data\Constants;
use App\Data\Models\Setting;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    /**
     * Display a settings index page.
     *
     */
    public function index()
    {
        return Inertia::render('Settings/Index', []);
    }
}
