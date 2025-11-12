<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarAddRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Models\Car;
use App\Models\CarDetail;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $cars = Car::when($request->search, function($query)use($request){
            return $query->whereAny([
                'make',
                'model',
                'year',
                'description',
                'price',
            ], 'like', '%' . $request->search . '%');
        })->with('detail')->paginate(15);
        return view('cars.index', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarAddRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['user_id'] = 1;
        $car = Car::create($validated);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('photos', 'public');
            // ვქმნით image ჩანაწერს polymorphic კავშირის მიხედვით
            $car->images()->create([
                'path' => $imagePath,
            ]);
        }

        return redirect()->route('cars.index')->with('success', 'მანქანა წარმატებით დაემატა!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car): View
    {
        return view('cars.show', ['car' => $car]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car): View
    {
        return view('cars.edit', ['car' => $car]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarUpdateRequest $request, Car $car): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($car->image && file_exists(storage_path('app/public/' . $car->image))) {
                unlink(storage_path('app/public/' . $car->image));
            }
            $validated['image'] = $request->file('image')->store('photos', 'public');
        }

        $car->update($validated);

        return redirect()->route('cars.show', $car)->with('success', 'განცხადება განახლდა!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car): RedirectResponse
    {
        if ($car->image && file_exists(storage_path('app/public/' . $car->image))) {
            unlink(storage_path('app/public/' . $car->image));
        }
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'განცხადება წაიშალა!');
    }
}