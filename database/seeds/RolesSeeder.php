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
        // Create some static sample data.
        $administrator = Role::create([
            'name' => 'Administrator',
            'slug' => 'administrator',
            'permissions' => [
                'change-permissions' => true,
                'create-courses' => true
            ]
        ]);
        $facilitator = Role::create([
            'name' => 'Facilitator',
            'slug' => 'facilitator',
            'permissions' => [
                'create-courses' => true
            ]
        ]);
    }
}
