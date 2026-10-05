@props([
    'backgroundImage' => asset('images/hero_placeholder_img2.webp'),
    'step' => '',
    'heading' => '',
    'paragraph' => '',
])

<div class="group relative h-72 w-full max-w-sm overflow-hidden rounded-2xl shadow-xl transition-all hover:scale-105" {{ $attributes }}>
    {{-- Background Image with Gradient --}}
    <div class="h-full w-full bg-cover bg-center transition-all duration-500 ease-in-out opacity-80"
        style="background-image: linear-gradient(10deg, rgba(2,0,36,0.9) 10%, rgba(0,0,0,0) 50%), url('{{ $backgroundImage }}');">
        
       

        {{-- Heading (Always visible) --}}
        <div class="absolute bottom-16 left-0 right-0 px-6">
        <h3 class="text-lg font-bold text-white">{{ $step  }}</h3>
            <h1 class=" text-3xl md:text-4xl  font-bold text-white">{{ $heading }}</h1>
        </div>

        {{-- Paragraph (Visible only on hover) --}}
        <div class="absolute bottom-0 left-0 right-0 px-6 py-3 bg-black/60 backdrop-blur-sm translate-y-full opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 ease-in-out">
            <p class="text-sm text-white">{{ $paragraph }}</p>
        </div>
    </div>
</div>
