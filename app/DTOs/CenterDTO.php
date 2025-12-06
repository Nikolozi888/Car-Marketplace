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
        self: ნიშნავს ამჟამინდელ კლასს, სადაც ეს სიტყვა წერია
        ანუ ჩვენ რო დავწეროთ return CarDTO იგივეა რაც return new self
    */
    /*
        static სიტყვა fromRequest-ს საშუალებას აძლევს, რომ გამოიძახოთ ფუნქცია ობიექტის შექმნის გარეშე
        თუ static-ს არ დავწერდით მოგვიწევდა ჯერ ცარიელი ობიექტის შექმნა და მერე მნიშვნელობების მინიჭება
    */
    public static function fromRequest(Request $request): self // აბრუნებს CenterDTO ობიექტს
    {        
        $data = $request->validated();

        return new self(        // იგივეა რაც return new CenterDTO()
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
