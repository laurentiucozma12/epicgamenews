<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Image;

class ImageFactory extends Factory
{
    public function definition(): array
    {
        // Choose random images from 1 to 10. I have images named 1.jpg 2.jpg ... 10.jpg
        $fake_image = $this->faker->randomElement(range(1, 10)) . '.jpg';

        return [
            'name' => $fake_image,
            'extension' => 'jpg',
        ];        
    }
}