<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <input type="checkbox" name="{{ $name }}" id="{{ $name }}" @checked($attributes->get('checked')) class="mt-1">
</div>