<?php

namespace Database\Factories;

use App\Models\Career;
use App\Models\AlumniProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CareerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Career::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle(),
            'company' => $this->faker->company(),
            'location' => $this->faker->city(),
            'description' => $this->faker->paragraph(),
            'requirements' => '2+ years of experience, proficiency in PHP & Laravel.',
            'posted_by' => AlumniProfile::factory(),
            'image' => $this->faker->imageUrl(400, 300, 'business'),
            'date_posted' => now(),
        ];
    }
}
