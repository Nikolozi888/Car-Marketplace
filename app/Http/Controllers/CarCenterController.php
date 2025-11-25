<?php

namespace App\Http\Controllers;

use App\Actions\Center\GetCenterAction;
use App\Actions\Center\CreateCenterAction;
use App\Actions\Center\UpdateCenterAction;
use App\Actions\Center\DeleteCenterAction;
use App\Http\Requests\AddCenterRequest;
use App\Http\Requests\UpdateCenterRequest;
use App\Models\Center;
use App\Notifications\CenterCreated;
use App\Notifications\CenterUpdated;
use Illuminate\Support\Facades\Auth;

class CarCenterController extends Controller
{
    public function __construct(
        private GetCenterAction $getCenter,
        private CreateCenterAction $createCenter,
        private UpdateCenterAction $updateCenter,
        private DeleteCenterAction $deleteCenter
    ) {}

    public function index()
    {
        $centers = $this->getCenter->handle();

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

        Auth::user()->notify(new CenterCreated($center));

        return redirect()
            ->route('admin.centers.index')
            ->with('success', 'ცენტრი წარმატებით დაემატა!');
    }

    public function edit(Center $center)
    {
        return view('admin.centers.edit', compact('center'));
    }

    public function update(Center $center, UpdateCenterRequest $request)
    {
        $validated = $request->validated();

        $this->updateCenter->handle($center, $validated);

        Auth::user()->notify(new CenterUpdated($center));

        return redirect()
            ->route('admin.centers.index')
            ->with('success', 'ცენტრი წარმატებით განახლდა!');
    }

    public function destroy(Center $center)
    {
        $this->deleteCenter->handle($center);

        return redirect()
            ->route('admin.centers.index')
            ->with('success', 'ცენტრი წარმატებით წაიშალა!');
    }
}
