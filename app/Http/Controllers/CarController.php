<?php

namespace App\Http\Controllers;

use App\Actions\SendMail;
use App\Actions\UnlinkImage;
use App\Http\Requests\CarAddRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Jobs\SendNotifications;
use App\Mail\CarCreatedMail;
use App\Mail\CarUpdatedMail;
use App\Models\Car;
use App\Models\CarDetail;
use App\Models\Image;
use App\Models\User;
use App\Notifications\CarCreated;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

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
    public function store(CarAddRequest $request, SendMail $sendMail): RedirectResponse
    {
        $validated = $request->validated();

        $validated['user_id'] = Auth::user()->id;
        $car = Car::create($validated);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('photos', 'public');
            // ვქმნით image ჩანაწერს polymorphic კავშირის მიხედვით
            $car->images()->create([
                'path' => $imagePath,
            ]);
        }

        // $user = Auth::user();
        // $sendMail->handle($user->email, new CarCreatedMail($user));

        $users = User::all();

        foreach($users as $person)
        {
            SendNotifications::dispatch($person, $car);
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
        Gate::authorize('update', $car);

        return view('cars.edit', ['car' => $car]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarUpdateRequest $request, Car $car, UnlinkImage $unlink, SendMail $sendMail): RedirectResponse
    {
        Gate::authorize('update', $car);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $unlink->handle($car);
            $validated['image'] = $request->file('image')->store('photos', 'public');
        }

        $car->update($validated);

        $user = Auth::user();
        $sendMail->handle($user->email, new CarUpdatedMail($user));

        return redirect()->route('cars.show', $car)->with('success', 'განცხადება განახლდა!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car, UnlinkImage $unlink): RedirectResponse
    {
        Gate::authorize('delete', $car);

        $unlink->handle($car);

        $car->delete();
        return redirect()->route('cars.index')->with('success', 'განცხადება წაიშალა!');
    }
}