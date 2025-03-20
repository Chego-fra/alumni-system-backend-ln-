<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AlumniProfile;
use App\Models\Career;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Resource;
use App\Models\CareerReply;
use App\Models\RSVP;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        AlumniProfile::factory(10)->create();
        Career::factory(5)->create();
        Event::factory(5)->create();
        Gallery::factory(5)->create();
        Resource::factory(5)->create();
        CareerReply::factory(10)->create();
        RSVP::factory(10)->create();
    }
}
