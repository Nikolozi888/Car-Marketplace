<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class CenterDTO
{
    public function __construct(
        public string $name,
        public string $address,
        public string $number,
        public string $email,
    ){ }

    public static function fromRequest(Request $request): self
    {        
        $data = $request->validated();

        return new self(
            name: $data['center_name'],
            address: $data['address'],
            number: $data['number'],
            email: $data['email'],
        );
    }

    public function toArray(): array
    {
        return [
            'center_name' => $this->name,
            'address' => $this->address,
            'number' => $this->number,
            'email' => $this->email,
        ];
    }

}
