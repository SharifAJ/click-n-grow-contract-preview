@props(['href', 'class' => ''])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'text-sm link link-hover focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-offset-gray-800 ' . $class]) }}>
    {{ $slot }}
</a>
