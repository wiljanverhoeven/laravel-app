<h1>Book Your Festival Bus</h1>

@if($festivals->isEmpty())
    <p>No festivals available for booking.</p>
@else
    

    <form action="{{ route('booking.store') }}" method="POST">
        @csrf

        <label for="festival">Choose a festival:</label>
        <select name="festival_id" id="festival" required>
            @foreach ($festivals as $festival)
                <option value="{{ $festival->id }}">{{ $festival->name }}</option>
            @endforeach
        </select>

        <label for="bus_route">Choose a bus:</label>
        <select name="bus_route_id" id="bus_route" required>
            <option value="">Select a Route</option>
            @foreach ($festivals as $festival)
                @foreach ($festival->busRoutes as $bus)
                    <option value="{{ $bus->id }}">{{ $bus->departure_location }} → {{ $festival->name }}</option>
                @endforeach
            @endforeach
        </select>

        <label for="seats">Number of seats:</label>
        <input type="number" name="seats" id="seats" min="1" required> 

        <button type="submit">Book Now</button>
    </form>
@endif
