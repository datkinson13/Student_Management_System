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
/*        Course::create([
            'name' => 'First Aid',
            'subtitle' => 'Learn to identify and eliminate potentially hazardous conditions in their environment, recognize emergencies and make appropriate decisions for first aid care.',
            'description' => 'The purpose of this course is to help participants identify and eliminate potentially hazardous conditions in their environment, recognize emergencies and make appropriate decisions for first aid care. It teaches skills that participants need to know in order to provide immediate care for a suddenly ill or injured person until more advanced medical care arrives to take over.',
            'StartDate' => '2017-11-15',
            'EndDate' => '2017-11-20',
            'CourseTime' => '10:00:00',
            'user_id' => 1
        ]);

        Course::create([
            'name' => 'First Aid v2',
            'subtitle' => 'Learn to identify and eliminate potentially hazardous conditions in their environment, recognize emergencies and make appropriate decisions for first aid care.',
            'description' => 'The purpose of this course is to help participants identify and eliminate potentially hazardous conditions in their environment, recognize emergencies and make appropriate decisions for first aid care. It teaches skills that participants need to know in order to provide immediate care for a suddenly ill or injured person until more advanced medical care arrives to take over.',
            'StartDate' => '2017-11-15',
            'EndDate' => '2017-11-20',
            'CourseTime' => '10:00:00',
            'user_id' => 1
        ]);

        Course::create([
            'name' => 'First Aid v3',
            'subtitle' => 'Learn to identify and eliminate potentially hazardous conditions in their environment, recognize emergencies and make appropriate decisions for first aid care.',
            'description' => 'The purpose of this course is to help participants identify and eliminate potentially hazardous conditions in their environment, recognize emergencies and make appropriate decisions for first aid care. It teaches skills that participants need to know in order to provide immediate care for a suddenly ill or injured person until more advanced medical care arrives to take over.',
            'StartDate' => '2017-11-15',
            'EndDate' => '2017-11-20',
            'CourseTime' => '10:00:00',
            'user_id' => 1
        ]);*/

        Course::create([
            'name' => 'First Aid',
            'subtitle' => 'Learn to identify and eliminate potentially hazardous conditions in their environment, recognize emergencies and make appropriate decisions for first aid care.',
            'description' => 'test',
            'StartDate' => '2017-11-15',
            'EndDate' => '2017-11-20',
            'CourseTime' => '10:00:00',
            'user_id' => 1
        ]);
        Course::create([
            'name' => 'First Aid v2',
            'subtitle' => 'Learn to identify and eliminate potentially hazardous conditions in their environment, recognize emergencies and make appropriate decisions for first aid care.',
            'description' => 'test',
            'StartDate' => '2017-11-15',
            'EndDate' => '2017-11-20',
            'CourseTime' => '10:00:00',
            'user_id' => 1
        ]);
        Course::create([
            'name' => 'First Aid v3',
            'subtitle' => 'Learn to identify and eliminate potentially hazardous conditions in their environment, recognize emergencies and make appropriate decisions for first aid care.',
            'description' => 'test',
            'StartDate' => '2017-11-15',
            'EndDate' => '2017-11-20',
            'CourseTime' => '10:00:00',
            'user_id' => 1
        ]);
    }
}
