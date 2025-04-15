<?php
namespace App\Traits\ModelHelpers;

trait ResourceModelHelper
{
    public function hasFile(): bool
    {
        return !empty($this->file_url);
    }

    public function hasVideo(): bool
    {
        return !empty($this->video_url);
    }

    public function getImageUrl(): string
    {
        return asset('storage/' . ltrim($this->image, '/'));
    }

    public function getShortDescription(int $limit = 60): string
    {
        return strlen($this->description) > $limit
            ? substr($this->description, 0, $limit) . '...'
            : $this->description;
    }

    public function getCategoryTag(): string
    {
        return match (strtolower($this->category)) {
            'ebook' => '📚',
            'video' => '🎬',
            'pdf' => '📄',
            'tutorial' => '🧑‍🏫',
            default => '📁',
        };
    }

    public function getFormattedDate(): string
    {
        return optional($this->date_posted)->format('F j, Y');
    }
}