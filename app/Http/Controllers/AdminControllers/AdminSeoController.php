<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminSeoController extends Controller
{
    public function editSeoHome() {
        
        $title = 'title';
        $description = 'description';
        $keywords = 'keywords';
        
        return view('admin_dashboard.seo.seo_home', [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
        ]);
    }

    public function editSeoVideoGames() {    
        
        $title = 'title';   
        $description = 'description';
        $keywords = 'keywords';
        
        return view('admin_dashboard.seo.seo_video_games', [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
        ]);
    }

    public function editSeoCategories() {    
        
        $title = 'title';   
        $description = 'description';
        $keywords = 'keywords';
        
        return view('admin_dashboard.seo.seo_categories', [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
        ]);
    }

    public function editSeoPlatforms() {    
        
        $title = 'title';   
        $description = 'description';
        $keywords = 'keywords';
        
        return view('admin_dashboard.seo.seo_platforms', [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
        ]);
    }

    public function editSeoAbout() {    
        
        $title = 'title';   
        $description = 'description';
        $keywords = 'keywords';
        
        return view('admin_dashboard.seo.seo_about', [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
        ]);
    }

    public function editSeoContact() {    
        
        $title = 'title';   
        $description = 'description';
        $keywords = 'keywords';
        
        return view('admin_dashboard.seo.seo_contact', [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
        ]);
    }
}
