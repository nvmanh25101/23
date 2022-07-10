<?php

namespace Database\Factories;

use App\Enums\TeacherLevelEnum;
use App\Enums\TeacherStatusEnum;
use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
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
            'password' => $this->faker->password,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'gender' => $this->faker->boolean,
            'birthdate' => $this->faker->dateTimeBetween('-50 years', '-25 years'),
            'level' => $this->faker->randomElement(TeacherLevelEnum::getValues()),
            'status' => $this->faker->randomElement(TeacherStatusEnum::getValues()),
            'faculty_id' => Faculty::query()->inRandomOrder()->value('id'),
        ];
    }
}
