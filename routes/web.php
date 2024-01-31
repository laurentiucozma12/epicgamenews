<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;

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
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\VideoGameController;
use App\Http\Controllers\RecentPostsController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\AdminControllers\TinyMCEController;

use App\Http\Controllers\AdminControllers\AdminHomeController;
use App\Http\Controllers\AdminControllers\AdminTagsController;
use App\Http\Controllers\AdminControllers\AdminAboutController;
use App\Http\Controllers\AdminControllers\AdminPostsController;
use App\Http\Controllers\AdminControllers\AdminRolesController;
use App\Http\Controllers\AdminControllers\AdminUsersController;
use App\Http\Controllers\AdminControllers\AdminContactsController;
use App\Http\Controllers\AdminControllers\AdminDashboardController;
use App\Http\Controllers\AdminControllers\AdminPlatformsController;
use App\Http\Controllers\AdminControllers\AdminCategoriesController;
use App\Http\Controllers\AdminControllers\AdminVideoGamesController;
use App\Http\Controllers\AdminControllers\AdminSeoController;

// Admin Dashboard Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'check_permissions'])->group(function(){

    Route::get('/', [AdminHomeController::class, 'index'])->name('index');
    
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');

    Route::prefix('seo')->group(function () {
        Route::get('/seo-home/edit', [AdminSeoController::class, 'editSeoHome'])->name('seo_home');
        // Route::put('/{seo_home:slug}', [AdminSeoController::class, 'update'])->name('seo.update');
        // Route::patch('/{seo_home:slug}', [AdminSeoController::class, 'update']);
        
        Route::get('/seo-video-games/edit', [AdminSeoController::class, 'editSeoVideoGames'])->name('seo_video_games');
        // Route::put('/{seo_home:slug}', [AdminSeoController::class, 'update'])->name('seo.update');
        // Route::patch('/{seo_home:slug}', [AdminSeoController::class, 'update']);

        Route::get('/seo-categories/edit', [AdminSeoController::class, 'editSeoCategories'])->name('seo_categories');
        // Route::put('/{seo_home:slug}', [AdminSeoController::class, 'update'])->name('seo.update');
        // Route::patch('/{seo_home:slug}', [AdminSeoController::class, 'update']);

        Route::get('/seo-platforms/edit', [AdminSeoController::class, 'editSeoPlatforms'])->name('seo_platforms');
        // Route::put('/{seo_home:slug}', [AdminSeoController::class, 'update'])->name('seo.update');
        // Route::patch('/{seo_home:slug}', [AdminSeoController::class, 'update']);

        Route::get('/seo-about/edit', [AdminSeoController::class, 'editSeoAbout'])->name('seo_about');
        // Route::put('/{seo_home:slug}', [AdminSeoController::class, 'update'])->name('seo.update');
        // Route::patch('/{seo_home:slug}', [AdminSeoController::class, 'update']);

        Route::get('/seo-contact/edit', [AdminSeoController::class, 'editSeoContact'])->name('seo_contact');
        // Route::put('/{seo_home:slug}', [AdminSeoController::class, 'update'])->name('seo.update');
        // Route::patch('/{seo_home:slug}', [AdminSeoController::class, 'update']);
    });

    Route::prefix('posts')->group(function () {
        Route::get('/', [AdminPostsController::class, 'index'])->name('posts.index');
        Route::get('/create', [AdminPostsController::class, 'create'])->name('posts.create');
        Route::post('/', [AdminPostsController::class, 'store'])->name('posts.store');
        Route::get('/{post:slug}/edit', [AdminPostsController::class, 'edit'])->name('posts.edit');
        Route::put('/{post:slug}', [AdminPostsController::class, 'update'])->name('posts.update');
        Route::patch('/{post:slug}', [AdminPostsController::class, 'update']);
        Route::delete('/{post:slug}', [AdminPostsController::class, 'destroy'])->name('posts.destroy');
        
        Route::get('/games-api', [AdminPostsController::class, 'createApi'])->name('posts.create_api');
        Route::post('/store_api', [AdminPostsController::class, 'storeApi'])->name('posts.store_api');

        Route::get('/scrap-post', [AdminPostsController::class, 'scrapPost'])->name('posts.scrap_post');
    });

    Route::post('upload_tinymce_image', [TinyMCEController::class, 'upload_tinymce_image'])->name('upload_tinymce_image');

    Route::prefix('video-games')->group(function () {
        Route::get('/', [AdminVideoGamesController::class, 'index'])->name('video_games.index');           
        Route::get('/create', [AdminVideoGamesController::class, 'create'])->name('video_games.create');
        Route::post('/', [AdminVideoGamesController::class, 'store'])->name('video_games.store');        
        Route::get('/{video_game:slug}/edit', [AdminVideoGamesController::class, 'edit'])->name('video_games.edit');
        Route::put('/{video_game:slug}', [AdminVideoGamesController::class, 'update'])->name('video_games.update');
        Route::patch('/{video_game:slug}', [AdminVideoGamesController::class, 'update']);
        Route::delete('/{video_game:slug}', [AdminVideoGamesController::class, 'destroy'])->name('video_games.destroy');
        Route::get('/{video_game:slug}', [AdminVideoGamesController::class, 'show'])->name('video_games.show');

        Route::get('/games-api', [AdminVideoGamesController::class, 'createApi'])->name('video_games.create_api');
        Route::post('/store_api', [AdminVideoGamesController::class, 'storeApi'])->name('video_games.store_api');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [AdminCategoriesController::class, 'index'])->name('categories.index');
        Route::get('/create', [AdminCategoriesController::class, 'create'])->name('categories.create');
        Route::post('/', [AdminCategoriesController::class, 'store'])->name('categories.store');
        Route::get('/{category:slug}/edit', [AdminCategoriesController::class, 'edit'])->name('categories.edit');
        Route::put('/{category:slug}', [AdminCategoriesController::class, 'update'])->name('categories.update');
        Route::patch('/{category:slug}', [AdminCategoriesController::class, 'update']);
        Route::delete('/{category:slug}', [AdminCategoriesController::class, 'destroy'])->name('categories.destroy');
        Route::get('/{category:slug}', [AdminCategoriesController::class, 'show'])->name('categories.show');
    });

    Route::prefix('platforms')->group(function () {
        Route::get('/', [AdminPlatformsController::class, 'index'])->name('platforms.index');
        Route::get('/create', [AdminPlatformsController::class, 'create'])->name('platforms.create');
        Route::post('/', [AdminPlatformsController::class, 'store'])->name('platforms.store');
        Route::get('/{platform:slug}/edit', [AdminPlatformsController::class, 'edit'])->name('platforms.edit');
        Route::put('/{platform:slug}', [AdminPlatformsController::class, 'update'])->name('platforms.update');
        Route::patch('/{platform:slug}', [AdminPlatformsController::class, 'update']);
        Route::delete('/{platform:slug}', [AdminPlatformsController::class, 'destroy'])->name('platforms.destroy');
        Route::get('/{platform:slug}', [AdminPlatformsController::class, 'show'])->name('platforms.show');
    });
    
    Route::resource('tags', AdminTagsController::class)->only(['index', 'show', 'destroy']);

    Route::resource('roles', AdminRolesController::class)->except('show');
    
    Route::prefix('users')->group(function () {
        Route::get('/', [AdminUsersController::class, 'index'])->name('users.index');
        Route::get('/create', [AdminUsersController::class, 'create'])->name('users.create');
        Route::post('/', [AdminUsersController::class, 'store'])->name('users.store');
        Route::get('/{user:name}/edit', [AdminUsersController::class, 'edit'])->name('users.edit');
        Route::put('/{user:name}', [AdminUsersController::class, 'update'])->name('users.update');
        Route::patch('/{user:name}', [AdminUsersController::class, 'update']);
        Route::delete('/{user:name}', [AdminUsersController::class, 'destroy'])->name('users.destroy');
        Route::get('/user:name', [AdminUsersController::class, 'showUsers'])->name('users.showUsers');
        Route::get('/{user:name}/related-posts', [AdminUsersController::class, 'showPosts'])->name('users.showPosts');
        Route::get('/{user:name}/related-video-games', [AdminUsersController::class, 'showVideoGames'])->name('users.showVideoGames');
        Route::get('/{user:name}/related-categories', [AdminUsersController::class, 'showCategories'])->name('users.showCategories');
    });
    
    Route::get('contacts', [AdminContactsController::class, 'index'])->name('contacts');
    Route::delete('contacts/{contact}', [AdminContactsController::class, 'destroy'])->name('contacts.destroy');
    
    Route::get('about', [AdminAboutController::class, 'edit'])->name('about.edit');
    Route::post('about', [AdminAboutController::class, 'update'])->name('about.update');
    
});

// Front User Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/video-games', [VideoGameController::class, 'index'])->name('video_games.index');
Route::get('/video-games/{video_game:slug}', [VideoGameController::class, 'show'])->name('video_games.show');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/platforms', [PlatformController::class, 'index'])->name('platforms.index');
Route::get('/platforms/{platform:slug}', [PlatformController::class, 'show'])->name('platforms.show');

Route::get('/about', AboutController::class)->name('about');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/tag/{tag:slug}', [TagController::class, 'show'])->name('tags.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy_policy.index');

require __DIR__.'/auth.php';

Route::get('/{post:slug}', [PostsController::class, 'show'])->name('show');