<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title', 'icon' => '', 'active' => false]));

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

foreach (array_filter((['title', 'icon' => '', 'active' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
	$openState = $active ? 'true' : 'false';
?>

<li class="whitespace-nowrap" x-data="{ open: <?php echo e($openState); ?> }">
	<!-- Toggle Button -->
	<button class="flex w-full items-center justify-between px-5 py-5 text-left text-gray-200 hover:bg-gray-600"
		@click="open = !open">
		<div class="flex items-center">
			<?php if($icon): ?>
				<i class="<?php echo e($icon); ?> me-5 text-xl"></i>
			<?php endif; ?>
			<span class="menu-text text-md"><?php echo e($title); ?></span>
		</div>
		<!-- Arrow Icon -->
        <i class="fa-solid fa-chevron-down" :class="{ 'rotate-180': open }"></i>
	</button>

	<!-- Submenu -->
	<ul class="mt-2 space-y-2 border-l border-gray-300 pl-8" x-show="open">
		<?php echo e($slot); ?>

	</ul>
</li>
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\components\sidebar-submenu-link.blade.php ENDPATH**/ ?>