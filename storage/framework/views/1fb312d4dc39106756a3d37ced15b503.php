<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['href', 'icon', 'text', 'active' => false]));

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

foreach (array_filter((['href', 'icon', 'text', 'active' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $activeClass = $active ? 'bg-emerald-700 text-white' : 'hover:bg-gray-600 text-gray-200';
?>

<li class="whitespace-nowrap">
    <a class="<?php echo e($activeClass); ?> flex items-center px-5 py-5" href="<?php echo e($href); ?>">
        <i class="<?php echo e($icon); ?> me-5 text-xl"></i>
        <span class="menu-text text-md"><?php echo e($text); ?></span>
    </a>
</li>
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\components\sidebar-link.blade.php ENDPATH**/ ?>