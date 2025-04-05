<x-layout>
    <h1>Choose Your Bus for {{ $festival->name }}</h1>

    <form action="{{ route('booking.store') }}" method="POST">
        @csrf
        <input type="hidden" name="festival_id" value="{{ $festival->id }}">

        <label for="bus_route">Choose a bus:</label>
        <select name="bus_route_id" id="bus_route" required>
            <option value="">Select a Route</option>
            @foreach ($busRoutes as $busRoute)
                <option value="{{ $busRoute->id }}">
                    {{ $busRoute->departure_location }} → {{ $festival->name }}
                    (Arrives: {{ \Carbon\Carbon::parse($busRoute->arrival_date)->format('d M Y, H:i') }})
                </option>
            @endforeach
        </select>

        <label for="seats">Number of seats:</label>
        <input type="number" name="seats" id="seats" min="1" required>

        @error('seats')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <button type="submit">Book Now</button>
    </form>
</x-layout>
