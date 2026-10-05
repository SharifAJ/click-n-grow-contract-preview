@props([
    'icon' => 'fas fa-seedling', // Default icon
    'title' => 'Feature Title', // Default title
    'description' => 'Feature description goes here.', // Default description
    'url' => '#', // Default URL
    'button_name' => 'Learn More',
])

<a class="card transform bg-base-100 shadow-lg transition-transform hover:-translate-y-1 hover:shadow-2xl"
    data-aos="fade-up" data-aos-delay="100" href="{{ $url }}" target="_blank">
    <div class="card-body pt-6">
        <x-icon icon="{{ $icon }}"></x-icon>
        <h3 class="text-xl font-bold">{{ $title }}</h3>
        <p>{{ $description }}</p>
        <button class="link link-primary text-left">{{ $button_name }}</button>

    </div>
</a>
