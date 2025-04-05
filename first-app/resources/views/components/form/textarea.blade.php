<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <textarea name="{{ $name }}" id="{{ $name }}" rows="4" class="mt-1 block w-full">{{ old($name, $slot) }}</textarea>
</div>