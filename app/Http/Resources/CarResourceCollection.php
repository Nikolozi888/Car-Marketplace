<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CarResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($cars) {
                
                if ($this->additional['summary_view'] ?? false) {
                    return [
                        'make' => $this->make,
                        'model' => $this->model,
                        'price' => $this->price,
                    ];
                }

                return [
                    'id' => $cars->id,
                    'make' => $cars->make,
                    'model' => $cars->model,
                    'year' => $cars->year,
                    'price' => $cars->price,
                    'status_label' => $cars->getStatusAttribute(),
                    'age_in_years' => $cars->getAgeAttribute(),
                    'is_new' => $cars->isNew(),
                    'created_at' => $cars->created_at->format('Y-m-d H:i:s'),
                ];
            }),
        ];
    }
}
