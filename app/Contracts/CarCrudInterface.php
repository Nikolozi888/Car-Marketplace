<?php

namespace App\Contracts;

use App\Actions\SendMail;
use App\Actions\UnlinkImage;
use App\Http\Requests\CarAddRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

interface CarCrudInterface
{
    public function index(Request $request): View;
    public function create(): View;
    public function store(CarAddRequest $request, SendMail $sendMail): RedirectResponse;
    public function show(Car $car): View;
    public function edit(Car $car): View;
    public function update(CarUpdateRequest $request, Car $car, UnlinkImage $unlink, SendMail $sendMail): RedirectResponse;
    public function destroy(Car $car, UnlinkImage $unlink): RedirectResponse;
}
