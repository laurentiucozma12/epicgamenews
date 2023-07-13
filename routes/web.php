<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/ 

use App\Http\Controllers\HomeController;
use App\Models\Post;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');

Route::get('/posts/{post:slug}', function (Post $post) {    
    return view('post', ['post' => $post]);
})->name('posts.show');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/more', function () {
    return view('more');
})->name('more');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


// -S-Platforms-button-
Route::get('platforms', function () {
    return view('/platforms');
})->name('platforms');

// Route::get('platforms/{platform}', function ($platform) {
//// !!! I should have in DB a platform table with a platform id !!!
//// !!! Also what if a game is playable on more platforms? for example on pc and playstation.. it should be included in more platforms !!!
//     $platform = Post::where('platform', $platform)->first();
//     return view('/platform');
// })->name('platforms');

Route::get('/platforms/mobile', function () {
    return view('/platforms/mobile');
})->name('mobile');

Route::get('/platforms/nintendo', function () {
    return view('/platforms/nintendo');
})->name('nintendo');

Route::get('/platforms/pc', function () {
    return view('/platforms/pc');
})->name('pc');

Route::get('/platforms/playstation', function () {
    return view('/platforms/playstation');
})->name('playstation');

Route::get('/platforms/xbox', function () {
    return view('/platforms/xbox');
})->name('xbox');
// -E-Platforms-button-


// -S-More-button-
Route::get('/game-trailers', function () {
    return view('game-trailers');
})->name('game-trailers');
Route::get('/anime', function () {
    return view('anime');
})->name('anime');
// -E-More-button-


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
