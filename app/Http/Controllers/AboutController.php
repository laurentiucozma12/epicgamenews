<?php

namespace App\Http\Controllers;

use App\Models\Seo;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __invoke(Request $request)
    {
        $seo = Seo::where('page_name', '=', 'About')->first();
        
        return view('about', [
            'seo' => $seo,
        ]);
    }
}