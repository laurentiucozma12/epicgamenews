<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

use App\Models\VideoGame;

class AdminVideoGamesController extends Controller
{
    private $rules = [
        'name' => 'required|min:3|max:30',
        'slug' => 'required|unique:videogames,slug',
    ];
    
    public function index()
    {
        $videoGames = VideoGame::with('user')->paginate(100);
        
        return view('admin_dashboard.videogames.index', [
            'videoGames' => $videoGames
        ]);
    }

    public function create()
    {
        return view('admin_dashboard.videogames.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
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
