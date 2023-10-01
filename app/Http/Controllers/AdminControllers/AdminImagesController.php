<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class AdminImagesController extends Controller
{
    public function showUploadForm()
    {
        return view('admin_dashboard.testcropimg.upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:1920',
        ]);

        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $croppedImage = Image::make($image)->resize(425, 225, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('images/' . $filename));

        return response()->json(['status' => 'success', 'filename' => $filename]);
    }
}
