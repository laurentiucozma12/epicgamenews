<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomError;

class ImageFactory extends Factory
{
    public function definition(): array
    {
        $fake_images = [
          '1.jpg',  
          '2.jpg',  
          '3.jpg',  
          '4.jpg',  
          '5.jpg',  
          '6.jpg',  
          '7.jpg',  
          '8.jpg',  
          '9.jpg',  
          '10.jpg',  
        ];

        return [
            'name' => $this->faker->word(),
            'extension' => 'jpg',
            'path' => 'images/' . $this->faker->RandomElement($fake_images),
        ];
    }
}