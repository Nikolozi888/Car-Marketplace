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

    /*
        static სიტყვა fromRequest-ს საშუალებას აძლევს, რომ გამოიძახოთ ფუნქცია ობიექტის შექმნის გარეშე
        თუ static-ს არ დავწერდით მოგვიწევდა ჯერ ცარიელი ობიექტის შექმნა და მერე მნიშვნელობების მინიჭება
    */
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

    /*
        ამ ფუნქციაში არ დავწერეთ static იმიტომ რომ ჩვენ გვჭირდება კონკრეტული ცენტრის თვისებების წამოღება
        toArray()-ის მიზანია მიმდინარე DTO ობიექტის შიგნით არსებული მონაცემების ამოღება და მასივის სახით დაბრუნება.
     */
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
