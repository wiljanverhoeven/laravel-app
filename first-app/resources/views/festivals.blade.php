@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-4xl font-bold text-center text-white mb-8">Upcoming Festivals</h1>

        @if($festivals->isEmpty())
            <p class="text-center text-lg text-gray-500">No festivals available at the moment.</p>
        @else
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr class="text-left text-sm text-gray-600">
                            <th class="py-3 px-4 border-b">ID</th>
                            <th class="py-3 px-4 border-b">Name</th>
                            <th class="py-3 px-4 border-b">Location</th>
                            <th class="py-3 px-4 border-b">Start Date</th>
                            <th class="py-3 px-4 border-b">End Date</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700">
                        @foreach ($festivals as $item)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="py-3 px-4 border-b">{{ $item->id }}</td>
                                <td class="py-3 px-4 border-b">{{ $item->name }}</td>
                                <td class="py-3 px-4 border-b">{{ $item->location }}</td>
                                <td class="py-3 px-4 border-b">{{ $item->start_date->format('Y-m-d H:i') }}</td>
                                <td class="py-3 px-4 border-b">{{ $item->end_date->format('Y-m-d H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
