<?php
namespace App\Traits\ModelHelpers;

use Illuminate\Support\Carbon;

trait EventModelHelper
{
    public function isUpcoming(): bool
    {
        return $this->date && Carbon::parse($this->date)->isFuture();
    }

    public function getFormattedDate(): string
    {
        return $this->date ? Carbon::parse($this->date)->format('F j, Y') : 'N/A';
    }

    public function getEventSchedule(): string
    {
        $date = $this->getFormattedDate();
        return "{$date} at {$this->time}";
    }

    public function getRsvpCount(): int
    {
        return $this->rsvps()->count();
    }

    public function isPast(): bool
    {
        return $this->date && Carbon::parse($this->date)->isPast();
    }

    public function getSummary(): string
    {
        return "{$this->title} - {$this->location} on " . $this->getFormattedDate();
    }
}