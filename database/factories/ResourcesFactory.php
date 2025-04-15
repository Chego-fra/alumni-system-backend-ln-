<?php

namespace Database\Factories;

use App\Models\Resources;
use App\Models\AlumniProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resources>
 */
class ResourcesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Resources::class;
    public function definition(): array
    {
        return [
            'title' => 'LinkedIn Optimization for Job Seekers',
            'category' => 'Career',
            'description' => 'Learn how to optimize your LinkedIn profile.',
            'file_url' => '/resources/interview_Guide.pdf',
            'video_url' => 'https://www.youtube.com/embed/QHfmD4L3Zb0',
            'posted_by' => AlumniProfile::factory(),
            'date_posted' => now(),
            'image' => $this->faker->imageUrl(400, 300, 'resources'),
        ];
    }
}
