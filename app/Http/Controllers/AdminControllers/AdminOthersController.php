<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Other;

class AdminOthersController extends Controller
{
    public function index()
    {
        return view('admin_dashboard.others.index');
    }

    public function create()
    {
        return view('admin_dashboard.others.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function show(Other $other)
    {
        return view('admin_dashboard.others.show', [
            'other' => $other
        ]);
    }

    public function edit(Other $other)
    {
        return view('admin_dashboard.others.edit', [
            'other' => $other
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
