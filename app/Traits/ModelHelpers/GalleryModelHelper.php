<?php
namespace App\Traits\ModelHelpers;

trait GalleryModelHelper
{
    public function isImage(): bool
    {
        return strtolower($this->type) === 'image';
    }

    public function isVideo(): bool
    {
        return strtolower($this->type) === 'video';
    }

    public function getFullMediaUrl(): string
    {
        return asset('storage/' . ltrim($this->file_path, '/'));
    }

    public function getShortTitle(int $limit = 30): string
    {
        return strlen($this->title) > $limit
            ? substr($this->title, 0, $limit) . '...'
            : $this->title;
    }

    public function getDescriptionPreview(int $limit = 50): string
    {
        return strlen($this->description) > $limit
            ? substr($this->description, 0, $limit) . '...'
            : $this->description;
    }

    public function getTypeIcon(): string
    {
        return $this->isImage() ? '🖼️' : ($this->isVideo() ? '🎥' : '📁');
    }
}