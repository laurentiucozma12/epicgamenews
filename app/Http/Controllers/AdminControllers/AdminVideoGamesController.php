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
        'slug' => 'required|unique:video_games,slug',
    ];
    
    public function index()
    {
        $video_games = VideoGame::with('user')->orderBy('id', 'DESC')->paginate(100);
        
        return view('admin_dashboard.video_games.index', [
            'video_games' => $video_games
        ]);
    }

    public function create()
    {
        return view('admin_dashboard.video_games.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        $validated['user_id'] = auth()->id();
        VideoGame::create($validated);

        return redirect()->route('admin.video_games.create')->with('success', 'Video Game has been Created');
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
