<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <x-admin.section title="Add Bus Route" class="text-white">
            <form action="{{ route('admin.busroutes.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Departure Location -->
                <x-form.input name="departure_location" label="Departure Location" class="bg-gray-700 text-white" />

                <!-- Departure Address -->
                <x-form.textarea name="departure_address" label="Departure Address" class="bg-gray-700 text-white"></x-form.textarea>

                <!-- Departure Date -->
                <div class="space-y-2">
                    <label for="departure_date" class="block text-sm font-medium text-black">Departure Date</label>
                    <input
                        id="departure_date"
                        name="departure_date"
                        type="text"
                        class="mt-1 block w-full rounded-mdtext-white border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        value="{{ old('departure_date', now()->format('Y-m-d\TH:i')) }}"
                    >
                    @error('departure_date')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Arrival Date -->
                <div class="space-y-2">
                    <label for="arrival_date" class="block text-sm font-medium text-black">Arrival Date</label>
                    <input
                        id="arrival_date"
                        name="arrival_date"
                        type="text"
                        class="mt-1 block w-full rounded-mdtext-white border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        value="{{ old('arrival_date', now()->format('Y-m-d\TH:i')) }}"
                    >
                    @error('arrival_date')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Capacity -->
                <x-form.input name="capacity" label="Capacity" type="number" min="1" class="bg-gray-700 text-white" />

                <!-- Price -->
                <x-form.input name="price" label="Price" type="number" step="0.01" class="bg-gray-700 text-white" />

                <!-- Festival Select -->
                <x-form.select name="festival_id" label="Festival" class="bg-gray-700 text-white">
                    @foreach ($festivals as $festival)
                        <option value="{{ $festival->id }}" @selected(old('festival_id') == $festival->id)>{{ $festival->name }}</option>
                    @endforeach
                </x-form.select>

                <!-- Is Active -->
                <x-form.checkbox name="is_active" label="Is Active" class="bg-gray-700 text-white" />

                <!-- Submit Button -->
                <x-form.button class="bg-blue-500 hover:bg-blue-600">Add Bus Route</x-form.button>
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
