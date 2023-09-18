<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Category;
use App\Models\Other;
use App\Models\VideoGame;

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
            'video_game_id' => VideoGame::all()->random()->id,
            'category_id' => Category::all()->random()->id,
            'other_id' => Other::all()->random()->id,
            'author_thumbnail' => $this->faker->sentence(), 
        ];
    }
}
