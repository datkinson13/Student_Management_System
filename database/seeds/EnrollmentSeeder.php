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
            'user_id' => 1,
            'course_id' => 1,
            'ExpiryDate' => "2017-12-10"
        ]);

        Enrollment::create([
            'user_id' => 1,
            'course_id' => 2,
            'ExpiryDate' => "2018-01-10"
        ]);

        Enrollment::create([
            'user_id' => 1,
            'course_id' => 3,
            'ExpiryDate' => "2018-06-10"
        ]);
    }
}
