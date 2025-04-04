@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-indigo-600 bg-gray-800 text-start text-base font-medium text-gray-200 focus:outline-none  transition duration-150 ease-in-out'
        : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent bg-gray-800 text-start text-base font-medium text-gray-200 hover:text-gray-800  hover:border-gray-300 focus:outline-none focus:text-gray-800 dark:focus:text-gray-200 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>