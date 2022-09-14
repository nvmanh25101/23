<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Faculty::factory(10)->create();
        // Subject::factory(10)->create();
        // Teacher::factory(100)->create();
        Student::factory(100)->create();
    }
}
