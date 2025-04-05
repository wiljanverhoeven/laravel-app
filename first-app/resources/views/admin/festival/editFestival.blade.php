<x-layout>
    <x-admin.section title="Edit Festival">
        <form action="{{ route('admin.festivals.update', $festival) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <x-form.input name="name" label="Festival Name" :value="$festival->name" />
            <x-form.input name="location" label="Location" :value="$festival->location" />
            <x-form.input name="start_date" label="Start Date" type="date" :value="$festival->start_date" />
            <x-form.input name="end_date" label="End Date" type="date" :value="$festival->end_date" />
            <x-form.button>Update Festival</x-form.button>
        </form>
    </x-admin.section>
</x-layout>