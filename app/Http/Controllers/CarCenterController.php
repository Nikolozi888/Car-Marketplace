<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCenterRequest;
use App\Http\Requests\UpdateCenterRequest;
use App\Models\Center;
use Illuminate\Http\Request;

class CarCenterController extends Controller
{
    public function index()
    {
        $centers = Center::latest()->paginate(10);

        return view('admin.centers.index', compact('centers'));
    }

    public function create()
    {
        return view('admin.centers.create');
    }

    public function store(AddCenterRequest $request)
    {
        $validation = $request->validated();

        Center::create($validation);

        return redirect()->route('admin.centers.index')->with('success', 'ცენტრი წარმატებით დაემატა!');
    }

    public function edit(Center $center)
    {
        return view('admin.centers.edit', compact('center'));
    }

    public function update(Center $center, UpdateCenterRequest $request)
    {
        $validation = $request->validated();

        $center->update($validation);

        return redirect()->route('admin.centers.index')->with('success', 'ცენტრი წარმატებით განახლდა!');
    }

    public function destroy(Center $center)
    {
        $center->delete();

        return redirect()->route('admin.centers.index')->with('success', 'ცენტრი წარმატებით წაიშლა!');
    }

    
}
