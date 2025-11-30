@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg shadow-md'
            : 'flex items-center px-4 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-primary-100 hover:text-primary-600 transition-colors duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
