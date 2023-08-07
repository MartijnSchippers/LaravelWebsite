<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use \App\Models\User;
use \App\Models\Admin;
use \App\Models\AdminNotification;
use \App\Models\Course;
use \App\Models\CoursesUser;
use \App\Models\Publication;
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

        $martijn = User::factory()->create([
        'name' => 'Martijn Schippers',
        'email' => 'martijn@martijn.com',
        'password' => bcrypt('password123')
        ]);

        $admin = Admin::create([
            'user_id' => $martijn->id
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

        // Make course a publication
        Publication::create([
            'course_id' => $c1->id,
            'price' => 999.99,
            'is_active' => 1
        ]);

        Publication::create([
            'course_id' => $c2->id,
            'price' => 800.00,
            'is_active' => 0
        ]);

        // give users access to publications
        $user_1->giveAccessToPublication($c1->id);
        $user_2->giveAccessToPublication($c2->id);

        // create notifications about users having access
        AdminNotification::create([
            'message' => 'Welcome, the system is ready for action'
        ]);
    }
}
