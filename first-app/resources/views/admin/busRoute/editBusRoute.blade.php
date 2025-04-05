<form action="{{ route('admin.busroutes.update', $busRoute) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')
    
    <!-- Departure Location -->
    <x-form.input name="departure_location" label="Departure Location" :value="$busRoute->departure_location" />

    <!-- Departure Address -->
    <x-form.textarea name="departure_address" label="Departure Address">{{ $busRoute->departure_address }}</x-form.textarea>

    <!-- Departure Date -->
    <x-form.input name="departure_date" label="Departure Date" type="datetime-local" :value="$busRoute->departure_date" />

    <!-- Arrival Date -->
    <x-form.input name="arrival_date" label="Arrival Date" type="datetime-local" :value="$busRoute->arrival_date" />

    <!-- Capacity -->
    <x-form.input name="capacity" label="Capacity" type="number" min="1" :value="$busRoute->capacity" />

    <!-- Price -->
    <x-form.input name="price" label="Price" type="number" step="0.01" :value="$busRoute->price" />

    <!-- Festival Select -->
    <x-form.select name="festival_id" label="Festival">
        @foreach ($festivals as $festival)
            <option value="{{ $festival->id }}" @selected($festival->id == $busRoute->festival_id)>
                {{ $festival->name }}
            </option>
        @endforeach
    </x-form.select>

    <!-- Is Active -->
    <x-form.checkbox name="is_active" label="Is Active" :checked="$busRoute->is_active" />

    <!-- Submit Button -->
    <x-form.button>Update Bus Route</x-form.button>
</form>
