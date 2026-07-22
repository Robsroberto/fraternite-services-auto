@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-md border-gray-700 bg-gray-900 text-gray-200 placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500 text-sm']) }}>
