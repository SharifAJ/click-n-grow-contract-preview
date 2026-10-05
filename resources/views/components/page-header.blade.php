@props([
    'title' => 'KisanSAT',
    'subTitle' => '',
])
<div class="rounded-lg bg-gradient-to-r from-green-200 via-emerald-100 to-emerald-200 p-6 text-center shadow-lg">
	<h1 class="my-4 text-2xl font-extrabold sm:text-4xl">{{ $title }}</h1>
	<p class="mt-2 text-base sm:text-lg">{{ $subTitle }}</p>
</div>
