<?php

namespace App\Http\Controllers;

use App\Actions\Center\GetCenterAction;
use App\Contracts\Actions\CreateableInterface;
use App\Contracts\Actions\DeleteableInterface;
use App\Contracts\Actions\UpdateableInterface;
use App\Contracts\Repositories\CenterRepositoryInterface;
use App\Events\Center\CenterDeleted;
use App\Http\Requests\AddCenterRequest;
use App\Http\Requests\UpdateCenterRequest;
use App\Models\Center;
use App\Events\Center\CenterCreated as CenterCreatedEvent;
use App\Notifications\CenterCreated;
use App\Notifications\CenterUpdated;
use App\Repositories\CenterRepository;
use Illuminate\Support\Facades\Auth;

class CarCenterController extends Controller
{
    public function __construct(
        // private GetCenterAction $getCenter,
        private CreateableInterface $createCenter,
        // private UpdateableInterface $updateCenter,
        // private DeleteableInterface $deleteCenter
        private CenterRepositoryInterface $centerRepository
    ) {}

    public function index()
    {
        $centers = $this->centerRepository->getPaginatedCenters();

        return view('admin.centers.index', compact('centers'));
    }

    public function create()
    {
        return view('admin.centers.create');
    }

    public function store(AddCenterRequest $request)
    {
        $validated = $request->validated();

        $center = $this->createCenter->handle($validated);

        // notification არის Observer-ში

        event(new CenterCreatedEvent($center));

        return $this->successRedirect('admin.centers.index', 'ცენტრი წარმატებით დაემატა!');
    }

    public function edit(Center $center)
    {
        return view('admin.centers.edit', compact('center'));
    }

    public function update(Center $center, UpdateCenterRequest $request)
    {
        $validated = $request->validated();

        $this->centerRepository->updateCenter($center, $validated);

        // notification არის Observer-ში

        // event არის observer-ში

        return $this->successRedirect('admin.centers.index', 'ცენტრი წარმატებით განახლდა!');
    }

    public function destroy(Center $center)
    {
        $this->centerRepository->deleteCenter($center);

        event(new CenterDeleted($center));

        return $this->successRedirect('admin.centers.index', 'ცენტრი წარმატებით წაიშალა!');
    }
}
