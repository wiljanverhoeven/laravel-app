<x-layout>
    <x-admin.section title="Add Festival">
        <form action="{{ route('admin.festivals.store') }}" method="POST" class="space-y-4">
            @csrf
            <x-form.input name="name" label="Festival Name" />
            <x-form.input name="location" label="Location" />
            <x-form.input name="start_date" label="Start Date" type="date" />
            <x-form.input name="end_date" label="End Date" type="date" />
            <x-form.button>Add Festival</x-form.button>
        </form>
    </x-admin.section>
</x-layout>