<?php
namespace App\Traits\ModelHelpers;

trait CareerRepliesModelHelper
{
    public function getShortMessage(int $limit = 50): string
    {
        return strlen($this->message) > $limit
            ? substr($this->message, 0, $limit) . '...'
            : $this->message;
    }

    public function getCareerTitle(): ?string
    {
        return optional($this->career)->title;
    }

    public function getAlumniName(): ?string
    {
        return optional($this->alumni)->name;
    }

    public function containsKeyword(string $keyword): bool
    {
        return stripos($this->message, $keyword) !== false;
    }

    public function getReplySummary(): string
    {
        $name = $this->getAlumniName() ?? 'Unknown Alumni';
        $job = $this->getCareerTitle() ?? 'Unknown Career';
        return "{$name} replied to '{$job}'";
    }
}