<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <x-admin.section title="Edit Festival" class="text-black">
            <form action="{{ route('admin.festivals.update', $festival) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Festival Name -->
                <x-form.input name="name" label="Festival Name" :value="$festival->name" class="bg-gray-700 text-white" />

                <!-- Festival Description -->
                <x-form.textarea name="description" label="Description" class="bg-gray-700 text-white">{{ $festival->description }}</x-form.textarea>

                <!-- Festival Location -->
                <x-form.input name="location" label="Location" :value="$festival->location" class="bg-gray-700 text-white" />

                <!-- Start Date -->
                <x-form.input name="start_date" label="Start Date" id="start_date" :value="$festival->start_date" class="bg-gray-700 text-white" />

                <!-- End Date -->
                <x-form.input name="end_date" label="End Date" id="end_date" :value="$festival->end_date" class="bg-gray-700 text-white" />

                <!-- Update Button -->
                <x-form.button class="bg-blue-500 hover:bg-blue-600">Update Festival</x-form.button>
            </form>

            <!-- Delete Festival Form -->
            <form action="{{ route('admin.festivals.destroy', $festival) }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                <x-form.button class="bg-red-500 hover:bg-red-600">Delete Festival</x-form.button>
            </form>
        </x-admin.section>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        //flatpicker for date and time selection
        flatpickr("#start_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            minuteIncrement: 15,
            mode: 'single',
            theme: 'dark'
        });

        flatpickr("#end_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            minuteIncrement: 15,
            mode: 'single',
            theme: 'dark'
        });
    });
</script>
