<?php

namespace App\Services;

use App\Models\Image;

class CreateImageService {
    private $imageable_id;
    private $imageable_type;

    public function __construct($imageable_id, $imageable_type) {
        $this->imageable_id = $imageable_id; 
        $this->imageable_type = $imageable_type;
    }

    public function createImage() {  
        $name = 'thumbnail_placeholder.jpg';
        $extension = 'jpg';

        $image = new Image([
            'name' => $name,
            'extension' => $extension,
        ]);
        
        $image->imageable_id = $this->imageable_id;
        $image->imageable_type = $this->imageable_type;
        $image->save();
    }
}
