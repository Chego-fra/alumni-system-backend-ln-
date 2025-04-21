<?php

namespace Database\Factories;

use App\Models\Events;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Events>
 */
class EventsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Events::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3), 
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'location' => $this->faker->address(),
            'description' => 'An opportunity to connect with alumni and industry professionals.',
            'organizer' => 'Alumni Association',
            'attendees' => $this->faker->numberBetween(50, 200),
            'image' => $this->faker->imageUrl(400, 300, 'events'),
        ];
    }
}
