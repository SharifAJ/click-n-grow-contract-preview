@props(['href', 'icon', 'text', 'active' => false])

@php
    $activeClass = $active ? 'bg-emerald-700 text-white' : 'hover:bg-gray-600 text-gray-200';
@endphp

<li class="whitespace-nowrap">
    <a class="{{ $activeClass }} flex items-center px-5 py-5" href="{{ $href }}">
        <i class="{{ $icon }} me-5 text-xl"></i>
        <span class="menu-text text-md">{{ $text }}</span>
    </a>
</li>
