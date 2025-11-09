<?php

namespace App\Http\Controllers;

use App\Models\Car;

class AdminController extends Controller
{

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function carsIndex()
    {
        $cars = Car::orderBy('created_at', 'desc')->get();
        return view('admin.cars.index', ['cars' => $cars]);
    }
}