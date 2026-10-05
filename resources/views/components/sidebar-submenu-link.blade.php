@props(['title', 'icon' => '', 'active' => false])

@php
	$openState = $active ? 'true' : 'false';
@endphp

<li class="whitespace-nowrap" x-data="{ open: {{ $openState }} }">
	<!-- Toggle Button -->
	<button class="flex w-full items-center justify-between px-5 py-5 text-left text-gray-200 hover:bg-gray-600"
		@click="open = !open">
		<div class="flex items-center">
			@if ($icon)
				<i class="{{ $icon }} me-5 text-xl"></i>
			@endif
			<span class="menu-text text-md">{{ $title }}</span>
		</div>
		<!-- Arrow Icon -->
        <i class="fa-solid fa-chevron-down" :class="{ 'rotate-180': open }"></i>
	</button>

	<!-- Submenu -->
	<ul class="mt-2 space-y-2 border-l border-gray-300 pl-8" x-show="open">
		{{ $slot }}
	</ul>
</li>
