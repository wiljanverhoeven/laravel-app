<select {{ $attributes->merge(['class' => 'w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500']) }}>
    {{ $slot }}
</select>