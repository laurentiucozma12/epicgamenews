<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AboutFactory extends Factory
{
    public function definition(): array
    {
        return [
            'about_first_text' => $this->faker->paragraph(),
            'about_second_text' => $this->faker->paragraph(),
            'about_our_mission' => $this->faker->paragraph(),
            'about_our_vision' => $this->faker->paragraph(),
            'about_services' => $this->faker->paragraph(),
        ];
    }
}
