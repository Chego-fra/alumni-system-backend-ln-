<?php
namespace App\Traits\ModelHelpers;

trait CareerModelHelper
{
    public function getJobSummary(): string
    {
        return "{$this->title} at {$this->company} ({$this->location})";
    }

    public function getFormattedDatePosted(): string
    {
        return optional($this->date_posted)->format('F j, Y'); // e.g., April 14, 2025
    }

    public function getTotalReplies(): int
    {
        return $this->careerReplies()->count();
    }

    public function isRecentlyPosted(): bool
    {
        return $this->date_posted >= now()->subDays(7);
    }

    public function hasImage(): bool
    {
        return !empty($this->image);
    }

    public function getPostedByName(): ?string
    {
        return optional($this->postedBy)->name;
    }
}