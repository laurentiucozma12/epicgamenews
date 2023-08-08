<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

class AdminCategoriesController extends Controller
{
    public function index()
    {
        return view('admin_dashboard.categories.index');
    }

    public function create()
    {
        return view('admin_dashboard.categories.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function show(Category $category)
    {
        return view('admin_dashboard.categories.show', [
            'category' => $category
        ]);
    }

    public function edit(Category $category)
    {
        return view('admin_dashboard.categories.edit', [
            'category' => $category
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
