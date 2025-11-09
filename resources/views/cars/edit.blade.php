@extends('layout')

@section('content')
    <h1 class="text-3xl font-bold mb-6">განცხადების რედაქტირება</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <strong>შეცდომა!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cars.update', $car) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT') 
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="make" class="block text-sm font-medium text-gray-700">მარკა</label>
                <input type="text" name="make" id="make" value="{{ old('make', $car->make) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
            </div>

            <div>
                <label for="model" class="block text-sm font-medium text-gray-700">მოდელი</label>
                <input type="text" name="model" id="model" value="{{ old('model', $car->model) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
            </div>

            <div>
                <label for="year" class="block text-sm font-medium text-gray-700">წელი</label>
                <input type="number" name="year" id="year" value="{{ old('year', $car->year) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">ფასი (USD)</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $car->price) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
            </div>
        </div>

        <div class="mt-6">
            <label for="image" class="block text-sm font-medium text-gray-700">სურათი</label>
            <input type="file" name="image" id="image" accept="image/*"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @if($car->image)
                <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->make }} {{ $car->model }}" class="mt-2 w-64 h-auto object-cover" style="max-height: 300px;">
            @endif
        </div>


        <div class="mt-6">
            <label for="description" class="block text-sm font-medium text-gray-700">აღწერა</label>
            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $car->description) }}</textarea>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded">
                განახლება
            </button>
        </div>
    </form>
@endsection