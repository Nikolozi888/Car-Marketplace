@extends('admin.layout')

@section('title', 'ცენტრების მართვა')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">ცენტრების სია</h2>
        <a href="{{ route('admin.centers.create') }}"
            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
            + ახლის დამატება
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">დასახელება
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">მისამართი
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ნომერი</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ფოსტა</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">მოქმედებები</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($centers as $center)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $center->center_name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $center->address }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $center->number }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $center->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.centers.edit', $center) }}" class="text-indigo-600 hover:text-indigo-900 mr-2"
                                title="რედაქტირება">✏️</a>
                            <form action="{{ route('admin.centers.destroy', $center) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('ნამდვილად გსურთ წაშლა?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="წაშლა">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            ცენტრები არ მოიძებნა.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection