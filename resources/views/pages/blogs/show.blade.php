<x-guest-layout brand="click-n-grow">
    <main class="bg-stone-50">
        <article class="mx-auto max-w-4xl px-4 py-12 sm:px-6">
            <a class="inline-flex items-center gap-2 font-semibold text-emerald-800 hover:text-emerald-950"
                href="{{ route('blogs.index') }}">
                <span aria-hidden="true">←</span> Back to Blogs
            </a>

            <header class="mt-8">
                <p class="text-sm font-bold uppercase tracking-wide text-emerald-700">
                    {{ $post->published_at?->format('F j, Y') }}
                </p>
                <h1 class="mt-3 text-3xl font-extrabold leading-tight text-gray-900 sm:text-5xl">{{ $post->title }}</h1>
            </header>

            <img class="mt-8 aspect-[16/9] w-full rounded-2xl object-cover shadow-sm"
                src="{{ asset('storage/' . $post->thumbnail_path) }}" alt="{{ $post->title }}">

            @if ($post->excerpt)
                <p class="mt-8 text-xl leading-relaxed text-gray-700">{{ $post->excerpt }}</p>
            @endif

            <div class="prose prose-lg mt-8 max-w-none whitespace-pre-line text-gray-800">
                {{ $post->content }}
            </div>
        </article>
    </main>
</x-guest-layout>
