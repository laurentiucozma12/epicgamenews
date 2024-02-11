<?php

namespace Database\Factories;

use App\Models\Seo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeoFactory extends Factory
{
    protected $model = Seo::class;

    public function definition(): array
    {
        return [
            'page_name' => $this->faker->sentence(),
            'page_type' => $this->faker->sentence(),
            'seo_name' => $this->faker->sentence(),
            'seo_title' => $this->faker->sentence(),
            'seo_description' => $this->faker->paragraph(),
            'seo_keywords' => $this->faker->words(5, true),
            'user_id' => User::first(),
        ];
    }
}
