<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Actions\DeleteableInterface;
use App\Contracts\Actions\UpdateableInterface;
use App\Contracts\Repositories\CarRepositoryInterface;
use App\DTOs\CarDTO;
use App\Events\Car\DeleteCarEvent;
use App\Facades\ImageManager;
use App\Http\Requests\CarAddRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Event;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CarResourceCollection;

class CarController extends Controller
{
    public function __construct(
        private UpdateableInterface $updateCar,
        private DeleteableInterface $deleteCar,
        private CarRepositoryInterface $carRepository,
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        $cars = $this->carRepository->getPaginatedCars($request->search);

        return response()->json(
            new CarResourceCollection($cars)
        );
    }

    public function store(CarAddRequest $request): JsonResponse
    {
        $carDto = CarDTO::fromRequest($request);
        $car = $this->carRepository->createCar($carDto->toArray());
        ImageManager::add($request, $car);

        return response()->json(
            new CarResource($car),
            Response::HTTP_CREATED
        );
    }

    public function show(Car $car): JsonResponse
    {
        return response()->json(
            new CarResource($car)
        );
    }

    public function update(CarUpdateRequest $request, Car $car): JsonResponse
    {
        $carDto = CarDTO::fromRequest($request);
        ImageManager::update($request, $car);
        $this->updateCar->handle($car, $carDto->toArray());

        return response()->json(
            new CarResource($car),
            Response::HTTP_OK
        );
    }

    public function destroy(Car $car): JsonResponse
    {
        $this->deleteCar->handle($car);
        Event::dispatch(new DeleteCarEvent($car));

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}