<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tag;

class CategoriesController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
    
        return view('categories',[
            'tags' => $tags,
        ]);
    
    }
}
