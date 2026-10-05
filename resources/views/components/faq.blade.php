@props(['faqs' => [], 'faqvalues' => 'Frequently Asked Questions'])

<div class="container mx-auto max-w-4xl px-4">
    <h2 class="mb-12 text-center text-3xl font-bold text-primary md:text-4xl">
        {{ $faqvalues }}
    </h2>
	
    <div class="space-y-4">
        @foreach ($faqs as $faq)
            <div class="collapse collapse-plus bg-base-100 shadow-sm transition-all hover:shadow-md"
                x-data="{ open: false }" @click="open = !open">
                <input type="checkbox" :checked="open" />
                <div class="collapse-title text-xl font-medium text-gray-700">
                    {{ $faq['question'] }}
                </div>
                <div class="collapse-content">
                    <p class="leading-relaxed text-gray-600">
                        {!! $faq['answer'] !!}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>
