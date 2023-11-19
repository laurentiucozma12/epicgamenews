<?php

namespace App\Http\Controllers\AdminControllers;

use Carbon\Carbon;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as ImageManager;

class AdminCropResizeImage extends Controller
{

    public function optimizeImage(Request $request, $maxWidth, $maxHeight, $store)
    {        
        // Convert the cropped JPG/PNG image to a WebP image
        list($convertedImage, $filename) = $this->convertToWebp($request);

        // Resize the WebP image
        $this->resizeImage($convertedImage, $maxWidth, $maxHeight);       

        // Save the WebP image using Laravel's Storage facade
        Storage::disk('public')->put($store . '/' . $filename . '.webp', $convertedImage->stream());

        // Return the image data
        $imageData = [
            'name' => $filename,
            'extension' => 'webp',
            'path' => $store . '/' . $filename . '.webp',
        ];

        return $imageData;
    }

    public function deleteOldImage($object)
    {
        // Retrieve the old image ID
        $oldImageId = $object->image->id ?? null;

        // Declare $oldImage variable
        $oldImage = null;

        // Check if there is an old image associated
        if ($oldImageId) {
            // Find the old image record from the database
            $oldImage = Image::find($oldImageId);

            // Delete the old image record from the database
            Image::destroy($oldImageId);

            // Delete the old image file from storage
            // Note: Ensure to adjust the path based on your storage configuration
            Storage::delete("public/{$oldImage->path}");
        }
    }

    private function convertToWebp($request)
    {
        $thumbnail = $request->file('thumbnail');
        $filename = $thumbnail->getClientOriginalName();
        
        // Remove the original extension from the filename
        $filename = $this->imageName($filename);

        // Get the base64-encoded image data from the request and decode it into binary format and save it using Laravel's Storage facade
        $croppedImageData = $request->input('croppedImageData');
        
        // Decode the Base64-encoded data
        $croppedImageBinary = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedImageData));

        // Create an Intervention Image instance from the binary data
        $croppedImage = ImageManager::make($croppedImageBinary);

        // Convert the image to WebP format
        $croppedImage->encode('webp');

        // Return the webp image and the file name
        return [$croppedImage, $filename];
    }

    private function resizeImage($convertedImage, $maxWidth, $maxHeight)
    {
        // Resize the WebP image
        if ($convertedImage->width() > $maxWidth || $convertedImage->height() > $maxHeight) {
            $convertedImage->resize($maxWidth, $maxHeight, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
    }

    private function imageName($filename)
    {        
        // Remove the original extension from the filename
        $filename = pathinfo($filename, PATHINFO_FILENAME);

        // Set the local time to Romanian hour and format it
        $date = Carbon::now();
        $date = Carbon::create($date->year, $date->month, $date->day, $date->hour + 3, $date->minute, $date->second);
        $formattedDate = $date->format('Y-m-d-G-i-s');

        // Modify the filename to include author name and date
        $resizedImageName = $formattedDate . '-' . Auth::user()->name;

        return $resizedImageName;
    }
}
