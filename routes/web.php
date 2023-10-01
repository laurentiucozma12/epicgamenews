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

use App\Http\Controllers\AdminControllers\DashboardController;
use App\Http\Controllers\AdminControllers\AdminPostsController;
use App\Http\Controllers\AdminControllers\TinyMCEController;
use App\Http\Controllers\AdminControllers\AdminVideoGamesController;
use App\Http\Controllers\AdminControllers\AdminCategoriesController;
use App\Http\Controllers\AdminControllers\AdminPlatformsController;
use App\Http\Controllers\AdminControllers\AdminOthersController;
use App\Http\Controllers\AdminControllers\AdminTagsController;
use App\Http\Controllers\AdminControllers\AdminRolesController;
use App\Http\Controllers\AdminControllers\AdminUsersController;
use App\Http\Controllers\AdminControllers\AdminContactsController;
use App\Http\Controllers\AdminControllers\AdminAboutController;
use App\Http\Controllers\AdminControllers\AdminStorageLinkController;
use App\Http\Controllers\AdminControllers\AdminImagesController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\VideoGameController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\TagController;

// Admin Dashboard Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'check_permissions'])->group(function(){

    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::resource('posts', AdminPostsController::class)->except('show');
    Route::post('upload_tinymce_image', [TinyMCEController::class, 'upload_tinymce_image'])->name('upload_tinymce_image');

    Route::prefix('video_games')->group(function () {
        Route::get('/', [AdminVideoGamesController::class, 'index'])->name('video_games.index');
        Route::get('/create', [AdminVideoGamesController::class, 'create'])->name('video_games.create');
        Route::post('/', [AdminVideoGamesController::class, 'store'])->name('video_games.store');
        Route::get('/{video_game}/edit', [AdminVideoGamesController::class, 'edit'])->name('video_games.edit');
        Route::put('/{video_game}', [AdminVideoGamesController::class, 'update'])->name('video_games.update');
        Route::patch('/{video_game}', [AdminVideoGamesController::class, 'update']);
        Route::delete('/{video_game}', [AdminVideoGamesController::class, 'destroy'])->name('video_games.destroy');
        Route::get('/{video_game}', [AdminVideoGamesController::class, 'show'])->name('video_games.show');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [AdminCategoriesController::class, 'index'])->name('categories.index');
        Route::get('/create', [AdminCategoriesController::class, 'create'])->name('categories.create');
        Route::post('/', [AdminCategoriesController::class, 'store'])->name('categories.store');
        Route::get('/{category}/edit', [AdminCategoriesController::class, 'edit'])->name('categories.edit');
        Route::put('/{category}', [AdminCategoriesController::class, 'update'])->name('categories.update');
        Route::patch('/{category}', [AdminCategoriesController::class, 'update']);
        Route::delete('/{category}', [AdminCategoriesController::class, 'destroy'])->name('categories.destroy');
        Route::get('/{category}', [AdminCategoriesController::class, 'show'])->name('categories.show');
    });

    Route::prefix('platforms')->group(function () {
        Route::get('/', [AdminPlatformsController::class, 'index'])->name('platforms.index');
        Route::get('/create', [AdminPlatformsController::class, 'create'])->name('platforms.create');
        Route::post('/', [AdminPlatformsController::class, 'store'])->name('platforms.store');
        Route::get('/{platform}/edit', [AdminPlatformsController::class, 'edit'])->name('platforms.edit');
        Route::put('/{platform}', [AdminPlatformsController::class, 'update'])->name('platforms.update');
        Route::patch('/{platform}', [AdminPlatformsController::class, 'update']);
        Route::delete('/{platform}', [AdminPlatformsController::class, 'destroy'])->name('platforms.destroy');
        Route::get('/{platform}', [AdminPlatformsController::class, 'show'])->name('platforms.show');
    });

    Route::prefix('others')->group(function () {
        Route::get('/', [AdminOthersController::class, 'index'])->name('others.index');
        Route::get('/create', [AdminOthersController::class, 'create'])->name('others.create');
        Route::post('/', [AdminOthersController::class, 'store'])->name('others.store');
        Route::get('/{other}/edit', [AdminOthersController::class, 'edit'])->name('others.edit');
        Route::put('/{other}', [AdminOthersController::class, 'update'])->name('others.update');
        Route::patch('/{other}', [AdminOthersController::class, 'update']);
        Route::delete('/{other}', [AdminOthersController::class, 'destroy'])->name('others.destroy');
        Route::get('/{other}', [AdminOthersController::class, 'show'])->name('others.show');
    });

    Route::resource('tags', AdminTagsController::class)->only(['index', 'show', 'destroy']);

    Route::resource('roles', AdminRolesController::class)->except('show');
    Route::resource('users', AdminUsersController::class);
    
    Route::get('contacts', [AdminContactsController::class, 'index'])->name('contacts');
    Route::delete('contacts/{contact}', [AdminContactsController::class, 'destroy'])->name('contacts.destroy');
    
    Route::get('about', [AdminAboutController::class, 'edit'])->name('about.edit');
    Route::post('about', [AdminAboutController::class, 'update'])->name('about.update');
    
    Route::get('storagelink', [AdminStorageLinkController::class, 'storageLink'])->name('storageLink');
    
});

// Front User Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/video_games/uncategorized', function () {
    abort(404);
});
Route::get('/video_games', [VideoGameController::class, 'index'])->name('video_games.index');
Route::get('/video_games/{video_game:slug}', [VideoGameController::class, 'show'])->name('video_games.show');

Route::get('/categories/uncategorized', function () {
    abort(404);
});
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/platforms/uncategorized', function () {
    abort(404);
});
Route::get('/platforms', [PlatformController::class, 'index'])->name('platforms.index');
Route::get('/platforms/{platform:slug}', [PlatformController::class, 'show'])->name('platforms.show');

Route::get('/other/uncategorized', function () {
    abort(404);
});
Route::get('/other', [OtherController::class, 'index'])->name('others.index');
Route::get('/other/{other:slug}', [OtherController::class, 'show'])->name('others.show');

Route::get('/about', AboutController::class)->name('about');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/tag/uncategorized', function () {
    abort(404);
});
Route::get('/tag/{tag:name}', [TagController::class, 'show'])->name('tags.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/{post:slug}', [PostsController::class, 'show'])->name('show');