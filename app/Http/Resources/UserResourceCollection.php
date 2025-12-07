<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserResourceCollection extends ResourceCollection
{
    public static $wrap = "users";

    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'cars' => CarResource::collection($user->whenLoaded('cars'))
                ];
            }),
        ];
    }

    public function with(Request $request): array
    {
        return [
            'meta' => [
                'key' => 'value'
            ]
        ];
    }
}
