<h1>Book Your Festival Bus</h1>

@if($festivals->isEmpty())
    <p>No festivals available for booking.</p>
@else
    <form action="{{ route('Bus') }}" method="POST">
        @csrf

        <label for="festival">Choose a festival:</label>
        <select name="festival_id" id="festival" required>
            @foreach ($festivals as $festival)
                <option value="{{ $festival->id }}">{{ $festival->name }}</option>
            @endforeach
        </select>

        <label for="bus_route">Choose a bus:</label>
        <select name="bus_route_id" id="bus_route" required>
        </select>

        <label for="seats">Number of seats:</label>
        <input type="number" name="seats" id="seats" min="1" required> 

        <button type="submit">Book Now</button>
    </form>

    <script>
        document.getElementById('festival').addEventListener('change', function() {
            const festivalId = this.value;
            const busRouteSelect = document.getElementById('bus_route');
            
            busRouteSelect.innerHTML = '';

            const selectedFestival = @json($festivals).find(festival => festival.id == festivalId);

            if (selectedFestival) {
                const placeholderOption = document.createElement('option');
                placeholderOption.textContent = 'Select a bus';
                placeholderOption.value = '';
                busRouteSelect.appendChild(placeholderOption);
                selectedFestival.bus_routes.forEach(bus => {
                    const option = document.createElement('option');
                    option.value = bus.id;
                    option.textContent = `${bus.departure_location} → ${selectedFestival.name} (${new Date(bus.departure_date).toLocaleDateString()})`;
                    busRouteSelect.appendChild(option);
                });
            }
        });

        document.getElementById('festival').dispatchEvent(new Event('change'));
    </script>
@endif
