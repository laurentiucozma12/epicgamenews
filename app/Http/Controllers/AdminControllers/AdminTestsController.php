<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Platform;
use App\Models\More;

class AdminTestsController extends Controller
{
    public function index()
    {
        return view('admin_dashboard.tests.index');
    }

    public function create()
    {
        return view('admin_dashboard.tests.create', [
            'categories' => Category::pluck('name', 'id'),
            'platforms' => Platform::pluck('name', 'id'),
            'mores' => More::pluck('name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
