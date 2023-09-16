<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminStorageLinkController extends Controller
{
    public function storageLink() {
        // Define the mapping of branch names to their respective storage paths
        $branchPaths = [
            'development',
            'pre-production',
            'production',
            ////// I forgot about this, gotta test if I can delete it storage_path('app/public') //////
            // 'production' => storage_path('app/public'), // old code
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
    }
}
