
<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <input type="text" name="{{ $name }}" id="{{ $name }}" value="{{ $value ?? old($name) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
</div>
