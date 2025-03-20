<?php

namespace Database\Factories;

use App\Models\AlumniProfile;
use App\Models\Event;
use App\Models\RSVP;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RSVP>
 */
class RSVPFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = RSVP::class;
    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
            'alumni_id' => AlumniProfile::factory(),
        ];
    }
}
