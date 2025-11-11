@extends('layout')

@section('content')
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img src="{{ asset('storage/' . $car->image) ?: 'https://via.placeholder.com/1200x600.png?text=No+Image' }}" 
            alt="{{ $car->make }} {{ $car->model }}" 
            class="w-full h-auto object-cover" style="max-height: 500px;">
        
        <div class="p-6">
            <h1 class="text-4xl font-bold text-blue-800 mb-2">{{ $car->make }} {{ $car->model }}</h1>
            <p class="text-gray-700 text-2xl mb-4">{{ $car->year }}</p>
            <p class="text-4xl font-extrabold text-green-600 mb-6">${{ number_format($car->price, 2) }}</p>
            
            <h3 class="text-xl font-semibold mb-2">აღწერა:</h3>
            <p class="text-gray-600 mb-6">
                {{ $car->description ?: 'აღწერა არ არის მითითებული.' }}
            </p>

            <p class="text-gray-600 mb-6">
                {{ $car->user->name }}
                {{ $car->detail->color }}
            </p>    

            <div class="flex space-x-4">
                <a href="{{ route('cars.edit', $car) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded">
                    რედაქტირება
                </a>
                
                <form action="{{ route('cars.destroy', $car) }}" method="POST" onsubmit="return confirm('ნამდვილად გსურთ წაშლა?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded">
                        წაშლა
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection