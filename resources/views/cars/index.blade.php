@extends('layout')

@section('content')
    
    
    <h1 class="text-3xl font-bold mb-6">მანქანების სია</h1>

    @if($cars->isEmpty())
        <p class="text-gray-600">განცხადებები არ მოიძებნა.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($cars as $car)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ $car->image_url ?: 'https://via.placeholder.com/400x300.png?text=No+Image' }}" alt="{{ $car->make }} {{ $car->model }}" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h2 class="text-2xl font-bold text-blue-700">{{ $car->make }} {{ $car->model }}</h2>
                        <p class="text-gray-600 text-lg mb-2">{{ $car->year }}</p>
                        <p class="text-2xl font-extrabold text-green-600 mb-4">${{ number_format($car->price, 2) }}</p>
                        <a href="{{ route('cars.show', $car) }}" class="inline-block w-full text-center bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            სრულად ნახვა
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        
    @endif
@endsection