<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Platform;

class AdminPlatformsController extends Controller
{
    public function index()
    {
        return view('admin_dashboard.platforms.index');
    }

    public function create()
    {
        return view('admin_dashboard.platforms.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function show(Platform $platform)
    {
        return view('admin_dashboard.platforms.show', [
            'platform' => $platform
        ]);
    }

    public function edit(Platform $platform)
    {
        return view('admin_dashboard.platforms.edit', [
            'platform' => $platform
        ]);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
