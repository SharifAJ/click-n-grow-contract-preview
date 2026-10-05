<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'backgroundImage' => asset('images/hero_placeholder_img2.webp'),
    'afterValue' => '',
    'beforeValue' => '',
    'value' => '',
    'description' => '',
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
    'backgroundImage' => asset('images/hero_placeholder_img2.webp'),
    'afterValue' => '',
    'beforeValue' => '',
    'value' => '',
    'description' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="group card h-72 w-full max-w-sm shadow-xl transition-all hover:scale-105" style="--gradient-stop-2:50%;"
	<?php echo e($attributes); ?>>
	<div
		class="card-body relative flex flex-col justify-end overflow-hidden rounded-2xl bg-cover bg-center px-6 py-3 transition-all duration-500 ease-in-out group-hover:[--gradient-stop-2:100%]"
		style="background-image: linear-gradient(10deg, rgba(2,0,36,0.9) 10%, rgba(0,0,0,0) var(--gradient-stop-2)), url('<?php echo e($backgroundImage); ?>');">

		<div class="card-content transition-all duration-500 ease-in-out">
			<p class="text-lg font-semibold text-white transition-all duration-500 ease-in-out">
				<?php echo e($beforeValue); ?>

			</p>
			<p class="counter mt-1 text-5xl font-black text-white transition-all duration-500 ease-in-out">
				<?php echo e($value); ?>

			</p>
			<p class="counter mt-1 text-lg font-semibold text-white transition-all duration-500 ease-in-out">
				<?php echo e($afterValue); ?>

			</p>
		</div>

		<!-- Smoothly Slide-Up Description -->
		<p
			class="mt-3 max-h-0 overflow-hidden font-medium text-white opacity-0 transition-all duration-500 ease-in-out group-hover:max-h-[100px] group-hover:opacity-100">
			<?php echo e($description); ?>

		</p>
	
	</div>
</div>
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\components\benefit-card.blade.php ENDPATH**/ ?>