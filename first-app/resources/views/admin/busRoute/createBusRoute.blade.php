<x-layout>
    <x-admin.section title="Add Bus Route">
        <form action="{{ route('admin.busroutes.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <!-- Departure Location -->
            <x-form.input name="departure_location" label="Departure Location" />

            <!-- Departure Address -->
            <x-form.textarea name="departure_address" label="Departure Address"></x-form.textarea>

            <!-- Departure Date -->
            <x-form.input name="departure_date" label="Departure Date" type="datetime-local" />

            <!-- Arrival Date -->
            <x-form.input name="arrival_date" label="Arrival Date" type="datetime-local" />

            <!-- Capacity -->
            <x-form.input name="capacity" label="Capacity" type="number" min="1" />

            <!-- Price -->
            <x-form.input name="price" label="Price" type="number" step="0.01" />

            <!-- Festival Select -->
            <x-form.select name="festival_id" label="Festival">
                @foreach ($festivals as $festival)
                    <option value="{{ $festival->id }}">{{ $festival->name }}</option>
                @endforeach
            </x-form.select>

            <!-- Is Active -->
            <x-form.checkbox name="is_active" label="Is Active" />

            <!-- Submit Button -->
            <x-form.button>Add Bus Route</x-form.button>
        </form>
    </x-admin.section>
</x-layout>
