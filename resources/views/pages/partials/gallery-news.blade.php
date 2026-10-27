<section class="gallery-news" id="gallery-news" aria-labelledby="gallery-news-title">
    <div class="gallery-news__inner">
        <header class="gallery-news__header">
            <div>
                <p class="gallery-news__eyebrow">From our community</p>
                <h2 id="gallery-news-title">News &amp; Image Gallery</h2>
                <p>Field visits, farmer gatherings, and the latest stories from Click-N-Grow.</p>
            </div>
            <a class="gallery-news__all" href="{{ route('blogs.index') }}">All news <span aria-hidden="true">→</span></a>
        </header>

        <div class="gallery-news__columns">
            <div class="gallery-news__photos" aria-label="Click-N-Grow image gallery">
                @forelse ($galleryItems as $item)
                    <article class="gallery-news__photo">
                        <a href="{{ $item->image_url }}" target="_blank" rel="noopener" aria-label="Open image: {{ $item->title }}">
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy">
                        </a>
                        <div class="gallery-news__photo-caption">
                            <h3>{{ $item->title }}</h3>
                            @if ($item->caption)<p>{{ $item->caption }}</p>@endif
                        </div>
                    </article>
                @empty
                    <p class="gallery-news__empty">Gallery photos will appear here soon.</p>
                @endforelse
            </div>

            <div class="gallery-news__articles" aria-label="Latest news">
                <div class="gallery-news__articles-heading">
                    <h3>Latest stories</h3>
                    <span>Updates &amp; insights</span>
                </div>
                @forelse ($newsPosts as $post)
                    <article class="gallery-news__article">
                        <a class="gallery-news__article-image" href="{{ route('blogs.show', $post->slug) }}">
                            <img src="{{ asset('storage/' . $post->thumbnail_path) }}" alt="{{ $post->title }}" loading="lazy">
                        </a>
                        <div>
                            <time datetime="{{ $post->published_at?->toDateString() }}">{{ $post->published_at?->format('M j, Y') }}</time>
                            <h4><a href="{{ route('blogs.show', $post->slug) }}">{{ $post->title }}</a></h4>
                            <p>{{ $post->excerpt ?: \Illuminate\Support\Str::limit($post->content, 100) }}</p>
                        </div>
                    </article>
                @empty
                    <div class="gallery-news__news-empty">
                        <p>News and articles will be shared here as they are published.</p>
                        <a href="{{ route('blogs.index') }}">Visit the blog <span aria-hidden="true">→</span></a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
