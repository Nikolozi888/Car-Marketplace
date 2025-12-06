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
        self: ნიშნავს ამჟამინდელ კლასს, სადაც ეს სიტყვა წერია
        ანუ ჩვენ რო დავწეროთ return CarDTO იგივეა რაც return new self
    */
    /*
        static სიტყვა fromRequest-ს საშუალებას აძლევს, რომ გამოიძახოთ ფუნქცია ობიექტის შექმნის გარეშე
        თუ static-ს არ დავწერდით მოგვიწევდა ჯერ ცარიელი ობიექტის შექმნა და მერე მნიშვნელობების მინიჭება
    */
    public static function fromRequest(Request $request): self // აბრუნებს CarDTO ობიექტს
    {        
        $data = $request->validated();

        return new self(            // იგივეა რაც return new CarDTO()
            centerId: $data['center_id'],
            make: $data['make'],
            model: $data['model'],
            year: (int)$data['year'],
            price: (float)$data['price'],
            description: $data['description'],
        );
    }

    /*
        ამ ფუნქციაში არ დავწერეთ static იმიტომ რომ ჩვენ გვჭირდება კონკრეტული მანქანის თვისებების წამოღება
        toArray()-ის მიზანია მიმდინარე DTO ობიექტის შიგნით არსებული მონაცემების ამოღება და მასივის სახით დაბრუნება.
     */
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
