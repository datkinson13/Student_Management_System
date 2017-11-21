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
            'name' => 'First Aid',
            'subtitle' => 'Learn to identify and eliminate potentially hazardous conditions in their environment, recognize emergencies and make appropriate decisions for first aid care.',
            'description' => 'The purpose of this course is to help participants identify and eliminate potentially hazardous conditions in their environment, recognize emergencies and make appropriate decisions for first aid care. It teaches skills that participants need to know in order to provide immediate care for a suddenly ill or injured person until more advanced medical care arrives to take over.',
            'StartDate' => '2018-01-08',
            'EndDate' => '2018-01-10',
            'CourseTime' => '09:00 AM',
            'days_valid' => 365,
            'user_id' => 1
        ]);

        Course::create([
            'name' => 'Provide Cardiopulmonary Resuscitation (CPR)',
            'subtitle' => 'Learn the necessary skills to provide cardiopulmonary resuscitation',
            'description' => 'This nationally recognised course provides participants with the necessary skills to provide cardiopulmonary resuscitation (CPR) in accordance with the Australian Resuscitation Council guidelines.',
            'StartDate' => '2018-02-01',
            'EndDate' => '2018-02-01',
            'CourseTime' => '10:00 AM',
            'days_valid' => 365,
            'user_id' => 1
        ]);

        Course::create([
            'name' => 'Electrical Appreciation and Awareness Training',
            'subtitle' => 'Electrical Appreciation and Awareness Training suitable for mechanical and operations personnel to provide an understanding of electrical safety and operation of electrical equipment.',
            'description' => 'Electrical Appreciation and Awareness Training suitable for mechanical and operations personnel to provide an understanding of electrical safety and operation of electrical equipment. The course is assessed and a certificate is provided on successful completion. The course is recommended as a refresher every 2 years and for new personnel on commencement of employment.',
            'StartDate' => '2018-01-23',
            'EndDate' => '2018-01-23',
            'CourseTime' => '08:00 AM',
            'days_valid' => 365,
            'user_id' => 1
        ]);

        Course::create([
            'name' => 'Welding Electrical Safety Course',
            'subtitle' => 'Welding Electrical Safety awareness course suitable for maintenance personnel, health and safety personnel, supervisors or senior managers.',
            'description' => 'Welding Electrical Safety awareness course suitable for maintenance personnel, health and safety personnel, supervisors or senior managers. Competency Training, in conjunction with the Welding Technology Institute of Australia (WTIA), has developed a course to raise awareness among personnel. The course is based on WTIA technical notes 7 (Health and Safety in Welding) and 22 (Welding Electrical Safety) and covers many topics.',
            'StartDate' => '2018-01-24',
            'EndDate' => '2018-01-24',
            'CourseTime' => '1:00 PM',
            'days_valid' => 365,
            'user_id' => 1
        ]);

        Course::create([
            'name' => 'Fundamentals in Project Management',
            'subtitle' => 'Intended for experienced project managers seeking to upgrade their qualifications.',
            'description' => 'This Fundamentals in Project Management course is intended for experienced project managers seeking to upgrade their qualifications, senior tradespeople and engineers involved with project management in an engineering, operations or maintenance environment. The Fundamentals in Project Management course can lead to completion of the Certificate IV Project Management or Diploma Project Management.',
            'StartDate' => '2018-01-16',
            'EndDate' => '2018-01-17',
            'CourseTime' => '08:00 AM',
            'days_valid' => 365,
            'user_id' => 1
        ]);

        Course::create([
            'name' => 'Work Safely at Heights',
            'subtitle' => 'Delivered at one of Competency Training’s national training centres, or at a client’s facility.',
            'description' => 'This nationally recognised course covers the requirements for working safely at heights. It should be noted that licensing, legislative, regulatory and certification requirements that apply to this unit can vary between states, territories, and Industry sectors. Relevant information must be sourced prior to application of the unit.',
            'StartDate' => '2018-01-19',
            'EndDate' => '2018-01-19',
            'CourseTime' => '08:00 AM',
            'days_valid' => 365,
            'user_id' => 1
        ]);
    }
}
