<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\VideoGame;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(), 
            'slug'=> $this->faker->unique()->slug(), 
            'excerpt' => $this->faker->sentence(), 
            'body' => $this->faker->paragraph(), 
            'user_id' => User::all()->random()->id, 
            'video_game_id' => VideoGame::all()->random()->id,
            'author_thumbnail' => $this->faker->sentence(), 
        ];
    }
}