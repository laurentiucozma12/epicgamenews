<?php

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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/categories', function () {
    return view('categories');
})->name('categories');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/more', function () {
    return view('more');
})->name('more');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/post', function () {
    return view('post');
})->name('post');


// -S-Platforms-button-
Route::get('platforms', function () {
    return view('/platforms');
})->name('platforms');

Route::get('/tags/mobile', function () {
    return view('/tags/mobile');
})->name('mobile');

Route::get('/tags/nintendo', function () {
    return view('/tags/nintendo');
})->name('nintendo');

Route::get('/tags/pc', function () {
    return view('/tags/pc');
})->name('pc');

Route::get('/tags/playstation', function () {
    return view('/tags/playstation');
})->name('playstation');

Route::get('/tags/xbox', function () {
    return view('/tags/xbox');
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
