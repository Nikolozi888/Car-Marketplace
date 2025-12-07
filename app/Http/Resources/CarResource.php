<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->additional['summary_view'] ?? false) {
            return [
                'make' => $this->make,
                'model' => $this->model,
                'price' => $this->price,
            ];
        }

        return [
            'id' => $this->id,
            'make' => $this->make,
            'model' => $this->model,
            'year' => $this->year,
            'price' => $this->price,
            'status_label' => $this->getStatusAttribute(),
            'age_in_years' => $this->getAgeAttribute(),
            'is_new' => $this->isNew(),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
