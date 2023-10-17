<?php

namespace App\Http\Controllers\AdminControllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as ImageManager;

class AdminCropResizeImage extends Controller
{
    public function cropResizeImage(Request $request, $maxWidth, $maxHeight, $store) {
        $thumbnail = $request->file('thumbnail');
        $filename = $thumbnail->getClientOriginalName();
        $file_extension = $thumbnail->getClientOriginalExtension();

        // Get the base64-encoded image data from the request and decode it into binary format and save it using Laravel's Storage facade
        $croppedImageData = $request->input('croppedImageData');
        $croppedImageBinary = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedImageData));
        Storage::disk('public')->put($store . '/' . $filename, $croppedImageBinary);

        // Create an Intervention Image instance from the binary data
        $croppedImage = ImageManager::make($croppedImageBinary);
        
        // Resize
        if ($croppedImage->width() > $maxWidth || $croppedImage->height() > $maxHeight) {
            $croppedImage->resize($maxWidth, $maxHeight, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        // Set the local time to Romanian hour and format it
        $date = Carbon::now();
        $date = Carbon::create($date->year, $date->month, $date->day, $date->hour + 3, $date->minute, $date->second);
        $formattedDate = $date->format('Y-m-d-G-i-s');

        // Modify the filename to include author name and date
        $resizedImageName = $formattedDate . '-' . Auth::user()->name . '-' . $filename;

        // Save the resized image using Laravel's Storage facade
        $resizedImagePath = $store . '/' . $resizedImageName;
        Storage::disk('public')->put($resizedImagePath, $croppedImage->stream());

        // Delete the old image
        Storage::disk('public')->delete($store . '/' . $filename);

        // Return the image data
        $imageData = [
            'name' => $resizedImageName,
            'extension' => $file_extension,
            'path' => $resizedImagePath,
        ];

        return $imageData;
    }
}
