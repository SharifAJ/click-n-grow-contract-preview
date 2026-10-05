@props([
    'icon' => 'fas fas fa-seedling',
    'iconColor' => 'text-emerald-600',
    'iconSize' => 'text-2xl',
    'bgSize' => 'h-16 w-16',
])

<div class="flex items-center">
	<span
		class="{{ $bgSize }} flex items-center justify-center rounded-full border-4 border-emerald-50 bg-primary bg-opacity-20 p-2">
		<i class="{{ $icon }} {{ $iconColor }} {{ $iconSize }}"></i>
	</span>
</div>
