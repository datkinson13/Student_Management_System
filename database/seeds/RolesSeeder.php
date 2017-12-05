<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // https://laravel.com/docs/5.5/authorization#creating-policies
        // List of permissions available currently:
        // course.create
        // course.edit
        // course.delete
        // course.view
        // course.compose
        // user.create
        // user.edit
        // user.view
        // user.delete
        // user.permissions
        // businessrole.view
        // businessrole.create
        // businessrole.edit
        // businessrole.delete

        // (note: this list may not be updated. it is best to check the policies)

        // Create some static sample data.
        $administrator = Role::create([
            'name' => 'Administrator',
            'slug' => 'administrator',
            'permissions' => [
                // Admin gets all permissions. This is handled in the role class and has nothing to do with the following line.
                'all' => true
            ]
        ]);
        $facilitator = Role::create([
            'name' => 'Facilitator',
            'slug' => 'facilitator',
            'permissions' => [
                'course.create' => true,
                'course.edit' => true,
                'course.view' => true,
                'course.delete' => true,
            ]
        ]);
    }
}
