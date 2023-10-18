<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\About;

class AdminAboutController extends Controller
{
    public function edit()
    {
        return view('admin_dashboard.about.edit', [
            'about' => About::find(1),
        ]);
    }

    public function update()
    {
        $validated = request()->validate([
            'about_first_text' => 'required|min:50,max:500',
            'about_second_text' => 'required|min:50,max:500',
            'about_our_mission' => 'required',
            'about_our_vision' => 'required',
            'about_services' => 'required',
        ]);

        About::find(1)->update($validated);
        return redirect()->route('admin.about.edit')->with('success', 'about has been updated');
    }
}
