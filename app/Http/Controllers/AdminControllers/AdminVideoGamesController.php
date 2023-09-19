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

    public function show(VideoGame $video_game)
    {
        $posts = $video_game->posts()->latest()->paginate(100);
        
        return view('admin_dashboard.video_games.show', [
            'video_game' => $video_game,
            'posts' => $posts,
        ]);
    }

    public function edit(VideoGame $video_game)
    {
        return view('admin_dashboard.video_games.edit', [
            'video_game' => $video_game
        ]);
    }

    public function update(Request $request, VideoGame $video_game)
    {
        $this->rules['slug'] = ['required', Rule::unique('video_games')->ignore($video_game)];
        $validated = $request->validate($this->rules);
        $video_game->update($validated);

        return redirect()->route('admin.video_games.edit', $video_game)->with('success', 'Video Game has been Updated');
    }

    public function destroy(VideoGame $video_game)
    {
        $default_category_id = VideoGame::where('name', 'uncategorized')->first()->id;

        if ($video_game->name === 'uncategorized')
            abort('404');

        $video_game->posts()->update(['category_id' => $default_category_id]);

        $video_game->delete();
        return redirect()->route('admin.video_games.index')->with('success', 'Video Game has been Deleted');
    }
}
