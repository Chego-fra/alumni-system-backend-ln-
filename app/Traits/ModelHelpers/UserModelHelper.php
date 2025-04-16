<?php
namespace App\Traits\ModelHelpers;

trait UserModelHelper
{
    public function getDisplayName(): string
    {
        return ucfirst($this->name);
    }

    public function getRoleLabel(): string
    {
        return match ($this->role) {
            'admin' => 'Administrator',
            'alumni' => 'Alumni Member',
            'faculty' => 'Faculty Staff',
            default => 'User',
        };
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function getUserSummary(): string
    {
        return "{$this->getDisplayName()} ({$this->email}) - {$this->getRoleLabel()}";
    }

    public function isVerified(): bool
    {
        return !is_null($this->email_verified_at);
    }
}