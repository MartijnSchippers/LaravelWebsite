<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use \App\Models\User;
use \App\Models\Admin;
use \App\Models\Course;
use \App\Models\CoursesUser;
use \App\Models\Publification;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $user_1 = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => bcrypt('password123')
        ]);

        $user_2 = User::factory()->create([
        'name' => 'Test User 2',
        'email' => 'test2@example.com',
        'password' => bcrypt('password123')
        ]);

        $super_user = User::factory()->create([
        'name' => 'Martijn Schippers',
        'email' => 'martijn.schippers2@gmail.com',
        'password' => bcrypt('password123')
        ]);

        $admin = Admin::create([
            'user_id' => $super_user->id
        ]);
        
        // create courses
        $c1 = Course::create([
            'title' => 'Lorum Ipsum',
            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>',
            'admin_id' => $admin->id,
            'slug' => 'lorum-ipsum1'
        ]);

        $c2 = Course::create([
            'title' => 'Lorum Ipsum 2',
            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>',
            'admin_id' => $admin->id,
            'slug' => 'lorum-ipsum2'
        ]);

        $c3 = Course::create([
            'title' => 'Lorum Ipsum 3',
            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>',
            'admin_id' => $admin->id,
            'slug' => 'lorum-ipsum3'
        ]);

        // add users to courses
        CoursesUser::create([
            'course_id' => $c1->id,
            'user_id' => $user_1->id
        ]);

        CoursesUser::create([
            'course_id' => $c1->id,
            'user_id' => $super_user->id
        ]);


        CoursesUser::create([
            'course_id' => $c2->id,
            'user_id' => $user_1->id
        ]);

        CoursesUser::create([
            'course_id' => $c3->id,
            'user_id' => $user_1->id
        ]);

        Publification::create([
            'course_id' => $c1->id,
            'price' => 999.99
        ]);

        Publification::create([
            'course_id' => $c2->id,
            'price' => 800.00
        ]);
    }
}
