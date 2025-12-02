<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class CarDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        // user_id არის trait-ში
        public int $centerId,
        public string $make,
        public string $model,
        public int $year,
        public float $price,
        public string $description,
    ){ }

    /*
        self: ნიშნავს ამჟამინდელ კლასს,
        ანუ ჩვენ რო დავწეროთ return CarDTO იგივეა რაც return new self
    */
    public static function fromRequest(Request $request): self
    {        
        $data = $request->validated();

        return new self(
            centerId: $data['center_id'],
            make: $data['make'],
            model: $data['model'],
            year: (int)$data['year'],
            price: (float)$data['price'],
            description: $data['description'],
        );
    }

    public function toArray(): array
    {
        return [
            'center_id' => $this->centerId,
            'make' => $this->make,
            'model' => $this->model,
            'year' => $this->year,
            'price' => $this->price,
            'description' => $this->description,
        ];
    }
}
