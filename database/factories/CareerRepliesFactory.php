<?php

namespace Database\Factories;

use App\Models\Career;
use App\Models\AlumniProfile;
use App\Models\CareerReplies;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CareerRepliesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CareerReplies::class;
    public function definition(): array
    {
        return [
            'career_id' => Career::factory(),
            'alumni_id' => AlumniProfile::factory(),
            'message' => 'I am interested in this job and meet all requirements.',
        ];
    }
}
