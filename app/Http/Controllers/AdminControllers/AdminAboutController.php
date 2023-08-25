<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAboutController extends Controller
{
    public function edit()
    {
        return view('admin_dashboard.about.edit');
    }

    public function update()
    {
        //
    }
}
