<?php

namespace Database\Seeders;

use App\Models\RSVP;
use App\Models\User;
use App\Models\Career;
use App\Models\Events;
use App\Models\Gallery;
use App\Models\Resources;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AlumniProfile;
use App\Models\CareerReplies;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Alumni User',
            'email' => 'alumni@example.com',
            'password' => Hash::make('password'),
            'role' => 'alumni',
        ]);

        User::create([
            'name' => 'Faculty User',
            'email' => 'faculty@example.com',
            'password' => Hash::make('password'),
            'role' => 'faculty',
        ]);

        AlumniProfile::factory(10)->create();
        Career::factory(5)->create();
        Events::factory(5)->create();
        Gallery::factory(5)->create();
        Resources::factory(5)->create();
        CareerReplies::factory(10)->create();
        RSVP::factory(10)->create();
    }
}
