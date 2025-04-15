<?php

namespace Database\Factories;

use App\Models\AlumniProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AlumniProfile>
 */
class AlumniProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = AlumniProfile::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'image' => $this->faker->imageUrl(200, 200, 'people'),
            'graduation_year' => $this->faker->year(),
            'major' => $this->faker->randomElement(['Computer Science', 'Engineering', 'Business']),
            'company' => $this->faker->company(),
            'location' => $this->faker->city(),
            'linkedin' => $this->faker->url(),
            'twitter' => $this->faker->url(),
        ];
    }
}
