<?php

namespace App\Http\Controllers;

use App\Services\AiService;
use App\Services\ImageGenerator;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GenerateImageController extends Controller
{
    public function __invoke(Request $request, ImageGenerator $imageGenerator)
    {
        return view('examples.generate', ['image' => $imageGenerator->generate('A beautiful sunset')]);
    }
}
