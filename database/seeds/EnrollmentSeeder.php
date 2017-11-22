<?php

use Illuminate\Database\Seeder;
use App\Enrollment;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Enrollment::create([
            'user_id' => 2,
            'course_id' => 1
        ]);

        Enrollment::create([
            'user_id' => 2,
            'course_id' => 2
        ]);

        Enrollment::create([
            'user_id' => 2,
            'course_id' => 3
        ]);

        Enrollment::create([
            'user_id' => 2,
            'course_id' => 4
        ]);

        Enrollment::create([
            'user_id' => 2,
            'course_id' => 5
        ]);

        Enrollment::create([
            'user_id' => 2,
            'course_id' => 6
        ]);

        Enrollment::create([
            'user_id' => 4,
            'course_id' => 3
        ]);

        Enrollment::create([
            'user_id' => 4,
            'course_id' => 5
        ]);
    }
}
