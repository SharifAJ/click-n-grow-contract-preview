<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['faqs' => [], 'faqvalues' => 'Frequently Asked Questions']));

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

foreach (array_filter((['faqs' => [], 'faqvalues' => 'Frequently Asked Questions']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="container mx-auto max-w-4xl px-4">
    <h2 class="mb-12 text-center text-3xl font-bold text-primary md:text-4xl">
        <?php echo e($faqvalues); ?>

    </h2>
	
    <div class="space-y-4">
        <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="collapse collapse-plus bg-base-100 shadow-sm transition-all hover:shadow-md"
                x-data="{ open: false }" @click="open = !open">
                <input type="checkbox" :checked="open" />
                <div class="collapse-title text-xl font-medium text-gray-700">
                    <?php echo e($faq['question']); ?>

                </div>
                <div class="collapse-content">
                    <p class="leading-relaxed text-gray-600">
                        <?php echo $faq['answer']; ?>

                    </p>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\components\faq.blade.php ENDPATH**/ ?>