<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Other;

class AdminOthersController extends Controller
{    
    public function index()
    {
        return view('admin_dashboard.others.index', [
            'others' => Other::all(),
        ]);
    }

    public function show(Other $other)
    {
        $posts = $other->posts()->latest()->paginate(100);
        return view('admin_dashboard.others.show', [
            'other' => $other,
            'posts' => $posts,
        ]);
    }
}