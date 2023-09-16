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
use App\Http\Controllers\AdminControllers\AdminOthersController;
use App\Http\Controllers\AdminControllers\AdminTagsController;
use App\Http\Controllers\AdminControllers\AdminCommentsController;
use App\Http\Controllers\AdminControllers\AdminRolesController;
use App\Http\Controllers\AdminControllers\AdminUsersController;
use App\Http\Controllers\AdminControllers\AdminContactsController;
use App\Http\Controllers\AdminControllers\AdminAboutController;

use App\Http\Controllers\StorageLinkController;
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

    Route::resource('posts', AdminPostsController::class);
    Route::post('upload_tinymce_image', [TinyMCEController::class, 'upload_tinymce_image'])->name('upload_tinymce_image');
    
    Route::resource('categories', AdminCategoriesController::class);
    Route::resource('others', AdminOthersController::class);

    Route::resource('tags', AdminTagsController::class)->only(['index', 'show', 'destroy']);
    Route::resource('comments', AdminCommentsController::class)->except('show');

    Route::resource('roles', AdminRolesController::class)->except('show');
    Route::resource('users', AdminUsersController::class);
    
    Route::get('contacts', [AdminContactsController::class, 'index'])->name('contacts');
    Route::delete('contacts/{contact}', [AdminContactsController::class, 'destroy'])->name('contacts.destroy');
    
    Route::get('about', [AdminAboutController::class, 'edit'])->name('about.edit');
    Route::post('about', [AdminAboutController::class, 'update'])->name('about.update');
});

// Front User Routes
Route::get('/storage-link', function () {
    // Define the mapping of branch names to their respective storage paths
    $branchPaths = [
        'development',
        'pre-production',
        ////// I forgot about this, gotta test if I can delete it storage_path('app/public') //////
        'production' => storage_path('app/public'),
    ];

    // Get the current branch name (assuming you have Git installed)
    $currentBranch = trim(shell_exec('git rev-parse --abbrev-ref HEAD'));

    // Check if the current branch exists in the mapping, default to 'production' if not found
    $targetFolder = $branchPaths[$currentBranch] ?? $branchPaths['production'];

    ////// gotta test if I can make it shorter like if ($currentBranch === 'development' || $currentBranch === 'pre-production' || $currentBranch === 'production') {...} //////
    // Define the target link folder (public storage)
    if ($currentBranch === 'development')
    {
        // dd($targetFolder); // "C:\xampp\htdocs\epicgamenews\storage\app\public"
        // dd(public_path('storage')); // "C:\xampp\htdocs\epicgamenews\public\storage"
        $linkFolder = public_path('storage'); 
        dd($targetFolder, $linkFolder, symlink($targetFolder, $linkFolder));
        symlink($targetFolder, $linkFolder);        
    } 
    else if ($currentBranch === 'pre-production') 
    {
        // dd($targetFolder); // "/home/epicjszd/repositories/preprod-epicgamenews/storage/app/public"
        // dd(public_path('storage')); // "/home/epicjszd/repositories/preprod-epicgamenews/public/storage"
        $linkFolder = public_path('storage'); 
        symlink($targetFolder, $linkFolder);
    } 
    else if ($currentBranch === 'production') 
    {        
        // dd($targetFolder); // "/home/epicjszd/public_html/storage/app/public"
        // dd(public_path('storage')); // "/home/epicjszd/public_html/public/storage"
        $linkFolder = public_path('storage'); 
        symlink($targetFolder, $linkFolder);
    }

    return redirect()->route('home');
});

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