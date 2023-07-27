<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->loadNavbarData();
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('about');
    }
}