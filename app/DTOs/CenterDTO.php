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
        return new self(
            name: $request->validated('center_name'),
            address: $request->validated('address'),
            number: $request->validated('number'),
            email: $request->validated('email'),
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
