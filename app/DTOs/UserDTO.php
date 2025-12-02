<?php

namespace App\DTOs;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public bool $isAdmin = false,
    ) {}


    public static function fromRequest(Request $request, bool $isAdmin = false): static
    {
        $validated = $request->validated();

        return new static(
            name: $validated['name'],
            email: $validated['email'],
            password: $validated['password'],
            isAdmin: $isAdmin
        );
    }
    
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'is_admin' => $this->isAdmin,
            'password' => Hash::make($this->password),
        ];
    }
}
