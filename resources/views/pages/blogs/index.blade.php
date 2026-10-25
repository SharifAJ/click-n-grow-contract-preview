<x-guest-layout brand="click-n-grow">
    <main class="bg-stone-50">
        <section class="bg-emerald-900 px-4 py-16 text-center text-white sm:py-20">
            <p class="mb-3 text-sm font-bold uppercase tracking-[0.2em] text-emerald-200">Click-N-Grow</p>
            <h1 class="text-4xl font-extrabold sm:text-5xl">Our Blogs</h1>
            <p class="mx-auto mt-4 max-w-2xl text-lg text-emerald-50">
                Ideas, insights, and stories from the world of farming and medicinal plants.
            </p>
        </section>

        <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            @if ($posts->isEmpty())
                <div class="rounded-2xl bg-white px-6 py-16 text-center shadow-sm">
                    <h2 class="text-2xl font-bold text-gray-900">New stories are on the way</h2>
                    <p class="mt-3 text-gray-600">Please check back soon for articles from Click-N-Grow.</p>
                </div>
            @else
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($posts as $post)
                        <article class="flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">
                            <a class="block aspect-[16/10] overflow-hidden bg-emerald-50"
                                href="{{ route('blogs.show', $post->slug) }}" aria-label="Read {{ $post->title }}">
                                <img class="h-full w-full object-cover transition duration-300 hover:scale-105"
                                    src="{{ asset('storage/' . $post->thumbnail_path) }}"
                                    alt="{{ $post->title }}" loading="lazy">
                            </a>
                            <div class="flex flex-1 flex-col p-6">
                                <p class="text-sm font-semibold text-emerald-700">
                                    {{ $post->published_at?->format('F j, Y') }}
                                </p>
                                <h2 class="mt-2 text-xl font-bold leading-snug text-gray-900">
                                    <a class="hover:text-emerald-800" href="{{ route('blogs.show', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h2>
                                <p class="mt-3 flex-1 leading-relaxed text-gray-600">
                                    {{ $post->excerpt ?: \Illuminate\Support\Str::limit($post->content, 180) }}
                                </p>
                                <a class="mt-5 inline-flex items-center gap-2 font-bold text-emerald-800 hover:text-emerald-950"
                                    href="{{ route('blogs.show', $post->slug) }}">
                                    Read More <span aria-hidden="true">→</span>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="mt-10">{{ $posts->links() }}</div>
            @endif
        </section>
    </main>
</x-guest-layout>
