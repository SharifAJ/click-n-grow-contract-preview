@props(['type' => 'success', 'message' => ''])

@if ($message)
	<div class="alert-{{ $type }} alert flex items-center justify-between rounded-lg p-4 shadow-md" role="alert"
		x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
		x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
		x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
		x-transition:leave-end="opacity-0 scale-90" x-cloak>

		<div class="flex items-center space-x-2">
			<!-- Icon based on type -->
			@if ($type === 'success')
				<i class="fas fa-check-circle"></i>
			@elseif ($type === 'error')
				<i class="fas fa-times-circle text-red-600"></i>
			@elseif ($type === 'warning')
				<i class="fas fa-exclamation-triangle text-yellow-600"></i>
			@elseif ($type === 'info')
				<i class="fas fa-info-circle text-blue-600"></i>
			@endif
			<span>{{ $message }}</span>
		</div>

		<!-- Dismiss Button -->
		<button class="btn btn-ghost btn-sm" @click="show = false">✖</button>
	</div>
@endif
