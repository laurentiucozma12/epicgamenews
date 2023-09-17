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
use App\Http\Controllers\AdminControllers\AdminCategoriesController;
use App\Http\Controllers\AdminControllers\AdminPlatformsController;
use App\Http\Controllers\AdminControllers\AdminOthersController;
use App\Http\Controllers\AdminControllers\AdminTagsController;
use App\Http\Controllers\AdminControllers\AdminCommentsController;
use App\Http\Controllers\AdminControllers\AdminRolesController;
use App\Http\Controllers\AdminControllers\AdminUsersController;
use App\Http\Controllers\AdminControllers\AdminContactsController;
use App\Http\Controllers\AdminControllers\AdminAboutController;
use App\Http\Controllers\AdminControllers\AdminStorageLinkController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\AboutController;
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
    
    Route::resource('categories', AdminCategoriesController::class);
    Route::resource('platforms', AdminPlatformsController::class)->only(['index', 'show']);
    Route::resource('others', AdminOthersController::class)->only(['index', 'show']);

    Route::resource('tags', AdminTagsController::class)->only(['index', 'show', 'destroy']);
    Route::resource('comments', AdminCommentsController::class)->except('show');

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

Route::get('/tag/{tag:name}', [TagController::class, 'show'])->name('tags.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/{post:slug}', [PostsController::class, 'show'])->name('show');
Route::post('/{post:slug}', [PostsController::class, 'addComment'])->name('add_comment');