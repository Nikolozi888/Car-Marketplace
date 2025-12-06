<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ImageManager extends Facade
{
    /*
        static-ია იმიტომ რო არ სჭირდება ობიექტის შექმნა
    */
    protected static function getFacadeAccessor()
    {
        return 'image.manager'; // ან ImageService თუ alias-ში წერია
    }
}