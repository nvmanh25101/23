<?php

namespace Database\Factories;

use App\Enums\StudentStatusEnum;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => bcrypt(12345678),
            'status' => StudentStatusEnum::getRandomValue(),
            'classroom_id' => Classroom::query()->inRandomOrder()->value('id'),
        ];
    }
}
