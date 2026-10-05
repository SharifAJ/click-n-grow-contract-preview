@props(['active'])

@php
    $classes = $active ?? false ? 'text-gray-200' : 'text-gray-400';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
