<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => 'KisanSAT',
    'subTitle' => '',
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
    'title' => 'KisanSAT',
    'subTitle' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>
<div class="rounded-lg bg-gradient-to-r from-green-200 via-emerald-100 to-emerald-200 p-6 text-center shadow-lg">
	<h1 class="my-4 text-2xl font-extrabold sm:text-4xl"><?php echo e($title); ?></h1>
	<p class="mt-2 text-base sm:text-lg"><?php echo e($subTitle); ?></p>
</div>
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\components\page-header.blade.php ENDPATH**/ ?>