<?php

namespace App\Http\Controllers;

use App\Contracts\Actions\CreateableInterface;
use App\Contracts\Actions\DeleteableInterface;
use App\Contracts\Actions\UpdateableInterface;
use App\Contracts\Repositories\CarRepositoryInterface;
use App\Events\Car\CarUpdated;
use App\Events\Car\DeleteCarEvent;
use App\Http\Requests\CarAddRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Models\Car;
use App\Services\Car\AddImageService;
use App\Services\Car\UpdateImageService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CarController extends Controller
{
    public function __construct(
        // private CreateableInterface $createCar,
        private UpdateableInterface $updateCar,
        private DeleteableInterface $deleteCar,
        private AddImageService $addImage,
        private UpdateImageService $updateImage,
        private CarRepositoryInterface $carRepository,
    ) {
    }

    public function index(Request $request): View
    {
        $cars = $this->carRepository->getPaginatedCars($request->search);

        return view('cars.index', compact('cars'));
    }

    public function create(): View
    {
        return view('cars.create');
    }

    public function store(CarAddRequest $request): RedirectResponse
    {
        // User ID-ს მინიჭება Trait-ში გადავიდა,
        // ამიტომ აქ შეგვიძლია პირდაპირ validated გადავცეთ.
        $validated = $request->validated();

        $car = $this->carRepository->createCar($validated);

        // სურათის ატვირთვა რჩება კონტროლერში (რადგან Request-ს ეხება)
        $this->addImage->execute($request, $car);

        // ნოტიფიკაცია წაიშალა აქედან -> გადავიდა Observer-ის "created"-ში

        // event არის Observer

        return $this->successRedirect('cars.index', 'მანქანა წარმატებით დაემატა!');
    }

    public function show(Car $car): View
    {
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car): View
    {
        $this->authorize('update', $car);

        return view('cars.edit', compact('car'));
    }

    public function update(CarUpdateRequest $request, Car $car): RedirectResponse
    {
        $this->authorize('update', $car);

        $validated = $request->validated();

        $this->updateImage->execute($request, $car);

        $this->updateCar->handle($car, $validated);

        // Fire event
        // CarUpdated::dispatch($car); -> გადავიდა model-ში

        return $this->successRedirect('cars.show', 'მანქანა წარმატებით განახლდა!', $car);
    }

    public function destroy(Car $car): RedirectResponse
    {
        $this->authorize('delete', $car);

        // UnlinkImage ამოვიღეთ აქედან -> გადავიდა Observer-ის "deleted"-ში.
        // როგორც კი deleteCar->handle($car) შესრულდება, Observer-ი ავტომატურად წაშლის სურათს.

        $this->deleteCar->handle($car);

        event(new DeleteCarEvent($car));

        return $this->successRedirect('cars.index', 'მანქანა წარმატებით წაიშალა!');
    }
}