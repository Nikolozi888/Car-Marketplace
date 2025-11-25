<?php

namespace App\Http\Controllers;

use App\Actions\CheckGateAction;
use App\Actions\UnlinkImageAction;
use App\Contracts\Actions\CreateableInterface;
use App\Contracts\Actions\DeleteableInterface;
use App\Contracts\Actions\UpdateableInterface;
use App\Http\Requests\CarAddRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Models\Car;
use App\Services\Car\AddImageService;
use App\Services\Car\UpdateImageService;
use App\Services\Car\SendCarCreatedNotificationsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CarController extends Controller
{
    public function __construct(
        private CreateableInterface $createCar,
        private UpdateableInterface $updateCar,
        private DeleteableInterface $deleteCar,
        private AddImageService $addImage,
        private UpdateImageService $updateImage,
        private SendCarCreatedNotificationsService $sendNotifications,
        private CheckGateAction $checkGate,
        private UnlinkImageAction $unlinkImage,
    ) {}

    public function index(Request $request): View
    {
        $cars = Car::search($request->search)
            ->with('detail')
            ->paginate(15);

        return view('cars.index', compact('cars'));
    }

    public function create(): View
    {
        return view('cars.create');
    }

    public function store(CarAddRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        $car = $this->createCar->handle($validated);

        $this->addImage->execute($request, $car);

        $this->sendNotifications->execute($car);

        return redirect()->route('cars.index')
            ->with('success', 'მანქანა წარმატებით დაემატა!');
    }

    public function show(Car $car): View
    {
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car): View
    {
        $this->checkGate->handle('update', $car);

        return view('cars.edit', compact('car'));
    }

    public function update(CarUpdateRequest $request, Car $car): RedirectResponse
    {
        $this->checkGate->handle('update', $car);

        $validated = $request->validated();

        $this->updateImage->execute($request, $car, $this->unlinkImage);

        $this->updateCar->handle($car, $validated);

        return redirect()->route('cars.show', $car)
            ->with('success', 'განცხადება განახლდა!');
    }

    public function destroy(Car $car): RedirectResponse
    {
        $this->checkGate->handle('delete', $car);

        $this->unlinkImage->handle($car);

        $this->deleteCar->handle($car);

        return redirect()->route('cars.index')
            ->with('success', 'განცხადება წაიშალა!');
    }
}
