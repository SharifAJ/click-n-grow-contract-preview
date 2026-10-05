<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['type' => 'success', 'message' => '']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['type' => 'success', 'message' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php if($message): ?>
	<div class="alert-<?php echo e($type); ?> alert flex items-center justify-between rounded-lg p-4 shadow-md" role="alert"
		x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
		x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
		x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
		x-transition:leave-end="opacity-0 scale-90" x-cloak>

		<div class="flex items-center space-x-2">
			<!-- Icon based on type -->
			<?php if($type === 'success'): ?>
				<i class="fas fa-check-circle"></i>
			<?php elseif($type === 'error'): ?>
				<i class="fas fa-times-circle text-red-600"></i>
			<?php elseif($type === 'warning'): ?>
				<i class="fas fa-exclamation-triangle text-yellow-600"></i>
			<?php elseif($type === 'info'): ?>
				<i class="fas fa-info-circle text-blue-600"></i>
			<?php endif; ?>
			<span><?php echo e($message); ?></span>
		</div>

		<!-- Dismiss Button -->
		<button class="btn btn-ghost btn-sm" @click="show = false">✖</button>
	</div>
<?php endif; ?>
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\components\simple-alert.blade.php ENDPATH**/ ?>