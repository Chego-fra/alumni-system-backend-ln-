<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CareerRepliesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => CareerRepliesResource::collection($this->collection),
            'meta' => [
                'total' => $this->total(),
                'current_page' => $this->currentPage(),
                'per_page' => $this->perPage(),
                'last_page' => $this-> lastPage(),
            ],
        ];
    }

    public function with($request){
        return [
            'status' => 'success'
        ];
    }

    public function withResponse($request, $response){
        $response->header('Accept', 'application/json');
        $response->header('Version', '1.0.0');
    }
}
