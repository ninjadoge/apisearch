<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RealEstatePropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'address' => $this->address,
            'size' => $this->size,
            'bedrooms' => $this->bedrooms,
            'price' => $this->price,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
