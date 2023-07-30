<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{public function test(Request $request)
    { 
        //// old Code
        // $file = request()->file('file');
        // $filename = $file->getClientOriginalName();
        // $path = $file->storeAs('tinymce_uploads', $filename, 'public');
        // return response()->json(['location' => "/storage/$path"]);
        
        //// saves images with the name you want
        // the parameter from file() method, MUST be the same with the the second parameter of the setAttribute() method inside create.blade
        $fileName = request()->file('file')->getClientOriginalName();
        // first parameter of storeAs() method is the folder where images are saved, inside storage folder
        $path = $request->file('file')->storeAs('tinymce_uploads', $fileName, 'public');
        return response()->json(['location' => "/storage/$path"]);

        //// saves images with a random name
        // the parameter from file() method, MUST be the same with the the second parameter of the setAttribute() method inside create.blade
        // first parameter of store() method is the folder where images are saved, inside storage folder
        // $imgpath = request()->file('file')->store('tinymce_uploads', 'public');
        // return response()->json(['location' => "/storage/$imgpath"]);
    }
}
