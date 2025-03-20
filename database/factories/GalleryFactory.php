<?php

namespace Database\Factories;

use App\Models\AlumniProfile;
use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gallery>
 */
class GalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Gallery::class;
    public function definition(): array
    {
        return [
            'title' => 'Alumni Meetup',
            'type' => $this->faker->randomElement(['image', 'video']),
            'url' => $this->faker->randomElement(['/e1.jpg', 'https://www.youtube.com/embed/QHfmD4L3Zb0']),
            'description' => 'A great alumni event moment!',
            'posted_by' => AlumniProfile::factory(),
        ];
    }
}
