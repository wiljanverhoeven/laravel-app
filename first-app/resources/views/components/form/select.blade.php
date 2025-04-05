<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $name }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
        {{ $slot }}
    </select>
</div>