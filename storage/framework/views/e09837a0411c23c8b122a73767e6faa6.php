<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['height' => 'h-[26px]', 'width' => 'w-[calc(100%+1.3px)]', 'fill' => 'fill-white']));

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

foreach (array_filter((['height' => 'h-[26px]', 'width' => 'w-[calc(100%+1.3px)]', 'fill' => 'fill-white']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div
	class="custom-shape-divider-top-waves line-height-0 absolute left-0 top-0 w-full rotate-180 transform overflow-hidden">
	<svg class="<?php echo e($height); ?> <?php echo e($width); ?> relative" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
		viewBox="0 0 1200 120" preserveAspectRatio="none">
		<path class="shape-fill <?php echo e($fill); ?>"
			d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z">
		</path>
	</svg>
</div>
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\components\section-divider-top-waves.blade.php ENDPATH**/ ?>