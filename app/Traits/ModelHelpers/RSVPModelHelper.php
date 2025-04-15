<?php
namespace App\Traits\ModelHelpers;

trait RSVPModelHelper
{
    public function isForEvent(int $eventId): bool
    {
        return $this->event_id === $eventId;
    }

    public function isByAlumni(int $alumniId): bool
    {
        return $this->alumni_id === $alumniId;
    }

    public function getAlumniName(): ?string
    {
        return $this->alumni?->name;
    }

    public function getEventTitle(): ?string
    {
        return $this->event?->title;
    }

    public function isRelationshipLoaded(): bool
    {
        return $this->relationLoaded('alumni') && $this->relationLoaded('event');
    }
}

