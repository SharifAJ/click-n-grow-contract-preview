<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'backgroundImage' => asset('images/hero_placeholder_img2.webp'),
    'step' => '',
    'heading' => '',
    'paragraph' => '',
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
    'step' => '',
    'heading' => '',
    'paragraph' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="group relative h-72 w-full max-w-sm overflow-hidden rounded-2xl shadow-xl transition-all hover:scale-105" <?php echo e($attributes); ?>>
    
    <div class="h-full w-full bg-cover bg-center transition-all duration-500 ease-in-out opacity-80"
        style="background-image: linear-gradient(10deg, rgba(2,0,36,0.9) 10%, rgba(0,0,0,0) 50%), url('<?php echo e($backgroundImage); ?>');">

        
        <div class="absolute bottom-20 left-0 right-0 px-6">
            <h1 class="text-xl font-bold text-white"><?php echo e($step); ?></h1>
            <h2 class="text-lg font-semibold text-white"><?php echo e($heading); ?></h2>
        </div>

        
        <div class="absolute bottom-0 left-0 right-0 px-6 py-3 bg-black/60 backdrop-blur-sm 
                    translate-y-full opacity-0 group-hover:translate-y-0 group-hover:opacity-100 
                    transition-all duration-500 ease-in-out">
            <p class="text-sm text-white"><?php echo e($paragraph); ?></p>
        </div>
    </div>
</div>

<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views/components/model-card.blade.php ENDPATH**/ ?>