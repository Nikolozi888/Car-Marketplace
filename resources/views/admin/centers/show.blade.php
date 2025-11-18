@extends('layout')

@section('content')
    <h1 class="text-3xl font-bold mb-6">ცენტრის დეტალები</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div>
                <h2 class="text-sm font-medium text-gray-600">ცენტრის სახელწოდება</h2>
                <p class="text-lg font-semibold mt-1">{{ $center->center_name }}</p>
            </div>

            <div>
                <h2 class="text-sm font-medium text-gray-600">მისამართი</h2>
                <p class="text-lg font-semibold mt-1">{{ $center->address }}</p>
            </div>

            <div>
                <h2 class="text-sm font-medium text-gray-600">ტელეფონის ნომერი</h2>
                <p class="text-lg font-semibold mt-1">{{ $center->number }}</p>
            </div>

            <div>
                <h2 class="text-sm font-medium text-gray-600">ელ. ფოსტა</h2>
                <p class="text-lg font-semibold mt-1">{{ $center->email }}</p>
            </div>

        </div>

        <div class="mt-6 flex gap-4">
            <a href="{{ route('admin.centers.edit', $center) }}"
               class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded">
                რედაქტირება
            </a>

            <form action="{{ route('admin.centers.destroy', $center) }}" method="POST"
                  onsubmit="return confirm('ნამდვილად გსურთ წაშლა?');">
                @csrf
                @method('DELETE')

                <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded">
                    წაშლა
                </button>
            </form>

            <a href="{{ route('admin.centers.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded">
                უკან დაბრუნება
            </a>
        </div>
    </div>
@endsection
