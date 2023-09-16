<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Platform;

class AdminPlatformsController extends Controller
{ 
    public function index()
    {
        return view('admin_dashboard.platforms.index', [
            'platforms' => Platform::all(),
        ]);
    }

    public function show(Platform $platform)
    {
        return view('admin_dashboard.platforms.show', [
            'platform' => $platform
        ]);
    }
}
