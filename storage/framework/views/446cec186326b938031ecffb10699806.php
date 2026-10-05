<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'icon' => 'fas fas fa-seedling',
    'iconColor' => 'text-emerald-600',
    'iconSize' => 'text-2xl',
    'bgSize' => 'h-16 w-16',
]));

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

foreach (array_filter(([
    'icon' => 'fas fas fa-seedling',
    'iconColor' => 'text-emerald-600',
    'iconSize' => 'text-2xl',
    'bgSize' => 'h-16 w-16',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="flex items-center">
	<span
		class="<?php echo e($bgSize); ?> flex items-center justify-center rounded-full border-4 border-emerald-50 bg-primary bg-opacity-20 p-2">
		<i class="<?php echo e($icon); ?> <?php echo e($iconColor); ?> <?php echo e($iconSize); ?>"></i>
	</span>
</div>
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\components\icon.blade.php ENDPATH**/ ?>