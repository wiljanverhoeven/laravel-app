<x-layout>
    <div class="max-w-7xl mx-auto p-6 space-y-10">
        <x-admin.section title="Users & Bookings">
            @foreach ($users as $user)
                <div class="border-b pb-2">
                    <p class="font-semibold">{{ $user->name }} ({{ $user->email }})</p>
                    <ul class="list-disc pl-5">
                        @forelse ($user->bookings as $booking)
                            <li>
                                Festival: {{ $booking->festival->name ?? 'N/A' }},
                                Bus: {{ $booking->busRoute->departure ?? 'N/A' }},
                                Date: {{ $booking->created_at->format('Y-m-d') }}
                            </li>
                        @empty
                            <li>No bookings</li>
                        @endforelse
                    </ul>
                </div>
            @endforeach
        </x-admin.section>

        <x-admin.section title="Manage Festivals">
            <a href="{{ route('admin.festivals.create') }}" class="btn-blue mb-4">Add Festival</a>
            @foreach ($festivals as $festival)
                <div class="bg-gray-100 p-3 rounded mb-2">
                    {{ $festival->name }}
                    <a href="{{ route('admin.festivals.edit', $festival) }}" class="text-blue-500 ml-4">Edit</a>
                </div>
            @endforeach
        </x-admin.section>

        <x-admin.section title="Manage Bus Routes">
            <a href="{{ route('admin.busroutes.create') }}" class="btn-green mb-4">Add Bus Route</a>
            @foreach ($busRoutes as $route)
                <div class="bg-gray-100 p-3 rounded mb-2">
                    {{ $route->departure }} → {{ $route->arrival }} ({{ $route->festival->name ?? 'No Festival' }})
                    <a href="{{ route('admin.busroutes.edit', $route) }}" class="text-green-500 ml-4">Edit</a>
                </div>
            @endforeach
        </x-admin.section>
    </div>
</x-layout>