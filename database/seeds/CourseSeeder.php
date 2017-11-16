<?php

use Illuminate\Database\Seeder;
use App\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'name' => str_random(10),
            'subtitle' => str_random(50),
            'description' => str_random(250),
            'StartDate' => '2017-11-15',
            'EndDate' => '2017-11-20',
            'CourseTime' => '10:00:00',
            'user_id' => 1
        ]);
    }
}
