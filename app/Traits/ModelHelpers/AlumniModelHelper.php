<?php
namespace App\Traits\ModelHelpers;

use App\Models\Events;

trait AlumniModelHelper
{
    public function fullSocialLinks(): array
    {
        return array_filter([
            'linkedin' => $this->linkedin,
            'twitter' => $this->twitter,
        ]);
    }

    public function hasCompany(): bool
    {
        return !empty($this->company);
    }

    public function careerCount(): int
    {
        return $this->careers()->count();
    }

    public function latestCareer()
    {
        return $this->careers()->latest('created_at')->first();
    }

    public function hasRSVPedTo(Events $event): bool
    {
        return $this->rsvps()->where('event_id', $event->id)->exists();
    }

    public function scopeGraduatedIn($query, $year)
    {
        return $query->where('graduation_year', $year);
    }

    public function getProfileSummary(): string
    {
       return "{$this->name}, Class of {$this->graduation_year}, works at {$this->company}";
    }


}