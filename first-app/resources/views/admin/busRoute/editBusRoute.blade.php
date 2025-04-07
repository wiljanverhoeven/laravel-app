<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <x-admin.section title="Edit Bus Route" class="text-white">
            <form action="{{ route('admin.busroutes.update', $busRoute) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Departure Location -->
                <x-form.input name="departure_location" label="Departure Location" :value="$busRoute->departure_location" class="bg-gray-700 text-white" />

                <!-- Departure Address -->
                <x-form.textarea name="departure_address" label="Departure Address" class="bg-gray-700 text-white">{{ $busRoute->departure_address }}</x-form.textarea>

                <!-- Departure Date -->
                <div class="space-y-2">
                    <label for="departure_date" class="block text-sm font-medium text-black">Departure Date</label>
                    <input
                        id="departure_date"
                        name="departure_date"
                        type="text"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        value="{{ old('departure_date', $busRoute->departure_date ? \Carbon\Carbon::parse($busRoute->departure_date)->format('Y-m-d\TH:i') : '') }}"
                        placeholder="Select departure date and time"
                    >
                </div>

                <!-- Arrival Date -->
                <div class="space-y-2">
                    <label for="arrival_date" class="block text-sm font-medium text-black">Arrival Date</label>
                    <input
                        id="arrival_date"
                        name="arrival_date"
                        type="text"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        value="{{ old('arrival_date', $busRoute->arrival_date ? \Carbon\Carbon::parse($busRoute->arrival_date)->format('Y-m-d\TH:i') : '') }}"
                        placeholder="Select arrival date and time"
                    >
                </div>

                <!-- Capacity -->
                <x-form.input name="capacity" label="Capacity" type="number" min="1" :value="$busRoute->capacity" class="bg-gray-700 text-white" />

                <!-- Price -->
                <x-form.input name="price" label="Price" type="number" step="0.01" :value="$busRoute->price" class="bg-gray-700 text-white" />

                <!-- Festival Select -->
                <x-form.select name="festival_id" label="Festival" class="bg-gray-700 text-white">
                    @foreach ($festivals as $festival)
                        <option value="{{ $festival->id }}" @selected($festival->id == $busRoute->festival_id)>{{ $festival->name }}</option>
                    @endforeach
                </x-form.select>

                <!-- Is Active -->
                <x-form.checkbox name="is_active" label="Is Active" :checked="$busRoute->is_active" class="bg-gray-700 text-white" />

                <!-- Submit Button -->
                <x-form.button class="bg-blue-500 hover:bg-blue-600">Update Bus Route</x-form.button>
            </form>

            <!-- Delete Bus Route Form -->
            <form action="{{ route('admin.busroutes.destroy', $busRoute) }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE') <!-- Use DELETE method for destruction -->
                <x-form.button class="bg-red-500 hover:bg-red-600">Delete Bus Route</x-form.button>
            </form>
        </x-admin.section>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // flatpicker for date and time selection
        flatpickr("#departure_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            minuteIncrement: 15
        });

        flatpickr("#arrival_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            minuteIncrement: 15
        });
    });
</script>
