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

    /*
        static სიტყვა fromRequest-ს საშუალებას აძლევს, რომ გამოიძახოთ ფუნქცია ობიექტის შექმნის გარეშე
        თუ static-ს არ დავწერდით მოგვიწევდა ჯერ ცარიელი ობიექტის შექმნა და მერე მნიშვნელობების მინიჭება
    */
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
    
    /*
        ამ ფუნქციაში არ დავწერეთ static იმიტომ რომ ჩვენ გვჭირდება კონკრეტული მომხმარებლის თვისებების წამოღება
        toArray()-ის მიზანია მიმდინარე DTO ობიექტის შიგნით არსებული მონაცემების ამოღება და მასივის სახით დაბრუნება.
     */
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
