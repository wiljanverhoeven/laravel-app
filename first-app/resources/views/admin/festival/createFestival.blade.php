<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <x-admin.section title="Add Festival" class="text-white">
            <form action="{{ route('admin.festivals.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Festival Name -->
                <x-form.input name="name" label="Festival Name" class="bg-gray-700 text-white" />

                <!-- Festival Description -->
                <x-form.textarea name="description" label="Description" class="bg-gray-700 text-white" />

                <!-- Festival Location -->
                <x-form.input name="location" label="Location" class="bg-gray-700 text-white" />
                
                <!-- Start Date -->
                <x-form.input name="start_date" label="Start Date" id="start_date" class="bg-gray-700 text-white" />

                <!-- End Date -->
                <x-form.input name="end_date" label="End Date" id="end_date" class="bg-gray-700 text-white" />

                <!-- Add Festival Button -->
                <x-form.button class="bg-blue-500 hover:bg-blue-600">Add Festival</x-form.button>
            </form>
        </x-admin.section>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // flatpicker for date and time selection
        flatpickr("#start_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            minuteIncrement: 15
        });
        
        flatpickr("#end_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            minuteIncrement: 15
        });
    });
</script>
