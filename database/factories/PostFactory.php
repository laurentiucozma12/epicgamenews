<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Category;
use App\Models\Platform;
use App\Models\Other;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(), 
            'slug'=> $this->faker->unique()->slug(), 
            'excerpt' => $this->faker->sentence(), 
            'body' => $this->faker->paragraph(), 
            'user_id' => User::factory(), 
            'category_id' => Category::all()->random()->id,
            'platform_id' => Platform::all()->random()->id,
            'other_id' => Other::all()->random()->id,
        ];
    }
}
