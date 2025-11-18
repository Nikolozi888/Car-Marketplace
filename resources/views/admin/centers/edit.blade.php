@extends('layout')

@section('content')
    <h1 class="text-3xl font-bold mb-6">ცენტრის რედაქტირება</h1>

    <x-error-component className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" />

    <form action="{{ route('admin.centers.update', $center->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="center_name" class="block text-sm font-medium text-gray-700">ცენტრის სახელი</label>
                <input type="text" name="center_name" id="center_name"
                    value="{{ old('center_name', $center->center_name) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required>
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">მისამართი</label>
                <input type="text" name="address" id="address" value="{{ old('address', $center->address) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required>
            </div>

            <div>
                <label for="number" class="block text-sm font-medium text-gray-700">ტელეფონის ნომერი</label>
                <input type="text" name="number" id="number" value="{{ old('number', $center->number) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">ელ. ფოსტა</label>
                <input type="email" name="email" id="email" value="{{ old('email', $center->email) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded">
                განახლება
            </button>
        </div>
    </form>
@endsection