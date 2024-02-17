<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Platform;
use App\Models\VideoGame;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\PostsService;
use App\Services\VideoGamesService;
use App\Services\CategoriesService;
use App\Services\PlatformsService;

class SiteMapController extends Controller
{
    public function index(
        PostsService $postsService, 
        VideoGamesService $videoGamesService, 
        CategoriesService $categoriesService,
        PlatformsService $platformsService,
    ) : Response
    {
        $posts = $postsService->getPosts()->get();
        $video_games = $videoGamesService->getVideoGames()->get();
        $categories = $categoriesService->getCategories()->get();
        $platforms = $platformsService->getPlatforms()->get();

        return response()->view('sitemap', [
            'posts' => $posts,
            'video_games' => $video_games,
            'categories' => $categories,
            'platforms' => $platforms,
        ])->header('Content-Type', 'text/xml');
    }
}