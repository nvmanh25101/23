<?php

namespace Database\Factories;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'credit' => $this->faker->numberBetween(1, 4),
            'faculty_id' => Faculty::query()->inRandomOrder()->value('id'),
        ];
    }
}
