<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = 'user';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' =>  'alumniprofile',
            'id' => $this->id,
            'attributes' => [
                'id'             => $this->id,
                'name'           => $this->getDisplayName(),
                'email'          => $this->email,
                'role'           => $this->role,
                'role_label'     => $this->getRoleLabel(),   
                'is_verified'    => $this->isVerified(),     
                'summary'        => $this->getUserSummary(),
                'created_at'     => $this->created_at,
                'updated_at'     => $this->updated_at,
            ],
            'links' => [
                'self' => route('users.show', $this->id)
            ]
        ];
    }
}
