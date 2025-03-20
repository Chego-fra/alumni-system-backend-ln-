<?php

namespace Database\Factories;

use App\Models\AlumniProfile;
use App\Models\Career;
use App\Models\CareerReply;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CareerReply>
 */
class CareerReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = CareerReply::class;
    public function definition(): array
    {
        return [
            'career_id' => Career::factory(),
            'alumni_id' => AlumniProfile::factory(),
            'message' => 'I am interested in this job and meet all requirements.',
        ];
    }
}
