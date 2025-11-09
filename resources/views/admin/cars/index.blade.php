@extends('admin.layout')

@section('title', 'მანქანების მართვა')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">მანქანების სია</h2>
        <a href="{{ route('cars.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
            + ახლის დამატება
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">სურათი</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">მარკა / მოდელი</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">წელი</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ფასი</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">მოქმედებები</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($cars as $car)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="{{ $car->image_url ?: 'https://via.placeholder.com/100x70.png?text=No+Image' }}" alt="Car image" class="w-24 h-16 object-cover rounded">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $car->make }}</div>
                            <div class="text-sm text-gray-500">{{ $car->model }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $car->year }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-600">
                            ${{ number_format($car->price) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('cars.show', $car) }}" class="text-gray-500 hover:text-gray-700 mr-2" title="ნახვა">👁️</a>
                            <a href="{{ route('cars.edit', $car) }}" class="text-indigo-600 hover:text-indigo-900 mr-2" title="რედაქტირება">✏️</a>
                            <form action="{{ route('cars.destroy', $car) }}" method="POST" class="inline-block" onsubmit="return confirm('ნამდვილად გსურთ წაშლა?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="წაშლა">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            მანქანები არ მოიძებნა.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection