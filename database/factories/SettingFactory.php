<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_text' => $this->faker->paragraph(),
            'second_text' => $this->faker->paragraph(),
            'first_image' => 'blog_template/images/about-img-1.jpg',
            'second_image' => 'blog_template/images/about-img-2.jpg',
            'our_mission' => $this->faker->paragraph(),
            'our_vision' => $this->faker->paragraph(),
            'services' => $this->faker->paragraph(),
        ];
    }
}
