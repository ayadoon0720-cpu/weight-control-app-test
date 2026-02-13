<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogFactory extends Factory
{
    public function definition(): array
    {
      return [
        'user_id' => 1, // Seeder側で上書きするので仮でOK
        'date' => $this->faker->dateTimeBetween('-35 days', 'now')->format('Y-m-d'),
        'weight' => $this->faker->randomFloat(1, 40, 90),
        'calories' => $this->faker->numberBetween(1200, 3000),
        'exercise_time' => $this->faker->time('H:i:s'),
        'exercise_content' => $this->faker->realText(30),
      ];
    }

}
